<?php namespace Terranet\Administrator;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Auth\Guard AS AuthGuard;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Terranet\Administrator\Filters\FilterInterface;
use Terranet\Administrator\Traits\CallableTrait;

class ControllerAbstract extends Controller
{
    use CallableTrait, ValidatesRequests;

    protected $user;

    protected $application;

    /**
     * @var int Items on page
     */
    protected $perPage;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $eloquent;

    /**
     * Scaffolding configuratino
     *
     * @var
     */
    protected $settings;

    /**
     * Current module factory
     *
     * @var mixed
     */
    protected $module;

    /**
     * Current controller name
     *
     * @var
     */
    protected $controller;

    /**
     * Current action name
     *
     * @var
     */
    protected $action;

    /**
     * Filter factory
     *
     * @var mixed|FilterInterface
     */
    protected $filter;

    /**
     * Fields factory
     *
     * @var
     */
    protected $editableFields;

    /**
     * Events dispatcher
     *
     * @var Dispatcher
     */
    protected $events;

    /**
     * Eloquent schema for current model
     *
     * @var \Terranet\Administrator\Schema\Factory
     */
    protected $schema;

    public function __construct(Application $application, AuthGuard $user)
    {
        //dd(\Route::current());
        $this->application = $application;

        if (! $this->module = $application['scaffold.module']) {
            return ;
        }

        $this->user = $user;

        Repository::unguard();

        $this->initRepository();

        // get current mvc vars
        $this->controller = $this->module ? $this->module->get('page') : 'default';
        $this->action     = $this->getCurrentRouteAction();

        switch ($this->action)
        {
            case 'index':
            case 'getIndex':
            case 'postIndex':
                $this->initPagination(
                    $this->getScaffoldConfig()
                );

                if ($queryBuilder = $this->module->get('query'))
                {
                    Repository::setScaffoldQueryBuilder($queryBuilder);
                }

                if ($with  = $this->module->get('with'))
                {
                    Repository::setScaffoldQueryWith($with);
                }

                if ($this->filter = $application['scaffold.filter'])
                {
                    Repository::setScaffoldFilter($this->filter);
                }

                Repository::setScaffoldSortable(app('scaffold.sortable'));

                break;

            case 'update';
                $this->schema = $this->application->make('scaffold.schema');
                $this->eloquent->setSchema($application['scaffold.schema']);
                break;
        }

        $this->events = $application['events'];
    }

    protected function getCurrentRouteAction()
    {
        if (! $this->action)
        {
            list(/*$controller*/, $this->action) = explode('@', Route::currentRouteAction());
        }

        return $this->action;
    }

    /**
     * @param $settings
     */
    protected function initPagination(Config $settings)
    {
        $this->perPage = (int) (($this->module && $this->module->has('rows_per_page')) ? $this->module->get('rows_per_page') : $settings->get('rows_per_page', 15));
    }

    /**
     * @return mixed
     * @internal param Application $application
     */
    protected function initRepository()
    {
        $this->eloquent = $this->application->make('scaffold.model');

        if ($this->eloquent)
        {
            $this->eloquent->unguard();
        }
    }

    /**
     * @return mixed
     * @internal param Application $application
     */
    protected function getScaffoldConfig()
    {
        if (null === $this->settings)
            $this->settings = $this->application->make('scaffold.config');

        return $this->settings;
    }
}