<?php require_once('../../../config.php');
require_once('../forms/upsegmento.php');
global $DB, $OUTPUT, $PAGE;

$PAGE->set_url('/blocks/inicial/vistas/update_segmento.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_inicial'));
$PAGE->set_context(\context_system::instance());
$settingsnode = $PAGE->settingsnav->add(get_string('inicialsetting', 'block_inicial'));
$editurl = new moodle_url('/blocks/inicial/vistas/update_segmento.php');
$editnode = $settingsnode->add(get_string('editpage', 'block_inicial'), $editurl);
$editnode->make_active();

if(is_siteadmin()){
echo $OUTPUT->header();
echo "<h2>Área de actualización</h2>";

$response_id = optional_param('response_id', null, PARAM_INT);
$response_descripcion = optional_param('response_descripcion', null, PARAM_ALPHANUMEXT);

$actualizateform = new upsegmento();
$segmento = $actualizateform->display($response_id,$response_descripcion);
echo '<a href="https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_segmento.php" class="btn btn-danger center-block">Cancelar</a>';
echo $OUTPUT->footer();
}

?>
