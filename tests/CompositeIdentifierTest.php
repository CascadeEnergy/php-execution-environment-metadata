<?php

namespace CascadeEnergy\Tests\ExecutionEnvironment\MetaData;

use CascadeEnergy\ExecutionEnvironment\MetaData\CompositeIdentifier;

class CompositeIdentifierTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldCombineTheResultsOfMultipleIdentifierProviders()
    {
        $identifierFoo = $this->getMock('CascadeEnergy\ExecutionEnvironment\MetaData\IdentifierProviderInterface');
        $identifierBar = $this->getMock('CascadeEnergy\ExecutionEnvironment\MetaData\IdentifierProviderInterface');
        $identifierBaz = $this->getMock('CascadeEnergy\ExecutionEnvironment\MetaData\IdentifierProviderInterface');
        
        $identifierFoo->expects($this->once())->method('getIdentifier')->willReturn('foo');
        $identifierBar->expects($this->once())->method('getIdentifier')->willReturn('bar');
        $identifierBaz->expects($this->once())->method('getIdentifier')->willReturn('baz');

        $composite = new CompositeIdentifier();

        /** @noinspection PhpParamsInspection */
        $composite->addIdentifierProvider($identifierFoo);

        /** @noinspection PhpParamsInspection */
        $composite->addIdentifierProvider($identifierBar);

        /** @noinspection PhpParamsInspection */
        $composite->addIdentifierProvider($identifierBaz);

        $this->assertEquals('foo:bar:baz', $composite->getIdentifier());
    }
}
