<?php

namespace Agpretto\Wing\Tests\Unit;

use Agpretto\Wing\Tests\TestCase;
use Agpretto\Wing\Wing;
use Agpretto\Wing\Tests\Fixtures\Puppet;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use stdClass;

class HasWingTest extends TestCase
{
    public function test_EmptyWing()
    {
        $puppet = $this->createPuppet();

        $this->assertInstanceOf(Puppet::class, $puppet);
        $this->assertSame(1, $puppet->id);
        $this->assertInstanceOf(MorphOne::class, $puppet->wing());
        $this->assertNull($puppet->metadata());
        $this->assertNull($puppet->wing);
        // $this->assertNull($puppet->wing->metadata); try to get property of non-object
        $this->assertFalse($puppet->wing()->exists());
        $this->assertFalse($puppet->hasMetadata('foo'));
    }

    public function test_StringWing()
    {
        $puppet = $this->createPuppet();
        $puppet->addWing('foo');

        $this->assertInstanceOf(Wing::class, $puppet->wing);
        $this->assertSame('1', $puppet->wing->model_id);
        $this->assertSame(Puppet::class, $puppet->wing->model_type);
        $this->assertFalse($puppet->hasMetadata('foo'));
        $this->assertSame('foo', $puppet->wing->metadata);
        $this->assertSame('foo', $puppet->metadata());
    }

    public function test_ArrayWing()
    {
        $data = [ 'foo'=>'bar', 'bar'=>'baz', 'min'=>'max' ];
        $puppet = $this->createPuppet();
        $puppet->addWing($data);

        $this->assertFalse($puppet->hasMetadata('baz'));
        $this->assertTrue($puppet->hasMetadata('foo'));
        $this->assertInstanceOf(stdClass::class, $puppet->metadata());
        $this->assertSame('bar', $puppet->metadata()->foo);
        $this->assertSame('baz', $puppet->metadata()->bar);
        $this->assertSame('max', $puppet->metadata()->min);
        // $this->assertNull($puppet->metadata()->max); undefined property stdClass max
    }

    public function test_ArrayDeepWing()
    {
        $data = [
            'foo' => [ 'foo' => 'bar', 'bar' => 'baz' ],
            'bar' => 'baz',
            'a-strange-key' => [ 'only', 'value' ]
        ];
        $puppet = $this->createPuppet();
        $puppet->addWing($data);

        $this->assertTrue($puppet->hasMetadata('foo'));
        $this->assertTrue($puppet->hasMetadata('bar'));
        $this->assertTrue($puppet->hasMetadata('a-strange-key'));
        $this->assertInstanceOf(stdClass::class, $puppet->metadata()->foo);
        $this->assertSame('bar', $puppet->metadata()->foo->foo);
        $this->assertSame('baz', $puppet->metadata()->foo->bar);
        $this->assertSame('only', $puppet->metadata()->{'a-strange-key'}[0]);
    }

    public function test_StringReplaced()
    {
        $puppet = $this->createPuppet();
        $puppet->addWing('foo');

        $this->assertSame('foo', $puppet->metadata());

        $puppet->addWing('bar');
        $this->assertSame('foo', $puppet->metadata());
    }
}
