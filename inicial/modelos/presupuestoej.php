<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
<?php
require_once("{$CFG->libdir}/formslib.php");

class queryPresupuestoej{

  public function listar(){

    global $DB;

    $sql2 = "SELECT cpe.*,
    (case
      WHEN cp.years = 0
        THEN '2021'
      WHEN cp.years = 1
        THEN '2022'
      WHEN cp.years = 2
        THEN '2023'
      WHEN cp.years = 3
        THEN '2024'
      WHEN cp.years = 4
        THEN '2025'
      WHEN cp.years = 5
        THEN '2026'
      WHEN cp.years = 6
        THEN '2027'
      WHEN cp.years = 7
        THEN '2028'
      WHEN cp.years = 8
        THEN '2029'
      WHEN cp.years = 9
        THEN '2030'
        end) as año,
      (case
        WHEN cpe.months = 1
          THEN 'Enero'
        WHEN cpe.months = 2
          THEN 'Febrero'
        WHEN cpe.months = 3
          THEN 'Marzo'
        WHEN cpe.months = 4
          THEN 'Abril'
        WHEN cpe.months = 5
          THEN 'Mayo'
        WHEN cpe.months = 6
          THEN 'Junio'
        WHEN cpe.months = 7
          THEN 'Julio'
        WHEN cpe.months = 8
          THEN 'Agosto'
        WHEN cpe.months = 9
          THEN 'Septiembre'
        WHEN cpe.months = 10
          THEN 'Octubre'
        WHEN cpe.months = 11
          THEN 'Noviembre'
        WHEN cpe.months = 12
          THEN 'Diciembre'
          end) as mes,
      cs.id as id_segmento,cg.id as id_agrupacion,cs.descripcion, cg.descripcion as descripcion2,
      cp.descripcion as descripcion3
      FROM mdl_cmipresupuestoej cpe
            INNER JOIN mdl_cmipresupuesto cp ON cp.id = cpe.id_presupuesto
            INNER JOIN mdl_cmisegmento cs ON cs.id = cpe.id_segmento
            INNER JOIN mdl_cmiagrupacion cg ON cg.id = cpe.id_agrupacion
            where cpe.condicion = 1";

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
      $resultado1 = $DB->update_record('cmipresupuestoej',$registro_update1, $bulk= false);
      echo '<script>
      swal({
          title: "Deleted!",
          text: "Presupuesto eliminado!",
          type: "warning"
        }).then(function(){
            window.location = "https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_presupuestoej.php";
          });
      </script>';

      // .then(function() {
      //   window.location = "http://cursos.mayahonh.com/blocks/inicial/vistas/index_agrupacion.php";
      // }
  }
}
?>
