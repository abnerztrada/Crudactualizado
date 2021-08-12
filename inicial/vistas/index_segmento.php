<?php require_once('../../../config.php');
require_once('../modelos/segmento.php');

global $DB, $OUTPUT, $PAGE;

$PAGE->set_url('/blocks/inicial/vistas/index_segmento.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_inicial'));
$PAGE->set_context(\context_system::instance());
$settingsnode = $PAGE->settingsnav->add(get_string('inicialsetting', 'block_inicial'));
$editurl = new moodle_url('/blocks/inicial/vistas/index_segmento.php');
$editnode = $settingsnode->add(get_string('editpage', 'block_inicial'), $editurl);
$editnode->make_active();

if(is_siteadmin()){
echo $OUTPUT->header();

$response_id = optional_param('response_id', null, PARAM_INT);
$response_condicion = optional_param('response_condicion', 1, PARAM_INT);

if($response_condicion==0){
  $actualizateform = new QuerySegmento();
  $segmento = $actualizateform->eliminar($response_id);
  $response_condicion=1;
}

echo "<h2>Área de segmento</h2>";
echo '<a  style="margin: 10px 40px 10px 430px" href="https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/create_segmento.php" class="btn btn-primary">Crear nuevo segmento</a>';
$actualizateform = new QuerySegmento();
$segmento = $actualizateform->listar();
$templatecontext = (object)[
    'segmentos' => $segmento,
];


echo $OUTPUT->render_from_template('block_inicial/segmento',$templatecontext);

echo '<a  style="margin-left: 100px" href="https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_presupuestoej.php" class="btn btn-info">Regresar</a>';
echo $OUTPUT->footer();
}
?>
