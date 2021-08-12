<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
<?php
require_once("{$CFG->libdir}/formslib.php");
// require_once('../modelos/Querymodelos.php');


class presupuesto extends moodleform {

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

        $mform-> addElement ('select', 'anual', get_string('anual', 'block_inicial'), $years);
        $mform-> setDefault('anual', 'default value');
        $mform-> setType('anual', PARAM_ALPHANUMEXT);


        $mform-> addElement ('text', 'nombre_presupuesto', get_string('nombre_presupuesto', 'block_inicial'));

        $mform-> addElement ('submit', 'guardar',  get_string('guardar', 'block_inicial'));


        if(isset($_POST["guardar"])){
          $registro = new stdClass();
          $registro->years = optional_param('anual', '', PARAM_ALPHANUMEXT);
          $registro->descripcion = optional_param('nombre_presupuesto', '', PARAM_ALPHANUMEXT);
          $resultado = $DB-> insert_record('cmipresupuesto',$registro);
         echo '<script>
          swal({
            title: "Success!",
            text: "Presupuesto creado!",
            type: "success"
            }).then(function() {
            window.location = "https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_presupuesto.php";
            });
          </script>';

      }
    }
}

?>
