<?php
namespace local_transcript\output;

defined('MOODLE_INTERNAL') || die();

use table_sql;
use context_user;

class transcript_table extends table_sql {
    protected $userid;

    public function __construct($uniqueid, $userid) {
        parent::__construct($uniqueid);
        $this->userid = $userid;
        $this->define_columns(['course', 'grade']);
        $this->define_headers(['Course', 'Grade']);
        $this->define_baseurl(new \moodle_url('/local/transcript/index.php'));
        $this->set_sql('c.id, c.fullname AS course, g.finalgrade AS grade', 
                       '{course} c JOIN {grade_grades} g ON c.id = g.itemid', 
                       'g.userid = ?', [$this->userid]);
    }

    protected function col_grade($row) {
        return $row->grade ?? 'N/A';
    }
}