<?php

namespace PressServerApi\Callback\Operation;

use PressServerApi\Callback\OperationInterface;

class CategoryOperation implements OperationInterface {

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
    private $parentId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $position;

    /**
     * @var array
     */
    private $rawdata;

    function __construct($operationKey, $id, $parentId, $name, $position, array $rawdata) {
        $this->operationKey = $operationKey;
        $this->id = $id;
        $this->parentId = $parentId;
        $this->name = $name;
        $this->position = $position;
        $this->rawdata = $rawdata;
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
    public function getParentId() {
        return $this->parentId;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * @return array
     */
    public function getRawdata() {
        return $this->rawdata;
    }
}
