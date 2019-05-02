<?php

namespace PfUopz;

use PfUopz\Fixtures\FinalMockery;
use Mockery\Exception as MockeryException;

/**
 * @internal
 */
final class MockeryBridgeTest extends AbstractTestCase
{
    public function testNativeBehavior(): void
    {
        $this->assertClassIsFinal(FinalMockery::class);
        $this->expectException(MockeryException::class);
        $this->expectExceptionMessage(sprintf(
            'The class \%s is marked final and its methods cannot be replaced.',
            FinalMockery::class
        ));
        \Mockery::mock(FinalMockery::class);
    }

    /**
     * @depends testNativeBehavior
     */
    public function testMock(): void
    {
        $this->assertClassIsFinal(FinalMockery::class);
        $mock = MockeryBridge::mock(FinalMockery::class);
        $this->assertClassIsNotFinal(FinalMockery::class);

        $mock
            ->shouldReceive('sayHello')
            ->once()
            ->andReturn('goodbye');
        $this->assertSame('goodbye', $mock->sayHello());
    }
}
