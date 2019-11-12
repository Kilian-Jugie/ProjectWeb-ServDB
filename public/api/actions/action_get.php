<?php

require_once 'config.php';
require_once 'action.php';

class ActionGet extends Action {
	private static $INSTANCE = null;

    public function execute($params, $input) {
		$requ = $this->getRequest($params["p0"]);
		if($requ)
			$requ->execute($params, $input);
		else
			echo "ERROR: No request for ".$params["p0"]." !!!\n";
	}
	
	public static function getInstance() {
		if(!self::$INSTANCE)
			self::$INSTANCE = new ActionGet();
		return self::$INSTANCE;
    }
}