<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
<?php
require_once("{$CFG->libdir}/formslib.php");


class agrupacion extends moodleform {

    function definition() {

        $mform =& $this->_form;
        global $DB;

        $mform-> addElement ('text', 'descripcion', get_string('descripcion', 'block_inicial'));
        $mform-> addElement ('submit', 'crear', get_string('crear', 'block_inicial'));

        if(isset($_POST["crear"])){
          $registro = new stdClass();
          $registro->descripcion = optional_param('descripcion', '', PARAM_TEXT);
          $resultado = $DB-> insert_record('cmiagrupacion',$registro);

          echo '<script>
          swal({
            title: "Success!",
            text: "Agrupación creada!",
            type: "success"
            }).then(function() {
            window.location = "https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_agrupacion.php";
            });
          </script>';
      }
  }
}

?>
