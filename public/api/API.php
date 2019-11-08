<?php 
include "BDD.php";

class API
{
	/*function __construct()
	{
		$this->reqArgs();

	}*/

	function getTableName($request) {
		$slashPos = strpos($request, "/", 1);
		if($slashPos === false) {
			return substr($request, 1);
		}
		else {
			return substr($request, 1, $slashPos-1);
		}
	}

	function getKey($request) {
		return substr($request, strpos($request, "/", 1)+1);
	}
	
	static function reqArgs($method, $table, $key, $input)
	{
		
		//$method = $_SERVER['REQUEST_METHOD'];
		//$request = $_SERVER['PATH_INFO'];
		//$input = file_get_contents("php://input");
	
		//$table = $this->getTableName($request);
		//$key = $this->getKey($request);
			
	
		if($method){
			$bdd = new BDD();
			switch($method) {
				case "GET": {
					$bdd->getAction($table, $key);
				}break;
				case "POST": {
					$bdd->postAction($table, $input);
				}break;
				case "PUT": {
					$bdd->putAction($table, $key, $input);
				}break;
				case "DELETE": {
					$bdd->deleteAction($table, $key);
				}break;
			}
		}
	}
}

new API();

function api_main($method, $params, $body) {
	if($body&&$body["test"]===true) {
		echo "Method:\n";
		var_dump($method);
		echo "\nParams:\n";
		var_dump($params);
		echo "\nBody:\n";
		var_dump($body);
		echo "\nResponse:\n";
	}
	//phpinfo();
	//echo $method." localhost/api/".$params["table"]."/".$params["key"];
	//var_dump($body);
	API::reqArgs($method, $params["table"], $params["key"], $body);
	//echo "Test:";
	//echo "YESSSSSS:".$params["table"]."+".$params["key"]."+";
	//var_dump($body);
	//echo " END";
}

?>