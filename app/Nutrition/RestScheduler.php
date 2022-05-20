<?php namespace App\Nutrition;

use Illuminate\Support\Manager;
use App\Nutrition\Rest\Maintenance;
use App\Nutrition\Rest\WeightGain;
use App\Nutrition\Rest\WeightLoss;


/**
 * Generate nutrition schedule for active days
 *
 * Class LoadScheduler
 *
 * @package App\Nutrition
 */
class RestScheduler extends Manager
{
    protected $defaultDriver = 'weight-loss';

    /**
     * Get a driver instance.
     *
     * @param  string  $driver
     * @return mixed
     */
    public function driver($driver = null)
    {
        $driver = $driver ?: $this->getDefaultDriver();

        $driver = (new DriverName($driver))->getDriver();

        return parent::driver($driver);
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->defaultDriver;
    }

    public function createWeightLossDriver()
    {
        return new WeightLoss();
    }

    public function createWeightGainDriver()
    {
        return new WeightGain();
    }

    public function createMaintenanceDriver()
    {
        return new Maintenance();
    }
}