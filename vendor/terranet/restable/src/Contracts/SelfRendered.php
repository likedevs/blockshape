<?php namespace Terranet\Restable\Contracts;

interface SelfRendered
{
    /**
     * Response listing.
     *
     * @param  array $messages
     * @return string
     */
    public function listing($messages);

    /**
     * Response single.
     *
     * @param  array $messages
     * @return string
     */
    public function single($messages);

    /**
     * Response created.
     *
     * @param  array $messages
     * @return string
     */
    public function created($messages);

    /**
     * Response updated.
     *
     * @param  array $messages
     * @return string
     */
    public function updated($messages);

    /**
     * Response deleted.
     *
     * @return string
     */
    public function deleted();

    /**
     * Simple response success.
     *
     * @param  mixed $message
     * @return string
     */
    public function success($message);

    /**
     * Unauthorized.
     *
     * @param  mixed $description
     * @return string
     */
    public function unauthorized($description = null);

    /**
     * Any error return 400 as bad request.
     *
     * @param  mixed $description
     * @return string
     */
    public function bad($description = null);

    /**
     * Alias of error 404 response.
     *
     * @param  array $description
     * @return string
     */
    public function missing($description = null);

    /**
     * Alias of error 422 response.
     *
     * @param  array $error
     * @return string
     */
    public function unprocess($error);
}