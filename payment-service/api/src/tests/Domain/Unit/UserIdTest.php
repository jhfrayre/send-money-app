<?php

use App\Domain\ValueObjects\UserId;

test('UserId is instantiable', function () {
    $userId = new UserId(1);
    expect($userId->value())->toBeInt()->toBe(1);
    expect($userId instanceof UserId)->toBe(true);
    $userId = UserId::make(1);
    expect($userId->value())->toBeInt()->toBe(1);
    expect($userId instanceof UserId)->toBeTrue();
});

test('UserId::make() throws InvalidArgumentException on non-integer string', function () {
    $userId = UserId::make('a');
})->throws(InvalidArgumentException::class);

test('UserId::make() throws InvalidArgumentException on integer string "1"', function () {
    $userId = UserId::make('1');
})->throws(InvalidArgumentException::class);

test('UserId::make() throws InvalidArgumentException on float', function () {
    $userId = UserId::make(3.14);
})->throws(InvalidArgumentException::class);

test('UserId::make() throws InvalidArgumentException on float string "3.14"', function () {
    $userId = UserId::make("3.14");
})->throws(InvalidArgumentException::class);

test('UserId::make() throws InvalidArgumentException on true', function () {
    $userId = UserId::make(true);
})->throws(InvalidArgumentException::class);

test('UserId::make() throws InvalidArgumentException on false', function () {
    $userId = UserId::make(false);
})->throws(InvalidArgumentException::class);

test('UserId::make() throws InvalidArgumentException on null', function () {
    $userId = UserId::make(null);
})->throws(InvalidArgumentException::class);

test('UserId __construct() throws TypeError on non-integer string', function () {
    $userId = new UserId('a');
})->throws(TypeError::class);

test('UserId __construct() returns 1 on "1"', function () {
    $userId = new UserId('1');
    expect($userId->value())->toBeInt()->toBe(1);
});

test('UserId __construct() returns 1 on true', function () {
    $userId = new UserId(true);
    expect($userId->value())->toBeInt()->toBe(1);
});

test('UserId __construct() throws TypeError on null', function () {
    $userId = new UserId(null);
})->throws(TypeError::class);

test('is_numeric() returns expected values', function () {
    expect(is_numeric(false))->toBe(false);
    expect(is_numeric(true))->toBe(false);
    expect(is_numeric('1'))->toBe(true);
    expect(is_numeric(1))->toBe(true);
    expect(is_numeric('a'))->toBe(false);
    expect(is_numeric(null))->toBe(false);
});
