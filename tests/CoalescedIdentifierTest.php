<?php

namespace CascadeEnergy\Tests\ExecutionEnvironment\MetaData;

use CascadeEnergy\ExecutionEnvironment\MetaData\CoalescedIdentifier;

class CoalescedIdentifierTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldReturnTheFirstIdentifierThatIsNotEmpty()
    {
        $foo = $this->getMock('CascadeEnergy\ExecutionEnvironment\MetaData\IdentifierProviderInterface');
        $bar = $this->getMock('CascadeEnergy\ExecutionEnvironment\MetaData\IdentifierProviderInterface');
        $baz = $this->getMock('CascadeEnergy\ExecutionEnvironment\MetaData\IdentifierProviderInterface');
        $qux = $this->getMock('CascadeEnergy\ExecutionEnvironment\MetaData\IdentifierProviderInterface');

        $foo->expects($this->once())->method('getIdentifier')->willReturn('');
        $bar->expects($this->once())->method('getIdentifier')->willReturn(null);
        $baz->expects($this->once())->method('getIdentifier')->willReturn('baz');
        $qux->expects($this->never())->method('getIdentifier')->willReturn('qux');

        $coalesced = new CoalescedIdentifier();

        /** @noinspection PhpParamsInspection */
        $coalesced->addIdentifierProvider($foo);
        /** @noinspection PhpParamsInspection */
        $coalesced->addIdentifierProvider($bar);
        /** @noinspection PhpParamsInspection */
        $coalesced->addIdentifierProvider($baz);
        /** @noinspection PhpParamsInspection */
        $coalesced->addIdentifierProvider($qux);

        $this->assertEquals('baz', $coalesced->getIdentifier());
    }

    public function testItShouldReturnTheEmptyStringIfNoIdentifiersAreAvailable()
    {
        $foo = $this->getMock('CascadeEnergy\ExecutionEnvironment\MetaData\IdentifierProviderInterface');
        $bar = $this->getMock('CascadeEnergy\ExecutionEnvironment\MetaData\IdentifierProviderInterface');

        $foo->expects($this->once())->method('getIdentifier')->willReturn('');
        $bar->expects($this->once())->method('getIdentifier')->willReturn(null);

        $coalesced = new CoalescedIdentifier();

        /** @noinspection PhpParamsInspection */
        $coalesced->addIdentifierProvider($foo);
        /** @noinspection PhpParamsInspection */
        $coalesced->addIdentifierProvider($bar);

        $this->assertEquals('', $coalesced->getIdentifier());
    }
}
