<?php

namespace Application\Db\ResultSet;


use Application\Exception\InvalidArgumentException;
use Application\Exception\UnexpectedValueException;
use Zend\Db\ResultSet\AbstractResultSet;

class FabResultSet extends AbstractResultSet {

    /** @var  QuestionFabInterface */
    protected $objectMaker;

    protected $fieldName;
    public function __construct(QuestionFabInterface $objectMaker, $fieldName){
        $this->setObjectMaker($objectMaker);
        $this->setFieldName($fieldName);
    }

    public function setObjectMaker(QuestionFabInterface $objectMaker){
        $this->objectMaker = $objectMaker;
        return $this;
    }

    public function setFieldName($fieldName){
        if(!is_string($fieldName)){
            throw new UnexpectedValueException('Field name has to be string, '.get_class($fieldName).' given instead');
        }
        $this->fieldName = $fieldName;
        return $this;
    }

    public function current(){
        $data = parent::current();
        if(!isset($data[$this->fieldName])){
            throw new UnexpectedValueException('Data fetched does not have '.$this->fieldName.' field name');
        }
        $object = $this->objectMaker->create($data[$this->fieldName]);
        if (!method_exists($object, 'exchangeArray')) {
            throw new UnexpectedValueException('Object ' .get_class($object). ' does not have exchangeArray function');
        }
        $object->exchangeArray($data);
        return $object;
    }
} 