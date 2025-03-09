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
 *  handler.php description here.
 *
 * @package tool_ivanmdl
 * @copyright  2025 ivanstankovic <ivan.stankovic@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_ivanmdl;

/**
 * Class for handling the entry records
 */
class handler {
    /**
     * Getting the entry
     * @param int $entryid
     * @return false|mixed|\stdClass
     */
    public function get(int $entryid) {
        global $DB;
        return $DB->get_record('tool_ivanmdl', ['id' => $entryid], '*', MUST_EXIST);
    }

    /**
     * Update the entry
     * @param stdClass $data
     * @param stdClass $entry
     * @return void
     */
    public function update(stdClass $data, stdClass $entry) {
        global $DB;
        $entry->name = $data->name;
        $entry->completed = $data->completed;
        $entry->priority = $data->priority;
        $entry->timemodified = time();
        $DB->update_record('tool_ivanmdl', $entry);
    }

    /**
     * Insert the entry
     * @param stdClass $data
     * @param int $courseid
     * @return bool|int
     */
    public function insert(stdClass $data, int $courseid) {
        global $DB;
        $data->courseid = $courseid;
        $data->timecreated = time();
        $data->timemodified = time();
        return $DB->insert_record('tool_ivanmdl', $data);
    }
}
