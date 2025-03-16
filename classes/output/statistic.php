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
 *  statistic.php description here.
 *
 * @package tool_ivanmdl
 * @copyright  2025 ivanstankovic <ivan.stankovic@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_ivanmdl\output;

use renderer_base;

/**
 * Data for renderer
 */
class statistic implements \templatable, \renderable {
    /**
     * Total user count.
     *
     * @var int
     */
    protected int $usercount;

    /**
     * Total enrolled users.
     *
     * @var int
     */
    protected int $enrolledusers;

    /**
     * Hello world message.
     *
     * @var string
     */
    protected string $helloworld;

    /**
     * Constructor for statistic object.
     *
     * @param int $usercount Total user count.
     * @param int $enrolledusers Total enrolled users.
     * @param string $helloworld Hello world message.
     */
    public function __construct(int $usercount, int $enrolledusers, string $helloworld) {
        $this->usercount = $usercount;
        $this->enrolledusers = $enrolledusers;
        $this->helloworld = $helloworld;
    }

    /**
     * Exporting the data for templates
     * @param renderer_base $output
     * @return array
     */
    public function export_for_template(renderer_base $output) {
        return [
            'usercount' => $this->usercount,
            'enrolledusers' => $this->enrolledusers,
            'helloworld' => $this->helloworld,
        ];
    }
}
