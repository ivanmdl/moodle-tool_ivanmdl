<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * tool_ivanmdl table.php description here.
 *
 * @package    tool_ivanmdl
 * @copyright  2025 ivanstankovic <ivan.stankovic@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_ivanmdl;

use table_sql;
use moodle_url;
use context_course;
use pix_icon;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/tablelib.php');

/**
 * Class tool_ivanmdl_table for displaying table results
 */
class table extends table_sql {
    /**
     * Sets up table sql
     * @param string  $uniqueid
     * @param int $courseid
     */
    public function __construct($uniqueid, $courseid) {
        parent::__construct($uniqueid);

        $this->set_attribute('id', 'tool_ivanmdl_table');

        $this->define_columns(['id', 'name', 'description', 'completed', 'priority', 'timecreated', 'edit']);
        $this->define_headers([
            get_string('id', 'tool_ivanmdl'),
            get_string('name', 'tool_ivanmdl'),
            get_string('description', 'tool_ivanmdl'),
            get_string('completed', 'tool_ivanmdl'),
            get_string('priority', 'tool_ivanmdl'),
            get_string('created', 'tool_ivanmdl'),
            get_string('edit', 'tool_ivanmdl'),
        ]);

        $this->set_sql(
            'id, name, completed, priority, timecreated, courseid, description, descriptionformat',
            '{tool_ivanmdl}',
            'courseid = ?',
            [$courseid]
        );

        $this->baseurl = new moodle_url('/admin/tool/ivanmdl/index.php', ['id' => $courseid]);
    }

    /**
     * Displays and formats column name
     * @param stdClass $row
     * @return string
     */
    public function col_name($row) {
        return format_string($row->name);
    }

    /**
     * Dispalys column with edit icon
     * @param stdClass $row
     * @return string
     */
    public function col_edit($row) {
        global $OUTPUT;
        $context = context_course::instance($row->courseid);

        if (has_capability('tool/ivanmdl:edit', $context)) {
            $editurl = new moodle_url('/admin/tool/ivanmdl/edit.php', ['entryid' => $row->id]);
            return $OUTPUT->action_icon($editurl, new pix_icon('t/edit', get_string('edit')));
        }

        return '';
    }

    /**
     * Displays column description
     *
     * @param stdClass $row
     * @return string
     */
    protected function col_description($row) {
        $options = handler::editor_options();
        $description = file_rewrite_pluginfile_urls($row->description, 'pluginfile.php',
            $options['context']->id, 'tool_ivanmdl', 'entry', $row->id, $options);
        return format_text($description, $row->descriptionformat, $options);
    }
}
