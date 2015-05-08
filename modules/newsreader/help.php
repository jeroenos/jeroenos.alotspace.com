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

if(file_exists('./languages/' . $_REQUEST['lang'] . '.php')) {
	include('./languages/' . $_REQUEST['lang'] . '.php');
} else {
	include('./languages/EN.php');
}

// output
$out = '
<html>
	<head>
		<title>WB Newsreader Info</title>
		<style type="text/css">
			table {
				font-family: Verdana, sans-serif;
				font-size: 12px;
				line-height: 1.3 em;
				width: 100%;
			}
			#colone {
				font-weight: bold;
				background-color: #009900;
				color: #FFFFFF;
				width: 200px;
				padding-left: 10px;
				height: 20px;
			}
			#coltwo {
				background-color: #DDDDDD;
				color: #000000;
				padding-left: 10px;
				height: 20px;
			}
		</style>
	</head>
';
echo $out;


$out = '
<body>
	<table>
		<tr>
			<td id="colone">' .$MOD_NEWSREADER_TEXT['RSS_URI']. '</td>
			<td id="coltwo">' .$MOD_NEWSREADER_MSG['RSS_URI']. '</td>
		</tr>
		<tr>
			<td id="colone">' .$MOD_NEWSREADER_TEXT['CYCLE']. '</td>
			<td id="coltwo">' .$MOD_NEWSREADER_MSG['CYCLE']. '</td>
		</tr>
		<tr>
			<td id="colone">' .$MOD_NEWSREADER_TEXT['LAST_UPDATED']. '</td>
			<td id="coltwo">' .$MOD_NEWSREADER_MSG['LAST_UPDATED']. '</td>
		</tr>
		<tr>
			<td id="colone">' .$MOD_NEWSREADER_TEXT['SHOW_IMAGE']. '</td>
			<td id="coltwo">' .$MOD_NEWSREADER_MSG['SHOW_IMAGE']. '</td>
		</tr>
		<tr>
			<td id="colone">' .$MOD_NEWSREADER_TEXT['SHOW_DESCRIPTION']. '</td>
			<td id="coltwo">' .$MOD_NEWSREADER_MSG['SHOW_DESCRIPTION']. '</td>
		</tr>
		<tr>
			<td id="colone">' .$MOD_NEWSREADER_TEXT['MAX_ITEMS']. '</td>
			<td id="coltwo">' .$MOD_NEWSREADER_MSG['MAX_ITEMS']. '</td>
		</tr>
		<tr>
			<td id="colone">' .$MOD_NEWSREADER_TEXT['CODING']. '</td>
			<td id="coltwo">' .$MOD_NEWSREADER_MSG['CODING']. '</td>
		</tr>
		<tr>
			<td id="colone">' .$MOD_NEWSREADER_TEXT['USE_UTF8_ENCODING']. '</td>
			<td id="coltwo">' .$MOD_NEWSREADER_MSG['USE_UTF8_ENCODING']. '</td>
		</tr>
	</table>
</body>
</html>
';

echo $out;

?>