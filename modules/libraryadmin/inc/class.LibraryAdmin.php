<?php

/*******************************************************************************
    Library Admin
    (c) 2010 Bianka Martinovic - All rights reserved
    http://www.webbird.de/
*******************************************************************************/

include_once dirname(__FILE__).'/../library_info.php';
include_once 'class.LibraryUtils.php';

if ( ! class_exists('LibraryAdmin') ) {

    class LibraryAdmin extends LibraryUtils {

        // ----- Debugging -----
        protected $debugLevel     = KLOGGER::OFF;
        #protected $debugLevel     = KLOGGER::DEBUG;
        protected $lib_info;

        private   $_subdirs = array( 'plugin' => '/plugins', 'plugins' => '/plugins' );


        /**
         * Constructor
         *
         * Loads the library info into the current object and dds some global
         * template vars
         *
         * @access public
         * @return void
         *
         **/
        public function __construct() {
            global $lib_info;
            $this->lib_info = $lib_info;
            parent::__construct();
            $this->is_backend = true;
        }   // end function __construct()

        /**
         * Returns the name of a subdirectory to unzip to when a plugin or theme or
         * whatever is uploaded.
         *
         * @access public
         * @param  string   $type - upload type (plugin, theme, ...)
         * @return string   directory name
         *
         **/
        public function get_subdir( $type ) {
            if ( isset( $this->_subdirs[$type] ) ) {
                return $this->_subdirs[$type];
            }
            $this->printError( 'Unknown asset type: ['.$type.']' );
        }   // end function get_subdir()

        /**
         *
         *
         *
         *
         **/
        public function component_types() {
            return
                array(
                    'tooltip' => array(
                                      'label'     => 'CSS Tooltips',
                                      'subdir'    => 'assets/css_tooltips',
                                      'show_dirs' => true,
                                      'exclude'   => '/^presets$/i',
                                      'regexp'    => '/^(.*)\.css$/',
                                      'radio'     => 1,
                                  ),
                    'dropdown' => array(
                                      'label'     => 'CSS Dropdown Menus',
                                      'method'    => 'listCSSMenus',
                                      'subdir'    => 'assets/css_dropdown_framework/themes',
                                      'regexp'    => '/(((.*)(?:\.(horizontal|vertical|linear).*)))\.html$/i',
                                      'default'   => 'default',
                                      'radio'     => 1,
                                  ),
                );
        }   // end function component_types()
        
        /**
         *
         *
         *
         *
         **/
        public function listCSSMenus( $item, $type ) {
        
            $dir      = LA_LIB_PATH.'/'.$this->lib_path.'/'.$item['subdir'];
            $subdirs  = array();
            $files    = array();
            $output   = array();
            $id       = 4;
            $selected = NULL;
            
            $id_map = array( 'horizontal' => 1, 'vertical' => 2, 'linear' => 3 );
            $files  = array(
                          array( 'id' => 0, 'parent' => NULL, 'title' => 'root'      , 'level' => 0 ),
                          array( 'id' => 1, 'parent' => 0   , 'title' => 'horizontal', 'level' => 1 ),
                          array( 'id' => 2, 'parent' => 0   , 'title' => 'vertical'  , 'level' => 1 ),
                          array( 'id' => 3, 'parent' => 0   , 'title' => 'linear'    , 'level' => 1 ),
                      );
                     
            if ( preg_match( "#<!-- name: (.*) -->#i", parent::$last_preset_content, $match ) ) {
                $selected = $match[1];
            }

            // find all files that match the given regexp
            if ( $dh = opendir( $dir ) ) {
                while ( ($file = readdir($dh)) !== false ) {
                    if ( is_dir( $dir.'/'.$file ) && ! preg_match( '/^\./', $file ) ) {
                        $subdirs[$file] = array(
                                              $file,
                                              $file
                                          );
                    }
                    elseif ( isset($item['regexp']) && preg_match( $item['regexp'], $file, $matches ) ) {
/*
Array
(
    [0] => adobe.com.horizontal.html
    [1] => adobe.com.horizontal
    [2] => adobe.com.horizontal
    [3] => adobe.com
    [4] => horizontal
)
*/
                        $name = preg_replace( '#\.+#', '.', join( '', preg_split( '#(\.'.join('|',array_keys($id_map)).'\.)#i', $matches[2] ) ) );
                        $checked = NULL;
                        if ( ! strcasecmp( $selected, $matches[2] ) ) {
                            $checked = 'checked="checked"';
                        }
                        $files[] = array(
                                       'parent' => $id_map[$matches[4]],
                                       'title'  => "<input type=\"radio\" name=\"".$type."[]\" value=\"".$matches[0]."\" $checked />".$name,
                                       'id'     => $id,
                                       'level'  => 2
                                   );
                        $id++;
                    }
                }
                closedir($dh);
            }
            
            $this->wblist()->config(
                array(
                    'ul_class' => 'tabbed'
                )
            );

            $this->log()->LogDebug( 'files in dir ['.$dir.']:', $files );
            return $this->wblist()->buildListIter( $files );

        }   // end function listCSSMenus()

    }

}

?>