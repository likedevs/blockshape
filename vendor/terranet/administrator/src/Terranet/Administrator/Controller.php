<?php namespace Terranet\Administrator;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Request as HttpRequest;
use Session;
use Terranet\Administrator\Exceptions\PermissionDeniedException;
use Terranet\Administrator\Form\Element;
use Terranet\Administrator\Form\Resizable;
use Terranet\Administrator\Form\TranslatableElement;
use Terranet\Administrator\Form\Type\Key;
use Terranet\Administrator\Form\Uploadable;
use URL;

class Controller extends ControllerAbstract
{
    public function index()
    {
        $this->registerAuditAction(HttpRequest::all());

        $items = [];

        if ($this->eloquent) {
            $items = $this->eloquent->indexResults($this->perPage = 10);
        }

        return view('administrator::index', ['items' => $items, 'total' => $items->total(), 'count' => $items->count()]);
    }

    private function registerAuditAction($arguments = null)
    {
        $this->events->fire('admin.performAction', [$this->user, "{$this->controller}.{$this->action}", $arguments]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($page, $id = null)
    {
        $this->eloquent = $this->eloquent->findRowByID($id);

        $this->checkActionPermissions(null, $this->eloquent);

        if ($this->eloquent) {
            Element::setRepository($this->eloquent);
        }

        $this->registerAuditAction($this->eloquent);

        $this->rememberPreviousPage();

        return view('administrator::edit', ['item' => $this->eloquent]);
    }

    protected function checkActionPermissions($action = null, $model = null)
    {
        // get current action if not provided
        if (! $action) {
            $action = $this->action;
        }

        $actionFactory = $this->application['scaffold.actions'];
        $actions = $actionFactory->getActions($model)->merge(
            $actionFactory->getGlobalActions($model)
        );

        if (! $actions->has($action)) {
            throw new PermissionDeniedException('Sorry, but you haven\'t permissions to perform this operation', 403);
        }
    }

    /**
     * Remember previous page
     */
    public function rememberPreviousPage()
    {
        Session::set('admin_previous_url', URL::previous());
    }

    public function update(UpdateRequest $request = null, $page, $id = 0)
    {
        $this->eloquent = $this->eloquent->findRowByID($id);

        $this->checkActionPermissions('edit', $this->eloquent);

        $this->registerAuditAction($this->eloquent);

        /*
        |-------------------------------------------------------
        | Data separation
        |-------------------------------------------------------
        |
        | Separate Images & Files from overall data that should
        | be saved.
        |
        */
        list($files, $images) = $this->decoupleMediaFromData();

        $relations = [];

        foreach ($this->getEditableFields() as $field) {
            $name = $field->getName();

            if ($this->isKeyField($field)) {
                continue;
            }

            // do not process media files
            if ($this->isMediaField($name, $files, $images) || $this->isTranslatableField($field)) {
                continue;
            }

            if ($field instanceof HasOne && $field->hasRelation()) {
                $relations[$name] = [
                    'value'    => \Input::get($name),
                    'field'    => $field,
                    'relation' => $field->loadRelation()
                ];
            } else if ($field->hasRelation()) {
                $relations[$name] = [
                    'value'    => \Input::get($name),
                    'field'    => $field,
                    'relation' => $field->loadRelation()
                ];
            } else {
                $value = $this->nullifyEmptyValues($name, $request->get($name));

                $data[$name] = $value;
            }
        }

        // append translatable fields
        foreach ($request->all() as $key => $value) {
            if (is_numeric($key)) {
                // remove translatable fields from main array whic
                //$data = array_except($data, array_keys($value));

                $data[$key] = $value;
            }
        }

        if ($appendableQueryString = $this->module->get('append_query_string', [])) {
            $data = array_merge($data, $request->only($appendableQueryString));
        }

        $data = $this->cleanData($data);

        /*
        |-------------------------------------------------------
        | Save main data
        |-------------------------------------------------------
        */
        $this->eloquent->fill($data)->save();

        /*
        |-------------------------------------------------------
        | Relationships
        |-------------------------------------------------------
        |
        | Save related data, fetched by "relation" from related tables
        |
        */
        $this->processRelations($relations);

        /*
        |-------------------------------------------------------
        | Process Files / Images
        |-------------------------------------------------------
        |
        | Image & Files processing. In order to use current row,
        | do it after main data saving.
        |
        */
        $files = $this->processFiles($files);
        $images = $this->processImages($images);
        $media = array_merge($files, $images);

        if (! empty($media)) {
            $this->eloquent->fill($media)->save();
        }

        return $this->getAfterUpdateRedirect($page, $this->eloquent->id)->with('messages', ['Item has been saved.']);
    }

    /**
     * @return array
     */
    protected function decoupleMediaFromData()
    {
        $files = $images = [];

        $factory = $this->application->make('scaffold.fields');

        foreach ($factory->getFields() as $field) {
            if ($field instanceof Uploadable && ($name = $field->getName())) {
                if ($field instanceof Resizable) {
                    $images[$name] = $field;
                } else {
                    $files[$name] = $field;
                }
            }
        }

        return [$files, $images];
    }

    protected function getEditableFields()
    {
        return $this->application['scaffold.fields']->getFields();
    }

    /**
     * @param $field
     * @return bool
     */
    protected function isKeyField($field)
    {
        return $field instanceof Key;
    }

    /**
     * @param $name
     * @param $files
     * @param $images
     * @return bool
     */
    private function isMediaField($name, $files, $images)
    {
        return array_key_exists($name, $files) || array_key_exists($name, $images);
    }

    /**
     * @param $field
     * @return bool
     */
    private function isTranslatableField($field)
    {
        return $field instanceof TranslatableElement;
    }

    /**
     * prevent constraint errors on saving empty ("") nullable values
     *
     * @param $name
     * @return mixed|null
     */
    protected function nullifyEmptyValues($name, $value = '')
    {
        if (! $value && $this->schema) {
            try {
                $element = $this->schema->get($name);
                if ($element->isNullable()) {
                    $value = null;
                }
            } catch (\Exception $e) {
            }
        }

        return $value;
    }

    /**
     * @param $data
     * @return array
     */
    protected function cleanData($data)
    {
        $data = array_except($data, ['_token', 'save', 'save_create', 'save_return', $this->eloquent->getKeyName()]);

        return $data;
    }

    private function processRelations($relations)
    {
        foreach ($relations as $name => $relation) {
            $row = $relation['relation'];

            $data = [$name => $relation['value']];

            if ($row instanceof BelongsToMany) {
                $row->sync((array) $data[$name]);
            } else {
                $first = $row->first() ?: $row->create([]);
                $first->fill($data)->save();
            }
        }
    }

    /**
     *
     * @param $files
     * @return array
     */
    protected function processFiles($files)
    {
        $uploaded = [];

        /**
         * @var $fileInfo \SplFileInfo
         * @var $file     Uploadable
         */
        foreach ($files as $key => $file) {
            if ($fileInfo = $file->upload()) {
                $file->destroy();

                if ($file->hasRelation()) {
                    $model = $this->resolveFileSaveModel($file);

                    $model->fill([
                        $key => str_replace(base_path('public'), '', $fileInfo->getPathname())
                    ])->save();
                } else {
                    $uploaded[$key] = str_replace(base_path('public'), '', $fileInfo->getPathname());
                }
            }
        }

        return $uploaded;
    }

    /**
     * @param $file
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function resolveFileSaveModel($file)
    {
        $model = $this->eloquent;

        if ($relation = $file->getRelation()) {
            list($table/*, $field*/) = explode('.', $relation);

            $model = $this->eloquent->$table();
            if ($first = $model->first()) {
                $model = $first;
            } else {
                list(/*$_table*/, $foreignKey) = explode('.', $model->getForeignKey());
                $parent = $model->getParent();
                $model = $model->getRelated();

                $model->{$foreignKey} = $parent->{$parent->getKeyName()};
            }
        }

