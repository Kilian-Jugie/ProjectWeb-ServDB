<?php

abstract class Request {
    protected $m_Name;

    public function __construct($name) {
        $this->m_Name = $name;
    }

    public function getName() {
        return $this->m_Name;
    }

    abstract public function execute($params,$input);
}