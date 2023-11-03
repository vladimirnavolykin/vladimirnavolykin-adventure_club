<?php


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testCalculatorSuccess(): void
    {
        $client = static::createClient();
        $client->request('POST', '/calculator', ['arg1' => 1, 'arg2' => 5, 'operator' => '+']);

        self::assertResponseIsSuccessful();
        $responseData = json_decode($client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertEquals(["result" => 6], $responseData);
    }

    public function testCalculatorErrorDivideByZero(): void
    {
        $client = static::createClient();
        $client->request('POST', '/calculator', ['arg1' => 1, 'arg2' => 0, 'operator' => '/']);

        $responseData = json_decode($client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertEquals(['error' => 'You can\'t divide by zero'], $responseData);
        $this->assertEquals(422, $statusCode);
    }
}
