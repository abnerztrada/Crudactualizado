<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
<?php
require_once("{$CFG->libdir}/formslib.php");
require_once('../modelos/ejecucion.php');

class upejecucion extends moodleform {

    function definition() {

        $mform =& $this->_form;
        global $DB;

        $years = [];
        $year = date('Y');
        $lcont = 0;
        while($lcont<10){
          $years[$lcont] = $year+$lcont;
          $lcont++;
        }

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
        $response_idp = optional_param('response_idp', null, PARAM_INT);
        $response_valor = optional_param('response_valor', null, PARAM_NUMBER);
        $response_segmento= optional_param('response_segmento', null, PARAM_ALPHANUMEXT);
        $response_agrupacion= optional_param('response_agrupacion', null, PARAM_ALPHANUMEXT);

        $mform-> addElement ('select', 'anual', get_string('anual', 'block_inicial'), $years);
        $mform-> setType('anual', PARAM_ALPHANUMEXT);
        $mform-> setDefault('anual', $response_year);

        $mform-> addElement ('select', 'mes', get_string('mes', 'block_inicial'), $meses);
        $mform-> setType('mes', PARAM_ALPHANUMEXT);
        $mform-> setDefault('mes', $response_month);

        $mform-> addElement ('select', 'presupuesto', get_string('presupuesto', 'block_inicial'), $result3);
        $mform-> setType('presupuesto', PARAM_FORMAT);
        $mform-> setDefault('presupuesto', $response_idp);

        $mform-> addElement ('text', 'valor', get_string('valor', 'block_inicial'));
        $mform-> setType('valor', PARAM_NUMBER);
        $mform-> setDefault('valor', $response_valor);

        $mform-> addElement ('select', 'segmento', get_string('segmento', 'block_inicial'), $result);
        $mform-> setDefault('segmento',  PARAM_ALPHANUMEXT);
        $mform-> setType('segmento', $response_segmento);

        $mform-> addElement ('select', 'agrupacion', get_string('agrupacion', 'block_inicial'), $result2);
        $mform-> setDefault('agrupacion',  PARAM_ALPHANUMEXT);
        $mform-> setType('agrupacion', $response_agrupacion);


        $mform-> addElement ('hidden', 'actuid', get_string('actuid', 'block_inicial'));
        $mform-> setType('actuid', PARAM_ALPHANUMEXT);
        $mform-> setDefault('actuid', $response_id);

        $mform-> addElement ('submit', 'actualizar', get_string('actualizar', 'block_inicial'));


        if(isset($_POST["actualizar"])){
          $response_id = optional_param('actuid', 4, PARAM_INT);
          $registro->id = $respons_id;
          // var_dump($response_id);

        $registro = new stdClass();
        $response_id = optional_param('actuid', 4, PARAM_INT);
        $registro->id = $response_id;
        $registro->years = optional_param('anual', '', PARAM_ALPHANUMEXT);
        $registro->months = optional_param('mes', '', PARAM_ALPHANUMEXT);
        $registro->id_presupuesto = optional_param('presupuesto', '', PARAM_FORMAT);
        $registro->valor = optional_param('valor', '', PARAM_NUMBER);
        $registro->id_segmento = optional_param('segmento', '', PARAM_INT);
        $registro->id_agrupacion = optional_param('agrupacion', '', PARAM_INT);

        $resultado = $DB->update_record('cmiejecucion',$registro, $bulk= false);
        echo '<script>
          swal({
            title: "Success!",
            text: "Ejecución actualizado!",
            type: "success"
          }).then(function() {
            window.location = "https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_ejecucion.php";
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
