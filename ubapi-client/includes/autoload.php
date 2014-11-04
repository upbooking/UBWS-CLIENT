<?

############ AUTOLOAD - BISOGNA RICONFIGURARE LE CLASSI ###############

//Definimos las rutas que vamos a utilizar en el plugin

define('UBSYS_UBWS_PATH' , '/core/autoload');

function ub_autoload($className){

	// Convert class name to filename format.
	$paths = array(
	   UBSYS_UBWS_PATH,
	);

	// Buscamos en cada ruta los archivos
	foreach($paths as $path) {		
		if(file_exists($_WSDL_APP_PATH.$path."/".$className."/class.".$className.".php")){		
			require_once($_WSDL_APP_PATH.$path."/".$className."/class.".$className.".php");		
		}	
	}
}
spl_autoload_register('ub_autoload');
####################################################################