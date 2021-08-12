<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
<?php
require_once("{$CFG->libdir}/formslib.php");

class querySegmento{

  public function listar(){

    global $DB;

    $sql2 = "SELECT * FROM mdl_cmisegmento where condicion=1";

    $result2 = array();
    if ($datas = $DB->get_records_sql($sql2)) {
      foreach($datas as $data) {
        array_push($result2,(array)$data);
      }
    }
    return $result2;
  }
  public function eliminar(){
    global $DB;


      $registro_update1 = new stdClass();
      $registro_update1->id = optional_param('response_id', null, PARAM_INT);;
      $registro_update1->condicion = 0;
      $resultado1 = $DB->update_record('cmisegmento',$registro_update1, $bulk= false);
      echo '<script>
      swal({
          title: "Deleted!",
          text: "Segmento eliminado!",
          type: "warning"
        });
      </script>';
  }
}
?>
