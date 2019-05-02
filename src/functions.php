<?php

namespace PfUopz;

/**
 * @param string $className
 */
function unfinal_class(string $className): void
{
    assert_class_exists($className);

    $class = new \ReflectionClass($className);
    if ($class->isFinal()) {
        $old = \uopz_flags($className, null);
        \uopz_flags($className, null, $old & ~\ZEND_ACC_FINAL);
    }
}

/**
 * @param string $className
 * @param string $methodName
 */
function unfinal_method(string $className, string $methodName): void
{
    assert_method_exists($className, $methodName);

    $method = new \ReflectionMethod($className, $methodName);
    if ($method->isFinal()) {
        $old = \uopz_flags($className, $methodName);
        \uopz_flags($className, $methodName, $old & ~\ZEND_ACC_FINAL);
    }
}

/**
 * @param string $className
 */
function unfinal_all(string $className): void
{
    unfinal_class($className);

    $class = new \ReflectionClass($className);
    foreach ($class->getMethods() as $method) {
        unfinal_method($className, $method->getName());
    }
}

/**
 * @internal
 *
 * @param string $className
 */
function assert_class_exists(string $className): void
{
    if (!\class_exists($className)) {
        throw new RuntimeException(\sprintf('Class `%s` does not exist', $className));
    }
}

/**
 * @internal
 *
 * @param string $className
 * @param string $methodName
 */
function assert_method_exists(string $className, string $methodName): void
{
    if (!\method_exists($className, $methodName)) {
        throw new \RuntimeException(\sprintf('Method `%s::%s` does not exist', $className, $methodName));
    }
}
