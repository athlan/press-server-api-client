<?php

namespace PressServerApi\Callback;

/**
 * Marker interface for callback operation.
 */
interface OperationInterface {

    /**
     * @return string operation key
     */
    public function getOperationKey();
}
