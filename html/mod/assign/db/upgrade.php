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
 * Upgrade code for install
 *
 * @package   mod_assign
 * @copyright 2012 NetSpot {@link http://www.netspot.com.au}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * upgrade this assignment instance - this function could be skipped but it will be needed later
 * @param int $oldversion The old version of the assign module
 * @return bool
 */
function xmldb_assign_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    // Automatically generated Moodle v3.5.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.6.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2018120500) {
        // Define field hidegrader to be added to assign.
        $table = new xmldb_table('assign');
        $field = new xmldb_field('hidegrader', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '0', 'blindmarking');

	if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Assignment savepoint reached.
        upgrade_mod_savepoint(true, 2018120500, 'assign');
    }
       if ($oldversion < 2020061567) {

        // Define field id to be added to assign_destination.
	$table = new xmldb_table('assign_destination');

        // Adding fields to table assign_destination.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('origin', XMLDB_TYPE_INTEGER, '5', null, null, null, null);
        $table->add_field('destination', XMLDB_TYPE_INTEGER, '5', null, null, null, null);
        $table->add_field('groupa', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('groupb', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('groupc', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('groupd', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('groupe', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('is_assign', XMLDB_TYPE_BINARY, null, null, null, null, null);

        // Adding keys to table assign_destination.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for assign_destination.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2020061567, 'assign');
       }
     if ($oldversion < 2020061571) {

        // Define field day to be added to assign_destination.
        $table = new xmldb_table('assign_destination');
        $field = new xmldb_field('day', XMLDB_TYPE_INTEGER, '5', null, null, null, null, 'is_assign');

        // Conditionally launch add field day.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
 	$field2 = new xmldb_field('roleid', XMLDB_TYPE_INTEGER, '5', null, null, null, null, 'day');

        // Conditionally launch add field roleid.
        if (!$dbman->field_exists($table, $field2)) {
            $dbman->add_field($table, $field2);
        }
        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2020061571, 'assign');
    }
  if ($oldversion < 2021071621) {

	           // Changing type of field is_assign on table assign_destination to text.
	           $table = new xmldb_table('assign_destination');
	           $field = new xmldb_field('is_assign', XMLDB_TYPE_TEXT, null, null, null, null, null, 'groupe');
	           // Launch change of type for field is_assign.
	           $dbman->change_field_type($table, $field);
	           // Assign savepoint reached.
	            upgrade_mod_savepoint(true, 2021071621, 'assign');
  }
    if($oldversion <2021072121){
	$table = new xmldb_table('assign_destination');
	$field = new xmldb_field('is_assign');
	
	if($dbman->field_exists($table, $field)){
		$dbman->drop_field($table, $field);
	}
	upgrade_mod_savepoint(true, 2021072121, 'assign');	
    }

    // Automatically generated Moodle v3.7.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.8.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.9.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
