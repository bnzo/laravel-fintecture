<?php

use Bnzo\Fintecture\Utils\PaymentSplitter;

it('can split 99', function () {
    $splits = PaymentSplitter::split(99, 3);

    expect($splits)->toEqual([33, 33, 33]);
});

it('can split 100.01 into 3 parts', function () {
    $splits = PaymentSplitter::split(100.01, 3);

    expect($splits)->toEqual([33.34, 33.34, 33.33]);
});

it('can split 100 into 3 parts', function () {
    $splits = PaymentSplitter::split(100, 3);

    expect($splits)->toEqual([33.34, 33.33, 33.33]);
});

it('can split 100.11 into 3 parts', function () {
    $splits = PaymentSplitter::split(100.11, 3);

    expect($splits)->toEqual([33.37, 33.37, 33.37]);
});

it('can split 278.15 into 3 parts', function () {
    $splits = PaymentSplitter::split(278.15, 3);

    expect($splits)->toEqual([92.72, 92.72, 92.71]);
});
