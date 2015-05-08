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

$MOD_NEWSREADER_TEXT = array(
	'RSS_URI'	=> 'RSS-URI',
	'CYCLE'	=> 'Update-Cycle',
	'LAST_UPDATED'	=> 'last updated',
	'SHOW_IMAGE'	=> 'show Logo',
	'SHOW_DESCRIPTION'	=> 'show Description',
	'MAX_ITEMS'	=> 'max, Items',
	'CODING'	=> 'Coding',
	'FROM'	=> 'from',
	'TO'	=> 'to',
	'USE_UTF8_ENCODING'	=> "Use UTF-8 encoding",
	'Configuration'	=> 'Configuration',
	'Request'	=> 'Request',
	'Resource'	=> 'Resource',
	'Value'	=> 'Value',
	'Description'	=> 'Description',
	'Image-URI'	=> 'Image-URI',
	'Image-Title'	=> 'Image-Title',
	'Image-Link'	=> 'Image-Link',
	'Channel-Title'	=> 'Channel-Title',
	'Channel-Desc'	=> 'Channel-Description',
	'Channel-Link'	=> 'Channel-Link',
	'SAVE'	=> 'Save',
	'CANCEL'	=> 'Cancel',
	'PREVIEW'	=> 'Preview'
);

$MOD_NEWSREADER_MSG	= array(
	'RSS_URI'	=> 'Weblink to the Newsfeed. Example: http://www.heise.de/newsticker/heise.rdf',
	'CYCLE'	=> 'Actualization interval in seconds. Should not be smaller than 14400 Sec. (4 hours).',
	'LAST_UPDATED'	=> 'Last actualization time of the Newsfeed.',
	'SHOW_IMAGE'	=> 'If enabled, the Newsfeed logo will be displayed (if defined in the newsfeed).',
	'SHOW_DESCRIPTION'	=> 'If enabled, the description of each news-item will be displayed (if included in the newsfeed)',
	'MAX_ITEMS'	=> 'maximum numbers of news items to display. Normaly, newsfeeds have no more than 15 items.',
	'CODING'	=> 'Coding of a Newsfeed. Sample: If the Newsfeed is UTF-8 coded and your Website is running with ISO-8859-1, please choose "from" utf-8 and "to" iso-8859-1.',
	'USE_UTF8_ENCODING'	=> 'Optional use of utf-8 encoding - if the feed gives an error like "missformed".'
);

$MOD_NEWSREADER_HEAD = array(
	'CONFIG_DISPL'	=> 'Output of the <u>saved</u> Configuration'
); 

$MOD_NEWSREADER_DESC = array(
	'Image-URI'	=> 'URI to the newsfeed image/logo',
	'Image-Title'	=> 'Title of the newsfeed image/logo',
	'Image-Link'	=> 'Link of the newsfeed image/logo. Mostly the URL of the newsfeed website',
	'Channel-Title'	=> 'Title of the newsfeed',
	'Channel-Desc'	=> 'Description of the newsfeed',
	'Channel-Link'	=> 'Link of the newsfeed title. Mostly the URL of the newsfeed website'
);

?>