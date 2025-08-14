<?php

namespace Djl997\Tests\Unit;

use Djl997\Tests\TestCase;

class FilesizeTest extends TestCase
{
    public function testFilesize()
    {
        $blade = '@filesize(1024)';
        $this->assertSame('1 kB', $this->blade->render($blade));
    }

    public function testFilesizeMb()
    {
        $blade = '@filesizemb(2097152)';

        $this->assertSame('2 MB', $this->blade->render($blade));
    }

    public function testFilesizeGb()
    {
        $blade = '@filesizegb(1073741824)';

        $this->assertSame('1,0 GB', $this->blade->render($blade));
    }
}
