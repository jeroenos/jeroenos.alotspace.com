<?php

/*

 jQueryAdmin Copyright (c) 2010 Bianka Martinovic <http://www.webbird.de>

 Website Baker Project <http://www.websitebaker.org/>
 Copyright (C) 2004-2009, Ryan Djurovich

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

function jQueryAdmin_init()
{

    global $database;

    if ( $database && ! defined( 'TEMPLATE' ) )
    {
        // get the name of the template in use; the template folder is always
        // scanned for presets
        $template = NULL;
        $tpl      = $database->query( "SELECT value FROM ".TABLE_PREFIX."settings WHERE name='default_template'" );
        if ( $tpl->numRows() > 0 ) {
            $row      = $tpl->fetchRow();
            $template = $row['value'];
        }
        define( 'TEMPLATE', $template );
    }
    
    if ( ! defined( 'TEMPLATE_DIR' ) )
    {
        define( 'TEMPLATE_DIR', WB_URL.'/templates/'.TEMPLATE );
    }

}   // end function jQueryAdmin_init()

/**
 * load file and replace some placeholders
 **/
function jQueryAdmin_loadFile( $file, $backend = false )
{

    if ( file_exists( $file ) )
    {
    
        $fh = fopen( $file, 'r' );
        $f_content = fread( $fh, filesize ($file) );
        fclose($fh);
        
        if ( ! $backend )
        {

            $f_content = str_ireplace(
                array(
                    '{URL}',
                    '{WB_URL}',
                    '{TEMPLATE_DIR}',
                    '{WB_PATH}',
                ),
                array(
                     WB_URL,
                     WB_URL,
                     TEMPLATE_DIR,
                     WB_PATH,
                ),
                $f_content
            );
            
        }

        return $f_content;
    }

    return "<!-- jQueryAdmin: File not found [$file] -->\n";
}   // end function jQueryAdmin_loadFile()

?>