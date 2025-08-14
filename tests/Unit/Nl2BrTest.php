<?php

namespace Djl997\Tests\Unit;

use Djl997\Tests\TestCase;

class Nl2BrTest extends TestCase
{
    public function testNl2br()
    {
        $blade = '@nl2br("Hello\nWorld")';

        $this->assertSame("Hello<br />\nWorld", $this->blade->render($blade));
    }

    // Test if <script> tags are escaped
    public function testNl2brScript()
    {
        $blade = '@nl2br("<script>alert(\'Hello\')</script>")';

        $this->assertSame("&lt;script&gt;alert(&#039;Hello&#039;)&lt;/script&gt;", $this->blade->render($blade));
    }

}