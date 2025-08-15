<?php

use Bnzo\Fintecture\Utils\PaymentSplitter;

it('can split', function () {
    $splits = PaymentSplitter::split(99, 3);

    expect($splits)->toEqual([33, 33, 33]);
});
