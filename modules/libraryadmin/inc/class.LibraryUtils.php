<?php

/*******************************************************************************
    Library Admin
    (c) 2010 Bianka Martinovic - All rights reserved
    http://www.webbird.de/
*******************************************************************************/

include_once 'init.inc.php';
include_once dirname(__FILE__).'/../include.php';
include_once dirname(__FILE__).'/class.LABackend.php';

// try to include wblib; can be installed in a sub directory, or globally
// global installation is preferred for easier update
if ( file_exists( dirname(__FILE__).'/wblib/include_all.php' ) ) {
    include dirname(__FILE__).'/wblib/include_all.php';
}
elseif ( file_exists( dirname(__FILE__).'/../../wblib/include_all.php' ) ) {
    include dirname(__FILE__).'/../../wblib/include_all.php';
}
else {
    echo "Unable to load wblib!<br />";
    exit;
}

if ( ! class_exists('LibraryUtils') ) {

    class LibraryUtils extends wbBase {

        // ----- Debugging -----
        protected $debugLevel    = KLOGGER::OFF;
        #protected $debugLevel    = KLOGGER::DEBUG;

        // accessors to wblib classes
        protected $tpl;
        protected $lang;
        protected $val;
        protected $db;
        protected $wblist;

        protected $base_uri;
        protected $subdir;
        protected $errors;
        protected $page_tree;
        protected $is_backend = false;
        protected $backend;

        static    $last_preset_content;
        static    $libs;
        static    $comp_num = 0;

        /**
         *
         *
         * @access public
         *
         **/
        public function __construct() {

            parent::__construct();

            $this->base_uri = $this->getURI( NULL, array('*'), array( 'tool' => 'libraryadmin' ) );
            $this->subdir   = basename( dirname(__FILE__) );

            if ( strpos( $this->base_uri, '&' ) > 0 ) {
                list( $base_url, $ignored ) = @split( '&', $this->base_uri, 2 );
            }
            else {
                $base_url = $this->base_uri;
            }

            global $module_name, $module_version;
            include dirname(__FILE__).'/../info.php';

            $this->tpl()->setGlobal(
                array(
                    'CURRENT_URL'    => $this->base_uri,
                    'BASE_URL'       => $base_url,
                    'LA_IMG_URL'     => LA_IMG_URL,
                    'TEMPLATE'       => TEMPLATE,
                    'LA_LIB_URL'     => LA_LIB_URL,
                    // this is the version of LibraryAdmin!
                    'MODULE_NAME'    => $module_name,
                    'MODULE_VERSION' => $module_version,
                )
            );

            $this->backend = new LABackend();

        }   // end function __construct()

/*******************************************************************************
 * Accessor functions
 ******************************************************************************/

        /**
         * auto-create accessor functions for lib_info elements
         *
         * @access public
         * @param  string  $key - required array key
         * @return string
         *
         **/
        function __get( $key ) {
            $key = str_ireplace( 'lib_', 'library_', $key );
            $this->log()->LogDebug( 'getting key ['.$key.']' );
            if( isset( $this->lib_info[$key] ) ) {
                $val = $this->lib_info[$key];
                $this->log()->LogDebug( 'value: ['.$val.']' );
                return $val;
            }
        }   // end function __get()

        /**
         * accessor to wbI18n
         **/
        public function lang() {
            if ( ! is_object( $this->lang ) ) {
                $this->lang = new wbI18n( LANGUAGE );
            }
            return $this->lang;
        }   // end function lang()

        /**
         * accessor to wbTemplate
         **/
        public function tpl() {
            if ( ! is_object( $this->lang ) ) {
                $this->tpl = new wbTemplate(
                    array(
    //                    'debug' => true,
                        'path'  => dirname(__FILE__).'/../templates',
                        'lang'  => $this->lang(),
                    )
                );
            }
            return $this->tpl;
        }   // end function tpl()

        /**
         * accessor to wbDatabase
         **/
        public function db() {
            if ( ! is_object( $this->db ) ) {
                if ( ! defined( 'DB_PORT' ) ) {
                    define( 'DB_PORT', '3306' );
                }
                $this->db = wbDatabase::singleton(
                    array(
                        'user'   => DB_USERNAME,
                        'pass'   => DB_PASSWORD,
                        'dbname' => DB_NAME,
                        'host'   => DB_HOST,
                        'port'   => DB_PORT,
                        'prefix' => TABLE_PREFIX,
                    )
                );

            }
            return $this->db;
        }   // end function db()

        /**
         * accessor to wbValidate
         **/
        public function val() {
            if ( ! is_object( $this->val ) ) {
                $this->val = new wbValidate(
                    array(
//                        'debug' => true,
                    )
                );
            }
            return $this->val;
        }   // end function val()

        /**
         * accessor to wbListBuilder
         **/
        public function wblist() {
            if ( ! is_object( $this->wblist ) ) {
                $this->wblist = new wbListBuilder(
                    array(
//                        'debug' => true,
                    )
                );
            }
            return $this->wblist;
        }

/*******************************************************************************
 *
 ******************************************************************************/

        /**
         * Main function; print the backend
         *
         * @access public
         * @return HTML
         *
         **/
        public function show() {

            $output      = NULL;
            $current 	 = NULL;
            $info    	 = NULL;
            $libs    	 = $this->findLibs();
            $lib     	 = $this->val()->param('lib');
            $preset  	 = NULL;
            $has_backups = NULL;

            // get last open tab from the cookie
            if ( isset( $_COOKIE['__la_open_tab'] ) && substr_compare( $_COOKIE['__la_open_tab'], 'lib_', 0, 4 ) == 0 && empty( $lib ) ) {
                $lib = $_COOKIE['__la_open_tab'];
            }
            elseif ( isset( $_SESSION['__la_open_tab'] ) && substr_compare( $_SESSION['__la_open_tab'], 'lib_', 0, 4 ) == 0 && empty( $lib ) ) {
                $lib = $_SESSION['__la_open_tab'];
            }
            else {
                $_SESSION['__la_open_tab'] = $lib;
            }

            // look for backend preset
            $this->backend->loadPreset();
            echo $this->backend->printPreset();

            if ( $this->val()->param('info') ) {
                $output = $this->showLibraries();
                $current = 1;
            }
            elseif ( ! empty($lib) ) {

                $this->lib = $this->loadLibrary( $lib );
                $this->base_uri = $this->getURI( NULL, array('*'), array( 'tool' => 'libraryadmin', 'lib' => $this->lib->lib_path ) );
                $this->_setCurrent( $this->lib->lib_path, $libs );

                /***********************************************************************
                    'case switch'
                ***********************************************************************/
                // handle upload?
                if ( $this->val()->param('upload') && ! $this->val()->param('cancel') ) {
                    list( $state, $info ) = $this->handleUpload();
                    if ( $state == 'form' ) {
						$output = $info;
						$info   = NULL;
					}
                }
                // list backups?
                elseif ( $this->val()->param('backups') && ! $this->val()->param('cancel') ) {
					$output = $this->listBackups();
                }
                // file to edit?
                elseif ( $this->val()->param('edit') && ! $this->val()->param('cancel') ) {
                    list( $type, $content ) = $this->editPresetContents( $this->val()->param('edit') );
                    if ( $type == 'info' ) {
                        $info   = $content;
                    }
                    else {
                        $output = $content;
                    }
                }
                // plugin to configure?
                elseif ( $this->val()->param('config') && $this->val()->param('plugin') && ! $this->val()->param('cancel') ) {
                    list( $type, $content ) = $this->configurePlugin();
                    if ( $type == 'info' ) {
                        $info   = $content;
                    }
                    else {
                        $output = $content;
                    }
                }
                // export plugin?
                elseif( $this->val()->param('export') && $this->val()->param('plugin') && ! $this->val()->param('cancel') ) {
                    $plugin_dir = LA_LIB_PATH.'/'.$this->lib->lib_path.'/'.$this->lib->get_subdir('plugin').'/'.$this->val()->param('plugin');
                    if ( file_exists( $plugin_dir ) && is_dir( $plugin_dir ) ) {
                        if ( true !== $this->exportPlugin( $this->val()->param('plugin'), $plugin_dir ) ) {
							$info = $this->last_error();
                        }
                        else {
                            $info = $this->tpl()->getTemplate(
	                  			'success.tpl',
	                  			array(
	                      			'msg' => $this->lang()->translate( 'Export successful!' )
								)
							);
                        }
                    }
                }
                // delete?
                elseif ( $this->val()->param('del') && $this->val()->param('plugin') && ! $this->val()->param('cancel') ) {
                    $plugin_dir = LA_LIB_PATH.'/'.$this->lib->lib_path.'/'.$this->lib->get_subdir('plugin').'/'.$this->val()->param('plugin');
                    if ( file_exists( $plugin_dir ) && is_dir( $plugin_dir ) ) {
                        $this->exportPlugin( $this->val()->param('plugin'), $plugin_dir );
                        $this->rm_full_dir( $plugin_dir );
                    }
                }

                // find backups
	            $backup_path    = LA_LIB_PATH . '/' . $this->lib->lib_path . '/backups';
	            $files          = NULL;
	            if ( file_exists( $backup_path ) && is_dir( $backup_path ) ) {
					$files = $this->scanDirectory( $backup_path, NULL, true, true );
	            }
	            if (
					( is_array($files) && count($files) )
					&&
					! $this->val()->param('backups')
				) {
				    $has_backups = true;
				}

                if ( empty( $output ) ) {
                    $output = $this->defaultView();
                }

                if ( is_object( $this->lib ) && $this->lib->lib_path != 'libraryadmin' ) {
                    foreach( $this->lib->scan_dirs as $dir ) {
                        if ( file_exists( LA_LIB_PATH.'/'.$this->lib->lib_path.'/'.$dir.'/backend.'.$this->lib->preset_suffix ) ) {
                            $this->backend->loadPreset(
                                array(
                                    'lib' => $this->lib->lib_path,
                                    'preset' => 'backend'
                                )
                            );
                            $preset .= $this->backend->printPreset();
                            break;
                        }
                    }
                }

            }
            else {
                $this->lib = $this->loadLibrary( 'libraryadmin' );
                $output    = $this->defaultView();
                $this->_setCurrent( 'libraryadmin', $libs );
            }

            $this->tpl()->setTemplate( 'index.tpl' );
            $this->tpl()->printTemplate(
                array(
                    'content' => $preset . $output,
                    'libs'    => $libs,
                    'current' => $current,
                    'info'    => $info,
                    'lib'     => ( is_object( $this->lib ) ? $this->lib->lib_path : NULL ),
                    'has_backups' => $has_backups,
                )
//                ,true
            );

        }   // end function show()

        /**
         * Checks if library_info.php is available;
         * loads library_info.php if so;
         * instantiates lib class
         *
         * @access public
         * @param  string  $lib - library path name
         * @return object
         *
         **/
        public function loadLibrary( $lib ) {

            $this->log()->LogDebug( 'Loading lib ['.$lib.']' );

            if ( file_exists( LA_LIB_PATH.'/'.$lib ) && file_exists( LA_LIB_PATH.'/'.$lib.'/library_info.php' ) ) {

                // get the library info
                global $lib_info;
                include LA_LIB_PATH.'/'.$lib.'/library_info.php';
                $this->log()->LogDebug( 'library info:', $lib_info );

                // lib class
                $class   = $lib_info['library_class'];

                // load library class file
                include_once LA_LIB_PATH.'/'.$lib.'/inc/class.'.$class.'.php';

                // create object
                $lib_class   = new $class();

                if ( is_object( $lib_class ) ) {

                    $this->log()->LogDebug( 'class ['.get_class($lib_class).'] loaded' );

                    if ( strpos( $this->base_uri, '&' ) > 0 ) {
                        list( $base_url, $ignored ) = @split( '&', $this->base_uri, 2 );
                    }
                    else {
                        $base_url = $this->base_uri;
                    }
                    $lib_url = $base_url;
                    if ( $this->lib_path ) {
                        $lib_url .= '&amp;lib='.$lib_class->lib_path;
                    }

                    $this->tpl()->setGlobal(
                        array(
                            'LA_THIS_LIB_URL' => $lib_url,
                            'LIB_IMG_URL'  => LA_LIB_URL.'/'.$lib_class->lib_path.'/images',
                        )
                    );

                    return $lib_class;
                }
                else {
                    $this->printError( "Unable to load class [$class]!" );
                }

            }
            else {
                $this->printError(
                    $this->lang()->translate(
                        "Unknown library [{{ lib }}]] or missing library_info.php",
                        array( 'lib' => $lib )
                    )
                );
            }

            // should never be reached
            return true;

        }   // end function loadLibrary()

/*******************************************************************************
 * Function prototypes
 ******************************************************************************/

        /**
         * List of core files to include
         *
         * This is a method prototype; you'll have to override this method to
         * include the appropriate files!
         *
         * @access public
         * @return array
         *
         **/
        public function core_files() {
            return array();
        }   // end function core_files()

        /**
         * List of known component types
         *
         * This is a method prototype; you'll have to override this method to
         * provide valid types!
         *
         * The list of component types will be used by the listComponents() method
         * to create selectable lists of components to include in the preset.
         *
         * @access public
         * @return array
         *
         **/
        public function component_types() {
            return array();
        }   // end function component_types()

        /**
         * Feturns the name of a file to check for when a plugin or theme or
         * whatever is uploaded.
         *
         * This is a method prototype; override this to return a file name of your
         * choice for the given $type.
         *
         * Returns 'default.preset' by default
         *
         * @access public
         * @param  string   $type - upload type (plugin, theme, ...)
         * @return string   filename
         *
         **/
        public function check_existance( $type ) {
            return 'default.preset';
        }   // end function check_existance()

        /**
         * Feturns the name of a subdirectory to unzip to when a plugin or theme or
         * whatever is uploaded.
         *
         * This is a method prototype; override this to return a directory of your
         * choice for the given $type.
         *
         * Returns 'plugins' by default
         *
         * @access public
         * @param  string   $type - upload type (plugin, theme, ...)
         * @return string   directory name
         *
         **/
        public function get_subdir( $type ) {
            return 'plugins';
        }   // end function get_subdir()

        /**
         *
         *
         *
         *
         **/
        public function protected_names() {
            return array( 'backend', 'frontend', 'default' );
        }   // end function protected_names()


/*******************************************************************************
 *   Utility functions
 ******************************************************************************/

        public function pages() {
            return $this->page_tree;
        }   // end function pages()

        /**
         *
         **/
        public function set_error( $msg ) {
            $this->errors[] = $msg;
        }   // end function set_error()

        /**
         *
         **/
        public function last_error() {
            return array_pop( $this->errors );
        }   // end function last_error()

        /**
         *
         **/
        public function get_errors() {
            return implode( "<br />\n", $this->errors );
        }   // end function get_errors()

        /**
         * find all module folders; this scans simply for sub directories in the
         * LA_LIB_PATH folder
         *
         * @access public
         * @param  array   $exclude - folders to exclude
         * @return array   found subdirectories (folder names)
         *
         **/
        function getModuleFolders( $exclude = array(), $regex_exclude = array() )
        {
            $found_dirs = array();
            if ( is_dir( LA_LIB_PATH ) )
            {
                if ( $dh = opendir( LA_LIB_PATH ) )
                {
                    while ( ( $subdir = readdir($dh) ) !== false )
                    {
                        if (
                             // only if it's a directory
                             is_dir( LA_LIB_PATH.'/'.$subdir )
                             &&
                             // skip hidden folders
                             ! preg_match( '/^\./', $subdir )
                             &&
                             // skip folders in $exclude array
                             ! in_array( $subdir, $exclude )
                             &&
                             // skip current lib directory
                             ! preg_match( '/^'.$this->subdir.'$/', $subdir )
                        ) {
                            // $exclude may contains regexp
                            if ( is_array( $regex_exclude ) && count( $regex_exclude ) > 0 ) {
                                foreach( $regex_exclude as $item ) {
                                    if ( preg_match( $item, $subdir ) ) {
                                        // continue while / skip this subdir
                                        continue 2;
                                    }
                                }
                            }
                            $found_dirs[] = $subdir;
                        }
                    }
                    closedir( $dh );
                    $this->log()->LogDebug(
                        'Found directories in path ['.LA_LIB_PATH.']:',
                        $found_dirs
                    );
                }
                else {
                    $this->log()->LogDebug(
                       'WARNING! Unable to open LA_LIB_PATH!',
                       LA_LIB_PATH
                    );
                }
            }
            else {
                $this->log()->LogDebug(
                    'WARNING! LA_LIB_PATH is not a directory!',
                    LA_LIB_PATH
                );
            }
            return $found_dirs;
        }   // end function getModuleFolders()

        /**
         * Find preset files
         *
         * Returns an array that contains the following data:
         *     <Filename without suffix> => array(
         *         'file'   => <complete Filename>,
         *         'type'   => $type,
         *         'subdir' => <$subdir>/<current $scan_dir entry>
         *     )
         *
         * @access public
         * @param  string   $type
         * @param  string   $subdir
         * @return array    list of files
         *
         **/
        public function findPresets( $suffix, $subdir = NULL, $is_selected = NULL )
        {

            $files     = array();
            $scan_dirs = $this->lib->scan_dirs;
            $protected = $this->lib->protected_names();

            $this->log()->LogDebug(
                "Find presets with suffix [".$suffix."], selected [".$is_selected."], in dirs:",
                $scan_dirs
            );

            $protect_regexp = '#^('.implode('|',$protected).')\.#i';

            foreach ( $scan_dirs as $scan_dir ) {

                if ( $subdir ) {
                    $dir = LA_LIB_PATH.'/'.$subdir.'/'.$scan_dir;
                }
                else {
                    $dir = LA_LIB_PATH.'/'.$this->lib->lib_path.'/'.$scan_dir;
                }

                $this->log()->LogDebug( "Scanning dir: $dir" );

                if ( is_dir($dir) ) {
                    if ( $dh = opendir($dir) ) {
                        while ( ($file = readdir($dh)) !== false ) {
                            if ( preg_match( "/^(.*)\.".$suffix."$/", $file, $matches ) ) {
                                $selected = NULL;
                                $can_del  = NULL;
                                if ( $is_selected && $is_selected == $subdir.$scan_dir.'/'.$matches[0] ) {
                                    $selected = true;
                                }
                                if ( ! preg_match( $protect_regexp, $file ) ) {
                                    $can_del = true;
                                }
                                $this->log()->LogDebug( 'found match:', $matches );
                                if ( is_numeric( $matches[1] ) ) {
                                    $title = $this->getPageTitle($matches[1]);
                                    $icon  = 'page.png';
                                }
                                else {
                                    $title = $matches[1];
                                    $icon  = NULL;
                                }
                                $files[] = array(
                                               'name'       => $matches[1],
                                               'file'       => $matches[0],
                                               'title'      => $title,
                                               'subdir'     => $subdir.$scan_dir,
                                               'selected'   => $selected,
                                               'can_delete' => $can_del,
                                               'icon'       => $icon,
                                           );
                            }
                        }
                        closedir($dh);
                    }
                    else {
                        $this->log()->LogDebug( "WARNING! Unable to open dir [$dir]" );
                    }
                }
                else {
                    $this->log()->LogDebug( "WARNING! Directory [$dir] does not exist or is not a directory" );
                }
            }

            // sort files by name
            $files = $this->ArraySort ( $files, 'title', 'asc', true );
            $this->log()->LogDebug( 'found preset files: ', $files );

            if ( ! count($files) ) { return NULL; }

            return $files;

        }   // end function findPresets()



        /**
         * Gets the list of installed plugins; these are expected in a subfolder
         * called 'plugins'
         *
         * @access public
         * @param  boolean $checkbox - add a checkbox to each item; default: false
         * @param  array   $selected - entries to select; default: empty array
         * @return string  unordered list (HTML)
         *
         **/
        public function listPlugins( $checkbox = false, $selected = array() )
        {

            $output = '<ul>';
            $files  = array();
            $dirs   = array();
            $dir    = LA_LIB_PATH.'/'.$this->lib->lib_path.'/'.$this->lib->get_subdir('plugins').'/';

            $this->log()->LogDebug( 'Scanning directory ['.$dir.'] for installed plugins' );
            $this->log()->LogDebug( 'Selected:', $selected );

            if ( $dh = opendir( $dir ) ) {
                while ( ( $file = readdir($dh) ) !== false ) {
                    if ( preg_match( "/^(.*)\.js$/", $file, $matches ) ) {
                        $files[$matches[0]] = $matches;
                    }
                    else if ( is_dir( $dir.$file ) && ! preg_match( '/^\./', $file ) ){
                        $dirs[] = $file;
                    }
                }
                closedir($dh);
            }
            else {
                $this->log()->LogDebug( 'WARNING! Unable to open directory ['.$dir.']' );
                return;
            }

            $plugins = $this->val->param('plugins');
            if ( is_array( $plugins ) ) {
                if ( ! is_array( $selected ) ) {
                    $selected = array();
                }
                foreach ( $plugins as $item ) {
                    $selected[] = $item;
                }
            }

            natcasesort( $dirs );

            // foreach plugin (per dir)...
            foreach ( $dirs as $subdir ) {

                $checked  = NULL;
                $readme   = NULL;
                $config   = NULL;
                $edit     = NULL;
                $delete   = NULL;
                $export   = NULL;
                $name     = $subdir;
                $cbox     = NULL;

                if ( $checkbox !== false ) {
	                $delete   = '<a class="tt" href="'.$this->base_uri.'&amp;plugin='.$subdir.'&amp;del=1" '
							  . 'onclick="REDIPS.dialog.show(250, 100, \''.$this->lang->translate('Are you sure?').'\', '
							  . '\''.$this->lang->translate('Cancel').'\', \'OK|dlgconfirm|\'+this.href, \''.$this->lang->translate('Close').'\' );return false;">'
	                          . '<img src="'.LA_IMG_URL.'/delete_16.png" alt="Delete" />'
	                          . '<span class="tooltip"><span class="top"></span><span class="middle">'
	                          . $this->lang()->translate('Click here to delete the plugin. This will NOT check if the plugin is in use!')
	                          . '</span><span class="bottom"></span></span>'
	                          . '</a>';

	                $export   = '<a class="tt" href="'.$this->base_uri.'&amp;plugin='.$subdir.'&amp;export=1">'
	                          . '<img src="'.LA_IMG_URL.'/disks.png" alt="Export" />'
	                          . '<span class="tooltip"><span class="top"></span><span class="middle">'
	                          . $this->lang()->translate('Click here to export (backup) the plugin.')
	                          . '</span><span class="bottom"></span></span>'
	                          . '</a>';
				}

                // find readme files
                $readme_filenames = array(
                    // current language
                    'readme_'.strtolower( LANGUAGE ).'.html',
                    // default
                    'readme.html'
                );

                // add readme link
                foreach ( $readme_filenames as $rfile ) {
                    if ( file_exists( $dir.$subdir.'/'.$rfile ) ) {
                        $readme = '<a target="_blank" class="lyteframe tt" href="'
                                . LA_LIB_URL.'/'.$this->lib->lib_path.'/'.$this->lib->get_subdir('plugins').'/'.$subdir.'/'.$rfile.'" '
								//. ' title="Readme for Plugin '.$subdir.'"'
                                // this makes Lytebox fail (don't know why...)
//                                . ' data-lyte-options="width: 600px; height: 500px; scrolling: auto;"'
                                . '>'
                                . '<img src="'.LA_IMG_URL.'/info.png" alt="Readme" />'
                                . '<span class="tooltip"><span class="top"></span><span class="middle">'
                                . $this->lang()->translate('Click on the lamp symbol to get more info about this plugin/component')
                                . '</span><span class="bottom"></span></span>'
                                . '</a>';
                        break;
                    }
                }

                // find config file
                if ( $checkbox !== false && file_exists( $dir.$subdir.'/config.php' ) ) {
                    $config = '<a class="tt" href="'.$this->base_uri.'&amp;plugin='.$subdir.'&amp;config=1">'
                            . '<img src="'.LA_IMG_URL.'/modify_16.png" alt="Configure" />'
                            . '<span class="tooltip"><span class="top"></span><span class="middle">'
                            . $this->lang()->translate('Click here to configure the plugin.')
                            . '</span><span class="bottom"></span></span>'
                            . '</a>';
                }

                // checkbox to add?
                if ( $checkbox ) {

                    reset( $selected );
                    // mark selected plugins
                    foreach ( $selected as $i => $sel ) {
                        if ( preg_match( "#/$subdir/#i", $sel['src'] ) ) {
                            $checked = 'checked="checked"';
                            break 1;
                        }
                    }

                    $cbox = "<input type=\"checkbox\" name=\"plugins[]\" value=\""
                          .  $subdir
                          .  "\" $checked />";

                }

                $output .= "<li> $cbox <span"
						.  (
							 ( $checked ) ? ' class="bold"' : ''
						   )
						.  '>'.$name
						.  "</span> <span style=\"float: right;\">$edit $config $readme $delete $export</span><br style=\"clear: right;\" /></li>\n";

            }

            $output .= "</ul>\n";

            return $output;

        }   // end function listPlugins()

        /**
         *
         *
         * @access public
         * @param  string  $dir       - directory to scan
         * @param  string  $type      - component type
         * @param  boolean $show_dirs - show directories instead of files
         * @param  array   $selected  - items to check
         * @param  array   $item      - current component
         *
         **/
        function listComponents( $dir, $type, $show_dirs, $selected, $item ) {

            $this->log()->LogDebug( '', array( $dir, $type, $show_dirs, $selected, $item ) );

            global $comp_toggle_default;

            self::$comp_num++;

            $files    = array();
            $subdirs  = array();
            $as_radio = false;
            $label    = $this->lang()->translate( $item['label'] );
            $output   = "<h2>$label</h2>\n";

            // is there a method configured to call for the component presentation?
            if ( isset( $item['method'] ) ) {
                if ( ! method_exists( $this->lib, $item['method'] ) ) {
                    $this->printError(
                        $this->lang->translate(
                            'Missing configured presentation method for component [{{ component }}]',
                            array( 'component' => $label )
                        )
                    );
                }
                $method  = $item['method'];
                $output .= $this->lib->$method( $item, $type, $selected );
            }
            else {

                list( $subdirs, $files ) = $this->matchFiles( $dir, $item );
                $this->log()->LogDebug( 'subdirs in dir ['.$dir.']:', $subdirs );
                $this->log()->LogDebug( 'files in dir ['.$dir.']:', $files );

                if ( count($files) == 0 ) {
                    if ( ! $show_dirs ) {
                        return $output
                             . $this->lang()->translate('No files found');
                    }
                    else {
                        $files    = $subdirs;
                        $as_radio = true;
                    }
                }

                if ( isset( $item['radio'] ) ) {
                    $as_radio = true;
                }

                $this->log()->LogDebug( 'selected:', $selected );

                asort( $files );
                $output .= "<ul>\n";

                foreach ( $files as $file => $match ) {

                    // is there a regexp to exclude files?
                    if ( isset( $item['exclude'] ) ) {
                        if ( preg_match( $item['exclude'], $file ) ) {
                            $this->log()->LogDebug( 'Excluding file ['.$file.'] (matches exclude regexp ['.$item['exclude'].'])' );
                            continue;
                        }
                    }

                    $checked      = NULL;
                    $filename     = basename( $file );

                    reset( $selected );

                    foreach ( $selected as $i => $sel ) {

                        // sort out files outside current lib directory
                        if ( ! preg_match( '#/'.$this->lib->lib_path.'/#i', $sel['src'] ) ) {
                            $this->log()->LogDebug( 'sorted out by missing lib_path match', $sel );
                            break;
                        }

                        $checked = NULL;

                        $this->log()->LogDebug( 'checking current -'.basename( $sel['src'] ).'- against filename -'.$filename.'-' );

                        // ----- check by filename -----
                        if (
                             ! strcasecmp( basename( $sel['src'] ), $filename )
                        ) {
                            $checked = 'checked="checked"';
                            $this->log()->LogDebug( 'check by filename match' );
                            break 1;
                        }

                        $this->log()->LogDebug(
                            'check against dir name: -'
                          . preg_replace( '#.*/#', '', dirname( $sel['src'] ) )
                          . '- -'
                          . preg_replace( '#\.\w+$#', '', $filename )
                          . '-'
                        );

                        // ----- check by path name -----
                        if (
                             ! strcasecmp( preg_replace( '#.*/#', '', dirname( $sel['src'] ) ), preg_replace( '#\.\w+$#', '', $filename ) )
                        ) {
                            $this->log()->LogDebug( 'check by dirname match' );
                            $checked = 'checked="checked"';
                            break 1;
                        }

                        // ----- check by path name in subdirs array -----
                        foreach ( array_keys($subdirs) as $subdir ) {
                            if ( preg_match( '#/'.$subdir.'/?$#', dirname( $sel['src'] ) ) ) {
                                $this->log()->LogDebug( 'check by subdir match -preg_match( \'#/'.$subdir.'/?$#\', dirname( '.$sel['src'].' ) )' );
                                $checked = 'checked="checked"';
                                break 1;
                            }
                        }

                        $this->log()->LogDebug( 'no match' );

                    }

                    $output .= "<li> <input type=\""
                            .  ( $as_radio ? 'radio' : 'checkbox' )
                            .  "\" name=\"".$type."[]\" value=\""
                            .  $file
                            .  "\" $checked /><span"
                            .  ( ( $checked ) ? ' class="bold"' : '' )
                            .  '>'
                            .  ( isset( $match[2] ) ? ucfirst($match[2]) : ucfirst($match[1]) )
							. '</span>';

                    // find readme files
                    $demo_filenames = array(
                        ( isset( $match[2] ) ? $match[2] : $match[1] ) . '_'.strtolower( LANGUAGE ).'.php',
                        ( isset( $match[2] ) ? $match[2] : $match[1] ) . '.php'
                    );

                    foreach ( $demo_filenames as $dfile )
                    {
                        if ( file_exists( $dir.'/examples/'.$dfile ) )
                        {
                            $url     = str_ireplace( LA_LIB_PATH, LA_LIB_URL, $dir );
                            $output .= '<span style="float: right;"><a class="tt" href="'
                                    .  $url.'/examples/'.$dfile.'" target="_blank" '
                                    .  'rel="lyteframe" rev="width: 800px; height: 600px; scrolling: auto;"'
                                    .  '>'
                                    .  '<img src="'.LA_IMG_URL.'/info.png" alt="Example" />'
                                    .  '<span class="tooltip"><span class="top"></span><span class="middle">'
                                    .  $this->lang()->translate('Click on the lamp symbol to get more info about this plugin/component')
                                    .  '</span><span class="bottom"></span></span>'
                                    .  '</a></span>';
                            break;
                        }
                    }

                    $output .= "</li>\n";

                }

                $output .= "</ul>\n</span>\n";

            }

            return $output;

        }   // end function listComponents()

        /**
         *
         *
         *
         *
         **/
		public function listBackups() {

		    // find backups
            $backup_path    = LA_LIB_PATH . '/' . $this->lib->library_path . '/backups';
            $backup_url     = LA_LIB_URL . '/' . $this->lib->library_path . '/backups';
            $files          = NULL;

			if ( $this->val()->param('delete') && file_exists( $backup_path . '/' . $this->val()->param('delete') ) ) {
				unlink( $backup_path . '/' . $this->val()->param('delete') );
		    }

		    if ( file_exists( $backup_path ) && is_dir( $backup_path ) ) {
				$files = $this->scanDirectory( $backup_path, '/', true, true );
            }

			$backups = array();
			if ( count($files) ) {
			    foreach( $files as $file ) {
			        $backups[] = array( 'filename' => $file );
			    }
			}

			$this->tpl()->setGlobal( array( 'backup_url' => $backup_url ) );

		    return $this->tpl()->getTemplate(
                'backups.tpl',
                array(
                    'backups'    => $backups,
                )
            );
		}   // end function listBackups()

        /**
         *
         * @access  public
         * @param   $file   file to edit (relative path to modules folder)
         * @return  HTML
         *
         **/
        function editPresetContents( $file ) {

            $file_path = $this->_checkPreset( $file, true );
            $info      = NULL;

            if ( $this->val->param('save') || $this->val->param('save_back') ) {

                $fcontent = implode( '', file( $file_path ) );
                $new      = $this->val->param( 'code', 'PCRE_PLAIN' );

                // remove backslashes
                if ( get_magic_quotes_gpc() ) {
                    $new = stripslashes($new);
                }

                // remove repeated empty lines
                $new      = preg_replace( "/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/s", "\n", $new );

                // do we have some changes?
                if ( strcasecmp( $fcontent, $new ) != 0 ) {
                    // create backup copy
                    copy( $file_path, $file_path . '.backup' );
                    $fh = fopen( $file_path, "w" );
                    if ( $fh ) {
                        fwrite( $fh, $new );
                        fclose( $fh );
                    }
                    $info = $this->tpl()->getTemplate(
								'success.tpl',
								array(
									'msg' => $this->lang()->translate(
		                                 'Configuration saved to file {{ file }}',
		                                 array( 'file' => str_ireplace( LA_LIB_PATH, '&lt;WB_PATH&gt;/modules', $file_path ) )
		                             )
								)
							);
                }
            }

            if ( $this->val->param('save_back') ) {
                return array( 'info', $info );
            }

            $content = NULL;
            $custom  = NULL;

            // get the preset contents
            $fcontent = implode( '', file( $file_path ) );

            preg_match_all( "#<!--\s*?custom\s*-->(.*?)<!--\s*?end custom\s*-->#ism", $fcontent, $matches, PREG_SET_ORDER );

            if ( is_array($matches) && count($matches) > 0 ) {
                foreach( $matches as $i => $item ) {
                    $custom  .= $matches[$i][1];
                    // remove from $fcontent
                    $fcontent = str_ireplace( $matches[$i][0], "", $fcontent );
                }
            }

            $content = $fcontent . "\n"
                     . ( ! empty($custom) ? "\n<!-- custom -->$custom<!-- end custom -->\n" : NULL );

            $output = $this->tpl()->getTemplate(
                'editor.tpl',
                array(
                    'name'   => $file,
                    'subdir' => $this->val->param('subdir'),
                    'lib'    => $this->val->param('lib'),
                    'type'   => $this->val->param('type'),
                    'file'   => $file,
                    'code'   => $content,
                    'info'   => $info
                )
            );

            return array( 'page', $output );

        }   // end function _editPresetContents()

        /**
         *
         *
         *
         *
         **/
        public function configurePlugin() {

            global $loader_begin_regexp, $loader_end_regexp,
                   $_plugin_config, $_plugin_lang;

            $plugin_dir = LA_LIB_PATH.'/'.$this->lib->lib_path.'/'.$this->lib->get_subdir('plugin').'/'.$this->val()->param('plugin');
            list( $fname, $before, $after, $items ) = $this->_parsePresetConfig( $plugin_dir );

            $output = NULL;
            $info   = NULL;

            if ( $this->val()->param('save') || $this->val()->param('save_back') ) {

                $new_plugin_config = array();
                foreach ( $items as $item )
                {
                    if ( $this->val()->param($item['name']) ) {
                        $new_plugin_config[$item['name']] = $this->val()->param($item['name']);
                    }
                }
                // ----- do we have extended settings? (config.php) -----
                $config = $this->val()->by_prefix('config_');
                if ( count($config) ) {
                    global $loader_begin_regexp, $loader_end_regexp,
                           $_plugin_config, $_plugin_lang;
                    include_once $plugin_dir."/config.php";
                    $newcontent = '<'.'?'.'php'."\n";
                    foreach ( array( '_plugin_config', '_plugin_lang', 'loader_begin_regexp', 'loader_end_regexp' ) as $key )
                    {
                        $newcontent .= "\t" . '$' . $key . ' = ';
                        if ( isset( ${$key} ) )
                        {
                            if ( is_array( ${$key} ) )
                            {
                                if ( $key == '_plugin_config' )
                                {
                                    $newcontent .= var_export( $config, 1 ) . ";\n\n";
                                }
                                else {
                                    $newcontent .= var_export( ${$key}, 1 ) . ";\n\n";
                                }
                            }
                            else {
                                $newcontent .= "'" . ${$key} . "';\n\n"; #str_replace( '$', '\$', ${$key} )
                            }
                        }
                    }
                    $newcontent .= "\n".'?'.'>';
                    $fh = fopen( $plugin_dir."/config.php", "w" );
                    if ( $fh )
                    {
                        fwrite( $fh, $newcontent );
                        fclose( $fh );
                    }
                }

                if ( count( $new_plugin_config ) > 0 )
                {
                    $config_out   = array();
                    foreach ( $items as $i => $item )
                    {
                        $value    = isset( $new_plugin_config[ $item['name'] ] )
                                  ? $new_plugin_config[ $item['name'] ]
                                  : $item['value'];
                        $config_out[] = "\t'".$item['name']."': ".$value
                                  . ( ( $i == count($items)-1 ) ? '' : ',' )
                                  . " // ".$item['label'];
                    }

                    $new = implode( "\n", $config_out );

                    $new = $before."\n"
                         . $new."\n"
                         . $after;

                    // parse generated preset for place holders to be replaced with additional config vars
                    $find_keys = implode( '|', array_keys( $config ) );
                    if ( ! empty( $find_keys ) ) {
                        $new = preg_replace( "#\{($find_keys)\}#isme", 'isset( $_plugin_config["\\1"] ) ? $_plugin_config["\\1"] : "";', $new );
                    }

                    $fh = fopen( $plugin_dir."/custom.preset", "w" );
                    if ( $fh )
                    {
                        fwrite( $fh, $new );
                        fclose( $fh );
                    }
                    else {
                        $this->printError( 'ERROR!!! Unable to save plugin configuration to file [custom.preset]' );
                    }

                }

                if ( $this->val()->param('save_back') ) {
                    $this->val()->delete('config');
                    $this->val()->delete('plugin');
                    return array(
                        'info',
                        $this->tpl()->getTemplate(
                  			'success.tpl',
                  			array(
                      			'msg' => $this->lang->translate( 'The plugin configuration was saved' )
							)
						)
                    );
                }

                $info = $this->lang->translate( 'The plugin configuration was saved' );

            }

            // do we have extended options?
            if ( is_array( $_plugin_config ) && count( $_plugin_config ) > 0 )
            {
                foreach ( $_plugin_config as $item => $setting )
                {

                    $label  = ( is_array($_plugin_lang) && isset($_plugin_lang[$item]) && $_plugin_lang[$item] != '' )
                            ? $_plugin_lang[$item]
                            : $item;

                    $field  =  "<input type=\"text\" class=\"fbtext\" name=\"config_"
                            .  $item
                            .  "\" id=\"config_"
                            .  $item
                            .  "\" value=\""
                            .  $setting
                            .  "\" />";

                    $output .= "<tr><td style=\"text-align: right; padding-right: 10px;\"><label for=\""
                            .  $item
                            .  "\">"
                            .  $label
                            .  "</label>:</td><td>$field</td></tr>\n";
                }
            }

            // create the form
            foreach ( $items as $item )
            {
                if( preg_match( "#(true|false)#i", $item['value'] ) ) {
                    $sel    = array(
                                  'true'  => ( $item['value'] == 'true'  ? 'selected="selected"' : '' ),
                                  'false' => ( $item['value'] == 'false' ? 'selected="selected"' : '' ),
                              );

                    $field  = "<select class=\"fbselect\" style=\"width: 15em;\" name=\""
                            .  $item['name']
                            .  "\" id=\""
                            .  $item['name']
                            .  "\"><option value=\"true\" ".$sel['true'].">true</option>"
                            .  "<option value=\"false\" ".$sel['false'].">false</option>"
                            .  "</select>";
                }
                elseif ( preg_match( "#function\s*?\(#i", $item['value'] ) ) {
                    $field  = "<textarea class=\"fbtextarea\" name=\""
                            .  $item['name']
                            .  "\" id=\""
                            .  $item['name']
                            .  "\">".htmlentities($item['value'])."</textarea>";
                }
                else {
                    $field  =  "<input type=\"text\" class=\"fbtext\" name=\""
                            .  $item['name']
                            .  "\" id=\""
                            .  $item['name']
                            .  "\" value=\""
                            .  $item['value']
                            .  "\" />";
                }

                $output .= "<tr><td style=\"text-align: right; padding-right: 10px;\"><label for=\""
                        .  $item['name']
                        .  "\">"
                        .  $item['label']
                        .  "</label>:</td><td>$field</td></tr>\n";
            }

            $output = $this->tpl()->getTemplate(
                'configure_plugin.tpl',
                array(
                    'subdir'      => $this->lib->get_subdir('plugin'),
                    'lib'         => $this->val->param('lib'),
                    'plugin'      => $this->val->param('plugin'),
                    'info'   	  => $info,
                    'form'   	  => $output
                )
            );

            return array(
                '',
                $output
            );

        }   // end function configurePlugin()

        /**
         *
         *
         *
         *
         **/
        public function configurePreset( $preset, $subdir ) {

            $info_class = NULL;
            $info_msg   = NULL;
            $what       = NULL;
            $msg        = NULL;

            // get the preset path
            $path       = dirname( $this->_checkPreset( $preset ) );

            if ( $this->val()->param('save') ) {
                list( $what, $msg ) = $this->_savePreset( $path );
                $info_class = $what;
                $info_msg   = $msg;
                $preset     = $this->val()->param('preset_name');
            }

            // delete preset?
            if ( $this->val()->param('delete') ) {
                $file_path = $this->_checkPreset( $this->val()->param('delete'), true );
                if ( ! unlink( $file_path ) ) {
                    $info_class = 'error';
                    $info_msg   = $this->lang()->translate(
                                      'Unable to delete preset [{{ preset }}]',
                                      array(
                                          'preset' => $this->val()->param('delete')
                                      )
                                  );
                }
                else {
                    $info_class = 'success';
                    $info_msg   = $this->lang()->translate(
                                      'Preset [{{ preset }}] was deleted successfully',
                                      array(
                                          'preset' => $this->val()->param('delete')
                                      )
                                  );
                    // remove preset name from current uri
                    $uri = $this->base_uri;
                    $uri = preg_replace( '#delete='.$this->val()->param('delete').'#', '', $uri );
                    $this->tpl()->setGlobal(
                        array(
                            'CURRENT_URL'    => $uri
                        )
                    );
                }
            }

            $selected    = array();
            $is_selected = $subdir.'/'.$preset;

            // find selected components
            if ( $preset != '[new]' && ! $this->val->param('is_new') && $what != 'error' ) {
                $selected = $this->_getSelectedFromPreset( $this->_checkPreset( $preset, true ) );
            }

            // find plugins; mark selected
            $plugins     = $this->listPlugins( true, $selected );

            // find components
            $comps   = array();
            $components = $this->lib->component_types();
            if ( is_array( $components ) && count($components) > 0 ) {
                foreach( $components as $name => $item ) {
                    $show_dirs = ( isset( $item['show_dirs'] ) && $item['show_dirs'] === true )
                               ? true
                               : false;
                    $comps[]['list'] = $this->listComponents(
                         LA_LIB_PATH.'/'.$this->lib->lib_path.'/'.$item['subdir'],
                         $name,
                         $show_dirs,
                         $selected,
                         $item
                    );
                }
            }

            // get page tree
            $pages = $this->db()->search(
                array(
                    'tables'   => 'pages',
                    'group_by' => 'page_id',
                    'order_by' => 'parent, position'
                )
            );
            if ( is_array( $pages ) && count($pages) > 0 ) {
                $list = new wbListBuilder(
                    array(
                        '__id_key'        => 'page_id',
                        '__title_key'     => 'menu_title',
                    )
                );
                $this->page_tree
                    = $list->buildDropDownIter(
                          $pages,
                          array(
                              'space' => '|-> ',
                              'selected' => 1
                          )
                      );
                $this->tpl()->setGlobal( 'page_tree', $this->page_tree );
            }

            // create the header
            $is_new = false;
            if ( $preset != '[new]' && $what != 'error' ) {

                $dir         = $this->_checkPreset( $preset, true );
                $short       = $preset;
                if ( stripos( $preset, "." ) > 0 )
                {
                    $short   = substr( $preset, 0, stripos( $preset, "." ) );
                }

                if ( is_numeric( $short ) )
                {
                    $droplet = 'LibLoader';
                    $page    = $this->lang()->translate( 'Page' ) . ': '
                             . $this->getPageTitle( $short );
                }
                else {
                    $droplet     = 'LibInclude';
                    $params      = array( 'lib='.$this->lib->lib_path );

                    // preset located in current lib path?
                    if ( ! preg_match( "#/".$this->lib->lib_path."/#i", $dir ) || $short != 'default' )
                    {
                        $params[] = "preset=$short";
                    }

                    if ( preg_match( "#/modules/([^\/].*?)/#i", $dir, $matches ) && ! preg_match( "#/".$this->lib->lib_path."/#i", $dir ) )
                    {
                        $params[] = "module=" . $matches[1];
                    }

                    if ( count( $params ) > 0 )
                    {
                        $droplet .= '?' . implode( '&amp;', $params );
                    }
                }

                $path    = str_ireplace( LA_LIB_PATH, './modules/', $dir );
                $path    = preg_replace( "#//+#", '/', $path );
                $path    = str_replace( '\\', '/', $path );

                $header = "<h2>"
                        . $this->lang()->translate( 'Edit Preset' )
                        . ": ".$preset
                        . ( isset( $page ) ? " ($page)" : '' )
                        . "</h2><br /><br />\n"
                        . "<span>"
                        . '<strong>'.$this->lang()->translate( 'Path' ) . ':</strong> '
                        . $path
                        . '<br /><br /><strong>'
                        . $this->lang()->translate( 'Usage (copy&amp;paste this into a WYSIWYG-Section)' )
                        . "</strong><br /><input type=\"text\" id=\"droplet_code\" value=\"[[$droplet]]\" readonly=\"readonly\" /></span><br /><br />\n";

            }
            else {
                $is_new = true;
                $path   = str_ireplace( LA_LIB_PATH, './modules/', $path );
                $path   = preg_replace( "#//+#", '/', $path );
                $path   = str_replace( '\\', '/', $path );
                $header = "<h2>"
                        . $this->lang()->translate( 'New Preset' )
                        . ":</h2>\n"
                        . "<input type=\"text\" name=\"preset_name\" id=\"preset_name\" />"
                        . "<input type=\"hidden\" name=\"is_new\" id=\"is_new\" value=\"1\" />"
                        . "<a href=\"#\" class=\"tt\" onclick=\"document.getElementById('preset_name').value=document.getElementById('page_tree').value;toggle_by_id('page_title','inline-block');\" "
                        . '"> '
                        . '<img src="'.LA_IMG_URL."/tree.png\" alt=\"\" />"
                        . '<span class="tooltip"><span class="top"></span><span class="middle">'
                        . $this->lang()->translate( 'Choose a page from the page tree to create a preset for' )
                        . "</span><span class=\"bottom\"></span></span></a> "
                        . '<span id="page_title" style="display: none;">'
                        . '<select name="page_tree" id="page_tree" onchange="'
                        . 'document.getElementById(\'preset_name\').value=document.getElementById(\'page_tree\').value;'
                        . '">'
                        . $this->page_tree
                        . '</select>'
                        . "</span><br /><br />\n"
                        . '<strong>'.$this->lang()->translate( 'Path' ) . ':</strong> '
                        . $path
                        . "<br /><br />\n"
                        ;
            }

            // render the template
            return $this->tpl()->getTemplate(
                'configure.tpl',
                array(
                    'header'           => $header,
                    'components'       => $comps,
                    'plugins'          => $plugins,
                    'file'             => $preset,
                    'subdir'           => $subdir,
                    'preset_name'      => $this->val->param('preset_name'),
                    'lib'              => $this->val->param('lib'),
                    'info_class'       => $info_class,
                    'info_msg'         => $info_msg,
                    'type'             => $this->val()->param('type'),
                    'is_new'           => ( $is_new ? 1 : NULL ),
                )
            );

        }   // end function configurePreset()

        /**
         *
         *
         *
         *
         **/
		protected function exportPlugin( $plugin, $plugin_dir ) {

			$temp_dir  = LA_LIB_PATH.'/'.$this->lib->lib_path.'/backups';
            $temp_file = $temp_dir . '/' . $plugin . '.zip';
            if ( ! file_exists( $temp_dir ) ) {
                mkdir( $temp_dir, 0755 );
            }
            // create zip
		    require_once(WB_PATH.'/include/pclzip/pclzip.lib.php');
		    $archive   = new PclZip($temp_file);
		    $file_list = $archive->create( $plugin_dir, PCLZIP_OPT_REMOVE_PATH, $plugin_dir );
		    if ($file_list == 0) {
		    	$this->set_error(
					$this->lang->translate(
						"Packaging error:<br /><br />{{ msg }}<br />",
						array( 'msg' => $archive->errorInfo(true) )
					)
				);
				return false;
		    }

		    return true;

		}   // end function exportPlugin()

        /**
         * find installed libs
         *
         * @access protected
         * @return array
         *
         **/
        protected function findLibs() {
            if ( is_array( self::$libs ) ) {
                return self::$libs;
            }
            self::$libs = scanLibraries();
            $this->log()->LogDebug( 'found libraries:', self::$libs );
            return self::$libs;
        }   // end function findLibs()

        /**
         * handle plugin upload
         *
         * @access public
         * @return array
         *
         **/
        function handleUpload() {

            // is there already a file?
            if ( isset( $_FILES['userfile'] ) ) {
                if ( $this->_saveUploadFile() === false ) {
					return array(
                    	'error',
						$this->tpl()->getTemplate(
                  			'error.tpl',
                  			array(
                      			'msg' => $this->last_error()
                  			)
              			)
					);
                }
                else {
                    return array(
                    	'success',
						$this->tpl()->getTemplate(
                  			'success.tpl',
                  			array(
                      			'msg' => $this->lang()->translate( 'Upload successful!' )
							)
						)
					);
                }
            }
            // add upload form?
            else {
                return array(
                	'form',
					$this->tpl()->getTemplate(
                  		  'uploadform.tpl',
	                      array(
	                          'lib'     => $this->val->param('lib'),
	                          'type'    => $this->val->param('type'),
	                          'plugins' => $this->listPlugins()
	                      )
                  	  )
				);
            }

        }   // end function handleUpload()

        /**
         *
         *
         *
         *
         **/
        public function defaultView() {

            // file to configure?
            $file = '[new]';
            $dir  =  $this->lib->scan_dirs[0];

            if ( $this->val()->param('config') && ! $this->val()->param('cancel') ) {
                $file = $this->val()->param('preset_name');
                $dir  = $this->val()->param('subdir');
            }

            // as configurePreset() may save a new preset, we call this first
            $configure_tpl  = $this->configurePreset( $file, $dir );

            // find presets in tool folder
            $lib_presets    = $this->findPresets( $this->lib->preset_suffix, NULL );

            // find presets in other modules folders
            $module_folders = $this->getModuleFolders( array( $this->lib->lib_path ), array( '/^lib_/' ) );

            $module_presets = NULL;
            if ( is_array( $module_folders ) ) {
                $module_presets = array();
                foreach ( $module_folders as $module ) {
                    $presets = $this->findPresets( $this->lib->preset_suffix, $module );
                    if ( count( $presets ) > 0 ) {
                        $module_presets[]
                            = array(
                                  'module'  => $module,
                                  'presets' => $presets
                              );
                    }
                }
            }

            // find presets im template folder
            $template_presets = $this->findPresets( $this->lib->preset_suffix, '../templates/'.TEMPLATE );

            // render the template
            return $this->tpl()->getTemplate(
                'backend.tpl',
                array(
                    'presets'          => $lib_presets,
                    'module_presets'   => $module_presets,
                    'template_presets' => $template_presets,
                    'lib'              => $this->lib->lib_path,
                    'subdir'           => $this->lib->scan_dirs[0],
                    'library_name'     => $this->lib->lib_name,
                    'plugins_and_components'
                                       => $configure_tpl,
                    '__la_open_tab'    => $this->lib->lib_path,
                )
//				,true
            );

        }   // end function defaultView()

        /**
         * This function creates a list of installed libraries
         *
         * @access public
         * @return HTML
         *
         **/
        public function showLibraries() {
            $content = NULL;
            $home    = true;
            $libs    = $this->findLibs();
            $content = $this->tpl()->getTemplate(
                           'lib_infos.tpl',
                           array(
                               'CURRENT_URL' => $this->base_uri,
                               'libs'        => $libs,
                           )
            );
            return $content;
        }   // end function showLibraries()

        /**
         * This method creates index.php files in every subdirectory of a given path
         *
         * @access public
         * @param  string  directory to start with
         * @return void
         *
         **/
        public function recursiveCreateIndex( $dir )
        {
            if ( $handle = opendir($dir) )
            {
                if ( ! file_exists( $dir . '/index.php' ) )
                {
                    $fh = fopen( $dir.'/index.php', 'w' );
        	          fwrite( $fh, INDEX_CONTENT );
        	          fclose( $fh );
                }

                while ( false !== ( $file = readdir($handle) ) )
                {
                    if ( $file != "." && $file != ".." )
                    {
                        if( is_dir( $dir.'/'.$file ) )
                        {
                            $this->recursiveCreateIndex( $dir.'/'.$file );
                        }
                    }
                }
                closedir($handle);
                return true;
            }
            else {
                return false;
            }

        }   // end function recursiveCreateIndex()

        /**
         * print an error message
         **/
        public function printError( $msg = NULL, $args = NULL ) {
            $error = $this->tpl()->getTemplate( 'error.tpl', array( 'msg' => $msg ) );
            // look for backend preset
            $this->backend->loadPreset();
            $preset = $this->backend->printPreset();
            if ( is_object( $this->lib ) ) {
                foreach( $this->lib->scan_dirs as $dir ) {
                    if ( file_exists( LA_LIB_PATH.'/'.$this->lib->lib_path.'/'.$dir.'/backend.'.$this->lib->preset_suffix ) ) {
                        $this->backend->loadPreset(
                            array( 'lib' => $this->lib->lib_path )
                        );
                        $preset .= $this->backend->printPreset();
                        break;
                    }
                }
            }
            echo $preset;

            if ( $this->is_backend ) {
                $lib = is_object( $this->lib ) ? $this->lib->lib_path : 'unknown';
                $this->tpl()->setFile('index.tpl');
                $this->tpl()->printTemplate(
                    array (
                        'libs'    => $this->findLibs(),
                        'content' => $error,
                        'lib'     => $lib
                    )
                );
            }
            else {
                echo $error;
                return;
            }
            exit;
        }   // end function printError()

        /**
         *
         *
         *
         *
         **/
        public function getPageTitle( $num ) {
            $data = $this->db()->search(
                array(
                    'tables' => 'pages',
                    'fields' => 'menu_title',
                    'where'  => 'page_id == ?',
                    'params' => array( $num )
                )
            );
            if ( is_array($data) && isset($data[0]) ) {
                return $data[0]['menu_title'];
            }
            return $num;
        }   // end function getPageTitle()

        /**
         *
         *
         *
         *
         **/
        public function matchFiles( $dir, $item ) {
            $this->log()->LogDebug( "DIR -$dir- ITEM", $item );
            $subdirs = array();
            $files   = array();
            // find all files that match the given regexp
            if ( $dh = opendir( $dir ) ) {
                while ( ($file = readdir($dh)) !== false ) {
                    if ( is_dir( $dir.'/'.$file ) && ! preg_match( '/^\./', $file ) ) {
                        $this->log()->LogDebug( 'Adding directory -'.$file.'-' );
                        $subdirs[$file] = array(
                                              $file,
                                              $file
                                          );
                    }
                    elseif ( isset($item['regexp']) && preg_match( $item['regexp'], $file, $matches ) ) {
                        $this->log()->LogDebug( 'Adding regexp ['.$item['regexp'].'] file ['.$file.'] match -'.$matches[0].'-' );
                        $files[$matches[0]] = $matches;
                    }
                }
                closedir($dh);
            }
            return array( $subdirs, $files );
        }   // end function matchFiles()

        /**
         *
         **/
        function _copyRecursive( $dirsource, $dirdest ) {
		    if ( is_dir($dirsource) ) {
		        $dir_handle = opendir($dirsource);
		    }
		    else {
		        return false;
			}
		    if ( is_resource($dir_handle) ) {
			    while ( $file = readdir($dir_handle) ) {
			        if( $file != "." && $file != ".." ) {
			            if( ! is_dir($dirsource."/".$file) ) {
			                copy ($dirsource."/".$file, $dirdest.'/'.$file);
			            }
			            else {
			                make_dir($dirdest."/".$file);
				            $this->_copyRecursive($dirsource."/".$file, $dirdest.'/'.$file);
			            }
			        }
			    }
			    closedir($dir_handle);
				return true;
			}
			else {
			    return false;
			}
		}   // end function _copyRecursive()

		/**
		 * this one is taken from the LEPTON core, just to stay independent
		 **/
		function rm_full_dir($directory)
		{
			// If suplied dirname is a file then unlink it
			if (is_file($directory))
			{
				return unlink($directory);
			}
			// Empty the folder
			if (is_dir($directory))
			{
				$dir = dir($directory);
				while (false !== $entry = $dir->read())
				{
					// Skip pointers
                if ($entry == '.' || $entry == '..')
                {
                    continue;
                }
					// Deep delete directories
                if (is_dir($directory . '/' . $entry))
					{
                    rm_full_dir($directory . '/' . $entry);
					}
					else
					{
                    unlink($directory . '/' . $entry);
					}
				}
				// Now delete the folder
				$dir->close();
				return rmdir($directory);
			}
    }   // end function rm_full_dir()

        /**
         *
         *
         *
         *
         **/
        private function _setCurrent( $lib, &$libs ) {
            foreach ( $libs as $i => $item ) {
                $libs[$i]['current'] = NULL;
                if ( $item['library_path'] == $lib ) {
                    $libs[$i]['current'] = 1;
                }
            }
        }   // end function _setCurrent()

        /**
         *
         *
         *
         *
         **/
        private function _getRegexpFor( $type = 'js' ) {
            switch ($type) {
                case 'js':
                    return '#<script(?:(?:.*(?P<src>(?<=src=")[^"]*(?="))[^>]*)|[^>]*)>(?P<content>(?:(?:\n|.)(?!(?:\n|.)<script))*)</script>#';
                	  break;

                case 'css':
                    return;
                    break;

                default:
            	      break;
            }
        }   // end function _getRegexpFor()

        /**
         * parse a preset file:
         * - replace WB_URL with LIB_URL
         * - find JavaScripts
         *
         * @access private
         * @param  string   $file - file to parse
         * @return array    found JavaScripts
         *
         **/
        private function _getSelectedFromPreset( $file ) {

            if ( ! file_exists( $file ) ) {
                $this->printError(
                    $this->lang()->translate(
                        'Unable to parse preset: File [{{ file }}] does not exist!',
                        array( 'file' => $file )
                    )
                );
            }

            // read the file
            $preset_content = implode( '', file( $file ) );

            // replace WB_URL with LIB_URL (backward compatibility with jQueryAdmin)
            $preset_content = str_ireplace( '{WB_URL}/modules', '{LIB_URL}', $preset_content );

            self::$last_preset_content = $preset_content;

            // parse page contents
            $parser = new DomParser();
            $parser->parseHTML( "<head>$preset_content</head>\n<body></body>" );

            // analyze page contents and get the results
            $result = $parser->analyze( "#/libraryadmin/#i", $parser );

            // selected CSS
            $items  = array_merge(
                            $parser->getLinkedCSS(),
                            $parser->getLinkedJS()
                        );
            $selected = array();

            foreach ( $items as $pos => $entry ) {
                foreach ( $entry as $i => $item ) {
                    $selected[basename( $item )]['src'] = $item;
                }
            }

            return $selected;

        }   // end function _getSelectedFromPreset()

        /**
         * parse preset configuration to show as dialog
         *
         * @access public
         * @param  string  $plugin_dir - directory to load from
         * @return array
         *
         **/
        function _parsePresetConfig( $plugin_dir )
        {

            global $loader_begin_regexp, $loader_end_regexp, $_plugin_config, $_plugin_lang;

            // set defaults
            $loader_begin_regexp = '\$j?\([^\)].*?\)\.\w+\(\{';
            $loader_end_regexp   = '\}\);';
            $items               = array();
            $before              = NULL;
            $after               = NULL;
            $fname               = NULL;

            include_once "$plugin_dir/config.php";


            // get the preset contents
            if ( file_exists( $plugin_dir.'/custom.preset' ) )
            {
                $content = implode( '', file( $plugin_dir.'/custom.preset' ) );
                $fname   = 'custom.preset';
            }
            elseif ( file_exists( $plugin_dir.'/loader.preset' ) )
            {
                $content = implode( '', file( $plugin_dir.'/loader.preset' ) );
                $fname   = 'loader.preset';
            }
            else
            {
                // this should never happen
                $this->printError( "Unable to load preset file; neither custom.preset nor loader.preset available." );
            }

            // match the beginning of the config
            if ( preg_match( '#^(.+?'.$loader_begin_regexp.')(.*)#ism', $content, $matches ) )
            {
                $before  = $matches[1];
                $content = $matches[2];

                // match the end of the config; there may be more content after that
                if ( preg_match( "#((?!$loader_end_regexp).*?)($loader_end_regexp.*)$#ism", $content, $matches ) )
                {
                    $after = $matches[2];
                    $lines = preg_split( "#\r?\n#", $matches[1] );
                    foreach( $lines as $line )
                    {
                        preg_match( "#([^:].*?)\s*:\s*(.*?)\s*\,?\s*\/\/(.*)$#i", $line, $item );
                        if ( is_array( $item ) && count($item) > 0 )
                        {
                            $name    = str_replace( "'", '', stripslashes(trim($item[1])) );
                            $value   = str_replace(
                                           array( '"' ),
                                           array( '&quot;' ),
                                           trim($item[2])
                                       );
                            $items[] = array(
                                           'name'  => $name,
                                           'value' => $value,
                                           'label' => trim($item[3])
                                       );
                        }
                    }
                }
            }
            return array( $fname, $before, $after, $items );

        }   // end function _parsePresetConfig()

        /**
         * handle upload
         *
         * @access private
         * @return boolean
         *
         **/
        private function _saveUploadFile()
        {

            if ( ! $this->val->param('type') ) {
                $this->printError(
                    $this->lang()->translate( 'Missing type!' )
                );
                return;
            }

            if ( $this->val->param('cancel') ) {
                return;
            }

            $check_for  = $this->check_existance( $this->val->param('type') );
            $subdir     = $this->lib->get_subdir( $this->val->param('type') );

            // Set temp vars
            $temp_dir   = UPLOAD_TEMP;
            $temp_file  = $temp_dir . $_FILES['userfile']['name'];
            $temp_unzip = UPLOAD_TEMP.'/unzip/';

            // target directory
            $dirname    = LA_LIB_PATH.'/'.$this->lib->lib_path.'/'.$subdir.'/'.str_replace( '.zip', '', $_FILES['userfile']['name'] );

            // Try to upload the file to the temp dir
            if( ! move_uploaded_file( $_FILES['userfile']['tmp_name'], $temp_file ) )
            {
           	    $this->set_error(
                     $this->lang()->translate( 'Upload failed!' )
                );
           	    return false;
            }

            // Include the PclZip class file
            require_once( LA_LIB_PATH.'/libraryadmin/inc/pclzip/pclzip.lib.php');

            $archive = new PclZip($temp_file);

            // Unzip the files to the temp unzip folder
            $list = $archive->extract(PCLZIP_OPT_PATH, $temp_unzip);

            // Check if uploaded file is a valid plugin zip file
            if ( ! ( $list && file_exists( $temp_unzip . $check_for ) ) )
            {
                $this->set_error('The file is not a valid Plugin! (Missing file "'.$check_for.'")');
                rm_full_dir($temp_unzip);
                return false;
            }

			// check: jquery plugin uploaded from wrong tab?
			$found      = false;
			$dir_handle = opendir($temp_unzip);
			while ( $file = readdir($dir_handle) ) {
		        if( $file != "." && $file != ".." ) {
		            if ( preg_match( '/jquery/i', $file ) && $this->lib->lib_path != 'lib_jquery' ) {
		                $this->set_error(
							$this->lang->translate(
								"The Plugin you've uploaded seems to be a jQuery Plugin. Please upload from the jQuery tab."
							)
						);
		                $found  = true;
		            }
		        }
		    }
		    closedir($dir_handle);
            if ( $found ) {
                rm_full_dir($temp_unzip);
            	return false;
            }

            // check config.php
            // TODO: check if lib exists and install the plugin there automatically
            if ( file_exists( $temp_unzip . 'config.php' ) ) {
                global $lib_needed;
                @include $temp_unzip . 'config.php';
                if ( $lib_needed && $this->lib->lib_path != $lib_needed ) {
		            $this->set_error(
                        $this->lang()->translate(
                            "The Plugin you've uploaded requires lib [{{ lib }}]. Please install the plugin from the appropriate tab.",
                            array( 'lib' => $lib_needed )
						)
					);
		            rm_full_dir($temp_unzip);
		            return false;
				}
            }

            // install into given folder
            if ( ! file_exists( $dirname ) )
            {
                mkdir( $dirname, 0755 );
            }
			if ( ! $this->_copyRecursive( $temp_unzip, $dirname ) )
            {
				$this->set_error(
					$this->lang->translate(
					    'Plugin installation failed. (Unable to extract into plugins subdir.)'
					)
				);
            	rm_full_dir($temp_unzip);
            	return false;
            }

            // Delete the temp zip file
            if( file_exists( $temp_file) )
            {
                unlink( $temp_file );
            }

            rm_full_dir($temp_unzip);

            // make sure that there's an index.php file in every subdir
            $this->recursiveCreateIndex( $dirname );

            return true;

        }   // end function _saveUploadFile()

        /**
         * Save preset
         *
         * @access public
         * @param  string   $workdir - working directory
         * @return void
         *
         **/
        public function _savePreset( $workdir ) {

            $this->log()->LogDebug( 'workdir: -'.$workdir.'-' );

            $preset_name = $this->val()->param('preset_name');

            if ( empty( $preset_name ) ) {
                $this->log()->LogDebug( 'missing preset name' );
                return
                    array(
                        'error',
                        $this->lang()->translate('Please insert a preset name!')
                    );
            }

            // validate file name
            if ( preg_match( '/^([\w\_\-\.]+)$/', $preset_name ) ) {
                $preset_file = $preset_name;
                // add the suffix if not already there
                if ( ! preg_match( "/\.".$this->lib->preset_suffix."$/i", $preset_file ) ) {
                    $preset_file .= '.' . $this->lib->preset_suffix;
                }
                $this->log()->LogDebug( 'preset file: -'.$preset_file.'-' );
            }
            else {
                $this->log()->LogDebug(
                    'invalid file name ['.$preset_name.']'
                );
                return
                    array(
                        'error',
                        $this->lang()->translate( 'Please insert a valid preset name!' )
                    );
            }

            $output   = NULL;
            $custom   = NULL;
            $base_dir = LA_LIB_PATH.'/'.$this->lib->lib_path;

            // get plugins
            $output   = $this->_handlePlugins( $base_dir );
            $output  .= $this->_handleComponents( $base_dir );

            // do we have some results?
            if ( $output ) {
                // be compatible to jQueryAdmin
                $output = str_ireplace(
                               array(
                                   '{WB_URL}/modules',
                                   'jqueryadmin',
                               ),
                               array(
                                   '{LIB_URL}',
                                   $this->lib->lib_path,
                               ),
                               $output
                           );
            }

            // we may have to create the sub directory
            if ( ! strripos( $workdir, $this->lib->scan_dirs[0] ) ) {
                $workdir .= '/'.$this->lib->scan_dirs[0];
            }
            if ( ! file_exists( $workdir ) ) {
                mkdir( $workdir, 0777 );
            }

            // if the preset already exists...
            if ( file_exists( $workdir.'/'.$preset_file ) ) {
                // ...look for custom code...
                if( $this->_hasCustomMarkup( $workdir.'/'.$preset_file ) ) {
                    // ...and preserve it
                    $fcontent = implode( '', file( $workdir.'/'.$preset_file ) );
                    preg_match_all( "#(<!--\s*?custom\s*-->.*?<!--\s*?end custom\s*-->)#ism", $fcontent, $matches, PREG_SET_ORDER );
                    if ( is_array($matches) && count($matches) > 0 ) {
                        foreach( $matches as $i => $item ) {
                            $custom  .= $matches[$i][1];
                        }
                    }
                }
            }

            $this->log()->LogDebug( 'saving preset: '.$workdir.'/'.$preset_file );

            $fh   = fopen( $workdir.'/'.$preset_file, 'w' );
            if ( ! $fh ) {
                $this->printError( 'Unable to open file '.$workdir.'/'.$preset_file );
            }
            else {
                fwrite( $fh, $output );
                if ( ! empty( $custom ) ) {
                    fwrite( $fh, "\n".$custom );
                }
                fseek( $fh, ftell( $fh ) );
                fclose( $fh );
                $name = str_ireplace( '.'.$this->lib->preset_suffix, '', $this->val()->param('preset_name') );

                $msg = $this->lang()->translate('Preset saved')
                     . ": [$preset_file]";

                // if there was no output...
                if ( ! $output ) {
                    $uri = $this->getURI(
                               $this->base_uri,
                               NULL,
                               array( 'edit' => $preset_file )
                           );
                    // forward to edit contents page
                    #echo header( 'Location: '. $uri );
                }

                return
                    array(
                        'success',
                        $msg
                    );
            }


        }   // end function _savePreset()

        /**
         *
         *
         *
         *
         **/
        private function _hasCustomMarkup( $file ) {
            if ( preg_match( "#<!--\s*?end?\s*?custom\s*-->#ism", implode( "", file( $file ) ) ) )
            {
                return true;
            }
            return false;
        }   // end function _hasCustomMarkup()

        /**
         *
         *
         *
         *
         **/
        private function _checkPreset( $file, $check_existance = false ) {

            $type = $this->val()->param( 'type', 'PCRE_STRING', array( 'default' => 'lib' ) );

            if ( ! preg_match( "/\.".$this->lib->preset_suffix."$/i", $file ) ) {
                $file .= '.' . $this->lib->preset_suffix;
            }

            // default file path - library folder
            $file_path = LA_LIB_PATH.'/'.$this->lib->lib_path.'/'.$this->val()->param('subdir').'/'.$file;

            // template path
            if ( $type == 'template' ) {
                $file_path = LA_TPL_PATH.'/'.$this->val()->param('subdir').'/'.$file;
            }
            // module path
            if ( $type == 'module' ) {
                $file_path = WB_PATH.'/modules/'.$this->val()->param('subdir').'/'.$file;
            }

            // remove repeated /
            $file_path = preg_replace( '#\/+#', '/', $file_path );

            if ( $check_existance === true ) {
                if ( ! file_exists ( $file_path ) ) {
                    $debug_info = NULL;
                    if ( $this->debugLevel > 0 ) {
                        $debug_info = "<br />\nPath: ".$file_path
                                    . "<textarea cols=\"100\" rows=\"20\" style=\"width: 100%;\">"
                                    . print_r( debug_backtrace(), 1 )
                                    . "</textarea>";
                    }
                    $this->printError(
                        $this->lang()->translate(
                            'Invalid file name! (File doesn\'t exist){{ debug_info }}',
                            array(
                                'debug_info' => $debug_info
                            )
                        )
                    );
                }
            }

            return $file_path;

        }   // end function _checkPreset()

        /**
         *
         *
         *
         *
         **/
        private function _addPreset( $dir, $preset ) {

            $this->log()->LogDebug( "adding preset [$dir] [$preset]" );

            // get the preset contents
            $content = implode( '', file( $dir.$preset.'.preset' ) );

            // be compatible to jQueryAdmin
            $content = str_ireplace(
                           array(
                               '{WB_URL}/modules',
                               'jqueryadmin',
                           ),
                           array(
                               '{LIB_URL}',
                               $this->lib->lib_path,
                           ),
                           $content
                       );

            return $content;

        }   // end private function _addPreset()

        /**
         *
         *
         *
         *
         **/
        private function _addFile( $filename ) {

            $parts = pathinfo($filename);

            if ( ! strcasecmp( $parts['extension'], 'js' ) ) {
                return '<script type="text/javascript" src="'
                       . $filename
                       . '"></script>' . "\n";
            }

            if ( ! strcasecmp( $parts['extension'], 'css' ) ) {
                return '<link media="screen" rel="stylesheet" type="text/css" href="'
                       . $filename
                       . '" />' . "\n";
            }

        }   // end function _addFile()

        /**
         *
         *
         *
         *
         **/
        private function _handlePlugins( $base_dir ) {

            // ----- Handle Plugins -----
            $plugins = $this->val()->param('plugins');
            $output  = NULL;

            if ( is_array( $plugins ) ) {

                foreach ( $plugins as $plugin ) {

                    $this->log()->LogDebug( 'handle plugin ['.$plugin.']' );

                    // is it a folder?
                    if ( is_dir( $base_dir.'/'.$this->lib->get_subdir('plugins').'/'.$plugin ) ) {

                        $this->log()->LogDebug( 'It\'s a folder, search for default.preset' );

                        // look for default.preset in plugin folder
                        if ( file_exists( $base_dir.'/'.$this->lib->get_subdir('plugins').'/'.$plugin.'/default.preset' ) ) {
                            $this->log()->LogDebug( 'default.preset found, loading contents' );
                            // make sure that we start in the header again
                            $output .= "<!-- position: head -->\n";
                            $output .= implode( '', file( $base_dir.'/'.$this->lib->get_subdir('plugins').'/'.$plugin.'/default.preset' ) );
                        }
                        else {
                            $added_files = false;
                            // if we have *.js files, just include them
                            list( $subdirs, $files )
                                = $this->matchFiles(
                                      $base_dir.'/'.$this->lib->get_subdir('plugins').'/'.$plugin,
                                      array( 'regexp' => '#^(.*\.js)$#' )
                                  );
                            if ( count($files) ) {
                                foreach ( $files as $f ) {
                                    $output .= '<script type="text/javascript" src="{LIB_URL}/'
                                             . $this->lib->lib_path.'/'.$this->lib->get_subdir('plugins').'/'.$plugin.'/'
                                             . $f[1]
                                             . '"></script>' . "\n";
                                }
                                $added_files = true;
                            }
                            // look for *.css files
                            list( $subdirs, $files )
                                = $this->matchFiles(
                                      $base_dir.'/'.$this->lib->get_subdir('plugins').'/'.$plugin,
                                      array( 'regexp' => '#^(.*\.css)$#' )
                                  );
                            if ( count($files) ) {
                                foreach ( $files as $f ) {
                                    $output .= '<link media="screen" rel="stylesheet" type="text/css" href="{LIB_URL}/'
                                             . $this->lib->lib_path.'/'.$this->lib->get_subdir('plugins').'/'.$plugin.'/'
                                             . $f[1]
                                             . '" />' . "\n";
                                }
                                $added_files = true;
                            }
                            if ( !$added_files ) {
                                $output .= "<!-- LibraryAdmin Error: Missing default.preset for plugin [$plugin] and no files found -->\n";
                            }
                            continue;
                        }

                        $this->log()->LogDebug( 'search for custom.preset' );
                        // look for a custom loader
                        if ( file_exists( $base_dir.'/'.$this->lib->get_subdir('plugins').'/'.$plugin.'/custom.preset' ) ) {
                            $this->log()->LogDebug( 'custom.preset found, loading contents' );
                            // make sure that we start in the header again
                            $output .= "<!-- position: head -->\n";
                            $output .= implode( '', file( $base_dir.'/'.$this->lib->get_subdir('plugins').'/'.$plugin.'/custom.preset' ) );
                        }
                        elseif ( file_exists( $base_dir.'/'.$this->lib->get_subdir('plugins').'/'.$plugin.'/loader.preset' ) ) {
                            $this->log()->LogDebug( 'loader.preset found, loading contents' );
                            // make sure that we start in the header again
                            $output .= "<!-- position: head -->\n";
                            $output .= implode( '', file( $base_dir.'/'.$this->lib->get_subdir('plugins').'/'.$plugin.'/loader.preset' ) );
                        }

                        $this->log()->LogDebug( 'search for config.php' );
                        // look for extended config
                        if ( file_exists( $base_dir.'/'.$this->lib->get_subdir('plugins').'/'.$plugin.'/config.php' ) ) {
                            $this->log()->LogDebug( 'config.php found, including it' );
                            global $_plugin_config;
                            include $base_dir.'/'.$this->lib->get_subdir('plugins').'/'.$plugin.'/config.php';
                            if ( is_array( $_plugin_config ) ) {
                                // parse preset contents
                                $find_keys = implode( '|', array_keys( $_plugin_config ) );
                                $output = preg_replace( "#\{($find_keys)\}#isme", 'isset( $_plugin_config["\\1"] ) ? $_plugin_config["\\1"] : "";', $output );
                            }
                        }
                    } // end is_dir
                }
            }

            $this->log()->LogDebug( 'output: ', $output );

            return $output;

        }   // end function _handlePlugins()

        /**
         *
         *
         *
         *
         **/
        private function _handleComponents( $base_dir ) {

            // ----- other components -----
            $components = $this->lib->component_types();
            if ( ! is_array( $components ) ) {
                return;
            }

            $output    = NULL;

            if ( count($components) ) {

                $this->log()->LogDebug( 'checking components:', $components );

                foreach( $components as $name => $item ) {

                    $selected_comps = $this->val()->param($name);

                    if ( is_array( $selected_comps ) ) {

                        $this->log()->LogDebug( 'selected elements of component '.$name, $selected_comps );

                        foreach ( $selected_comps as $comp ) {

                            $files  = array();
                            $core   = array();
                            $path   = '{LIB_URL}/'.$this->lib->lib_path.'/'.$item['subdir'].'/'.$comp;
                            $file   = preg_replace( '#{lib_url}#i', LA_LIB_PATH, $path );
                            $preset = NULL;

                            $this->log()->LogDebug( 'check if it\'s a file: '.$file );

                            // look if the selected item is a file
                            if ( is_file( $file ) ) {
                                // if yes, sort out files that have .html as suffix
                                $parts = pathinfo($file);
                                $this->log()->LogDebug( 'it\'s a file - pathinfo:', $parts );
                                if ( strcasecmp( $parts['extension'], 'html' ) ) {
                                    $this->log()->LogDebug( 'it\'s not a HTML file, so go on' );
                                    // add presets as source code
                                    if ( ! strcasecmp( $parts['extension'], 'preset' ) ) {
                                        $this->log()->LogDebug( 'it\'s a preset, so add it\'s contents' );
                                        $preset .= $this->_addPreset( $parts['dirname'], $parts['basename'] );
                                        continue;
                                    }
                                    $this->log()->LogDebug( 'adding file -'.$file.'-' );
                                    $files[] = $path;
                                }
                            }
                            // check if it's a directory
                            elseif ( is_dir( $file ) ) {
                                $this->log()->LogDebug( 'it\'s a directory' );
                                if ( isset( $item['regexp'] ) ) {
                                    // find files in that directory that match the regexp
                                    if ( $dh = opendir( $file ) ) {
                                        while ( ($f = readdir($dh)) !== false ) {
                                            if ( isset($item['regexp']) && preg_match( $item['regexp'], $f, $matches ) ) {
                                                $this->log()->LogDebug( 'adding file matching regexp -'.$f.'-' );
                                                $files[] = $path . '/' . $f;
                                            }
                                        }
                                        closedir($dh);
                                    }
                                }
                            }

                            // do we have preset files for this component? We use
                            // the given regexp to get the component name
                            if ( isset( $item['regexp'] ) ) {
                                preg_match( $item['regexp'], $comp, $match );
                                $this->log()->LogDebug( 'regexp -'.$item['regexp'].'- match', $match );
                                // if there's a preset for this component (for dependencies, defaults etc.)
                                if ( isset($match[2]) ) {
                                    $this->log()->LogDebug( 'looking for preset '.$base_dir.'/'.$item['subdir'].'/presets/'.$match[2].'.preset' );
                                    if ( file_exists( $base_dir.'/'.$item['subdir'].'/presets/'.$match[2].'.preset' ) ) {
                                        $this->log()->LogDebug( 'adding preset' );
                                        $preset .= $this->_addPreset( $base_dir.'/'.$item['subdir'].'/presets/', $match[2] );
                                    }
                                }
                            }

                            // now, if we have preset contents, let's see where
                            // to insert the files
                            if ( $preset ) {
                                if ( count($files) && preg_match ( '#{{ insert_files }}#i', $preset ) ) {
                                    $files    = array_unique( $files );
                                    $insert   = NULL;
                                    foreach ( $files as $filename ) {
                                        $insert .= $this->_addFile( $filename );
                                    }
                                    $this->log()->LogDebug( 'inserting', $insert );
                                    $output  .= "\n"
                                             .  '<!-- position: head -->'
                                             .  "\n"
                                             .  preg_replace (
                                                    '#{{ insert_files }}#i',
                                                    $insert,
                                                    $preset
                                                );
                                    $files = array();
                                }
                                else {
                                    $output = $preset . $output;
                                }
                            }

                            // if we have files now, add them to the current output
                            if ( count($files) ) {
                                $files    = array_unique( $files );
                                $insert   = NULL;
                                foreach ( $files as $filename ) {
                                    $insert .= $this->_addFile( $filename );
                                }
                                $this->log()->LogDebug( 'inserting', $insert );
                                $output .= "\n"
                                        .  '<!-- position: head -->'
                                        .  "\n"
                                        .  $insert;
                            }

                            // look for a preset for that component
                            $find_preset = preg_replace( '#{lib_url}#i', LA_LIB_PATH, $path ) . '/presets/' . $comp . '.preset';
                            if ( is_file( $find_preset ) ) {
                                $parts = pathinfo($find_preset);
                                $output .= "\n"
                                        .  '<!-- position: head 3 -->'
                                        .  "\n"
                                        .  $this->_addPreset( $parts['dirname'], $parts['basename'] );
                            }

                        }   // foreach ( $selected_comps as $comp ) {

                        // ----- do we have core files for this component? -----
                        $core = array();
                        if ( isset( $item['core'] ) ) {
                            $this->log()->LogDebug( 'adding core file(s)', $item['core'] );
                            $core[] = '{LIB_URL}/'.$this->lib->lib_path.'/'.$item['subdir'].'/'.$item['core'];
                        }
                        // prepend core files
                        if ( count($core) ) {
                            foreach( $core as $file ) {
                                $output = $this->_addFile($file) . $output;
                            }
                        }

                    }   // if ( is_array( $selected_comps ) ) {

                }   // foreach( $components as $name => $item ) {

            }   // if ( is_array( $components ) && count($components) > 0 ) {

            // remove blank lines
            $output = preg_replace( "/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/s", "\n", $output );

            return $output;

        }   // end function _handleComponents()

    }

}

?>