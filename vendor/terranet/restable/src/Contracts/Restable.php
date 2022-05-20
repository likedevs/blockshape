<?php namespace Terranet\Restable\Contracts;

interface Restable
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
     * Response error.
     *
     * @param  array $messages
     * @param int $type
     * @return string
     */
    public function error($messages, $type = 400);

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
     * @param  array $errors
     * @return string
     */
    public function unprocess($errors);

    /**
     * Render response with format.
     *
     * @param  string $format
     * @return mixed
     */
    public function render($format = null, $callback = null);
}