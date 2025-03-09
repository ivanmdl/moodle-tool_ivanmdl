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
 *  edit.php description here.
 *
 * @package tool_ivanmdl
 * @copyright  2025 ivanstankovic <ivan.stankovic@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/adminlib.php');

$courseid = optional_param('courseid', 0, PARAM_INT);
$entryid = optional_param('entryid', 0, PARAM_INT);

$entry = null;

$title = get_string('addentry', 'tool_ivanmdl');

$handler = new \tool_ivanmdl\handler();

if ($entryid) {
    $entry = $handler->get($entryid);
    $courseid = $entry->courseid;
    $title = get_string('editentry', 'tool_ivanmdl');
}

$course = get_course($courseid);

require_login($course);
$context = context_course::instance($courseid);
require_capability('tool/ivanmdl:edit', $context);

$url = new moodle_url('/admin/tool/ivanmdl/edit.php', ['courseid' => $courseid]);

$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_title($title);
$PAGE->set_heading($title);

$form = new \tool_ivanmdl\form\edit_entry();

if (!empty($entry->id)) {
    file_prepare_standard_editor($entry, 'description',
        \tool_ivanmdl\handler::editor_options($courseid),
        $PAGE->context, 'tool_ivanmdl', 'entry', $entry->id);
}

$form->set_data($entry);

if ($form->is_cancelled()) {
    redirect(new moodle_url('/admin/tool/ivanmdl/index.php', ['id' => $courseid]));
} else if ($data = $form->get_data()) {
    if ($entry) {
        $handler->update($data, $entry);
    } else {
        $handler->insert($data, $courseid);
    }

    redirect(new moodle_url('/admin/tool/ivanmdl/index.php',
        ['id' => $courseid]),
        get_string('entryadded', 'tool_ivanmdl'),
        null,
        \core\output\notification::NOTIFY_SUCCESS);
}

echo $OUTPUT->header();
echo $OUTPUT->heading($title);
$form->display();
echo $OUTPUT->footer();

