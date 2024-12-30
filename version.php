<?php
defined('MOODLE_INTERNAL') || die();

$plugin->component = 'local_transcript';
$plugin->version = 2025010100; // YYYYMMDDXX
$plugin->requires = 2022041900; // Requires Moodle 4.0 or higher.
$plugin->maturity = MATURITY_STABLE;
$plugin->release = '1.0';
$plugin->dependencies = [
    'mod_assign' => 2022041900,
];