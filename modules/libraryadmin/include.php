<?php

/*******************************************************************************
    Library Admin - jQuery Library
    (c) 2010 Bianka Martinovic - All rights reserved
    http://www.webbird.de/
*******************************************************************************/

global $debug;

include_once( dirname(__FILE__).'/inc/class.LibraryUtils.php' );
include_once( dirname(__FILE__).'/inc/class.LABackend.php' );
include_once( dirname(__FILE__).'/inc/functions.inc.php' );
include_once( dirname(__FILE__).'/inc/parser.inc.php' );

/**
 * include all presets (from any lib) for current page
 *
 * @access public
 * @param  string   $content - page content to parse
 * @param  int      $page_id - page id
 *
 **/
function libLoader( $content, $page_id ) {

    // find installed libs
    $libs = scanLibraries();

    // find preset for current page
    foreach( $libs as $i => $lib ) {
        foreach ( $lib['scan_dirs'] as $dir ) {
            if ( file_exists( LA_LIB_PATH.'/'.$lib['library_path'].'/'.$dir.'/'.$page_id.'.'.$lib['preset_suffix'] ) ) {
                $content = includePreset( $content, $lib['library_path'], $page_id );
            }
        }
    }

    return $content;
}   // end function libLoader()

/**
 * include a LibraryAdmin preset; this function is called by the droplets
 * and used for the Frontend
 *
 * @access public
 * @param  string  $content   - page content to parse
 * @param  string  $preset    - preset name
 * @param  string  $module    - optional module name (scan module directory for preset)
 * @param  string  $plugin    - optional plugin name (include that plugin directly)
 * @param  boolean $backend   -
 * @param  boolean $be_module - called from a backend module
 *
 **/
function includePreset(
    $content,                // rendered page
    $lib,                    // lib to load
    $preset    = 'default',  // preset name
    $module    = NULL,       // module path name
    $plugin    = NULL,       // plugin path name
    $backend   = false,      // flag backend true/false
    $be_module = false,      // loaded by backend module true/false
    $subdir    = ''          // different subdir provided
) {

    global $debug, $css;

    if ( $debug ) {
        echo "includePreset() params:<br />\n".
             "--- use lib      [$lib]<br />\n".
             "--- preset       [$preset]<br />\n".
             "--- module       [$module]<br />\n".
             "--- plugin       [$plugin]<br />\n".
             "--- backend      [$backend]<br />\n".
             "--- be_module    [$be_module]<br />\n".
             "--- subdir       [$subdir]<br />\n";
    }

    $util = new LibraryUtils();

    if ( isset( $lib ) && ! empty( $lib ) ) {
        $lh   = $util->loadLibrary( $lib );
    }
    else {
        $lh   = $util->loadLibrary( 'libraryadmin' );
    }

    if ( $debug ) {
        echo "Loaded library<br /><textarea cols=\"100\" rows=\"20\" style=\"width: 100%;\">";
        print_r( $lh->lib_info );
        echo "</textarea>";
    }

    // load the preset
    $preset_content     = NULL;
    $core_regex         = NULL;
    $core_files         = array();

    if ( empty( $plugin ) ) {
        if ( empty( $module ) ) {
            $module = $lh->lib_path;
        }
        #$preset_content = __includePreset( $lh->lib_path, $lh, $preset, $backend );
        $preset_content = __includePreset( $module, $lh, $preset, $backend, $subdir );
    }
    else {
        $preset_content = __includePlugin( $lh->lib_path, $plugin );
    }

    if ( method_exists( $lh, 'add_to_content' ) ) {
        $preset_content = $lh->add_to_content( $preset_content );
    }

    $content = __parsePresetContent( $lh->lib_path, $content, $preset_content, $lh->core_files() );
    if ( method_exists( $lh, 'no_conflict_mode' ) ) {
        $content = $lh->no_conflict_mode( $content );
    }

    return $content;

}   // end function includePreset()

/**
 * include a LibraryAdmin preset in the WB backend
 *
 * @deprecated This method is marked as deprecated an will be removed in near
 *             future. Please use the LABackend class instead.
 *
 * @access public
 * @param  string  $module   - module name (scan module directory for preset)
 * @param  object  $lib      - library object
 * @param  string  $preset   - preset name (default: 'default')
 * @param  string  $plugin   - plugin name
 *
 **/
