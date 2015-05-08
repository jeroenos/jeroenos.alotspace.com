<?php

/*

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

// direct access prevention
defined('WB_PATH') OR die(header('Location: ../index.php'));

include_once dirname( __FILE__ ).'/inc/init.inc.php';

function get_lightboxes()
{

    $dir   = LA_LIB_PATH;
    $libs  = array();
    $files = array();
    $dirs  = array();
    $lib_info = array();
    
    // scan base directory for libs
    if ( $dh = opendir( $dir ) ) {
        while ( false !== ( $file = readdir($dh) ) ) {
            if ( $file != "." && $file != ".." ) {
                if (
                       is_dir( $dir.'/'.$file )
                    && ( preg_match( '#^lib_#', $file ) || $file == 'libraryadmin' )
                    && file_exists( $dir.'/'.$file.'/library_info.php' )
                ) {
                    include $dir.'/'.$file.'/library_info.php';
                    // plugins subdir
                    $plugin_dir = LA_LIB_PATH.'/'.$lib_info['library_path'].'/plugins';
                    if ( $sdh = opendir( $plugin_dir ) ) {
                        while ( ( $subdir = readdir($sdh) ) !== false ) {
                            if ( is_dir( $plugin_dir.'/'.$subdir ) && file_exists( $plugin_dir.'/'.$subdir.'/foldergallery_template.htt' ) ) {
                                $files[$file][] = $subdir;
                            }
                        }
                        closedir($sdh);
                    }
                }
            }
        }
        closedir($dh);
    }
    return $files;
}

?>