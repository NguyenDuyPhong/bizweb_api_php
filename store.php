<?php

// echo "signature: " . $_GET['signature'];

require __DIR__ . '/BizwebApi/BizwebClient.php';
session_start();
define("BIZWEB_API_KEY", ""); 
define("BIZWEB_SECRET", ""); 
	// nono: $_SESSION['shop']  
	// ok: $_SESSION['token']  
    $sc = new BizwebClient('nguyenduyphong.bizwebvietnam.net', '4548228799e840608cf3f0eff1cab9da', BIZWEB_API_KEY, BIZWEB_SECRET);  

	// var_dump($_SESSION); 
    try
    {
        // Get all products
        $products = $sc->call('GET', '/admin/store.json?page=1', array()); // NOT shop.json 
        
        echo "shop: " . $_SESSION['shop'];
        echo "<br/>token: " . $_SESSION['token'];
        echo "<br/>";
        
        echo "<pre>";
        var_dump($products);
        echo "</pre>";
        

    }
    catch (BizwebApiException $e)
    {
		var_dump($e); 
        /* 
         $e->getMethod() -> http method (GET, POST, PUT, DELETE)
         $e->getPath() -> path of failing request
         $e->getResponseHeaders() -> actually response headers from failing request
         $e->getResponse() -> curl response object
         $e->getParams() -> optional data that may have been passed that caused the failure

        */
    }
    
?>