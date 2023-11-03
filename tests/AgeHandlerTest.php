<?php

use App\Model\Age;
use App\Service\AgeHandler;
use PHPUnit\Framework\TestCase;

final class AgeHandlerTest extends TestCase
{
    public function testWithoutActualDate(): void
    {
        $birthday = '22.03.1988';
        $ageHandler = new AgeHandler();
        $result = $ageHandler(
            new Age(new \DateTimeImmutable($birthday))
        );

        $expectedAge = (new \DateTimeImmutable($birthday))->diff(new \DateTimeImmutable())->y;
        $this->assertEquals($expectedAge, $result);
    }

    public function testWithActualDate(): void
    {
        $birthday = '22.03.1988';
        $ageHandler = new AgeHandler();
        $result = $ageHandler(
            new Age(new \DateTimeImmutable($birthday), new \DateTimeImmutable('22.03.1978'))
        );

        $this->assertEquals(0, $result);
    }
}
