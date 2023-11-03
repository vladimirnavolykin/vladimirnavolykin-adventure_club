<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AgeControllerTest extends WebTestCase
{
    public function testAge(): void
    {
        $client = static::createClient();
        $client->request('POST', '/age', ['birthday' => '22.03.1988', 'actualDate' => '22.03.1978']);

        self::assertResponseIsSuccessful();
        $responseData = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(["age" => 0], $responseData);
    }

    public function testAgeWithoutActualDate(): void
    {
        $client = static::createClient();
        $client->request('POST', '/age', ['birthday' => '22.03.1988']);

        self::assertResponseIsSuccessful();
        $responseData = json_decode($client->getResponse()->getContent(), true);

        $expectedAge = (new \DateTimeImmutable('22.03.1988'))->diff(new \DateTimeImmutable())->y;
        $this->assertEquals(["age" => $expectedAge], $responseData);
    }
}
