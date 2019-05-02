<?php

/**
 * https://stackoverflow.com/questions/32213542/php-mocking-final-class
 */

namespace PfUopz;

use PfUopz\Fixtures\FinalClass;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @internal
 */
final class FunctionsTest extends AbstractTestCase
{
    public function testUnfinal(): void
    {
        $this->assertSame('hello', (new FinalClass())->sayHello());

        /*
         * FinalClass - final
         * FinalClass::returnA - final
         */
        $this->assertClassIsFinal(FinalClass::class);
        $this->assertMethodIsFinal(FinalClass::class, 'sayHello');

        /*
         * FinalClass - not final
         * FinalClass::returnA - final
         */
        unfinal_class(FinalClass::class);
        $this->assertClassIsNotFinal(FinalClass::class);
        $this->assertMethodIsFinal(FinalClass::class, 'sayHello');

        /*
         * FinalClass - not final
         * FinalClass::returnA - not final
         */
        unfinal_method(FinalClass::class, 'sayHello');
        $this->assertClassIsNotFinal(FinalClass::class);
        $this->assertMethodIsNotFinal(FinalClass::class, 'sayHello');

        /** @var MockObject|FinalClass $mock */
        $mock = $this
            ->getMockBuilder(FinalClass::class)
            ->getMock();

        $mock
            ->method('sayHello')
            ->willReturn('goodbye');

        /*
         * Voila!
         */
        $this->assertSame('goodbye', $mock->sayHello());
    }
}
