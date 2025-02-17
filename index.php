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
 *  index.php description here.
 *
 * @package tool_ivanmdl
 * @copyright  2025 ivanstankovic <ivan.stankovic@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/adminlib.php');

$id = required_param('id', PARAM_INT);
$cleanedid = clean_param($id, PARAM_INT);
$course = get_course($cleanedid);

require_login();
$url = new moodle_url('/admin/tool/ivanmdl/index.php', ['id' => $cleanedid]);
$title = get_string('pluginname', 'tool_ivanmdl');
$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_pagelayout('report');
$PAGE->set_title('Hello to the ivanmdl list');
$PAGE->set_heading($title);

$id = optional_param('id', 0, PARAM_INT);

echo $OUTPUT->header();
echo $OUTPUT->heading($title);

echo html_writer::div(get_string('hello_world', 'tool_ivanmdl', $cleanedid));

echo $OUTPUT->footer();


