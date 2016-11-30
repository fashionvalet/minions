<?php

namespace Fv\Minions\Contracts\Worker;

/**
 * Author       : Rifki Yandhi
 * Date Created : Nov 15, 2016 4:53:22 PM
 * File         : OrderCommentInterface.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     :
 */
interface OrderCommentInterface
{

    public function create($orderId, $data);
}

/* End of file OrderCommentInterface.php */