<?php namespace Fv\Minions;

use Illuminate\Support\ServiceProvider;
use Fv\Minions\Workers;

class MinionServiceProvider extends ServiceProvider
{
    protected $workers = [
        'fv.minion.order' => \Fv\Minions\Workers\Order::class,
        'fv.minion.shipment' => \Fv\Minions\Workers\Shipment::class,
        'fv.minion.product' => \Fv\Minions\Workers\Product::class,
        'fv.minion.invoice' => \Fv\Minions\Workers\Invoice::class,
        'fv.minion.inventory'  => \Fv\Minions\Workers\Inventory::class,
        'fv.minion.creditmemo' => \Fv\Minions\Workers\OrderCreditMemo::class,
        'fv.minion.customer' => \Fv\Minions\Workers\Customer::class
    ];

    public function register()
    {
        $this->registerSoap();
        $this->registerWorkers();
    }

    protected function registerSoap()
    {
        $this->app->bind('fv.minions', function ($app) {
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
            $this->app->bind($name, function ($app) use ($class) {
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
