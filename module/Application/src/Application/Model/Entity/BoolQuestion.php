<?php

namespace Application\Model\Entity;


use Application\Model\QuestionInterface;

class BoolQuestion implements QuestionInterface{

    public  $id;
    public  $text;

    public function exchangeArray($data){
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->text = (!empty($data['text'])) ? $data['text'] : null;
    }
} 