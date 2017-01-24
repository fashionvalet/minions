<?php

namespace Fv\Minions;

use Illuminate\Support\ServiceProvider;
use Fv\Minions\Workers;

class MinionServiceProvider extends ServiceProvider
{

    protected $workers = [
        'fv.minion.order'             => \Fv\Minions\Workers\Order::class,
        'fv.minion.order.invoice'     => \Fv\Minions\Workers\OrderInvoice::class,
        'fv.minion.order.comment'     => \Fv\Minions\Workers\OrderComment::class,
        'fv.minion.order.shipment'    => \Fv\Minions\Workers\OrderShipment::class,
        'fv.minion.order.creditmemo'  => \Fv\Minions\Workers\OrderCreditMemo::class,
        'fv.minion.shipment'          => \Fv\Minions\Workers\Shipment::class,
        'fv.minion.product'           => \Fv\Minions\Workers\Product::class,
        'fv.minion.product.attribute' => \Fv\Minions\Workers\ProductAttribute::class,
        'fv.minion.invoice'           => \Fv\Minions\Workers\Invoice::class,
        'fv.minion.inventory'         => \Fv\Minions\Workers\Inventory::class,
        'fv.minion.creditmemo'        => \Fv\Minions\Workers\CreditMemo::class,
        'fv.minion.directory'         => \Fv\Minions\Workers\Directory::class
    ];

    public function register()
    {
        $this->registerClient();
        $this->registerWorkers();
    }

    public function registerClient()
    {
        $this->app->bind('fv.minions', function($app) {
            $settings = $app['config']->get('services.minion');
            $minion   = new Minion($settings);

            return $minion->createClientInstance();
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
