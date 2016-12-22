<?php

namespace PressServerApi\Callback;

use GuzzleHttp\Psr7;
use PHPUnit\Framework\TestCase;

class OperationsFromRequestFactoryTest extends TestCase {

    /**
     * @test
     */
    public function noop()
    {
    }

    /**
     * @ignore_test
     */
    public function should_call_factories()
    {
        $body = file_get_contents("test/resources/requests/zalacznik2.txt");

        $request = Psr7\parse_request($body);
        $params = Psr7\parse_query($request->getBody());

        foreach($params as $opration => $param) {
            var_dump($opration);
            var_dump($this->parseBody($param));
        }
    }

    private function parseBody($param)
    {
        return unserialize(base64_decode($param));
    }
}