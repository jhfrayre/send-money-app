<?php

use App\Domain\ValueObjects\PaymentSystem;

test('PaymentSystem is instantiable', function () {
    $paymentSystem = new PaymentSystem(1, 'InstaPay');
    expect($paymentSystem instanceof PaymentSystem)->toBe(true);
    expect((new PaymentSystem(1, 'InstaPay'))->id())->toBeInt()->toBe(1);
});

test('PaymentSystem id()', function () {
    $paymentSystem = new PaymentSystem(1, 'InstaPay');
    expect($paymentSystem->id())->toBeInt()->toBe(1);
    $paymentSystem = new PaymentSystem('1');
    expect($paymentSystem->id())->toBeInt()->toBe(1);
});

test('PaymentSystem name()', function () {
    $paymentSystem = new PaymentSystem(1, 'InstaPay');
    expect($paymentSystem->name())->toBeString()->toBe('InstaPay');
    $paymentSystem = new PaymentSystem(1, '');
    expect($paymentSystem->name())->toBeString()->toBe('');
    $paymentSystem = new PaymentSystem(1);
    expect($paymentSystem->name())->toBe(null);
});
