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
require_once "request/get/own_owner.php";
require_once "request/get/order_detail.php";
require_once "request/get/all_product.php";
require_once "request/get/cart_data.php";
require_once "request/get/cart_detail.php";
require_once "request/get/all_product_type.php";
require_once "request/get/own_event.php";
require_once "request/get/get_stock.php";
require_once "request/get/all_stock.php";
require_once "request/get/all_size.php";
require_once "request/get/all_order.php";
require_once "request/get/request_actif_event_data.php";

require_once "request/post/add_campus.php";
require_once "request/post/add_event.php";
require_once "request/post/add_product.php";
require_once "request/post/add_size.php";
require_once "request/post/add_status.php";
require_once "request/post/add_type.php";
require_once "request/post/add_publication_type.php";
require_once "request/post/add_role.php";
require_once "request/post/add_to_cart.php";
require_once "request/post/add_product_type.php";
require_once "request/post/add_order.php";

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
require_once "request/put/update_product_cart.php";
require_once "request/put/update_publication_status.php";

require_once "request/delete/delete_campus.php";
require_once "request/delete/delete_comment.php";
require_once "request/delete/delete_event.php";
require_once "request/delete/delete_product.php";
require_once "request/delete/delete_size.php";
require_once "request/delete/delete_status.php";
require_once "request/delete/delete_stock.php";
require_once "request/delete/delete_type.php";
require_once "request/delete/delete_user.php";
require_once "request/delete/delete_product_cart.php";

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
		ActionGet::getInstance()->addRequest(new RequestOwnOrder("own_order"));
		ActionGet::getInstance()->addRequest(new RequestOrderDetail("order_detail"));
		ActionGet::getInstance()->addRequest(new RequestAllEvent("all_event"));
		ActionGet::getInstance()->addRequest(new RequestAllProduct("all_product"));
		ActionGet::getInstance()->addRequest(new RequestCartData("cart_data"));
		ActionGet::getInstance()->addRequest(new RequestCartDetail("cart_detail"));
		ActionGet::getInstance()->addRequest(new RequestAllProductType("all_product_type"));
		ActionGet::getInstance()->addRequest(new RequestOwnEvent("own_event"));
		ActionGet::getInstance()->addRequest(new RequestGetStock("get_stock"));
		ActionGet::getInstance()->addRequest(new RequestAllStock("all_stock"));
		ActionGet::getInstance()->addRequest(new RequestAllSize("all_size"));
		ActionGet::getInstance()->addRequest(new RequestAllOrder("all_order"));
		ActionGet::getInstance()->addRequest(new RequestActifEventData("actif_event_data"));

		self::registerActionForMethod('POST', ActionPost::getInstance());
		ActionPost::getInstance()->addRequest(new RequestAddUser("add_user"));
		ActionPost::getInstance()->addRequest(new RequestAddCampus("add_campus"));
		ActionPost::getInstance()->addRequest(new RequestAddEvent("add_event"));
		ActionPost::getInstance()->addRequest(new RequestAddProduct("add_product"));
		ActionPost::getInstance()->addRequest(new RequestAddSize("add_size"));
		ActionPost::getInstance()->addRequest(new RequestAddStatus("add_status"));
		ActionPost::getInstance()->addRequest(new RequestAddType("add_type"));
		ActionPost::getInstance()->addRequest(new RequestAddPublicationType("add_publication_type"));
		ActionPost::getInstance()->addRequest(new RequestAddRole("add_role"));
		ActionPost::getInstance()->addRequest(new RequestAddToCart("add_to_cart"));
		ActionPost::getInstance()->addRequest(new RequestAddProductType("add_product_type"));
		ActionPost::getInstance()->addRequest(new RequestAddOrder("add_order"));

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
		ActionPut::getInstance()->addRequest(new RequestUpdateUserStatus("update_user_status"));
		ActionPut::getInstance()->addRequest(new RequestUpdateProductCart("update_product_cart"));
		ActionPut::getInstance()->addRequest(new RequestUpdatePublicationStatus("update_publication_status"));

		self::registerActionForMethod('DELETE', ActionDelete::getInstance());
		ActionDelete::getInstance()->addRequest(new RequestDeleteCampus("delete_campus"));
		ActionDelete::getInstance()->addRequest(new RequestDeleteProduct("delete_product"));
		ActionDelete::getInstance()->addRequest(new RequestDeleteSize("delete_size"));
		ActionDelete::getInstance()->addRequest(new RequestDeleteStatus("delete_status"));
		ActionDelete::getInstance()->addRequest(new RequestDeleteStock("delete_stock"));
		ActionDelete::getInstance()->addRequest(new RequestDeleteType("delete_type"));
		ActionDelete::getInstance()->addRequest(new RequestDeleteUser("delete_user"));
		ActionDelete::getInstance()->addRequest(new RequestDeleteProductCart("delete_product_cart"));
		
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
