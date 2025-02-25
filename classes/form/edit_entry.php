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
 *  edit_entry.php description here.
 *
 * @package tool_ivanmdl
 * @copyright  2025 ivanstankovic <ivan.stankovic@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_ivanmdl\form;

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

/**
 * Class for edit entry form
 */
class edit_entry extends \moodleform {
    /**
     * Define form
     * @return void
     */
    public function definition() {
        global $COURSE;
        $mform = $this->_form;

        $mform->addElement('text', 'name', get_string('entryname', 'tool_ivanmdl'));
        $mform->setType('name', PARAM_NOTAGS);
        $mform->addRule('name', get_string('required'), 'required');

        $mform->addElement('advcheckbox', 'completed', get_string('completed', 'tool_ivanmdl'));

        $mform->addElement('hidden', 'courseid', $COURSE->id);
        $mform->setType('courseid', PARAM_INT);

        $mform->addElement('hidden', 'entryid');
        $mform->setType('entryid', PARAM_INT);

        $this->add_action_buttons();
    }

    /**
     * Method for form validation
     *
     * @param array $data
     * @param array $files
     * @return array
     */
    public function validation($data, $files) {
        global $DB;

        $errors = parent::validation($data, $files);

        $conditions = ['courseid' => $data['courseid'], 'name' => $data['name']];
        $conditions['id'] = $data['entryid'];

        if ($DB->record_exists_select('tool_ivanmdl', 'courseid = ? AND name = ? AND id <> ?', array_values($conditions))) {
            $errors['name'] = get_string('error_name_exists', 'tool_ivanmdl');
        }

        return $errors;
    }
}
