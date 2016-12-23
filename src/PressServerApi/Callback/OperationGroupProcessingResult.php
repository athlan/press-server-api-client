<?php

namespace PressServerApi\Callback;

class OperationGroupProcessingResult {

    /**
     * @var OperationProcessingResult[]
     */
    private $results = [];

    public function addResult(OperationProcessingResult $result) {
        $this->results[] = $result;
    }

    /**
     * @return OperationProcessingResult[]
     */
    public function getResults() {
        return $this->results;
    }
}