<?php

namespace CascadeEnergy\Tests\ExecutionEnvironment\MetaData;

use CascadeEnergy\ExecutionEnvironment\MetaData\DockerContainer;

class DockerContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldReturnAnEmptyStringIfNoContainerIdFileExists()
    {
        $filesystem = $this->getMock('Symfony\Component\Filesystem\Filesystem');

        $filesystem->expects($this->once())->method('exists')->with('/tmp/container.id')->willReturn(false);

        /** @noinspection PhpParamsInspection */
        $dockerContainer = new DockerContainer($filesystem);

        $this->assertEquals('', $dockerContainer->getIdentifier());
    }

    public function testItShouldReturnTheContentsOfTheContainerIdFileIfItExists()
    {
        $completePath = __FILE__;

        $filesystem = $this->getMock('Symfony\Component\Filesystem\Filesystem');

        $filesystem->expects($this->once())->method('exists')->with($completePath)->willReturn(true);

        /** @noinspection PhpParamsInspection */
        $dockerContainer = new DockerContainer($filesystem, $completePath);

        $this->assertEquals(file_get_contents($completePath), $dockerContainer->getIdentifier());
    }
}
