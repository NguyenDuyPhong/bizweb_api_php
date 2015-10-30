<?php
/*
 * class for doing GET, POST, PUT, DELETE Product on Bizweb /admin/products... 
 * 
 * @author: phong.nguyen 
 */  
class ProductBW extends BizwebClient {  
	public function __construct($shop_domain, $token, $api_key, $secret) { 
        parent::__construct($shop_domain, $token, $api_key, $secret); 
    } 
	 
	/*
	 * get all products 
	 * 
	 * @author: phong.nguyen 20151029  
	 * @param: string $strID - Product ID 
	 */  
	public function get_all(){  
		return $this->call('GET', '/admin/products.json', array()); 
	}
	
	 
	/*
	 * get one product 
	 * 
	 * @author: phong.nguyen 20151029  
	 * @param: string $strID - Product ID 
	 */  
	public function get_one($strID){  
		return $this->call('GET', '/admin/products/' . $strID . '.json', array()); 
	}
	
	/*
	 * post one product  
	 * 
	 * @author: phong.nguyen 20151029  
	 * @param: array $arrData - Product data under array  
	 */  
	public function post_one($arrData){  
		return $this->call('POST', '/admin/products.json', $arrData);  
	}
	
	
	/*
	 * delete one product  
	 * 
	 * @author: phong.nguyen 20151029  
	 * @param: string $strID - ID need to be deleted 
	 */  
	public function delete_one($strID){  
		return $this->call('DELETE', '/admin/products/' . $strID . '.json', array() );  
	}
	
	/*
	 * update one product  
	 * 
	 * @author: phong.nguyen 20151029  
	 * @param: string $strID - ID need to be updated 
	 * @param: array $arrData - Product data under array  
	 */  
	public function update_one($strID, $arrData){  
		return $this->call('PUT', '/admin/products/' . $strID . '.json', $arrData);  
	}
} 

?>
