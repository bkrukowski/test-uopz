<?php

namespace PfUopz;

use PfUopz\Fixtures\FinalPHPUnit;
use PHPUnit\Framework\MockObject\RuntimeException as PHPUnitRuntimeException;

/**
 * @internal
 */
final class PHPUnitBridgeTest extends AbstractTestCase
{
    public function testNativeBehavior(): void
    {
        $this->expectException(PHPUnitRuntimeException::class);
        $this->expectExceptionMessage(sprintf(
            'Class "%s" is declared "final" and cannot be mocked.',
            FinalPHPUnit::class
        ));
        $this->getMockBuilder(FinalPHPUnit::class)->getMock();
    }

    /**
     * @depends testNativeBehavior
     */
    public function testMock(): void
    {
        $this->assertClassIsFinal(FinalPHPUnit::class);
        $bridge = new class () extends PHPUnitBridge {
        };
        $mock = $bridge->getMockBuilder(FinalPHPUnit::class)->getMock();
        $this->assertClassIsNotFinal(FinalPHPUnit::class);

        $mock
            ->expects($this->once())
            ->method('sayHello')
            ->willReturn('goodbye');

        $this->assertSame('goodbye', $mock->sayHello());
    }
}