function backendPreset(
    $module   = NULL,
    $lib      = '',
    $preset   = 'default',
    $plugin   = NULL,
    $subdir   = NULL
) {
    $la = new LABackend();
    $la->loadPreset(
        array(
            'module' => $module,
            'lib'    => $lib,
            'preset' => $preset,
            'plugin' => $plugin,
            'subdir' => $subdir,
        )
    );
    $la->printPreset();
}   //  end function backendPreset()

/**
 * find installed libs
 **/
function scanLibraries() {

    global $lib_info, $module_version;

    $dir  = LA_LIB_PATH;
    $libs = array();

    // add LibraryAdmin itself
    include $dir.'/libraryadmin/library_info.php';
    include $dir.'/libraryadmin/info.php';
    $libs[] = array_merge(
                  $lib_info,
                  array(
                      'path' => 'libraryadmin',
                      'module_version' => $module_version,
                  )
              );
    $lib_info = array();

    // find available libraries; path names must begin with 'lib_' and contain
    // a file 'library_info.php'
    if ( $handle = opendir($dir) ) {
        while ( false !== ( $file = readdir($handle) ) ) {
            if ( $file != "." && $file != ".." ) {
                if (
                       is_dir( $dir.'/'.$file )
                    && preg_match( '#^lib_#', $file )
                    && file_exists( $dir.'/'.$file.'/library_info.php' )
                ) {
                    include $dir.'/'.$file.'/library_info.php';
                    include $dir.'/'.$file.'/info.php';
                    $libs[] = array_merge(
                                  $lib_info,
                                  array(
                                      'path'    => $file,
                                      'module_version' => $module_version,
                                  )
                              );
                    $lib_info = array();
                }
            }
        }
        closedir($handle);
    }
    else {
        $this->printError( 'Unable to open library path ('.$dir.')' );
    }

    return $libs;

}   // end function scanLibraries()

/**
 *
 *
 *
 *
 **/
function __parsePresetContent( $path, $content, $preset_content, $core_files = array(), $be_module = false ) {

    global $debug, $css, $js, $inline_js;

    if ( ! empty ( $preset_content ) ) {

        if ( $debug ) {
            echo "page content:<br /><textarea cols=\"100\" rows=\"20\" style=\"width: 100%;\">";
            print_r( $content );
            echo "</textarea>";
            echo "preset content:<br /><textarea cols=\"100\" rows=\"20\" style=\"width: 100%;\">";
            print_r( $preset_content );
            echo "</textarea>";
        }

        // if called from a backend module...
        if ( $be_module ) {
            // "fake" head and body
            $content = "<head></head>\n<body>\n".$content."\n</body>";
        }

        // parse page contents
        $parser = new DomParser();
        $parser->parseHTML( $content );

        // parse preset contents
        $preset = new DomParser();
        $preset->parseHTML( $preset_content );

        // add lib_path to core files
        $core_regex = NULL;
        if ( count( $core_files ) > 0 ) {
            foreach( $core_files as $i => $file ) {
                $core_files[$i] = $path.'/'.$file;
            }
            // get the list of core files to include
            $core_regex = '#(' . implode( '|', $core_files ) . ')$#i';
        }

        // analyze page contents and get the results
        $result = $parser->analyze(
            "#/libraryadmin/#i",
            $preset,
            $core_files,
            $core_regex,
            $path
        );

        // backend
        if ( $be_module ) {
            $css       = $parser->getLinkedCSS();
            $js        = $parser->getLinkedJS();
            $inline_js = $parser->getJS();
        }

        if ( $debug ) {
            echo "parse result:<br /><textarea cols=\"100\" rows=\"20\" style=\"width: 100%;\">";
            print_r( $result );
            echo "</textarea>";
        }

        if ( $be_module ) {
            $result   = array();
            $result['head'] = $parser->getHTML( 'head' );
            $result['body'] = $parser->getHTML( 'body' );
            return $result;
        }

        return $result;

    }
    else {
        if ( $debug ) {
            echo "[LibraryAdmin Debug] unable to load preset [$path] or preset empty<br />";
        }
    }

}   // end function __parsePresetContent()

?>