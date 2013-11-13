<?php

namespace Application\Model;


use Application\Exception\UnexpectedValueException;
use Zend\Db\TableGateway\TableGateway;

class QuestionTable {
    /**
     * @var \Zend\Db\TableGateway\TableGateway
     */
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway){
        $this->tableGateway= $tableGateway;
    }

    public function fetchAll(){
        $resultSet = $this->tableGateway->select();
        if(!$resultSet){
            throw new UnexpectedValueException('No rows selected');
        };
        return $resultSet;
    }

} 