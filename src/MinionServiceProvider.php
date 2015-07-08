<?php namespace Fv\Minions;

use Illuminate\Support\ServiceProvider;

class MinionServiceProvider extends ServiceProvider
{
    protected $workers = [
        'fv.minion.order' => Fv\Minions\Workers\Order::class
        'fv.minion.shipment' => Fv\Minions\Workers\Shipment::class
    ];

    public function register()
    {
        $this->registerSoap();
        $this->registerWorkers();
    }

    public function provides()
    {
        return ['fv.minions'];
    }

    protected function getWorkers()
    {
        return $workers;
    }

    protected function registerSoap()
    {
        $this->app->bindShared('fv.minions', function ($app) {
            $settings = $app['config']->get('services.minion');

            $minion = new Minion($settings);
            $soap = $minion->createSoapInstance()->getMinionInstance();

            return $soap;
        });
    }

    protected function registerWorkers()
    {
        $worker = $this->getWorkers();

        foreach ($workers as $name => $class) {
            $this->app->bindShared($name, function ($app) {
                return new $class($app['fv.minions']);
            });
        }
    }
}
