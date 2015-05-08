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

// Must include code to stop this file being access directly
/* -------------------------------------------------------- */
if(defined('WB_PATH') == false)
{
	// Stop this file being access directly
		die('<head><title>Access denied</title></head><body><h2 style="color:red;margin:3em auto;text-align:center;">Cannot access this file directly</h2></body></html>');
}
/* -------------------------------------------------------- */

global $admin;

include_once(WB_PATH . '/modules/newsreader/functions.php');
// include core functions to edit the optional module CSS files (frontend.css, backend.css)
include_once(WB_PATH .'/framework/module.functions.php');

if(!defined('LANGUAGE')) getLanguage();

if(file_exists(WB_PATH . '/modules/newsreader/languages/' . LANGUAGE . '.php')) {
	require_once(WB_PATH . '/modules/newsreader/languages/' . LANGUAGE . '.php');
} else {
	require_once(WB_PATH . '/modules/newsreader/languages/EN.php');
}

$sqlquery = "SELECT uri, cycle, last_update, show_image, show_desc, show_limit, coding_from, coding_to,use_utf8_encode
				 FROM ".TABLE_PREFIX."mod_newsreader
				 WHERE section_id = '$section_id'";
$sqlresult = $database->query($sqlquery);

$show_imageCkd = "";
$show_descCkd = "";

if(! $sqlresult->numRows() > 0) {
	$uri = '';
	$cycle = 86400;
	$last_update = 0;
	$sqltype = 'INSERT';
	$show_image = 1;
	$show_imageCkd = 'checked="checked"';
	$show_desc = 1;
	$show_descCkd = 'checked="checked"';
	$show_limit = 15;
	$optionFrom = '--';
	$optionTo = '--';
} else {
	$sqlrow = $sqlresult->fetchRow( MYSQL_ASSOC );
	$uri = $sqlrow['uri'];
	$cycle = $sqlrow['cycle'];
	$datetime = DATE_FORMAT . ' ' . TIME_FORMAT;
	$last_update = date($datetime, $sqlrow['last_update'] + TIMEZONE);
	$show_image = $sqlrow['show_image'];
	if($show_image == 1) {$show_imageCkd = 'checked="checked"';}
	$show_desc = $sqlrow['show_desc'];
	if($show_desc == 1) {$show_descCkd = 'checked="checked"';}
	$show_limit = $sqlrow['show_limit'];	
	$sqltype = 'UPDATE';
	$optionFrom = $sqlrow['coding_from'];
	$optionTo = $sqlrow['coding_to'];
	
	$use_utf8_encoding = $sqlrow['use_utf8_encode']==1 ? "checked='checked'" : "";
}

// include the button to edit the optional module CSS files (function added with WB 2.7)
// Note: CSS styles for the button are defined in backend.css (div class="mod_moduledirectory_edit_css")
// Place this call outside of any <form></form> construct!!!
if(function_exists('edit_module_css'))
{
	edit_module_css('newsreader');
}

$arrOptions = array();
$arrOptions = readCharsets();

