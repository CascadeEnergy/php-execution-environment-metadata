<?php

namespace CascadeEnergy\Tests\ExecutionEnvironment\MetaData;

use CascadeEnergy\ExecutionEnvironment\MetaData\Hostname;

class HostnameTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldReturnTheCurrentHostName()
    {
        $hostname = new Hostname();
        $this->assertEquals(gethostname(), $hostname->getIdentifier());
    }
}
