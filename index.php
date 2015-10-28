<?php
/*
 * index.php for getting token 
 * 
 * @author: phong.nguyen 20151028   
 */ 
require __DIR__ . '/BizwebAPI/BizwebClient.php';
//pro  https://phongnd.bizwebvietnam.net/admin/api/auth/?api_key=538492d90e9be03a46b57919a16c9840
//pro  https://phongnd.bizwebvietnam.net/admin/app#/embed/538492d90e9be03a46b57919a16c9840 
// https://app.shopify.com/services/partners/apiclient#/detail/1000023239 
// array(4) { ["shop"]=> string(21) "phongnd.bizwebvietnam.net" ["timestamp"]=> string(10) "1432195146" ["signature"]=> string(64) "2470dba6ff96ef19b0113131c0364e7c7489860f8ac4da46e4bca399a1929108" ["code"]=> string(64) "764ed580f6cd4677ae798820454cbc57c1e066a9fee1400b8c6014a0ac0054d4" } 
// 

// shoify config. 
define("BIZWEB_API_KEY", "797c456c504bcf1c9a42964851e55d80"); // EGANY on Bizweb 
define("BIZWEB_SECRET", "419313b6c64bf212597c0a64573d56eb");
define("REDIRECT_URI", "http://localhost/bizweb_app_phong"); 
define("BIZWEB_SCOPE", "read_products,write_products");
session_start();

    if (isset($_GET['code'])) { // if the code param has been sent to this page... we are in Step 2
        // Step 2: do a form POST to get the access token
        $shopifyClient = new BizwebClient($_GET['store'], "", BIZWEB_API_KEY, BIZWEB_SECRET);
        session_unset();

        // if(!$shopifyClient->validateSignature($_GET)) die('Error: invalid signature.');
// var_dump($_GET);  
// die( "signature: " . $_GET['signature']); 


        // Now, request the token and store it in your session.
        $token =  $shopifyClient->getAccessToken($_GET['code'], REDIRECT_URI);
        $_SESSION['token'] = $token;
        if ($_SESSION['token'] != '')
            $_SESSION['shop'] = $_GET['shop'];

        echo $token;

        header("Location: shop.php");
        exit;       
    }
    // if they posted the form with the shop name
    else if (isset($_POST['shop']) || isset($_GET['shop'])) {

        // Step 1: get the shopname from the user and redirect the user to the
        // shopify authorization page where they can choose to authorize this app
        $shop = isset($_POST['shop']) ? $_POST['shop'] : $_GET['shop'];
        $shopifyClient = new BizwebClient($shop, "", BIZWEB_API_KEY, BIZWEB_SECRET);

        // if(!$shopifyClient->validateSignature($_GET)) die('Error: invalid signature.');
        
        // redirect to authorize url
        header("Location: " . $shopifyClient->getAuthorizeUrl(BIZWEB_SCOPE, REDIRECT_URI));
        exit;
    }

    // first time to the page, show the form below
?>
    <p>Install this app in a shop to get access to its private admin data.</p> 

    <p style="padding-bottom: 1em;">
        <span class="hint">Don&rsquo;t have a shop to install your app in handy? <a href="https://app.shopify.com/services/partners/dev_shops/new">Create a test shop.</a></span>
    </p> 

    <form action="" method="post">
      <label for='shop'><strong>The URL of the Shop</strong> 
        <span class="hint">(enter it exactly like this: myshop.bizwebvietnam.net)</span> 
      </label> 
      <p> 
        <input id="shop" name="shop" size="45" type="text" value="" /> 
        <input name="commit" type="submit" value="Install" /> 
      </p> 
    </form>