<?php

/*

 Website Baker Project <http://www.websitebaker.org/>
 Copyright (C) 2004-2007, Ryan Djurovich

 Website Baker is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Website Baker is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Website Baker; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

require('../../config.php');

// Tells script to update when this page was last updated
$update_when_modified = true;
// Include WB admin wrapper script
require(WB_PATH.'/modules/admin.php');

if(isset($_REQUEST['uri']) AND isset($_REQUEST['cycle'])) {
	$uri = addslashes(trim($_REQUEST['uri']));
	$cycle = trim($_REQUEST['cycle']);
	if(isset($_REQUEST['show_image'])) {
		$show_image = '1';
	} else {
		$show_image = '0';
	}
	if(isset($_REQUEST['show_desc'])) {
		$show_desc = '1';
	} else {
		$show_desc = '0';
	}
	if(isset($_REQUEST['show_limit'])) {
		$show_limit = trim($_REQUEST['show_limit']);
	} else {
		$show_limit = 15;
	}
	if(isset($_REQUEST['codefrom'])) {
		$coding_from = trim($_REQUEST['codefrom']);
	} else {
		$coding_from = '--';
	}
	if(isset($_REQUEST['codeto'])) {
		$coding_to = trim($_REQUEST['codeto']);
	} else {
		$coding_to = '--';
	}
	
	$use_utf8_encode = isset($_REQUEST['use_utf8_encode']) ? 1 : 0;
}


// save config
if($_REQUEST['sqltype'] == 'UPDATE') {
	
   $sqlquery = 'UPDATE '. TABLE_PREFIX . "mod_newsreader SET 
                page_id = '$page_id',
                uri = '$uri',
                cycle = '$cycle',
                show_image = '$show_image',
                show_desc = '$show_desc',
                show_limit = '$show_limit',
                coding_from = '$coding_from',
                coding_to = '$coding_to'
                WHERE section_id = '$section_id'";	
} else {
    $sqlquery = 'INSERT INTO ' . TABLE_PREFIX . "mod_newsreader
                ( section_id, page_id , uri, cycle, show_image, show_desc, show_limit, coding_from, coding_to, content ) 
	            values 
	            ( '$section_id','$page_id', '$uri', '$cycle', '$show_image', '$show_desc', '$show_limit'
	            ,'$coding_from','$coding_to', 'x' )" ;	
}

$database->query($sqlquery);

// get the newsfeed and save it
include_once(WB_PATH . '/modules/newsreader/functions.php');
update($uri, $section_id, $show_image, $show_desc, $show_limit, $coding_from, $coding_to, $use_utf8_encode);

if($database->is_error()) {
	$admin->print_error(mysql_error() . " $sqlquery", $js_back);
} else {
	$admin->print_success($MESSAGE['PAGES']['SAVED'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

$admin->print_footer();

?>