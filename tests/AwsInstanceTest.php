<?php

namespace CascadeEnergy\Tests\ExecutionEnvironment\MetaData;

use CascadeEnergy\ExecutionEnvironment\MetaData\AwsInstance;

class AwsInstanceTest extends \PHPUnit_Framework_TestCase
{
    /** @var AwsInstance */
    private $awsInstance;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $guzzleClient;

    public function setUp()
    {
        $this->guzzleClient = $this->getMockBuilder('GuzzleHttp\Client')->setMethods(['get'])->getMock();

        /** @noinspection PhpParamsInspection */
        $this->awsInstance = new AwsInstance($this->guzzleClient);
    }

    public function testItShouldReturnTheInstanceId()
    {
        $result = $this->getMock('Psr\Http\Message\ResponseInterface');
        $result->expects($this->once())->method('getBody')->willReturn(json_encode(['instanceId' => 'foo']));

        $this->guzzleClient
            ->expects($this->once())
            ->method('get')
            ->with('http://169.254.169.254/latest/dynamic/instance-identity/document')
            ->willReturn($result);

        $this->assertEquals('foo', $this->awsInstance->getIdentifier());
    }

    public function testItShouldCacheTheInstanceIdentityDocument()
    {
        $result = $this->getMock('Psr\Http\Message\ResponseInterface');
        $result->expects($this->once())->method('getBody')->willReturn(json_encode(['instanceId' => 'foo']));

        // Note that the `once` expectation on this mock is sufficient for this test's condition
        $this->guzzleClient
            ->expects($this->once())
            ->method('get')
            ->with('http://169.254.169.254/latest/dynamic/instance-identity/document')
            ->willReturn($result);

        $this->awsInstance->getIdentifier();
        $this->awsInstance->getIdentifier();
    }

    public function testItShouldReturnAnEmptyStringIfNoInstanceIdIsAvailable()
    {
        $result = $this->getMock('Psr\Http\Message\ResponseInterface');
        $result->expects($this->once())->method('getBody')->willReturn(json_encode(['foo' => 'bar']));

        // Note that the `once` expectation on this mock is sufficient for this test's condition
        $this->guzzleClient
            ->expects($this->once())
            ->method('get')
            ->with('http://169.254.169.254/latest/dynamic/instance-identity/document')
            ->willReturn($result);

        $this->assertEquals('', $this->awsInstance->getIdentifier());
    }

    public function testItShouldReturnAnEmptyStringIfAnErrorOccurs()
    {
        $this->guzzleClient
            ->expects($this->once())
            ->method('get')
            ->willThrowException(new \Exception());

        $this->assertEquals('', $this->awsInstance->getIdentifier());
    }
}
