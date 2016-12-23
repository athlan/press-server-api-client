<?php

namespace PressServerApi\Callback\Response\Psr7Response;

use GuzzleHttp\Psr7\Response;
use PressServerApi\Callback\OperationGroupProcessingResult;
use \PressServerApi\Callback\Response\ProcessingResultResponseFactory as ProcessingResultResponseBodyFactory;
use Psr\Http\Message\ResponseInterface;


class ProcessingResultResponseFactory {

    /**
     * @var ProcessingResultResponseBodyFactory
     */
    private $responseBodyFactory;

    public function __construct(ProcessingResultResponseBodyFactory $responseBodyFactory) {
        $this->responseBodyFactory = $responseBodyFactory;
    }

    /**
     * @param OperationGroupProcessingResult $result
     * @return ResponseInterface
     */
    public function createProcessingResultResponse(OperationGroupProcessingResult $result) {
        $body = $this->responseBodyFactory->createProcessingResultResponse($result);
        return new Response(200, [], $body);
    }
}
