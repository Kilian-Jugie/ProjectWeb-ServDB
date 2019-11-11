<?php

interface Action {
    public function execute($params, $input);
    public static function getInstance();
}