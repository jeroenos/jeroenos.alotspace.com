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

include_once('./functions.php');
if(!defined('NEWS_READER_LANGUAGE')) {
	define('NEWS_READER_LANGUAGE', getLanguage());
}

if(file_exists('./languages/' . NEWS_READER_LANGUAGE . '.php'))
{
	include_once('./languages/' . NEWS_READER_LANGUAGE . '.php');
}
else
{
	include_once('./languages/EN.php');
}

// create and set object newsfeed
include_once('./newsparser.php');
$px = new RSS_feed();
$px->Set_Limit($_REQUEST['MAX_ITEMS']); 
$px->Show_Image($_REQUEST['SHOW_IMAGE']); 
$px->Show_Description($_REQUEST['SHOW_DESCRIPTION']);
$px->Set_URL($_REQUEST['RSS_URI']);

$nf = array();	
$nf['show_image'] = $_REQUEST['SHOW_IMAGE'];
$nf['show_desc'] = $_REQUEST['SHOW_DESCRIPTION'];
$nf['coding_from'] = $_REQUEST['CODE_FROM'];
$nf['coding_to'] = $_REQUEST['CODE_TO'];
$nf['use_utf8_encoding'] = $_REQUEST['USE_UTF8ENCODE'];

// get newsfeed contents
$nf['content'] = $px->Get_Results( $nf['use_utf8_encoding'] );
$nf['ch_title'] = $px->channel['title'];
$nf['ch_link'] = isset($px->channel['link']) ? $px->channel['link'] : "";
$nf['ch_desc'] = $px->channel['desc'];
$nf['img_title'] = $px->image['title'];
$nf['img_uri'] = isset($px->image['url']) ? $px->image['url'] : ""; // URI to image/logo
$nf['img_link'] = isset($px->image['link']) ? $px->image['link'] : "";

