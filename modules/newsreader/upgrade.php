<?php

/**
 *  @module         newsreader
 *  @version        see info.php of this module
 *  @authors        Ryan Djurovich, Chio Maisriml, Thomas Hornik, Dietrich Roland Pehlke
 *  @copyright      2004-2011 Ryan Djurovich, Chio Maisriml, Thomas Hornik, Dietrich Roland Pehlke
 *  @license        GNU General Public License
 *  @license terms  see info.php of this module
 *  @platform       see info.php of this module
 *  @requirements   PHP 5.2.x and higher
 */

/**
 *	prevent this file from being accessed directly
 */
if(!defined('WB_PATH')) die(header('Location: ../../index.php'));

$query = "show fields from `".TABLE_PREFIX."mod_newsreader`";

$result = $database->query ( $query );

if ($database->is_error() ) {

	$admin->print_error( $database->get_error() );

} else {
	
	$alter = 1;
	
	while ( !false == $data = $result->fetchRow( MYSQL_ASSOC ) ) {
		if ($data['Field'] == "use_utf8_encode") {
			$alter = 0;
			break;
		}
	}

	if ( $alter != 0 ) {

		$thisQuery = "ALTER TABLE `".TABLE_PREFIX."mod_newsreader` ADD `use_utf8_encode` INT NOT NULL DEFAULT 0";
		$r = $database->query($thisQuery);

		if ( $database->is_error() ) {

			$admin->print_error( $database->get_error() );

		} else {

			$admin->print_success( "Update Table for module 'newsreader' with success." );
		}
	}
}

?>