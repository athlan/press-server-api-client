<?php

namespace PressServerApi\Callback\Response;

use PressServerApi\Callback\OperationGroupProcessingResult;

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

            $ops[$singleResult->getOperation()->getOperationKey()] = $msg;
        }

        $buff .= base64_encode(serialize($ops));

        $buff .= ':STREAM-STOP';

        return $buff;
    }
}
