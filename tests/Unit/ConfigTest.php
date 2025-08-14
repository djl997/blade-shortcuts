<?php

namespace Djl997\Tests\Unit;

use Djl997\Tests\TestCase;

class ConfigTest extends TestCase
{
    public function testAppName()
    {
        $blade = '@appname';

        $this->assertSame('Laravel', $this->blade->render($blade));
    }

    public function testConfig()
    {
        $blade = '@config(\'app.name\')';

        $this->assertSame('Laravel', $this->blade->render($blade));
    }
}