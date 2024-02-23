<?php

namespace mecatronicosrd;

class Categoria{
    private $config;
    private $cn = null;
    

    public function __construct()
    {
     
        $this->config = parse_ini_file(__DIR__.'/../config.ini');
        
        $this->cn = new \PDO($this->config['dns'],$this->config['usuario'],$this->config['clave'],array(
            \PDO:: MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8'
        ));

    }

   // funcion para mostrar
   public function mostrar(){
    $sql ="SELECT * FROM categorias";
    $resultado  = $this->cn->prepare($sql);
     
    

    if($resultado->execute())
        return $resultado-> fetchAll();

      return false;  
    
}


}