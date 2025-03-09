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
 *  handler_test.php description here.
 *
 * @package tool_ivanmdl
 * @copyright  2025 ivanstankovic <ivan.stankovic@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_ivanmdl;

defined('MOODLE_INTERNAL') || die();
global $CFG;

/**
 * Class for testing handler
 * @coversDefaultClass \tool_ivanmdl\handler
 */
final class handler_test extends \advanced_testcase {
    /**
     * Test for tool_ivanmdl_handler->insert method
     * @return void
     * @covers ::insert
     */
    public function test_insert(): void {
        $this->resetAfterTest();

        $handler = new \tool_ivanmdl\handler();

        $course = $this->getDataGenerator()->create_course();
        $entryid = $handler->insert((object)[
            'courseid' => $course->id,
            'name' => 'testname1',
            'completed' => 1,
            'priority' => 0,
        ], $course->id);
        $entry = $handler->get($entryid);
        $this->assertEquals($course->id, $entry->courseid);
        $this->assertEquals('testname1', $entry->name);
    }
}
