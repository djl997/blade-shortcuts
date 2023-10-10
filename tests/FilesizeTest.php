<?php

namespace Djl997\Tests;

class FilesizeTest extends TestCase
{
    public function testFilesize()
    {
        $blade = '@filesize(1024)';
        $this->assertSame('1 kB', $this->blade->render($blade));
    }

    public function testFilesizeMB()
    {
        $blade = '@filesizemb(2097152)';

        $this->assertSame('2 MB', $this->blade->render($blade));
    }

    public function testFilesizeGB()
    {
        $blade = '@filesizegb(1073741824)';

        $this->assertSame('1,0 GB', $this->blade->render($blade));
    }
}
