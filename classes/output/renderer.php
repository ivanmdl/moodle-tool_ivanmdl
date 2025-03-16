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
 *  renderer.php description here.
 *
 * @package tool_ivanmdl
 * @copyright  2025 ivanstankovic <ivan.stankovic@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_ivanmdl\output;

use tool_ivanmdl\output\statistic;

/**
 * Class for rendering output
 */
class renderer extends \plugin_renderer_base {
    /**
     * Method for rendering output
     * @param \tool_ivanmdl\output\statistic $page
     * @return bool|string
     */
    public function render_statistic(statistic $page) {
        return $this->render_from_template('tool_ivanmdl/statistic', $page->export_for_template($this));
    }
}
