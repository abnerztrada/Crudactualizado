<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
<?php
require_once("{$CFG->libdir}/formslib.php");
require_once('../modelos/presupuesto.php');

class uppresupuestoej extends moodleform {

    function definition() {

        $mform =& $this->_form;
        global $DB;

        // $years = [];
        // $year = date('Y');
        // $lcont = 0;
        // while($lcont<10){
        //   $years[$lcont] = $year+$lcont;
        //   $lcont++;
        // }

        $meses = [];
        $mes = date('M');
        $lcont = 1;
        while($lcont<=12){
          $meses[$lcont] = $mes+$lcont;
          $lcont++;
        }

        $sql = "SELECT id, descripcion FROM mdl_cmisegmento where condicion = 1";
        $result = array();
        $datas = $DB->get_records_sql($sql);
        foreach($datas as $data){
            $result[$data->id] = $data->descripcion;
        }

        $sql3 = "SELECT id, descripcion FROM mdl_cmipresupuesto where condicion = 1";
        $result3 = array();
        $datas1 = $DB->get_records_sql($sql3);
        foreach($datas1 as $data1){
          $result3[$data1->id] = $data1->descripcion;
        }

        $sql2 = "SELECT id, descripcion FROM mdl_cmiagrupacion where condicion = 1";
        $result2 = array();
        $datas1 = $DB->get_records_sql($sql2);
        foreach($datas1 as $data1){
            $result2[$data1->id] = $data1->descripcion;
        }

        $response_id = optional_param('response_id', null, PARAM_INT);
        $response_year = optional_param('response_year', null, PARAM_ALPHANUMEXT);
        $response_month = optional_param('response_month', null, PARAM_ALPHANUMEXT);
        $response_presupuesto  = optional_param('response_presupuesto', null, PARAM_FORMAT);
        $response_valor = optional_param('response_valor', null, PARAM_NUMBER);
        $response_agrupacion = optional_param('response_agrupacion', null, PARAM_INT);
        $response_segmento = optional_param('response_segmento', null, PARAM_INT);

        // $mform-> addElement ('select', 'anual', get_string('anual', 'block_inicial'), $years);
        // $mform-> setType('anual', PARAM_ALPHANUMEXT);
        // $mform-> setDefault('anual', $response_year);

        $mform-> addElement ('select', 'mes', get_string('mes', 'block_inicial'), $meses);
        $mform-> setType('mes', PARAM_ALPHANUMEXT);
        $mform-> setDefault('mes', $response_month);

        $mform-> addElement ('select', 'nombre_presupuesto', get_string('nombre_presupuesto', 'block_inicial'), $result3);
        $mform-> setType('nombre_presupuesto', PARAM_FORMAT);
        $mform-> setDefault('nombre_presupuesto', $response_presupuesto);

        $mform-> addElement ('text', 'valor', get_string('valor', 'block_inicial'));
        $mform-> setType('valor', PARAM_NUMBER);
        $mform-> setDefault('valor', $response_valor);

        $mform-> addElement ('select', 'agrupacion', get_string('agrupacion', 'block_inicial'), $result2);
        $mform-> setType('agrupacion', PARAM_ALPHA);
        $mform-> setDefault('agrupacion', $response_agrupacion);

        $mform-> addElement ('select', 'segmento', get_string('segmento', 'block_inicial'), $result);
        $mform-> setType('segmento', PARAM_ALPHANUMEXT);
        $mform-> setDefault('segmento', $response_segmento);

        $mform-> addElement ('hidden', 'actuid', get_string('actuid', 'block_inicial'));
        $mform-> setType('actuid', PARAM_ALPHANUMEXT);
        $mform-> setDefault('actuid', $response_id);

        $mform-> addElement ('submit', 'actualizar', get_string('actualizar', 'block_inicial'));


        if(isset($_POST["actualizar"])){
          $response_id = optional_param('actuid', 4, PARAM_INT);
          $registro->id = $respons_id;
          var_dump($response_id);

        $registro = new stdClass();
        $response_id = optional_param('actuid', 4, PARAM_INT);
        $registro->id = $response_id;
        $registro->months = optional_param('mes', '', PARAM_ALPHANUMEXT);
        $registro->id_presupuesto = optional_param('nombre_presupuesto', '', PARAM_FORMAT);
        $registro->valor = optional_param('valor', '', PARAM_NUMBER);
        $registro->id_segmento = optional_param('segmento', '', PARAM_ALPHANUMEXT);
        $registro->id_agrupacion = optional_param('agrupacion', '', PARAM_ALPHANUMEXT);

        $resultado = $DB->update_record('cmipresupuestoej',$registro, $bulk= false);
        echo '<script>
          swal({
            title: "Success!",
            text: "Presupuesto actualizado!",
            type: "success"
          }).then(function() {
            window.location = "https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_presupuestoej.php";
          });
        </script>';
        }
    }
}

?>

<script>
$(document).ready(function(){
  $('#id_valor').keyup(function (event) {
    if (event.which !== 8 && event.which !== 0 && event.which < 48 || event.which > 57  || event.which == 46){
      $(this).val(function (index, value) {
        return value.replace(/[^0-9\.]/g, "");
      });
    }
  });
})

</script>
