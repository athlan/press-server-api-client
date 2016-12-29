<?php

namespace PressServerApi\Callback\Response;

use PressServerApi\Callback\OperationGroupProcessingResult;
use PressServerApi\Callback\OperationInterface;

class ProcessingResultResponseFactory {

    /**
     * @param OperationGroupProcessingResult $result
     * @return string response
     */
    public function createProcessingResultResponse(OperationGroupProcessingResult $result) {
        $buff = 'STREAM-START:';

        $ops = [];
        foreach($result->getResults() as $singleResult) {
            $msg = null;

            if($singleResult->isSuccess()) {
                $msg = 'ok';
            }
            else {
                $msg = $singleResult->getMessage();
            }

            $key = $this->getOperationResponseKey($singleResult->getOperation());
            $ops[$key] = $msg;
        }

        $buff .= base64_encode(serialize($ops));

        $buff .= ':STREAM-STOP';

        return $buff;
    }

    private function getOperationResponseKey(OperationInterface $operation) {
        preg_match('/^(.+)_([0-9]+)$/', $operation->getOperationKey(), $matches);
        return $matches[2];
    }
}
