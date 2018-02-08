<?php

namespace PHPJuice\Slopeone\Tests;

use PHPJuice\Slopeone\Algorithm;
use PHPUnit\Framework\TestCase as TestCase;

class SlopeoneTest extends TestCase {
    public function testClear() {
        $slopeone = new Algorithm();
        $this->assertNull($slopeone->clear());
    }

    public function testShouldReturnValideSlopeonePrediction() {
        $slopeone = new Algorithm();

        $testData =[
          [
            "squid" => 1,
            "cuttlefish" => 0.5,
            "octopus" => 0.2
          ],
          [
            "squid" => 1,
            "octopus" => 0.5,
            "nautilus" => 0.2
          ],
          [
            "squid" => 0.2,
            "octopus" => 1,
            "cuttlefish" => 0.4,
            "nautilus" => 0.4
          ],
          [
            "cuttlefish" => 0.9,
            "octopus" => 0.4,
            "nautilus" => 0.5
          ]
        ];

        foreach ($testData as $user => $userPrefs) {
            $slopeone->add($userPrefs);
        }

        $results = $slopeone->predict([
            "squid" => 0.4
        ]);

        $expectedResults = [
          "cuttlefish"=>0.25,
          "octopus"=>0.23333333333333,
          "nautilus"=>0.1
        ];
        $this->assertEquals($expectedResults, $results);
    }
}
