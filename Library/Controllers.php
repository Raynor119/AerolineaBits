<?php
    class Controllers{
        function __construct(){


            $this->view = new Views();
            $this->loadClassModels();
        }

        private function loadClassModels(){


            $model = get_class($this) . "Model";
            $path = "Models/" . $model . ".php";
            if(file_exists($path)){
                require $path;
                $this->model=new $model();

            }

        }
    }

?>