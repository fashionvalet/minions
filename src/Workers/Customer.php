<?php

namespace Fv\Minions\Workers;

/**
 * Author       : Rifki Yandhi
 * Date Created : May 12, 2017 8:20:27 PM
 * File         : Customer.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class Customer extends Worker
{

    public function createCustomer($data)
    {
        return $this->getSoapService()->call('customerCustomerCreate', [$this->getSoapSession(), $data]);
    }

}

/* End of file Customer.php */