<?php

namespace PressServerApi\Callback\Operation\Factory\Psr7Request;

use GuzzleHttp\Psr7;
use PressServerApi\Callback\Operation\Factory\OperationFactoryInterface;
use PressServerApi\Callback\OperationInterface;
use Psr\Http\Message\RequestInterface;

class OperationsFromRequestFactory {

    /**
     * @var OperationFactoryInterface[]
     */
    private $factories;

    public function __construct(array $factories) {
        $this->factories = $factories;
    }

    /**
     * @param RequestInterface $request
     * @return OperationInterface[]
     */
    public function createOperations(RequestInterface $request) {
        $params = Psr7\parse_query($request->getBody());
        $operations = [];

        foreach($params as $key => $value) {
            $operation = $this->createOperation($key, $value);

            if(null !== $operation) {
                $operations[] = $operation;
            }
        }

        return $operations;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return null|OperationInterface
     */
    private function createOperation($key, $value) {
        foreach($this->factories as $factory) {
            $operation = $factory->createOperation($key, $value);

            if(null !== $operation) {
                return $operation;
            }
        }

        return null;
    }
}
