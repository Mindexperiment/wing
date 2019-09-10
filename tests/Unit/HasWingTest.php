<?php

namespace Agpretto\Wing\Tests\Unit;

use Agpretto\Wing\Tests\TestCase;
use Agpretto\Wing\Wing;
use Agpretto\Wing\Tests\Fixtures\Puppet;

class HasWingTest extends TestCase
{
    public function test_MorphToInstance()
    {
        $puppet = new Puppet();

        $this->assertNull($puppet->wing);
    }
}
