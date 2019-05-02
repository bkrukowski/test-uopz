<?php

namespace PfUopz;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
abstract class AbstractTestCase extends TestCase
{
    protected function assertClassIsFinal(string $className, bool $expected = true): void
    {
        $class = new \ReflectionClass($className);
        $this->assertSame($expected, $class->isFinal());
    }

    protected function assertClassIsNotFinal(string $className): void
    {
        $this->assertClassIsFinal($className, false);
    }

    protected function assertMethodIsFinal(string $className, string $methodName, bool $expected = true): void
    {
        $method = new \ReflectionMethod($className, $methodName);
        $this->assertSame($expected, $method->isFinal());
    }

    protected function assertMethodIsNotFinal(string $className, string $methodName): void
    {
        $this->assertMethodIsFinal($className, $methodName, false);
    }
}
