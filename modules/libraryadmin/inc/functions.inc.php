<?php

/*******************************************************************************
    Library Admin - jQuery Library
    (c) 2010 Bianka Martinovic - All rights reserved
    http://www.webbird.de/
*******************************************************************************/

global $debug;
include_once 'init.inc.php';
include_once dirname(__FILE__).'/class.LibraryUtils.php';

/**
 * include a certain preset
 *
 * @param  string   $module  - module subfolder to scan
 * @param  string   $lib     - library object handle
 * @param  string   $preset  - preset file name
 * @param  boolean  $backend - called from backend
 *
 * @return string
 *
 **/
function __includePreset(
    $module  = 'libraryadmin',
    $lib     = '',
    $preset  = 'default',
    $backend = false,
    $subdir  = ''
) {

    global $debug;

    // set defaults
    if ( empty( $preset ) ) {
        $preset = 'default';
    }
    if ( empty( $module ) ) {
        $module = 'libraryadmin';
    }
    
    $suffix    = $lib->preset_suffix;
    $scan_dirs = $lib->scan_dirs;

    if ( $debug ) {
        echo "<br /><br />__includePreset() params:<br />\n".
             "--- module       [$module]<br />\n".
             "--- use lib      [" .
               ( ( isset( $lib ) && is_object( $lib ) ) ? $lib->lib_path : '-' )
               . "]<br />\n".
             "--- preset       [$preset]<br />\n".
             "--- backend      [$backend]<br />\n".
             "--- subdir       [$subdir]<br />\n".
             "--- suffix       [$suffix]<br />\n".
             "--- scan dirs    [".print_r($scan_dirs,1)."]<br />\n"
             ;
    }
    
    // add the suffix if not already there
    if ( ! preg_match( "/\.$suffix$/i", $preset ) ) {
        $preset .= '.'.$suffix;
    }

    $template = TEMPLATE;
    if ( $backend ) {
        // get theme name
        $template = basename( THEME_PATH );
    }

    $search_dirs = array();
    foreach (
        array(
            WB_PATH.'/modules/'.$module,
            WB_PATH.'/templates/'.$template
        ) as $base
    ) {
        if ( is_array($scan_dirs) ) {
            foreach ( $scan_dirs as $sub ) {
		        if ( isset($subdir) && $subdir != '' && is_scalar($subdir) ) {
		            if ( is_dir( $base.'/'.$subdir ) ) {
		                $search_dirs[] = $base.'/'.$subdir;
					}
					if ( is_dir( $base.'/'.$sub.'/'.$subdir ) ) {
		            	$search_dirs[] = $base.'/'.$sub.'/'.$subdir;
					}
		        }
		        if ( is_dir( $base.'/'.$sub ) ) {
                	$search_dirs[] = $base.'/'.$sub;
				}
            }
        }
    };

    if ( $debug ) {
        echo "<br /><br />__includePreset() scanning dirs ... for preset [$preset]:<br />",
             "<textarea cols=\"100\" rows=\"20\" style=\"width: 100%;\">";
        print_r( $search_dirs );
        echo "</textarea>";
    }

    // now, try to find the given preset in the search dirs
    foreach ( $search_dirs as $dir ) {
        if ( $debug ) {
            echo "looking for file: -$dir/$preset-<br />";
        }
        if ( file_exists( $dir.'/'.$preset ) ) {
            if ( $debug ) {
                echo "found file [$dir/$preset]<br />";
            }
            $preset_content = __loadFile( $dir.'/'.$preset, $backend );
            return __parsePreset( $preset_content );
        }
    }

    // preset not found
    return NULL;

}  // end __includePreset()

/**
 *
 *
 *
 *
 **/
function __includePlugin( $path, $plugin )
{

    if ( file_exists( LA_LIB_PATH.'/'.$path.'/plugins/'.$plugin.'/default.preset' ) ) {
        $preset_content  = __loadFile( LA_LIB_PATH.'/'.$path.'/plugins/'.$plugin.'/default.preset' );
    }
    if ( file_exists( LA_LIB_PATH.'/'.$path.'/plugins/'.$plugin.'/custom.preset' ) ) {
        $preset_content .= __loadFile( LA_LIB_PATH.'/'.$path.'/plugins/'.$plugin.'/custom.preset' );
    }
    elseif ( file_exists( LA_LIB_PATH.'/'.$path.'/plugins/'.$plugin.'/loader.preset' ) ) {
        $preset_content .= __loadFile( LA_LIB_PATH.'/'.$path.'/plugins/'.$plugin.'/loader.preset' );
    }
    
    if ( $preset_content ) {
        return __parsePreset( $preset_content );
    }

    return NULL;

}   // end function __includePlugin()

/**
 *
 *
 *
 *
 **/
function __parsePreset( $content, $backend = false )
{

    $positions = array( 'head' => array(), 'body' => array() );
    $parts     = preg_split(
                     "#<!--\s*position:\s*(head|body)\s*-->#ism",
                     $content,
                     -1,
                     PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE
                 );

    if ( count( $parts ) > 0 ) {

        $i   = 0;
        $pos = 'head';

        while( $i < count($parts) )
        {
            if ( $parts[$i] == 'head' || $parts[$i] == 'body' )
            {
                $pos = $parts[$i];
                $i++;
            }
            $positions[$pos][] = $parts[$i];
            $i++;
        }
    }

    if ( $backend ) {
        return $positions;
    }

    $result = '<head>'.implode('',$positions['head']).'</head>'
            . '<body>'.implode('',$positions['body']).'</body>';

    return $result;

}   // end function __parsePreset()

/**
 * load file and replace some placeholders
 **/
function __loadFile( $file, $backend = false ) {

    if ( file_exists( $file ) ) {
    
        if ( ! filesize ($file) ) {
            return "<!-- LibraryAdmin: File [$file] is empty -->\n";
        }
        else {

            $fh = fopen( $file, 'r' );
            $f_content = fread( $fh, filesize ($file) );
            fclose($fh);

            $f_content = str_ireplace(
                array(
                    '{URL}',
                    '{WB_URL}',         // for backward compatibility
                    '{TEMPLATE_DIR}',
                    '{WB_PATH}',        // for backward compatibility
                    '{LIB_URL}',
                    '{LIB_PATH}',
                ),
                array(
                     LA_LIB_URL,
                     LA_LIB_URL.'/../',    // for backward compatibility
                     TEMPLATE_DIR,
                     LA_LIB_PATH.'/../',   // for backward compatibility
                     LA_LIB_URL,
                     LA_LIB_PATH
                ),
                $f_content
            );

            return $f_content;
        }
        
    }

    return "<!-- LibraryAdmin: File not found [$file] -->\n";
    
}   // end function __loadFile()

?>