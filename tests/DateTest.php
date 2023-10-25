<?php

namespace Djl997\Tests;

class DateTest extends TestCase
{
    public function testCarbon()
    {
        $blade = '@carbon(now())';

        $this->assertSame(now()->format('Y-m-d H:i:s'), $this->blade->render($blade));
    }

    public function testDate()
    {
        $blade = '@date(now())';

        $this->assertSame(now()->format('F j, Y'), $this->blade->render($blade));
    }

    public function testDateTime()
    {
        $blade = '@datetime(now())';

        $this->assertSame(now()->format('F j, Y g:i A'), $this->blade->render($blade));
    }

    public function testYear()
    {
        $blade = '@year(now())';

        $this->assertSame(now()->format('Y'), $this->blade->render($blade));
    }

    public function testMonth()
    {
        $blade = '@month(now())';

        $this->assertSame(now()->format('F'), $this->blade->render($blade));
    }

    public function testDay()
    {
        $blade = '@day(now())';

        $this->assertSame(now()->format('l'), $this->blade->render($blade));
    }

    public function testTime()
    {
        $blade = '@time';

        $this->assertSame(now()->format('g:i A'), $this->blade->render($blade));
    }

    public function testNullTime()
    {
        $blade = '@time(null)';

        $this->assertSame('', $this->blade->render($blade));
    }

    public function testNullDateTime()
    {
        $blade = '@datetime(null)';

        $this->assertSame('', $this->blade->render($blade));
    }
}
