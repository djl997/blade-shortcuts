<?php

namespace Djl997\Tests;

class CascadeTest extends TestCase
{
    public function testCascadeFromMonths()
    {
        $blade = '@cascadeFromMonths(120)';

        // Check if it returns as 10 years
        $this->assertSame('10yrs', $this->blade->render($blade));
    }

    public function testCascadeFromMonthsWithFactor()
    {
        // One year is 2 months
        $blade = '@cascadeFromMonths([120, [\'year\' => 2]])';

        $this->assertSame('60yrs', $this->blade->render($blade));
    }

    public function testCascadeFromDays()
    {
        $blade = '@cascadeFromDays(121)';

        // Check if it returns as 10 years
        $this->assertSame('4mos 1w 2d', $this->blade->render($blade));
    }

    public function testCascadeFromDaysWithFactor()
    {
        // 4 days is 1 week
        $blade = '@cascadeFromDays([121, [\'week\' => 4]])';

        $this->assertSame('30w 1d', $this->blade->render($blade));
    }

    public function testCascadeFromDaysWithFormat()
    {
        $blade = '@cascadeFromHours([4000, [\'hour\']])';

        $this->assertSame('4000h', $this->blade->render($blade));
    }

    public function testCascadeFromHours()
    {
        $blade = '@cascadeFromHours(121)';

        // Check if it returns as 10 years
        $this->assertSame('5d 1h', $this->blade->render($blade));
    }

    public function testCascadeFromHoursWithFactor()
    {
        // One day is 4 hours
        $blade = '@cascadeFromHours([121, [\'day\' => 4]])';

        $this->assertSame('4w 2d 1h', $this->blade->render($blade));
    }

    public function testCascadeFromMinutes()
    {
        $blade = '@cascadeFromMinutes(121)';

        // Check if it returns as 10 years
        $this->assertSame('2h 1m', $this->blade->render($blade));
    }

    public function testCascadeFromMinutesWithFactor()
    {
        // One hour is 30 minutes
        $blade = '@cascadeFromMinutes([121, [\'hour\' => 30]])';

        $this->assertSame('4h 1m', $this->blade->render($blade));
    }

    public function testCascadeFromSeconds()
    {
        $blade = '@cascadeFromSeconds(121)';

        // Check if it returns as 10 years
        $this->assertSame('2m 1s', $this->blade->render($blade));
    }

    public function testCascadeFromSecondsWithFactor()
    {
        // One minute is 30 seconds
        $blade = '@cascadeFromSeconds([121, [\'minute\' => 30]])';

        $this->assertSame('4m 1s', $this->blade->render($blade));
    }

}
