<?php

namespace Djl997\Tests;

use Djl997\BladeShortcuts\BladeShortcutsServiceProvider;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use InteractsWithViews;
 
    protected $blade;

    public function setUp(): void
    {
        parent::setUp();
        $this->blade = $this->app->make('blade.compiler');
    }

    protected function getPackageProviders($app)
    {
        return [
            BladeShortcutsServiceProvider::class,
        ];
    }
}
