<?php
    require "config.php";
    //$url = isset($_GET["url"]) ? $_GET["url"]: "Vista/principal";
    $url= $_SERVER["REQUEST_URI"];

    session_start();
 
    $url = explode("/", $url);
    
    $controller = "";
    $method = "";
    $cont=1;
    foreach($url as $t){
        
        if($cont==2){
            $controller=$t;
        }
        if($cont==3){
            $method=$t;
        }
        $cont=$cont+1;   
    }




    
    spl_autoload_register(function($class){
        if(file_exists(LB.$class . ".php")){
            require LB.$class . ".php";
        }
    });



    require 'Controllers/Error.php';
    $error = new Errors();
    
   
    $controllerPath = "Controllers/" . $controller .'.php';
    
    
    if(file_exists($controllerPath)){
   
        require $controllerPath;

        $controller = new $controller();

        if(isset($method)){
        
 
            if(method_exists($controller, $method)){
                if($method=="inicio"){
                    $usuario = $_SESSION['usuario'];
                    $roll=$_SESSION['roll'];

                    

                    if($usuario !="" ){
                        if($roll=="pasajero"){
                            $method="pasajero";
                            $controller->{$method}();
                        }else{
                            $method="Vrecepcionista";
                            $controller->{$method}();
                        }
                    }else{
                        $controller->{$method}();
                    }
                }else{
                $controller->{$method}();
                }
            }
            else
                $error->error();
        }
    }else
        $error->error();


?>