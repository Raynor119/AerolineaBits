<?php
    class Connection{
        function __construct(){
            $this->db= new PDOManager("raynor", "67895421d", "db_contactos");
        }
    }
?>