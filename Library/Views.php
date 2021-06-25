<?php
    class Views{
        function render($controller, $view){
            $controller= get_class($controller);
            
            require VW . $controller . "/" . $view . ".html";
            

        }
    }



?>