        return $model;
    }

    /**
     * @param $images
     * @return array
     */
    protected function processImages($images)
    {
        $uploaded = [];

        /**
         * @var $imageInfo \SplFileInfo
         * @var $image     Uploadable|Resizable
         */
        foreach ($images as $key => $image) {
            // if no sizes specified => proceed like with regular files
            if (true) {
                if (! $image->hasSizes()) {
                    if ($imageInfo = $image->upload()) {
                        // remove previous image
                        $image->destroy();

                        $uploaded[$key] = str_replace(base_path('public'), '', $imageInfo->getPathname());
                    }
                } else {
                    if ($reSizedImages = $image->resize()) {
                        // how to save images
                        $saveAsMap = $image->getAliases();

                        $model = $this->resolveFileSaveModel($image);

                        $data = [];
                        foreach ($reSizedImages as $name => $imageInfo) {
                            // remove previous images
                            if (isset($model->$name) && ! empty($model->$name)) {
                                $image->destroy($model->$name);
                            }

                            if ($this->isFillable($model, $name)) {
                                $path = $this->isAliased($saveAsMap, $name)
                                    ? str_replace(base_path('public'), '',
                                        $reSizedImages[$saveAsMap[$name]]->getPathname())
                                    : str_replace(base_path('public'), '', $imageInfo->getPathname());

                                $data[$name] = $path;
                            }
                        }
                        $model->fill($data)->save();
                    }
                }
            }
        }

        return $uploaded;
    }

    /**
     * @param $model
     * @param $name
     * @return bool
     */
    protected function isFillable($model, $name)
    {
        return in_array($name, $model->getFillable());
    }

    /**
     * @param $saveAsMap
     * @param $name
     * @return bool
     */
    protected function isAliased($saveAsMap, $name)
    {
        return ! empty($saveAsMap) && isset($saveAsMap[$name]);
    }

    protected function getAfterUpdateRedirect($page, $id = null)
    {
        $queryString = $this->detectQueryString()->toString();

        if (\Input::get('save')) {
            return redirect(route('admin_model_edit', ['page' => $page, 'id' => $id]) . $queryString);
        } else if (\Input::get('save_return')) {
            if ($previous = $this->getPreviousUrl()) {
                $this->forgetPreviousUrl();

                return redirect()->to($previous);
            }

            return redirect(route('admin_model_index', ['page' => $page]) . $queryString);
        }

        return redirect(route('admin_model_create', ['page' => $page]) . $queryString);
    }

    /**
     * Detect appendable query string
     *
     * @return QueryString
     */
    protected function detectQueryString()
    {
        static $queryString = null;

        if (is_null($queryString) && ! empty($queryString = $this->module->get('append_query_string', []))) {
            $queryString = HttpRequest::only($queryString);
        }
        $queryString = new QueryString($queryString);

        return $queryString;
    }

    /**
     * Get previous page
     *
     * @return mixed
     */
    protected function getPreviousUrl()
    {
        return session('admin_previous_url');
    }

    /**
     * Forget previous url
     */
    protected function forgetPreviousUrl()
    {
        Session::forget('admin_previous_url');
    }

    public function create(Request $request)
    {
        $this->checkActionPermissions(null, $this->eloquent);

        $this->registerAuditAction();

        return view('administrator::edit', $request->all());
    }

    public function delete($page, $id)
    {
        $item = $this->eloquent->findRowByID($id);

        $this->checkActionPermissions(null, $item);

        /**
         * @var $action \Terranet\Administrator\Actions\Action
         */
        $actionFactory = $this->application['scaffold.actions'];
        $actions = $actionFactory->getActions($item);

        if ($deleteCallback = $actions->get('delete')) {
            $deleteCallback->executeCallback($item);
        }

        if ($item->delete()) {
            $this->registerAuditAction($item);

            return redirect()->back()->with('messages', ['Item was removed successfully']);
        }

        return redirect()->back()->withErrors(['An error occurred during Item deletion...']);
    }

    public function custom($page, $id, $action)
    {
        $this->checkActionPermissions($action);

        $actionFactory = $this->application['scaffold.actions'];
        $actions = $actionFactory->getActions();
        $queryString = $this->detectQueryString()->toString();

        if ($callback = $actions->get($action)) {
            $this->eloquent = $this->eloquent->findRowByID($id);

            $callback->executeCallback($this->eloquent, []);

            $this->registerAuditAction();

            return redirect(route('admin_model_index', ['page' => $page]) . $queryString)->with('messages',
                ['Request processed successfully']);
        }

        return redirect(route('admin_model_index', ['page' => $page]) . $queryString)
            ->withErrors(['An error occurred during request processing...']);
    }

    public function customGlobal($page)
    {
        $action = HttpRequest::get('action');

        $this->checkActionPermissions($action);

        /**
         * @var $action \Terranet\Administrator\Actions\Action
         */
        $actionFactory = $this->application['scaffold.actions'];
        $actions = $actionFactory->getGlobalActions();
        $queryString = $this->detectQueryString()->toString();

        if ($customCallback = $actions->get($action)) {
            $payload = HttpRequest::except(['action', '_token']);

            $customCallback->executeCallback($this->eloquent, $payload);

            $this->registerAuditAction();

            return redirect(route('admin_model_index', ['page' => $page]) . $queryString)->with('messages',
                ['Request processed successfully']);
        }

        return redirect(route('admin_model_index',
                ['page' => $page]) . $queryString)->withErrors(['An error occurred during request processing...']);
    }

    /**
     * List settings by selected group [according to settings page name]
     *
     * @param $group
     * @return $this
     */
    public function listSettings($group)
    {
        $settings = $this->eloquent->getSettings($group);

        return view('administrator::settings')->with('settings', $settings);
    }

    /**
     * Save settings per page
     *
     * @param null $group
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveSettings($group = null, UpdateRequest $request)
    {
        $data = $this->cleanData($request->all());

        foreach ($data as $key => $value) {
            $this->eloquent->updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
        }

        return back()->with('messages', ['Settings saved successfully']);
    }

    public function dashboard()
    {
        return "@todo: not implemented yet.";
    }
}
