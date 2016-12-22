<?php

namespace PressServerApi\Callback\Operation;

use PressServerApi\Callback\OperationInterface;

class AnnouncementOperation implements OperationInterface {

    /**
     * @var string
     */
    private $operationKey;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTimeImmutable
     */
    private $dateStart;

    /**
     * @var \DateTimeImmutable
     */
    private $dateStop;

    /**
     * @var int
     */
    private $categoryId;

    /**
     * @var string
     */
    private $content;

    /**
     * @var array
     */
    private $rawdata;

    public function __construct($operationKey, $id, $dateStart, $dateStop, $categoryId, $content, array $rawdata) {
        $this->operationKey = $operationKey;
        $this->id = $id;
        $this->dateStart = $dateStart;
        $this->dateStop = $dateStop;
        $this->categoryId = $categoryId;
        $this->content = $content;
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
     * @return \DateTimeImmutable
     */
    public function getDateStart() {
        return $this->dateStart;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDateStop() {
        return $this->dateStop;
    }

    /**
     * @return int
     */
    public function getCategoryId() {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @return array
     */
    public function getRawdata() {
        return $this->rawdata;
    }
}
