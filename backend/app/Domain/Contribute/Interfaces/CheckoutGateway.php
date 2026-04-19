<?php

namespace App\Domain\Contribute\Interfaces;


interface CheckoutGateway
{
    /**
     * @param $checkoutData data related to checkout, like user_id,amount,.......
     */
    public function checkout(array $checkoutData);
}
