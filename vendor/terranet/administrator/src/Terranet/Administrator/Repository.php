<?php namespace Terranet\Administrator;

use App;
use Request;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Terranet\Administrator\Contracts\Queryable;
use Terranet\Administrator\Filters\FilterInterface;
use Terranet\Administrator\Form\Element;
use Terranet\Administrator\Schema\SchemaInterface;

abstract class Repository extends Eloquent implements RepositoryInterface
{
    protected $schema = null;

    private static $scaffoldQueryBuilder = null;

    private static $scaffoldQueryWith = null;

    /**
     * @var null|FilterInterface
     */
    private static $filter = null;

    /**
     * @var null
     */
    private static $sortable = null;

    /**
     * @var null|\Illuminate\Database\Eloquent\Builder
     */
    protected $query = null;

    public function setSchema(SchemaInterface $schema)
    {
        $this->schema = $schema->describe($this->getTable());

        return $this;
    }

    /**
     * @param null $scaffoldQueryWith
     * @return $this
     */
    public static function setScaffoldQueryWith($scaffoldQueryWith)
    {
        self::$scaffoldQueryWith = $scaffoldQueryWith;
    }

    /**
     * Inject the scaffold Query Builder
     *
     * @param null $scaffoldQueryBuilder
     * @return $this
     */
    public static function setScaffoldQueryBuilder($scaffoldQueryBuilder)
    {
        self::$scaffoldQueryBuilder = $scaffoldQueryBuilder;
    }

    /**
     * Set the scaffold Filter factory
     *
     * @param FilterInterface $filter
     */
    public static function setScaffoldFilter(FilterInterface $filter)
    {
        self::$filter = $filter;
    }

    public static function setScaffoldSortable(Sortable $sortable)
    {
        self::$sortable = $sortable;
    }

    /**
     * Get index page results
     *
     * @param int $perPage
     * @return mixed
     */
    public function indexResults($perPage = 20)
    {
        return $this
            ->_buildIndexQuery()
            ->paginate($perPage);
    }

    /**
     * Find row by its ID
     *
     * @param $id
     * @return mixed
     */
    public function findRowByID($id)
    {
        $row = $this->findOrNew($id);

        Element::setRepository($row);

        return $row;
    }

    public function getSettings($group)
    {
        return $this->where("group", '=', $group)->orderBy('key')->get();
    }

    /**
     * Build Scaffolding Index page query
     *
     * @return mixed
     */
    protected function _buildIndexQuery()
    {
        $this->query = $this->newQuery();

        $this->query->select($this->getTable() . '.*');

        $this->handleQueryBuilderStatement();

        $this->handleWithStatement();

        $this->handleFilter();

        $this->handleSortable();

        return $this->query;
    }

    /**
     * @internal param $query
     */
    protected function handleQueryBuilderStatement()
    {
        if (($queryBuilder = self::$scaffoldQueryBuilder) && $subQuery = call_user_func($queryBuilder, $this->query)) {
            $this->query = $subQuery;
        }
    }

    /**
     * @internal param $query
     */
    protected function handleWithStatement()
    {
        if ($with = self::$scaffoldQueryWith) {
            $this->query->with($with);
        }
    }

    protected function handleFilter()
    {
        if ($filter = self::$filter) {
            foreach ($filter->getElements() as $element) {
                // do not apply filter if no request var were found.
                if (! Request::has($element->getName())) {
                    continue;
                }

                if ($element->hasQuery() && $subQuery = $element->execQuery($this->query, $element->getValue())) {
                    $this->query = $subQuery;
                } else {
                    $this->handleDefaultFilterQuery($element);
                }
            }
        }
    }

    /**
     * @param Queryable $element
     * @throws Exception
     * @internal param $query
     * @internal param $table
     * @internal param $type
     * @internal param $name
     * @internal param $value
     */
    protected function handleDefaultFilterQuery(Queryable $element)
    {
        $table = $this->getTable();
        $type = $element->getType();
        $name = $element->getName();
        $value = urldecode($element->getValue());

        if ($this->schema && ! $this->schema->has($element->getName())) {
            throw new Exception(sprintf("Can not filter by [%s], because it not a [%s] column. Use [query] option to apply custom filters.", $element->getName(), $table));
        }

        switch ($type) {
            case 'text':
                $this->query->where("{$table}.{$name}", 'LIKE', "%{$value}%");
                break;

            case 'select':
            case 'multiselect':
                if (! is_array($value)) {
                    $value = [$value];
                }
                $this->query->whereIn("{$table}.{$name}", $value);
                break;

            case 'bool':
            case 'number':
                $this->query->where("{$table}.{$name}", '=', (int) $value);
                break;

            case 'date':
                $this->query->whereDate("{$table}.{$name}", '=', $value);
                break;

            case 'daterange':
                list($date_from, $date_to) = explode(' - ', $value);
                $this->query->whereBetween("{$table}.{$name}", [$date_from, $date_to]);
                break;
        }
    }

    /**
     * Extend query with Order By Statement
     */
    private function handleSortable()
    {
        $element = self::$sortable->getElement();
        $direction = self::$sortable->getDirection();

        if ($element && $direction) {
            $column = app('scaffold.columns')->getColumn($element);

            if ($column && $column->hasQuery()) {
                $column->execQuery($this->query, $direction);
            } else if (is_string($element)) {
                $this->query->orderBy($element, $direction);
            }
        }
    }
}