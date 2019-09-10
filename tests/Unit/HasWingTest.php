<?php

namespace Agpretto\Tests\Unit;

use Agpretto\Tests\TestCase;
use Agpretto\Wing\Wing;
use Agpretto\Tests\Fixtures\Puppet;

class HasWingTest extends TestCase
{
    public function test_MorphToInstance()
    {
        $puppet = new Puppet();

        $this->assertInstanceOf(Wing::class, $puppet->wing);
    }
}
