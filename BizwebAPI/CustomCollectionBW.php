<?php
/*
 * class for doing GET, POST, PUT, DELETE CustomCollection on Bizweb /admin/custom_collections... 
 * 
 * @author: phong.nguyen  
 */  
class CustomCollectionBW extends BizwebClient {  
	public function __construct($shop_domain, $token, $api_key, $secret) { 
        parent::__construct($shop_domain, $token, $api_key, $secret); 
    } 
	 
	/*
	 * Get one CustomCollection 
	 * 
	 * @author: phong.nguyen 20151028  
	 * @param: string $strID - CustomCollection ID 
	 */  
	public function get_one($strID){  
		return $this->call('GET', '/admin/custom_collections/' . $strID . '.json', array()); 
	}
	
	/*
	 * Get all CustomCollection 
	 * 
	 * @author: phong.nguyen 20151028  
	 * @param: string $strID - CustomCollection ID 
	 */  
	public function get_all(){  
		return $this->call('GET', '/admin/custom_collections.json', array()); 
	}
	
	/*
	 * post one CustomCollection  
	 * 
	 * @author: phong.nguyen 20151028  
	 * @param: array $arrData - CustomCollection data under array  
	 */  
	public function post_one($arrData){  
		// $arrData = array( 'custom_collection' => $arrData);   
		return $this->call('POST', '/admin/custom_collections.json', $arrData);  
	}
	
	/*
	 * Delete one CustomCollection  
	 * 
	 * @author: phong.nguyen 20151028  
	 * @param: string $strID - ID need to be deleted 
	 */  
	public function delete_one($strID){  
		return $this->call('DELETE', '/admin/custom_collections/' . $strID . '.json', array() );  
	}
	
	/*
	 * Update one CustomCollection  
	 * 
	 * @author: phong.nguyen 20151028  
	 * @param: string $strID - ID need to be updated 
	 * @param: array $arrData - CustomCollection data under array  
	 */  
	public function update_one($strID, $arrData){  
		// $arrData = array( 'custom_collection' => $arrData);   
		return $this->call('PUT', '/admin/custom_collections/' . $strID . '.json', $arrData);  
	} 
	 
	
	
	/*
	 * Add 1 Collection "$strCollectionTitle" inside array current Custom Collection.  
	 * Return relevant id for $strCollectionTitle. 
	 * 
	 * @author: phong.nguyen 20151028  
	 * @param: array $arrAllCurrentCC - MODIFIED, all current CustomCollections 
	 * @param: string $strCollectionTitle 
	 * @return: string $id 
	 */  
	public function add_one_cc(&$arrAllCurrentCC, $strCollectionTitle){   
		
		$strCCTitleChecking = trim($strCollectionTitle); 
		// $boFound = false; 
		$arrFoundCC = null; 
		foreach($arrAllCurrentCC as $arr1CC){
			$strCCTitle = trim($arr1CC['name']); 
			if($strCCTitle == $strCCTitleChecking){
				$arrFoundCC = $arr1CC; 
				break; 
			} 
		} 
		
		//check found == true/false 
		if($arrFoundCC != null){ 
			return $arrFoundCC['id'];  
		} 
		else{  
			// create new CC   
			$arrData = array(
				// 'custom_collection' => array(   // no need! 
					'alias' => $strCCTitleChecking, 
					'name' => $strCCTitleChecking, 
					// 'body_html' => '', // no need!!! 
				// )
			); 
			$arrNewCC = $this->post_one($arrData); 
			
			//update current CustomCollection 
			$arrAllCurrentCC[] = $arrNewCC; 
			
			//return New ID 
			return $arrNewCC['id'];  
		} 
		
	} 
	 
		
} 


