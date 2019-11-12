<?php

abstract class Action {
    private $m_Requests = array();

    public function addRequest($request) {
        array_push($this->m_Requests, $request);
    }

    protected function getRequest($name) {
        foreach($this->m_Requests as $iterator) {
            if($iterator->getName() === $name) 
                return $iterator;
        }
        return null;
    }

    abstract public function execute($params, $input);
    abstract public static function getInstance();
}