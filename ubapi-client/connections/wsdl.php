<?

// Identification Datas
$authRequest = array(
	'user' => 'YOUR_USER_NAME', 
	'apiKey' => 'YOUR_API_KEY'
);

// Define App Path
$_WSDL_APP_PATH = $_SERVER['DOCUMENT_ROOT'].'/ubapi-client';
// Define Cache timing
$_WSDL_CACHING_TIME = 3600;



########## MICROCACHING SYSTEM ##########

// Define Cache Path 
define( 'CACHE_PATH', $_WSDL_APP_PATH.'/cache'); 

################ AUTOLOAD ###############
include($_WSDL_APP_PATH.'/includes/autoload.php');



######################## CONNECT TO WSDL ########################

ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache

// endpoint
$ub = new SoapClient("https://ssl.upbooking.com/ws/inventory.xml");

$objCaGetUserCred = new class_cache; 

$authResponse = $objCaGetUserCred->load('get_user_credentials'); 

// if use_cache return false, this write cache 
if(!$objCaGetUserCred->use_cache()) { 
	$authResponse = $ub->authUser($authRequest);
	$objCaGetUserCred->save('get_user_credentials', $authResponse, $_WSDL_CACHING_TIME); 
}

function getWSDL($ubReq = array(),$debug=0){
	global $ub;
	$ubRes = array();
	$cacheUb[$ubReq['ubCall']] = new class_cache;
	$registerVal = $ubReq['ubCall'].'_'.implode("_", $ubReq['ubParams']);

	$ubRes = $cacheUb[$ubReq['ubCall']]->load($registerVal); 

	// if use_cache return false, this write cache 
	if(!$cacheUb[$ubReq['ubCall']]->use_cache()) { 
		$ubRes = $ub->getDynFunc($ubReq);
		$cacheUb[$ubReq['ubCall']]->save($registerVal, $ubRes, $_WSDL_CACHING_TIME); 
	} 
	if ($debug==0){
		return $ubRes;
	} else {		
		printArray($ubRes);
	}
}

//****** WSDL DEBUG - only for testing purposes ********
	function wsdlDebug($array, $res = false){
	$string = '<pre>' . print_r($array, true) . '</pre>';
	if($res) return $string;
	else echo $string;
}
//*******************************************************


