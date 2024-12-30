<?php
require_once('../../config.php');
require_once($CFG->libdir . '/pdflib.php');

require_login();

$context = context_user::instance($USER->id);
require_capability('local/transcript:view', $context);

$PAGE->set_url(new moodle_url('/local/transcript/index.php'));
$PAGE->set_context($context);
$PAGE->set_title(get_string('pluginname', 'local_transcript'));
$PAGE->set_heading(get_string('heading', 'local_transcript'));

$courses = enrol_get_users_courses($USER->id);
if (empty($courses)) {
    echo $OUTPUT->header();
    echo $OUTPUT->notification(get_string('nocourses', 'local_transcript'), 'info');
    echo $OUTPUT->footer();
    exit;
}

// Generate Transcript
if (optional_param('download', false, PARAM_BOOL)) {
    $pdf = new pdf();
    $pdf->SetFont('Helvetica', '', 12);
    $pdf->AddPage();
    $pdf->Write(5, "Transcript for {$USER->firstname} {$USER->lastname}\n\n");

    foreach ($courses as $course) {
        $grades = grade_get_course_grades($course->id, $USER->id);
        $finalgrade = $grades->grades[$USER->id]->str_grade ?? 'N/A';
        $pdf->Write(5, "Course: {$course->fullname} - Grade: {$finalgrade}\n");
    }

    $filename = "transcript_{$USER->id}.pdf";
    $pdf->Output($filename, 'D');
    exit;
}

// Render Page
echo $OUTPUT->header();

$templatecontext = [
    'courses' => array_values($courses),
    'downloadurl' => $PAGE->url->out(false, ['download' => 1]),
];

echo $OUTPUT->render_from_template('local_transcript/transcript', $templatecontext);

echo $OUTPUT->footer();