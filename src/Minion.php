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
            $response = $this->client->post("integration/admin/token", [
                'json' => [
                    'username' => $this->settings['username'],
                    'password' => $this->settings['password']
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                $body = str_replace('"', '', $response->getBody()->read(1024));
                return $body;
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
                'Authorization' => "Bearer {$this->access_token}"
            ]
        ]);
    }

    public function getSettings()
    {
        return $this->settings;
    }

}
