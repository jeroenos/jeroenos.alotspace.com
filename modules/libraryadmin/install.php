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

if ( file_exists( dirname(__FILE__).'/../droplets/functions.inc.php' ) ) {
    include_once dirname(__FILE__).'/../droplets/functions.inc.php';
}

if ( ! function_exists('wb_unpack_and_import') ) {
    DEFINE_wb_unpack_and_import();
}

wb_unpack_and_import( dirname(__FILE__).'/install/droplet_LibInclude.zip', WB_PATH.'/temp/unzip/' );
wb_unpack_and_import( dirname(__FILE__).'/install/droplet_LibLoader.zip', WB_PATH.'/temp/unzip/' );

function DEFINE_wb_unpack_and_import() {

    function wb_unpack_and_import( $temp_file, $temp_unzip ) {

        global $admin, $database;

        // Include the PclZip class file
        if ( ! class_exists( 'PclZip', false ) ) {
        	require_once(WB_PATH.'/include/pclzip/pclzip.lib.php');
		}

        $errors  = array();
        $count   = 0;
        $archive = new PclZip($temp_file);
        $list    = $archive->extract(PCLZIP_OPT_PATH, $temp_unzip);
        $table   = 'mod_droplets';

        // now, open all *.php files and search for the header;
        // an exported droplet starts with "//:"
        if ( $dh = opendir($temp_unzip) ) {
            while ( false !== ( $file = readdir($dh) ) )
            {
                if ( $file != "." && $file != ".." )
                {
                    if ( preg_match( '/^(.*)\.php$/i', $file, $name_match ) ) {
                        // Name of the Droplet = Filename
                        $name  = $name_match[1];
                        // Slurp file contents
                        $lines = file( $temp_unzip.'/'.$file );
                        // First line: Description
                        if ( preg_match( '#^//\:(.*)$#', $lines[0], $match ) ) {
                            $description = $match[1];
                        }
                        // Second line: Usage instructions
                        if ( preg_match( '#^//\:(.*)$#', $lines[1], $match ) ) {
                            $usage       = addslashes( $match[1] );
                        }
                        // Remaining: Droplet code
                        $code = implode( '', array_slice( $lines, 2 ) );
                        // replace 'evil' chars in code
                        $tags = array('<?php', '?>' , '<?');
                        $code = addslashes(str_replace($tags, '', $code));
                        // Already in the DB?
                        $stmt  = 'INSERT';
                        $id    = NULL;
                        $found = $database->get_one("SELECT * FROM ".TABLE_PREFIX.$table." WHERE name='$name'");
                        if ( $found && $found > 0 ) {
                            $stmt = 'REPLACE';
                            $id   = $found;
                        }
                        // execute; different table structure in WB/LEPTON!
                        $result = $database->query("$stmt INTO ".TABLE_PREFIX.$table
								. " (`id`, `name`, `code`, `description`,`modified_when`,`modified_by`,`active`,`comments` )"
								. " VALUES ('$id','$name','$code','$description','".time()."','".$admin->get_user_id()."',1,'$usage')");
                        if( ! $database->is_error() ) {
                            $count++;
                            $imports[$name] = 1;
                        }
                        else {
                            $errors[$name] = $database->get_error();
                        }
                    }
                }
            }
            closedir($dh);
        }

        return array( 'count' => $count, 'errors' => $errors, 'imported'=> $imports );

    }   // end function wb_unpack_and_import()
    
}

?>
