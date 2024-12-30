<?php
defined('MOODLE_INTERNAL') || die();

$capabilities = [
    'local/transcript:view' => [
        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
        'archetypes' => [
            'student' => CAP_ALLOW,
        ],
        'clonepermissionsfrom' => 'moodle/user:viewdetails',
    ],
];