<?php

namespace Agpretto\Wing\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Agpretto\Wing\Tests\Fixtures\Puppet;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return ['Agpretto\Wing\WingServiceProvider'];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Eloquent::unguard();

        $this->loadLaravelMigrations();

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->artisan('migrate')->run();
    }

    protected function createPuppet($description = 'andrea'): Puppet
    {
        return Puppet::create([
            'email' => "{$description}@test.com",
            'name' => 'Andrea Giuseppe',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
    }
}
