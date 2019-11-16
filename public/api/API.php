<?php 
require_once "actions/action_get.php";
require_once "actions/action_post.php";
require_once "actions/action_put.php";
require_once "actions/action_delete.php";

require_once "request/request_viewall.php";
require_once "request/request_adduser.php";
require_once "request/request_selectcampus.php";
require_once "request/request_selectdatawhenconnect.php";

require_once "request/get/request_count_bde.php";
require_once "request/get/request_select_all_order.php";
require_once "request/get/all_event.php";
require_once "request/get/user_data.php";

require_once "request/post/add_campus.php";
require_once "request/post/add_event.php";
require_once "request/post/add_product.php";
require_once "request/post/add_size.php";
require_once "request/post/add_status.php";
require_once "request/post/add_type.php";
require_once "request/post/add_publication_type.php";

require_once "request/put/update_campus.php";
require_once "request/put/update_event.php";
require_once "request/put/update_own_data.php";
require_once "request/put/update_own_event.php";
require_once "request/put/update_product.php";
require_once "request/put/update_size.php";
require_once "request/put/update_status.php";
require_once "request/put/update_stock.php";
require_once "request/put/update_user_status.php";
require_once "request/put/update_user_data.php";
require_once "request/put/update_product_type.php";
require_once "request/put/update_publication_type.php";

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
		ActionGet::getInstance()->addRequest(new RequestSelectDataWhenConnect("data_when_connect"));
		ActionGet::getInstance()->addRequest(new RequestCountBde("count_bde"));
		ActionGet::getInstance()->addRequest(new RequestSelectAllOrder("all_order"));
		ActionGet::getInstance()->addRequest(new RequestUserData("user_data"));

		self::registerActionForMethod('POST', ActionPost::getInstance());
		ActionPost::getInstance()->addRequest(new RequestAddUser("add_user"));
		ActionPost::getInstance()->addRequest(new RequestAddCampus("add_campus"));
		ActionPost::getInstance()->addRequest(new RequestAddEvent("add_event"));
		ActionPost::getInstance()->addRequest(new RequestAddProduct("add_product"));
		ActionPost::getInstance()->addRequest(new RequestAddSize("add_size"));
		ActionPost::getInstance()->addRequest(new RequestAddStatus("add_status"));
		ActionPost::getInstance()->addRequest(new RequestAddType("add_type"));
		ActionPost::getInstance()->addRequest(new RequestAddPublicationType("add_publication_type"));

		self::registerActionForMethod('PUT', ActionPut::getInstance());
		ActionPut::getInstance()->addRequest(new RequestUpdateCampus("update_campus"));
		ActionPut::getInstance()->addRequest(new RequestUpdateEvent("update_event"));
		ActionPut::getInstance()->addRequest(new RequestUpdateOwnData("update_own_data"));
		ActionPut::getInstance()->addRequest(new RequestUpdateProduct("update_product"));
		ActionPut::getInstance()->addRequest(new RequestUpdateSize("update_size"));
		ActionPut::getInstance()->addRequest(new RequestUpdateStatus("update_status"));
		ActionPut::getInstance()->addRequest(new RequestUpdateStock("update_stock"));
		ActionPut::getInstance()->addRequest(new RequestUpdateUserData('update_user_data'));
		ActionPut::getInstance()->addRequest(new RequestUpdateProductType("update_product_type"));
		ActionPut::getInstance()->addRequest(new RequestUpdatePublicationType("update_publication_type"));

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
	/*if($body&&$body["test"]===true) {
		echo "Method:\n";
		var_dump($method);
		echo "\nParams:\n";
		var_dump($params);
		echo "\nBody:\n";
		var_dump($body);
		echo "\nResponse:\n";
	}*/
	API::reqArgs($method, $params, $body);
}

?>
