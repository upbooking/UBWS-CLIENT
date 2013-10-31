<?
require($_SERVER['DOCUMENT_ROOT'].'/public/ubapi-client/connections/wsdl.php'); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<p>Upbooking API Connection Example with Caching System </p>
<p>
<?
$ubReq = array(
		"user" => $authRequest["user"], 
		"secret" => $authResponse["secret"],
		"ubCall" => "getAllCollectionsByUser",
		"ubParams" => array(
			"user" => $authRequest["user"]
		)
	);

	$ubRes = getWSDL($ubReq);
	
	wsdlDebug($ubRes);
?>
</p>
</body>
</html>
