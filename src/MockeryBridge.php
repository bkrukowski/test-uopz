<?php

namespace PfUopz;

class MockeryBridge extends \Mockery
{
    public static function mock(...$args)
    {
        foreach ($args as $arg) {
            if (!is_string($arg)) {
                continue;
            }

            if (0 === strpos('alias:', $arg)) {
                continue;
            }

            if (0 === strpos('overload:', $arg)) {
                continue;
            }

            [$class] = explode('[', $arg);

            if (class_exists($class)) {
                unfinal_all($class);
            }
        }

        return parent::mock(...$args);
    }
}
