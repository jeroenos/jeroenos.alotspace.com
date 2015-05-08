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
	'RSS_URI' => 'RSS-URI',
	'CYCLE'	=> 'Update-Turnus',
	'LAST_UPDATED'	=> 'letzte Aktualisierung',
	'SHOW_IMAGE'	=> 'Logo anzeigen',
	'SHOW_DESCRIPTION'	=> 'Beschreibung anzeigen',
	'MAX_ITEMS'	=> 'max. Anzahl',
	'CODING'	=> 'Kodierung',
	'FROM'	=> 'von',
	'TO'	=> 'zu',
	'USE_UTF8_ENCODING'	=> "UTF-8 encoding benutzen",
	'Configuration'	=> 'Konfiguration',
	'Request'	=> 'Anforderung',
	'Resource'	=> 'Ressource',
	'Value'	=> 'Wert',
	'Description'	=> 'Beschreibung',
	'Image-URI'	=> 'Bild-URI',
	'Image-Title'	=> 'Bild-Title',
	'Image-Link'	=> 'Bild-Link',
	'Channel-Title'	=> 'Kanal-Title',
	'Channel-Desc'	=> 'Kanal-Description',
	'Channel-Link'	=> 'Kanal-Link',
	'SAVE'	=> 'Speichern',
	'CANCEL'	=> 'Abbrechen',
	'PREVIEW'	=> 'Vorschau'
);

$MOD_NEWSREADER_MSG = array(
	'RSS_URI'	=> 'Tragen Sie hier den Weblink zum Newsfeed ein. Bsp.: http://www.heise.de/newsticker/heise.rdf',
	'CYCLE'	=> 'Zeitraum in Sekunden, wann das Newsfeed aktualisiert werden soll. Sollte nicht weniger als 14400 Sek. (4 Std.) sein.',
	'LAST_UPDATED'	=> 'Zu diesem Zeitpunkt wurde das Newsfeed zuletzt aktualisiert.',
	'SHOW_IMAGE'	=> 'Wenn aktiviert, wird bei der News-Ausgabe das Logo angezeigt, das der Feed-Hersteller (evtl.) im Newsfeed angegeben hat.',
	'SHOW_DESCRIPTION'	=> 'Wenn aktiviert, werden bei den News-Eintr&auml;gen die Beschreibungen angezeigt (sofern vorhanden)',
	'MAX_ITEMS'	=> 'maximale Anzahl der angezeigten News-Eintr&auml;ge. In aller Regel enthalten Newsfeeds maximal 15 Eintr&auml;ge.',
	'CODING'	=> 'Kodierung eines Newsfeeds. Ist z.Bsp. das Newsfeed in UTF-8 kodiert und Ihre Website auf ISO-8859-1 eingestellt, w&auml;hlen Sie bitte bei "von" utf-8 und bei "zu" iso-8859-1 aus.',
	'USE_UTF8_ENCODING'	=> 'Optional utf-8 encoding benutzen - falls der Feed einen Parsing-Fehler produziert (z.B. <i>"An XML error occurred on line 22: not well-formed (invalid token)"</i>.'
);

$MOD_NEWSREADER_HEAD = array(
	'CONFIG_DISPL'	=> 'Ausgabe der <u>gespeicherten</u> Konfiguration'
); 

$MOD_NEWSREADER_DESC = array(
	'Image-URI'	=> 'URI zum Newsfeed Bild/Logo',
	'Image-Title'	=> 'Titel des Newsfeed Bild/Logos',
	'Image-Link'	=> 'Link vom Newsfeed Bild/Logo. Meistens die URL der Newsfeed Website',
	'Channel-Title'	=> 'Titel des Newsfeeds',
	'Channel-Desc'	=> 'Beschreibung des Newsfeeds',
	'Channel-Link'	=> 'Link vom Newsfeed Titel. Meistens die URL der Newsfeed Website'
);
?>