# Bizweb_api_php
phong.nguyen 20151028 
Bizweb Client API for php 

# usage inside CodeIgniter app: 
- Put BizwebAPI inside folder **".../third_party/"**  
- Use classes by this LOC 
```php
require_once APPPATH."/third_party/BizwebAPI/autoload.php";    
```
- Get token  
. Please read docs: https://docs.shopify.com/api/authentication/oauth   
. View a demo app included inside this stuff. 

- Get 1 product by id 

```ruby
$proBW = new ProductBW( 'your_Bizweb_store.myBizweb.com', 'your_Bizweb_token', 'your_Bizweb_api_key', 'your_Bizweb_api_secret'); 
$product = $proBW->get_one('1000459014');  
``` 
