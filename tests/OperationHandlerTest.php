<?php

namespace App\Tests;

use App\Model\Operation;
use App\Service\OperationHandler;
use PHPUnit\Framework\TestCase;

final class OperationHandlerTest extends TestCase
{
    public function testSuccessOperations(): void
    {
        $operationHandler = new OperationHandler();
        $result = $operationHandler(
            new Operation(1, .5, '+')
        );

        $this->assertEquals(1.5, $result);

        $result = $operationHandler(
            new Operation(1, .5, '-')
        );

        $this->assertEquals(0.5, $result);

        $result = $operationHandler(
            new Operation(2, 2, '*')
        );

        $this->assertEquals(4, $result);

        $result = $operationHandler(
            new Operation(15, 3, '/')
        );

        $this->assertEquals(5, $result);
    }

    public function testDivByZero(): void
    {
        $this->expectException(\DivisionByZeroError::class);

        $operationHandler = new OperationHandler();
        $operationHandler(
            new Operation(1, 0, '/')
        );
    }
}
