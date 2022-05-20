<?php namespace App\Nutrition;

use Illuminate\Support\Manager;
use App\Nutrition\Load\Maintenance;
use App\Nutrition\Load\WeightGain;
use App\Nutrition\Load\WeightLoss;


/**
 * Generate nutrition schedule for active days
 *
 * Class LoadScheduler
 *
 * @package App\Nutrition
 */
class LoadScheduler extends Manager
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