<?php namespace Fv\Minions\Workers;

use Artisaninweb\SoapWrapper\Service as SoapService;

abstract class Worker
{
    protected $soap;

    protected $session;

    public function __construct(SoapService $soap)
    {
        $this->soap = $soap;
    }

    public function getSoapService()
    {
        return $this->soap;
    }

    public function getSoapSession()
    {
        if (is_null($this->session)) {
            $this->session = $this->generateNewSession();
        }

        return $this->session;
    }

    protected function generateNewSession()
    {
        $username = $this->getSoapService()->getOptions()['username'];
        $password = $this->getSoapService()->getOptions()['password'];

        $session = $this->getSoapService()->call('login', [$username, $password]);

        return $session;
    }

    protected function execute($endpoint, $params)
    {
        return $this->getSoapService()->call($endpoint, [$this->getSoapSession(), $params]);
    }
}
