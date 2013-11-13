<?php

namespace Application\Service;

use Application\Db\ResultSet\QuestionFabInterface;
use Application\Exception\InvalidArgumentException;

class QuestionFab implements QuestionFabInterface {

    protected $classMap = array(
       'bool' => 'Application\Model\Entity\BoolQuestion',
       'test' => 'Application\Model\Entity\TextQuestion',
    );

    function create($name) {
        if(!isset($this->classMap[$name])){
            throw new InvalidArgumentException('There is no '.$name.' index in classMap');
        }
        return new $this->classMap[$name];
    }
}