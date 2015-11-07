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
	
	/* 
	 * Add 1 collection for a product.   
	 * 
	 * @author: phong.nguyen 20151028  
	 * @param: string $strProID - Product ID  
	 * @param: string $strCollectionTitle - Collection Title  
	 * @param: array $arrAllCurrentCC - MODIFIED, all Custom Collection   
	 * @param: array $objCCollectHRV - object HaravanClient "Custom Collection"  
	 * @param: array $objCollectHRV - object HaravanClient "Collect"   
	 */  
	public function add_one_collection($strProID, $strCollectionTitle, &$arrAllCurrentCC, $objCCollectHRV, $objCollectHRV){  
		// get id for Custom Collection "$strCollectionTitle"  
		$strCCRelevantID = $objCCollectHRV->add_one_cc($arrAllCurrentCC, $strCollectionTitle);  
		
		// add current Custom Collection for a product  
		$arrCollectData = array(
			// 'collect' => array( // no need! 
				'product_id' => $strProID, 
				'collection_id' => $strCCRelevantID, 
			// ) 
		); 
		$arrCollects = $objCollectHRV->post_one($arrCollectData);   
		
		return $strCCRelevantID; 
	} 
	
	
	/*
	 * check existing product by Haravan handle 
	 * 
	 * @author: phong.nguyen 20151021  
	 * @param: string $strProHandle - Handle need to be checked   
	 * @param: array $arrAllProducts - Product data under array  
	 */  
	public function check_existing_product($strProHandle, $arrAllProducts){   
		$boFound = false; 
		$strProID = null; 
		foreach($arrAllProducts as $arrPro){
			if ($strProHandle == $arrPro['alias']){
				$boFound = true; 
				$strProID = $arrPro['id']; 
				break;  
			}
		}
		
		return $strProID; 
	} 
	
	
} 


?>
