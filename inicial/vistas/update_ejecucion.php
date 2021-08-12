<?php require_once('../../../config.php');
require_once('../forms/upejecucion.php');
global $DB, $OUTPUT, $PAGE;

$PAGE->set_url('/blocks/inicial/vistas/update_ejecucion.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_inicial'));
$PAGE->set_context(\context_system::instance());
$settingsnode = $PAGE->settingsnav->add(get_string('inicialsetting', 'block_inicial'));
$editurl = new moodle_url('/blocks/inicial/vistas/update_ejecucion.php');
$editnode = $settingsnode->add(get_string('editpage', 'block_inicial'), $editurl);
$editnode->make_active();

if(is_siteadmin()){
echo $OUTPUT->header();
echo "<h2>Área de actualización</h2>";
$response_id = optional_param('response_id', null, PARAM_INT);
$response_year = optional_param('response_year', null, PARAM_ALPHANUMEXT);
$response_month = optional_param('response_month', null, PARAM_ALPHANUMEXT);
$response_idp = optional_param('response_idp', null, PARAM_ALPHANUMEXT);
$response_valor = optional_param('response_valor', null, PARAM_NUMBER);
$response_segmento= optional_param('response_segmento', null, PARAM_ALPHANUMEXT);
$response_agrupacion= optional_param('response_agrupacion', null, PARAM_ALPHANUMEXT);



$actualizateform = new upejecucion();
$segmento = $actualizateform->display($response_id,$response_year,$response_month,$response_idp,$response_valor,$response_segmento,$response_agrupacion);
echo '<a href="https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_ejecucion.php" class="btn btn-danger center-block">Cancelar</a>';
echo $OUTPUT->footer();
}
?>
