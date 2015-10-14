<?php

namespace CascadeEnergy\Tests\ExecutionEnvironment\MetaData;

use CascadeEnergy\ExecutionEnvironment\MetaData\Process;

class ProcessTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldReturnTheCurrentProcessId()
    {
        if (!function_exists('posix_getpid')) {
            $this->markTestSkipped('The posix_getpid function is not available on this PHP installation');
            return;
        }

        $process = new Process();
        $this->assertEquals(posix_getpid(), $process->getIdentifier());
    }
}
