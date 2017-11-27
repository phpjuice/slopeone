<?php

namespace PHPJuice\Slopeone\Tests;

use PHPJuice\Slopeone\Algorithm;
use PHPUnit\Framework\TestCase as TestCase;

class SlopeoneTest extends TestCase
{
    public function testShouldConstructSlopeone()
    {
        $slopeone = new Algorithm();
        $this->assertTrue(true, $slopeone instanceof Algorithm);
    }
}
