<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\DirectoryInterface;

/**
 * Author       : Rifki Yandhi
 * Date Created : Jan 24, 2017 3:02:05 PM
 * File         : DirectoryCurrency.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class Directory extends Worker implements DirectoryInterface
{

    public function getCurrencyDetail()
    {
        try
        {
            $response = $this->getClient()->get("directory/currency");

            if ($response->getStatusCode() === 200) {
                return json_decode((string) $response->getBody());
            }
            else {
                return false;
            }
        }
        catch (\GuzzleHttp\Exception\ClientException $ex)
        {
            return NULL;
        }
    }

    public function getCountries()
    {
        try
        {
            $response = $this->getClient()->get("directory/countries");

            if ($response->getStatusCode() === 200) {
                return json_decode((string) $response->getBody());
            }
            else {
                return false;
            }
        }
        catch (\GuzzleHttp\Exception\ClientException $ex)
        {
            return NULL;
        }
    }

}

/* End of file DirectoryCurrency.php */