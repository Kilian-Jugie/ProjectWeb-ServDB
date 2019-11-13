<?php 
require_once "actions/action_get.php";
require_once "actions/action_post.php";
require_once "actions/action_put.php";
require_once "actions/action_delete.php";

require_once "request/request_viewall.php";
require_once "request/request_adduser.php";

class API
{
	private static $actions = array();
	
	static function registerActionForMethod($method, $action) {
		self::$actions[$method] = $action;
	}

	static function callActionForMethod($method, $dbParams, $dbInput) {
		foreach(self::$actions as $key => $iterator) {
			if($key === $method) {
				$iterator->execute($dbParams, $dbInput);
			}
		}
	}

	static function reqArgs($method, $params, $input) {
		self::registerActionForMethod('GET', ActionGet::getInstance());
		ActionGet::getInstance()->addRequest(new RequestViewAll("viewall"));
		ActionGet::getInstance()->addRequest(new RequestSelectCampus("select_campus"));

		self::registerActionForMethod('POST', ActionPost::getInstance());
		ActionPost::getInstance()->addRequest(new RequestAddUser("adduser"));

		self::registerActionForMethod('PUT', ActionPut::getInstance());
		self::registerActionForMethod('DELETE', ActionDelete::getInstance());
		
		self::callActionForMethod($method, $params, $input);
	}
}

/**
 * PSR-1 Note: This function does not follow camelCase rule because
 * of it specificity of not be called from PHP code but from js code.
 * This is the only exception allowed to this rule.
 */
function api_main($method, $params, $body) {
	$minimumParameterCount = 2;

	if(count($params)<$minimumParameterCount) {
		for($i=count($params); $i<$minimumParameterCount; $i++) {
			$params[$i] = "";
		}
		return;
	}

	if($body&&$body["test"]===true) {
		echo "Method:\n";
		var_dump($method);
		echo "\nParams:\n";
		var_dump($params);
		echo "\nBody:\n";
		var_dump($body);
		echo "\nResponse:\n";
	}
	API::reqArgs($method, $params, $body);
}

?>