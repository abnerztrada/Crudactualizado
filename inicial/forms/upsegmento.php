<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
<?php
require_once("{$CFG->libdir}/formslib.php");
require_once('../modelos/segmento.php');

class upsegmento extends moodleform {

    function definition() {

        $mform =& $this->_form;
        global $DB;
        $response_id = optional_param('response_id', null, PARAM_INT);
        $response_descripcion = optional_param('response_descripcion', null, PARAM_ALPHANUMEXT);

        $mform-> addElement ('text', 'actudescripcion', get_string('actudescripcion', 'block_inicial'));
        $mform-> setType('actudescripcion', PARAM_ALPHANUMEXT);
        $mform-> setDefault('actudescripcion', $response_descripcion);

        $mform-> addElement ('hidden', 'actuid', get_string('actuid', 'block_inicial'));
        $mform-> setType('actuid', PARAM_ALPHANUMEXT);
        $mform-> setDefault('actuid', $response_id);

        $mform-> addElement ('submit', 'actualizar', get_string('actualizar', 'block_inicial'));

        if(isset($_POST["actualizar"])){
        $registro_update = new stdClass();
        $response_id=optional_param('actuid', 4, PARAM_INT);
        $response_descripcion=optional_param('actudescripcion', 'no lleva nada', PARAM_ALPHANUMEXT);
        $registro_update->id = $response_id;
        $registro_update->descripcion = $response_descripcion;
        $resultado = $DB->update_record('cmisegmento',$registro_update, $bulk= false);
        echo '<script>
          swal({
            title: "Success!",
            text: "Segmento actualizado!",
            type: "success"
          }).then(function() {
            window.location = "https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_segmento.php";
          });
        </script>';
        }
    }
}

?>
