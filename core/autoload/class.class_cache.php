<?

// this is a simple cache class, the performance is not good
// and is better to change it with some serious caching system
class class_cache { 
     
    public $check_cache = false; 
     
    public function save( $name, $value, $timeout = 0) { 
     
        $cache_file = "<?PHP\n\n";          
        $cache_file .= "/*\n    CACHE FILE NAME: ". $name ."\n    GENERATE TIME: ". date('c') ."\n*/\n\n";          
        $timeout = $timeout + time(); 
        $cache_file .= "//cache timeout\n" . '$timeout = '. $timeout . ";\n\n";           
        $cache_file .= "//cache content\n" . '$cache_variable = '. var_export($value, true) .';';          
        $cache_file .= "\n\n?>"; 
        return file_put_contents( CACHE_PATH .'/'. $name .'.php', $cache_file); 
    } 
     
    public function load($name) {      
        if( file_exists(CACHE_PATH .'/'. $name .'.php')) {           
            include CACHE_PATH .'/'. $name .'.php';              
            if($timeout > time()) { 
                $this -> check_cache = true; 
            }              
            return $cache_variable;              
        } else {          
            return "<b>Error</b>\n\n Cache file does not exists."; 
        } 
    } 
     
    public function use_cache() { 
        return $this->check_cache; 
    } 
         
    public function flush( $name) {      
        if( file_exists( CACHE_PATH .'/'. $name .'.php')) {          
            unlink( CACHE_PATH .'/'. $name .'.php'); 
        } 
    }  
} 