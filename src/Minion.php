<?php namespace Fv\Minions;

use Artisaninweb\SoapWrapper\Wrapper as SoapWrapper;

class Minion extends SoapWrapper
{
    protected $settings = [];

    public function __construct(array $settings)
    {
        parent::__construct();

        $this->settings = $settings;
    }

    public function createSoapInstance()
    {
        $this->add(function ($soap) {
            $settings = $this->getSettings();

            $soap->name('minions')
                ->wsdl($settings['wsdl'])
                ->cache(WSDL_CACHE_NONE)
                ->options([
                    'username' => $settings['username'],
                    'password' => $settings['password'],
                ]);
        });

        return $this;
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function getMinionInstance()
    {
        return $this->services()['minions'];
    }
}
