<?php

namespace PressServerApi\Callback\Operation;

use PressServerApi\Callback\OperationInterface;

class AnnouncementPhotoOperation implements OperationInterface {

    /**
     * @var string
     */
    private $operationKey;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $photoPath;

    /**
     * @var array
     */
    private $rawdata;

    public function __construct($operationKey, $id, $photoPath, array $rawdata) {
        $this->operationKey = $operationKey;
        $this->id = $id;
        $this->photoPath = $photoPath;
    }

    /**
     * @return string
     */
    public function getOperationKey() {
        return $this->operationKey;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPhotoPath() {
        return $this->photoPath;
    }

    /**
     * @return array
     */
    public function getRawdata() {
        return $this->rawdata;
    }
}