$out = '<div align="left">
                <script language="javascript" type="text/javascript">
								<!-- 
                        function popUp(URL) {
                                day = new Date();
                                id = day.getTime();
                                eval("page" + id + " = window.open(URL, \'" + id + "\', \'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=500,height=400\');");
                        }
                        function testRDF(URL) {
                        	var nrWindow;
                        	var values =  "/?RSS_URI=" + document.forms[1].elements["uri"].value;
                        	values += "&SHOW_IMAGE=" + document.forms[1].elements[6].value;
                        	values += "&SHOW_DESCRIPTION=" + document.forms[1].elements[7].value;
                        	values += "&MAX_ITEMS=" + document.forms[1].elements[8].value;
                        	values += "&CODE_FROM=" + document.forms[1].elements[9].value;
                        	values += "&CODE_TO=" + document.forms[1].elements[10].value;
                        	values += "&USE_UTF8ENCODE=" + (document.forms[1].elements[11].checked ? document.forms[1].elements[11].value : 0);
                        	
                        	//document.write(values);
                        	nrWindow = open(URL + values,"Test", \'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=500,height=400\');
                        	nrWindow.resizeTo(800,400);
                        }
                        //-->
                </script>
                <a href="javascript:popUp(\'' . WB_URL . '/modules/newsreader/help.php/?lang=' . LANGUAGE . '\')" alt="Info" title="Newsreader Info">
                        <img src="' . WB_URL . '/modules/newsreader/images/info_icon.png" border=0 alt="Info" title="Newsreader Info" />
                </a>
        </div>

	<form name="newsreader' . $section_id . '" action="' . WB_URL . '/modules/newsreader/save.php" method="post">
		  <input type="hidden" name="page_id" value="' . $page_id . '" />
		  <input type="hidden" name="section_id" value="' . $section_id . '" />
		  <input type="hidden" name="sqltype" value="' . $sqltype . '" />
		  '.(method_exists( $admin, 'getFTAN') ? $admin->getFTAN() : "") .'
		  <table width=100%>
		  		<tr>
		  			<td>' . $MOD_NEWSREADER_TEXT['RSS_URI'] . '</td>
		  			<td><input name="uri" size="50" maxlength="255" value="' . stripslashes($uri) . '" tabindex=1 /></td>
		  		</tr>
		  		<tr>
		  			<td>' . $MOD_NEWSREADER_TEXT['CYCLE'] . '</td>
		  			<td>
		  				<input name="cycle" size="5" maxlength="5" value="' . $cycle . '" tabindex=2 />
		  				&nbsp;ss
		  			</td>
		  		</tr>
		  		<tr>
		  			<td>' . $MOD_NEWSREADER_TEXT['LAST_UPDATED'] . '</td>
		  			<td>' . $last_update . '</td>
		  		</tr>
		  		<tr>
		  			<td>' . $MOD_NEWSREADER_TEXT['SHOW_IMAGE'] . '</td>
		  			<td><input name="show_image" type=checkbox value="' . $show_image . '" ' . $show_imageCkd . ' tabindex=3 /></td>
		  		</tr>
		  		<tr>
		  			<td>' . $MOD_NEWSREADER_TEXT['SHOW_DESCRIPTION'] . '</td>
		  			<td><input name="show_desc" type=checkbox value="' . $show_desc . '" ' . $show_descCkd . '  tabindex=4 /></td>
		  		</tr>
		  		<tr>
		  			<td>' . $MOD_NEWSREADER_TEXT['MAX_ITEMS'] . '</td>
		  			<td><input name="show_limit" size="2" maxlength="2" value="' . $show_limit . '" tabindex=5 /></td>
		  		</tr>
		  		<tr>
		  			<td>' . $MOD_NEWSREADER_TEXT['CODING'] . '</td>
		  			<td>
		  				' . $MOD_NEWSREADER_TEXT['FROM'] . '
		  				<select name="codefrom" tabindex=6 >';
		  					foreach($arrOptions as $option)
		  					{
		  						$out .= '<option value="'.$option.'"'; 
	  							$out .= ($option == $optionFrom) ? ' selected="selected">' : ">" ;
		  						$out .= $option . '</option>';
		  					}
						$out .=	'</select>
		  				' . $MOD_NEWSREADER_TEXT['TO'] . '
		  				<select name="codeto" size=1 tabindex=7 >';
		  					foreach($arrOptions as $option)
		  					{
		  						$out .= '<option value="'.$option.'"'; 
	  							$out .= ($option == $optionTo) ? ' selected="selected">' : ">" ;
		  						$out .= $option . '</option>';
		  					}
						$out .= '</select>
		  			</td>
		  		</tr>
		  		<tr>
		  			<td>' . $MOD_NEWSREADER_TEXT['USE_UTF8_ENCODING'] . '</td>
		  			<td><input name="use_utf8_encode" type=checkbox value="1" ' . $use_utf8_encoding . ' tabindex=8 /></td>
		  		</tr>
		  	  	<tr>
		  	  		<td>&nbsp;</td><td>&nbsp;</td>
		  	  	</tr>
		  	  	</table>
		  	  	<table width=100%>
		  	  	<tr>
		  	  		<td align="center">
		  				<input type="submit" value="' . $TEXT['SAVE'] . '" style="width: 100px; margin-top: 5px;" tabindex=9 />
		  			</td>
		  			<td align="center">
		  				<input type="button" value="' . $TEXT['CANCEL'] . '" onclick="javascript: window.location = \'index.php\';" style="width: 100px; margin-top: 5px;" tabindex=10 />
		  			</td>
		  	  		<td align="center">
		  	  			<input type="button" value="' . $MOD_NEWSREADER_TEXT['PREVIEW'] . '" onclick="javascript:testRDF(\'' . WB_URL . '/modules/newsreader/preview.php\');" style="width: 100px; margin-top: 5px;" tabindex=11 />
		  	  		</td>
		  		</tr>
		  	</table>
		  </form>';

echo $out;

?>