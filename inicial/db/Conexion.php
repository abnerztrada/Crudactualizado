<?php
require_once('access.php');

if(mysqli_connect_error()){
    printf("Fallo conexión a la base de datos: %s\n", mysqli_connect_error()); 
    exit(); 
}

if(!function_exists('ejecutarConsulta'))
{
    function ejecutarConsulta($sql)
    {
        global $DB; 
        $query = $DB->query($sql); 
    }

    function ejecutarConsultaSimpleFila($sql)
    { 
        global $DB; 
        $query = $DB->query($sql);
        $row = $query->fetch_assoc(); 
        return $row;
    }

    function ejecutar_retornarID($sql)
    { 
        global $DB; 
        $query = $DB->query($sql);
        return $DB->insert_id;
    }


    function limpiarCadena($str)
    { 
        global $DB; 
        $str = mysqli_real_escape_string($DB, trim($str)); 
        return htmlspecialchars($str);
    }
    
}

?>