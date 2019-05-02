<?php

namespace PfUopz;

use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\TestCase;

abstract class PHPUnitBridge extends TestCase
{
    public function getMockBuilder($className): MockBuilder
    {
        unfinal_all($className);

        return parent::getMockBuilder($className);
    }
}
