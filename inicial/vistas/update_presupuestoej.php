<?php require_once('../../../config.php');
require_once('../forms/uppresupuestoej.php');
global $DB, $OUTPUT, $PAGE;

$PAGE->set_url('/blocks/inicial/vistas/update_presupuestoej.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_inicial'));
$PAGE->set_context(\context_system::instance());
$settingsnode = $PAGE->settingsnav->add(get_string('inicialsetting', 'block_inicial'));
$editurl = new moodle_url('/blocks/inicial/vistas/update_presupuestoej.php');
$editnode = $settingsnode->add(get_string('editpage', 'block_inicial'), $editurl);
$editnode->make_active();

if(is_siteadmin()){
echo $OUTPUT->header();
echo "<h2>Área de actualización</h2>";
$response_id = optional_param('response_id', null, PARAM_INT);
$response_month = optional_param('response_month', null, PARAM_ALPHANUMEXT);
$response_presupuesto = optional_param('response_presupuesto', null, PARAM_ALPHANUMEXT);
$response_valor = optional_param('response_valor', null, PARAM_NUMBER);
$response_agrupacion = optional_param('response_agrupacion', null, PARAM_INT);
$response_segmento = optional_param('response_segmento', null, PARAM_INT);


$actualizateform = new uppresupuestoej();
$segmento = $actualizateform->display($response_id,$response_month,$response_presupuesto,$response_valor,$response_agrupacion,$response_segmento);
echo '<a href="https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_presupuestoej.php" class="btn btn-danger center-block">Cancelar</a>';
echo $OUTPUT->footer();
}

?>
