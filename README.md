# PfUopz

Mock final classes and methods in PHP.

## Usage

### PHPUnit

Extend `PfUopz\PHPUnitBridge` instead of `PHPUnit\Framework\TestCase` class.

### Mockery

Use `PfUopz\MockeryBridge` instead of `Mockery` class.

### Frameworkless

* function `PfUopz\unfinal_class($className)` - mark class as not final
* function `PfUopz\unfinal_method($className, $methodName)` - mark method as not final
* function `PfUopz\unfinal_all($className)` - mark class and all methods as not final

### Example

```php
<?php

use PfUopz\PHPUnitBridge;

final class MyFinalClass {
    public function sayHello(): string
    {
        return 'hello';
    }
}

final class MyTest extends PHPUnitBridge
{
    public function testFinalClass()
    {
        $mock = $this->getMockBuilder(MyFinalClass::class)->getMock();
        
        $mock
            ->expects($this->once())
            ->method('sayHello')
            ->willReturn('goodbye');

        $this->assertSame('goodbye', $mock->sayHello());
    }
}
```

## External links

> The simplest solution is to not mark classes or methods as final!

[dock.mockery.io](http://docs.mockery.io/en/latest/reference/final_methods_classes.html)
