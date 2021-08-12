<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
<?php
require_once("{$CFG->libdir}/formslib.php");
require_once('../modelos/presupuesto.php');

class uppresupuesto extends moodleform {

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



        $response_id = optional_param('response_id', null, PARAM_INT);
        $response_year = optional_param('response_year', null, PARAM_ALPHANUMEXT);
        $response_descripcion = optional_param('response_descripcion', null, PARAM_FORMAT);

        $mform-> addElement ('select', 'anual', get_string('anual', 'block_inicial'), $years);
        $mform-> setType('anual', PARAM_ALPHANUMEXT);
        $mform-> setDefault('anual', $response_year);

        $mform-> addElement ('text', 'nombre_presupuesto', get_string('nombre_presupuesto', 'block_inicial'));
        $mform-> setType('nombre_presupuesto', PARAM_FORMAT);
        $mform-> setDefault('nombre_presupuesto', $response_descripcion);

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
        $registro->years = optional_param('anual', '', PARAM_ALPHANUMEXT);
        $registro->descripcion = optional_param('nombre_presupuesto', '', PARAM_FORMAT);

        $resultado = $DB->update_record('cmipresupuesto',$registro, $bulk= false);
        echo '<script>
          swal({
            title: "Success!",
            text: "Presupuesto actualizado!",
            type: "success"
          }).then(function() {
            window.location = "https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_presupuesto.php";
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
