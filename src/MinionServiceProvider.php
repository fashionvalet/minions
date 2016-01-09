<?php namespace Fv\Minions;

use Illuminate\Support\ServiceProvider;
use Fv\Minions\Workers;

class MinionServiceProvider extends ServiceProvider
{
    protected $workers = [
        'fv.minion.order'    => Workers\Order::class,
        'fv.minion.shipment' => Workers\Shipment::class,
        'fv.minion.product'  => Workers\Product::class,
        'fv.minion.invoice'  => Workers\Invoice::class,
    ];

    public function register()
    {
        $this->registerSoap();
        $this->registerWorkers();
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
        $workers = $this->getWorkers();

        foreach ($workers as $name => $class) {
            $this->app->bindShared($name, function ($app) use ($class) {
                return new $class($app['fv.minions']);
            });
        }
    }

    protected function getWorkers()
    {
        return $this->workers;
    }

    public function provides()
    {
        return ['fv.minions'];
    }
}
