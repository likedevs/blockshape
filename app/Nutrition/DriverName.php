<?php namespace App\Nutrition;

use App\Nutrition\Exception\UnknownDriverException;

class DriverName
{
    protected $driver;

    /**
     * DriverName constructor.
     *
     * @param $driver
     * @throws UnknownDriverException
     */
    public function __construct($driver)
    {
        if (! in_array($driver, ['weight-loss', 'weight-gain', 'maintenance'])) {
            throw new UnknownDriverException();
        }

        $this->driver = studly_case($driver);
    }

    public function __toString()
    {
        return $this->getDriver();
    }

    /**
     * @return mixed
     */
    public function getDriver()
    {
        return $this->driver;
    }
}