<?php
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_transcript', get_string('pluginname', 'local_transcript'));
    $ADMIN->add('localplugins', $settings);

    $settings->add(new admin_setting_configcheckbox('local_transcript/enabled',
        get_string('enableplugin', 'local_transcript'),
        get_string('enableplugin_desc', 'local_transcript'), 1));
}