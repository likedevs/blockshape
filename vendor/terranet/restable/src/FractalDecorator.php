<?php namespace Terranet\Restable;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\MessageBag;
use Illuminate\Contracts\Support\MessageProvider AS MessageProviderInterface;
use Illuminate\Support\Facades\Response as LaravelResponse;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Terranet\Restable\Contracts\SelfRendered;

class FractalDecorator implements SelfRendered
{

    /**
     * @var SelfRendered
     */
    private $selfRendered;
    /**
     * @var Manager
     */
    private $fractalManager;

    /**
     * @param SelfRendered $selfRendered
     * @param Manager $fractalManager
     */
    public function __construct(SelfRendered $selfRendered, Manager $fractalManager)
    {
        $this->selfRendered = $selfRendered;
        $this->fractalManager = $fractalManager;
    }

    /**
     * Response listing.
     *
     * @param  mixed array|object $collection
     * @param null $transformer
     * @return string
     */
    public function listing($collection, $transformer = null)
    {
        return $this->selfRendered->listing(
            $this->fractalCollection($collection, $transformer)
        );
    }

    /**
     * Response single.
     *
     * @param array $object $object
     * @param null $transformer
     * @return string
     */
    public function single($object, $transformer = null)
    {
        return $this->selfRendered->single(
            $this->fractalItem($object, $transformer)
        );
    }

    /**
     * Response created.
     *
     * @param array $object
     * @param null $transformer
     * @return string
     */
    public function created($object, $transformer = null)
    {
        return $this->selfRendered->created(
            $this->fractalItem($object, $transformer)
        );
    }

    /**
     * Response updated.
     *
     * @param array $object
     * @param null $transformer
     * @return string
     */
    public function updated($object, $transformer = null)
    {
        return $this->selfRendered->updated(
            $this->fractalItem($object, $transformer)
        );
    }

    /**
     * @param $object
     * @param $transformer
     * @return \League\Fractal\Scope
     */
    protected function fractalItem($object, $transformer)
    {
        return $this->fractalManager->createData(new Item($object, $transformer));
    }

    /**
     * @param $collection
     * @param $transformer
     * @return \League\Fractal\Scope
     */
    protected function fractalCollection($collection, $transformer)
    {
        return $this->fractalManager->createData(new Collection($collection, $transformer));
    }

    /**
     * Response deleted.
     *
     * @return string
     */
    public function deleted()
    {
        return $this->selfRendered->deleted();
    }

    /**
     * Simple response success.
     *
     * @param  mixed $message
     * @return string
     */
    public function success($message)
    {
        return $this->selfRendered->success($message);
    }

    /**
     * Unauthorized.
     *
     * @param  mixed $description
     * @return string
     */
    public function unauthorized($description = null)
    {
        return $this->selfRendered->unauthorized($description);
    }

    /**
     * Any error return 400 as bad request.
     *
     * @param  mixed $description
     * @return string
     */
    public function bad($description = null)
    {
        return $this->selfRendered->bad($description);
    }

    /**
     * Alias of error 404 response.
     *
     * @param  array $description
     * @return string
     */
    public function missing($description = null)
    {
        return $this->selfRendered->missing($description);
    }

    /**
     * Alias of error 422 response.
     *
     * @param  array $error
     * @return string
     */
    public function unprocess($error)
    {
        return $this->selfRendered->unprocess($error);
    }
}