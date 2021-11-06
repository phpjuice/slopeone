<?php

namespace PHPJuice\Slopeone\Tests;

use PHPJuice\Slopeone\Algorithm;

test('it calculates dev matrix', function () {
    $expected = [
        'Item1' => [
            'Item1' => 0.0,
            'Item2' => 0.15,
            'Item3' => 0.17,
            'Item4' => 0.3,
        ],
        'Item2' => [
            'Item1' => -0.15,
            'Item2' => 0.0,
            'Item3' => 0.07,
            'Item4' => 0.2,
        ],
        'Item3' => [
            'Item1' => -0.17,
            'Item2' => -0.07,
            'Item3' => 0.0,
            'Item4' => 0.27,
        ],
        'Item4' => [
            'Item1' => -0.3,
            'Item2' => -0.2,
            'Item3' => -0.27,
            'Item4' => 0.0,
        ],
    ];
    $slopeone = new Algorithm();
    $slopeone->update($this->dataset);
    expect($expected)->toEqual($slopeone->getModel());
});

test("it returns valid slopeone predictions", function () {
    $slopeone = new Algorithm();
    $slopeone->update($this->dataset);

    $results = $slopeone->predict([
        'Item1' => 0.4,
    ]);

    $expected = [
        'Item2' => 0.25,
        'Item3' => 0.23,
        'Item4' => 0.1,
    ];
    $this->assertEquals($expected, $results);

    expect($expected)->toBe($results);

    $u1 = [
        'Item1' => 1,
        'Item2' => 0.5,
        'Item3' => 0.2,
    ];

    $u2 = [
        'Item1' => 1,
        'Item3' => 0.5,
        'Item4' => 0.2,
    ];

    $u3 = [
        'Item2' => 0.9,
        'Item3' => 0.4,
        'Item4' => 0.5,
    ];

    expect(0.26)->toBe($slopeone->predict(($u1))['Item4']);
    expect(0.60)->toBe($slopeone->predict(($u2))['Item2']);
    expect(0.77)->toBe($slopeone->predict(($u3))['Item1']);
});

beforeEach(function () {
    $dataset = [
        'Item1' => [
            'Rating1' => 1,
            'Rating2' => 1,
            'Rating3' => 0.2,
        ],
        'Item2' => [
            'Rating1' => 0.5,
            'Rating3' => 0.4,
            'Rating4' => 0.9,
        ],
        'Item3' => [
            'Rating1' => 0.2,
            'Rating2' => 0.5,
            'Rating3' => 1,
            'Rating4' => 0.4,
        ],
        'Item4' => [
            'Rating2' => 0.2,
            'Rating3' => 0.4,
            'Rating4' => 0.5,
        ],
    ];

    $this->dataset = transpose($dataset);
});
