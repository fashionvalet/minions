<?php

namespace Fv\Minions;

use GuzzleHttp\Client;

class Minion
{

    protected $settings = [];
    protected $client;
    protected $access_token;
    protected $base_path;

    public function __construct(array $settings)
    {
        $this->settings = $settings;

        $this->client = new Client([
            'base_uri' => $settings['api_uri'],
            'timeout'  => $settings['api_timeout']
        ]);

        $this->access_token = session()->get('minion_access_token');
        if (!$this->access_token) {
            $this->access_token = $this->getToken();
            session()->put('minion_access_token', $this->access_token);
        }
    }

    public function getToken()
    {
        try
        {
            if (env('MAGENTO_INTEGRATION_KEY')) {
                return env('MAGENTO_INTEGRATION_KEY');
            }
            else {
                return false;
            }
        }
        catch (Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    }

    public function createClientInstance()
    {
        return new Client([
            'base_uri' => $this->settings['api_uri'],
            'timeout'  => $this->settings['api_timeout'],
            'headers'  => [
                'Authorization' => "Bearer ". env('MAGENTO_INTEGRATION_KEY')
            ]
        ]);
    }

    public function getSettings()
    {
        return $this->settings;
    }

}
