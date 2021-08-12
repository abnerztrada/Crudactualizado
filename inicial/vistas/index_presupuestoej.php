<?php require_once('../../../config.php');
require_once('../modelos/presupuestoej.php');

global $DB, $OUTPUT, $PAGE;

$PAGE->set_url('/blocks/inicial/vistas/index_presupuestoej.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_inicial'));
$PAGE->set_context(\context_system::instance());
$settingsnode = $PAGE->settingsnav->add(get_string('inicialsetting', 'block_inicial'));
$editurl = new moodle_url('/blocks/inicial/vistas/index_presupuestoej.php');
$editnode = $settingsnode->add(get_string('editpage', 'block_inicial'), $editurl);
$editnode->make_active();

if(is_siteadmin()){
echo $OUTPUT->header();
$response_id = optional_param('response_id', null, PARAM_INT);
$response_condicion = optional_param('response_condicion', 1, PARAM_INT);

if($response_condicion==0){
  $actualizateform = new queryPresupuestoej();
  $presupuesto = $actualizateform->eliminar($response_id);
  $response_condicion=1;
}
echo "<h2>Área de presupuesto</h2>";
echo '<a style="margin: 10px 40px 10px 430px" href="https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/create_presupuestoej.php" class="btn btn-primary">Crear nuevo presupuesto</a>';
$actualizateform = new QueryPresupuestoej();
$presupuesto = $actualizateform->listar();
$templatecontext = (object)[
    'presupuestosej' => $presupuesto,
];

  echo $OUTPUT->render_from_template('block_inicial/presupuestoej',$templatecontext);



echo '<a style="margin-left: 10px" href="https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_segmento.php" class="btn btn-primary width: ">Área de segmento</a>';
echo '<a style="margin-left: 10px" href="https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_agrupacion.php" class="btn btn-primary">Área de agrupación</a>';
echo '<a style="margin-left: 10px" href="https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_ejecucion.php" class="btn btn-primary width: ">Área de ejecuciones</a>';
echo '<a style="margin: 0px 0px 0px 10px" href="https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_presupuesto.php" class="btn btn-primary width: ">Área de presupuesto</a>';
echo $OUTPUT->footer();
}

?>
