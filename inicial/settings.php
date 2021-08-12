<?php
$settings->add(new admin_setting_heading(
            'headerconfig',
            get_string('headerconfig', 'block_inicial'),
            get_string('descconfig', 'block_inicial')
        ));

$settings->add(new admin_setting_configcheckbox(
            'inicial/Allow_HTML',
            get_string('labelallowhtml', 'block_inicial'),
            get_string('descallowhtml', 'block_inicial'),
            '0'

        ));
