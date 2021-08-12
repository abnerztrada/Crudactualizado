<?php require_once('../../../config.php');
require_once('../forms/ejecucion.php');
global $DB, $OUTPUT, $PAGE;

$PAGE->set_url('/blocks/inicial/vistas/create_ejecucion.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_inicial'));
$PAGE->set_context(\context_system::instance());
$settingsnode = $PAGE->settingsnav->add(get_string('inicialsetting', 'block_inicial'));
$editurl = new moodle_url('/blocks/inicial/vistas/create_ejecucion.php');
$editnode = $settingsnode->add(get_string('editpage', 'block_inicial'), $editurl);
$editnode->make_active();

if(is_siteadmin()){
echo $OUTPUT->header();
echo "<h2>Área de creación</h2>";

$actualizateform = new ejecucion();
$segmento = $actualizateform->display();
echo '<a href="https://calidad.laucmi.telefonicaed.pe/blocks/inicial/vistas/index_presupuestoej.php" class="btn btn-danger">Cancelar</a>';
echo $OUTPUT->footer();
}
?>
