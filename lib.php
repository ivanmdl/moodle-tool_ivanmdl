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