$out = '
<html>
	<head>
		<title>WB Newsreader</title>
		<style type="text/css">
			td {
				background-color: #336699;
				color: #FFFFFF;
			}
			.newsreader {
			}
			.nr_description {
				font-weight: bold;
			}
			.nr_content {
			}
			.nr_content ul {
			}
			.nr_content li {
				margin-bottom: 1em;
				list-style: circle;
			}
			.nr_itemdesc {
			}

			.discreet {
				font-size:90%;
			}
 		</style>
	</head>
	<body>
		<h1>' . $MOD_NEWSREADER_HEAD['CONFIG_DISPL'] . '</h1>
		<br />
		<table width=100%>
			<tr>
				<th>' . $MOD_NEWSREADER_TEXT['Configuration'] . '</th>
				<th>' . $MOD_NEWSREADER_TEXT['Request'] . '</th>
			</tr>
			<tr>
				<td>' . $MOD_NEWSREADER_TEXT['RSS_URI'] . '</td>
				<td>' . $_REQUEST['RSS_URI'] . '</td>
			</tr>
			<tr>
				<td>' . $MOD_NEWSREADER_TEXT['SHOW_IMAGE'] . '</td>
				<td>' . $_REQUEST['SHOW_IMAGE'] . '</td>
			</tr>
			<tr>
				<td>' . $MOD_NEWSREADER_TEXT['SHOW_DESCRIPTION'] . '</td>
				<td>' . $_REQUEST['SHOW_DESCRIPTION'] . '</td>
			</tr>
			<tr>
				<td>' . $MOD_NEWSREADER_TEXT['MAX_ITEMS'] . '</td>
				<td>' . $_REQUEST['MAX_ITEMS'] . '</td>
			</tr>
			<tr>
				<td>' . $MOD_NEWSREADER_TEXT['CODING'] . '</td>
				<td>' . $MOD_NEWSREADER_TEXT['FROM'] . ': ' . $_REQUEST['CODE_FROM'] . ' ' . $MOD_NEWSREADER_TEXT['TO'] . ': ' . $_REQUEST['CODE_TO'] . '</td>
			</tr>
		</table>

		<br />

		<table width=100%>
			<tr>
				<th>' . $MOD_NEWSREADER_TEXT['Resource'] . '</th>
				<th>' . $MOD_NEWSREADER_TEXT['Value'] . '</th>
				<th>' . $MOD_NEWSREADER_TEXT['Description'] . '</th>
			</tr>
			<tr>
				<td>' . $MOD_NEWSREADER_TEXT['RSS_URI'] . '</td>
				<td>' . $px->URL . '</td>
				<td>' . $MOD_NEWSREADER_MSG['RSS_URI'] . '</td>
			</tr>
			<tr>
				<td>' . $MOD_NEWSREADER_TEXT['Image-URI'] . '</td>
				<td>' . $nf['img_uri'] . '<br />'. (($nf['img_uri'] != "") ? '<img src="' . $nf['img_uri'] . '" />' : '') .'</td>
				<td>' . $MOD_NEWSREADER_DESC['Image-URI'] . '</td>
			</tr>
			<tr>
				<td>' . $MOD_NEWSREADER_TEXT['Image-Title'] . '</td>
				<td>' . $nf['img_title'] . '</td>
				<td>' . $MOD_NEWSREADER_DESC['Image-Title'] . '</td>
			</tr>
			<tr>
				<td>' . $MOD_NEWSREADER_TEXT['Image-Link'] . '</td>
				<td>' . $nf['img_link'] . '</td>
				<td>' . $MOD_NEWSREADER_DESC['Image-Link'] . '</td>
			</tr>
			<tr>
				<td>' . $MOD_NEWSREADER_TEXT['Channel-Title'] . '</td>
				<td>' . $nf['ch_title'] . '</td>
				<td>' . $MOD_NEWSREADER_DESC['Channel-Title'] . '</td>
			</tr>
			<tr>
				<td>' . $MOD_NEWSREADER_TEXT['Channel-Desc'] . '</td>
				<td>' . $nf['ch_desc'] . '</td>
				<td>' . $MOD_NEWSREADER_DESC['Channel-Desc'] . '</td>
			</tr>
			<tr>
				<td>' . $MOD_NEWSREADER_TEXT['Channel-Link'] . '</td>
				<td>' . $nf['ch_link'] . '</td>
				<td>' . $MOD_NEWSREADER_DESC['Channel-Link'] . '</td>
			</tr>
		</table>

		<br />';
		
		if($nf['coding_from'] != '--' && $nf['coding_to'] != '--')
		{
			include_once('./ConvertCharset.class.php');
			$NewEncoding = new ConvertCharset;
			$nf['ch_title'] = $NewEncoding->Convert($nf['ch_title'],$nf['coding_from'] , $nf['coding_to'], 0);
			$nf['ch_desc'] = $NewEncoding->Convert($nf['ch_desc'],$nf['coding_from'] , $nf['coding_to'], 0);
			$nf['content'] = $NewEncoding->Convert($nf['content'],$nf['coding_from'] , $nf['coding_to'], 0);
		}
		
$out .=	'<b>Output:</b>
			<hr />
			<br />
<div class="newsreader">';
if ($nf['img_link'] != "") {
$out .= '	<a href="' . $nf['img_link'] . '" alt="" title="' . $nf['img_title'] . '">
		<img src="' . $nf['img_uri'] . '" alt="" title="' . $nf['img_title'] . '" border=0 />
	</a>';
}
$out .='	<h2>' . $nf['ch_title'] . '</h2>
	<div class="nr_description">' . $nf['ch_desc'] . '</div>
	<div class="discreet">' . $MOD_NEWSREADER_TEXT['LAST_UPDATED'] . ': ' . date("Y-m-d H:i:s", time()) . '</div>
	<div class="nr_content">' .
		$nf['content'] .
'	</div>
</div>

	</body>
</html>
';

echo $out;

?>