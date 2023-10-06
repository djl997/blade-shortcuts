<?php

namespace Djl996\Tests;

class CascadeTest extends TestCase
{
    public function testCascadeMonths()
    {
        $blade = '@cascadeMonths(120)';

        // Check if it returns as 10 years
        $this->assertSame('10yrs', $this->blade->render($blade));
    }

    public function testCascadeMonthsWithFactor()
    {
        // One year is 2 months
        $blade = '@cascadeMonths([120, [\'year\' => 2]])';

        $this->assertSame('60yrs', $this->blade->render($blade));
    }
}
