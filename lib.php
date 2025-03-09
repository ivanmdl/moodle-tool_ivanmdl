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
 *  lib.php description here.
 *
 * @package tool_ivanmdl
 * @copyright  2025 ivanstankovic <ivan.stankovic@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * This function extends the course navigation with the plugin link
 *
 * @param navigation_node $navref
 * @param stdClass $course
 * @param context $context
 * @return void
 * @throws \core\exception\moodle_exception
 * @throws coding_exception
 */
function tool_ivanmdl_extend_navigation_course(navigation_node $navref, \stdClass $course, \context $context) {
    if (has_capability('tool/ivanmdl:view', $context)) {
        $url = new moodle_url('/admin/tool/ivanmdl/index.php', ['id' => $course->id]);

        $navref->add(
            get_string('pluginname', 'tool_ivanmdl'),
            $url,
            navigation_node::TYPE_SETTING,
            null,
            'ivanmdleterw'
        );
    }
}

/**
 * Serve the embedded files.
 *
 * @param stdClass $course the course object
 * @param stdClass $cm the course module object
 * @param context $context the context
 * @param string $filearea the name of the file area
 * @param array $args extra arguments (itemid, path)
 * @param bool $forcedownload whether or not force download
 * @param array $options additional options affecting the file serving
 * @return bool false if the file not found, just send the file otherwise and do not return anything
 */
function tool_ivanmdl_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options=[]): bool {

    if ($context->contextlevel != CONTEXT_COURSE) {
        return false;
    }

    if ($filearea !== 'entry') {
        return false;
    }

    require_login($course);
    require_capability('tool/devcourse:view', $context);

    $itemid = array_shift($args);

    $entry = \tool_ivanmdl\handler::get($itemid);

    $filename = array_pop($args);

    if (!$args) {
        $filepath = '/';
    } else {
        $filepath = '/'.implode('/', $args).'/';
    }

    $fs = get_file_storage();
    $file = $fs->get_file($context->id, 'tool_ivanmdl', $filearea, $itemid, $filepath, $filename);

    if (!$file) {
        return false;
    }

    send_stored_file($file, null, 0, $forcedownload, $options);
}


