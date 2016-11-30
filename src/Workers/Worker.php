<?php

namespace Fv\Minions\Workers;

abstract class Worker
{

    /**
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    public function __construct()
    {
        $this->client = app('fv.minions');
    }

    public function getClient()
    {
        return $this->client;
    }

}
