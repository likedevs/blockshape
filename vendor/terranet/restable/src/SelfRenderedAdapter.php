<?php namespace Terranet\Restable;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\MessageBag;
use Illuminate\Contracts\Support\MessageProvider AS MessageProviderInterface;
use Illuminate\Support\Facades\Response as LaravelResponse;

class SelfRenderedAdapter implements Contracts\SelfRendered
{

    /**
     * @var Contracts\Restable
     */
    private $restable;

    /**
     * @param Contracts\Restable $restable
     */
    public function __construct(Contracts\Restable $restable)
    {
        $this->restable = $restable;
    }


    /**
     * Response listing.
     *
     * @param  array $messages
     * @return string
     */
    public function listing($messages)
    {
        return $this->restable->listing($messages)->render();
    }

    /**
     * Response single.
     *
     * @param  array $messages
     * @return string
     */
    public function single($messages)
    {
        return $this->restable->single($messages)->render();
    }

    /**
     * Response created.
     *
     * @param  array $messages
     * @return string
     */
    public function created($messages)
    {
        return $this->restable->created($messages)->render();
    }

    /**
     * Response updated.
     *
     * @param  array $messages
     * @return string
     */
    public function updated($messages)
    {
        return $this->restable->updated($messages)->render();
    }

    /**
     * Response deleted.
     *
     * @return string
     */
    public function deleted()
    {
        return $this->restable->deleted()->render();
    }

    /**
     * Simple response success.
     *
     * @param  mixed $message
     * @return string
     */
    public function success($message)
    {
        return $this->restable->success($message)->render();
    }

    /**
     * Unauthorized.
     *
     * @param  mixed $description
     * @return string
     */
    public function unauthorized($description = null)
    {
        return $this->restable->unauthorized($description)->render();
    }

    /**
     * Any error return 400 as bad request.
     *
     * @param  mixed $description
     * @return string
     */
    public function bad($description = null)
    {
        return $this->restable->bad($description)->render();
    }

    /**
     * Alias of error 404 response.
     *
     * @param  array $description
     * @return string
     */
    public function missing($description = null)
    {
        return $this->restable->missing($description)->render();
    }

    /**
     * Alias of error 422 response.
     *
     * @param  array $errors
     * @return string
     */
    public function unprocess($errors)
    {
        return $this->restable->unprocess($errors)->render();
    }
}