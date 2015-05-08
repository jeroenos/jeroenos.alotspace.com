<?php

/*******************************************************************************
    Library Admin
    (c) 2010 Bianka Martinovic - All rights reserved
    http://www.webbird.de/
*******************************************************************************/

include_once dirname(__FILE__).'/../library_info.php';
include_once dirname(__FILE__).'/../include.php';
include_once dirname(__FILE__).'/class.LibraryUtils.php';

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

if ( ! class_exists('LABackend') ) {

    class LABackend extends wbBase {

        // ----- Debugging -----
        protected $debugLevel     = KLOGGER::OFF;
        #protected $debugLevel     = KLOGGER::DEBUG;
        protected $lib_info;
        protected $tpl;
        
        private static $loaded  = array();
        private $scripts = array();
        private $inline  = array();

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
            $this->tpl = new wbTemplate(
                array(
//                    'debug' => true,
                    'path'  => dirname(__FILE__).'/../templates',
                )
            );
        }   // end function __construct()

        /**
         * include a LibraryAdmin preset in the backend
         *
         * @access public
         * @param  array  $options
         *
         **/
        public function loadPreset( $options = array() ) {

            global $css, $js, $inline_js;
            
            $utils = new LibraryUtils();

            if ( !isset($options['module']) || $options['module'] == '' ) {
                $options['module'] = 'libraryadmin';
            }
            if ( !isset($options['preset']) || $options['preset'] == '' ) {
                $options['preset'] = 'backend';
            }

            if ( isset( $options['lib'] ) && ! empty( $options['lib'] ) ) {
                $lh   = $utils->loadLibrary( $options['lib'] );
            }
            else {
                $lh   = $utils->loadLibrary( 'libraryadmin' );
            }
            $lib_path = $lh->lib_path;

            if ( empty( $options['plugin'] ) ) {
                $preset_content = __includePreset( $options['module'], $lh, $options['preset'], true, ( isset($options['subdir']) ? $options['subdir'] : NULL ) );
            }
            else {
                $preset_content = __includePlugin( $options['plugin'] );
            }

            // do not load jquery core in LEPTON (already loaded there)
            $corefiles = $lh->core_files();
            if ( defined('LEPTON_GUID') && $lib = 'lib_jquery' ) {
                $corefiles = NULL;
            }
            // do not load jquery core in WB 2.8.2
            if ( defined('WB_VERSION') && WB_VERSION >= "2.8.2" && $lib = 'lib_jquery' ) {
				$corefiles = NULL;
			}
            $data   = __parsePresetContent( $lh->lib_path, NULL, $preset_content, $corefiles, true );

            if ( count($data) ) {
				// do we have core files?
				if ( is_array($corefiles) && count($corefiles) ) {
                    foreach( $corefiles as $ignore => $file ) {
                        $file = $this->__sanitize( $file, $lib_path );
                        if ( !isset(self::$loaded[$file]) ) {
                            $this->scripts[] = '.script("'.$file.'").wait()';
                            self::$loaded[$file] = 1;
                        }
                    }
                }
                // do we have header files?
                if ( isset( $data['head'] ) ) {
                	// insert JS to head
                    if ( isset($js['head']) && is_array($js['head']) && count($js['head']) ) {
                        foreach( $js['head'] as $ignore => $file ) {
                            $file = $this->__sanitize( $file, $lib_path );
                            if ( !isset(self::$loaded[$file]) ) {
                                $this->scripts[] = '.script("'.$file.'").wait()';
                                self::$loaded[$file] = 1;
                            }
                        }
                    }
                    // insert CSS into head
                    if ( is_array($css) && count($css) > 0 ) {
                        foreach ( $css as $media => $files ) {
                            foreach( $files as $file ) {
                                $file = $this->__sanitize( $file, $lib_path );
                                if ( !isset(self::$loaded[$file]) ) {
                                    $this->inline[] = '
  if ( filesadded.indexOf("['.$file.']") == -1 ) {
    var fileref=document.createElement("link")
    fileref.setAttribute("rel", "stylesheet");
    fileref.setAttribute("type", "text/css");
    fileref.setAttribute("media", "'.$media.'");
    fileref.setAttribute("href", "'.$file.'");
    if (typeof fileref!="undefined") {
        document.getElementsByTagName("head")[0].appendChild(fileref);
        filesadded+="['.$file.']";
    }
  }'."\n";
                                    self::$loaded[$file] = 1;
                                }
                            }
                        }
                    }   // if ( is_array($css) && count($css) > 0 )

                }
                // add body js
                if ( isset($js['body']) && is_array($js['body']) && count($js['body']) ) {
                    foreach( $js['body'] as $ignore => $file ) {
                        $file = $this->__sanitize( $file, $lib_path );
                        if ( !isset(self::$loaded[$file]) ) {
                            $this->scripts[] = '.script("'.$file.'").wait()';
                            self::$loaded[$file] = 1;
                        }
                    }
                }
                // add inline js
                if ( isset( $inline_js['head'] ) ) {
                    $this->inline[] = implode( "\n", $inline_js['head'] );
                }
                if ( isset( $inline_js['body'] ) ) {
                    $this->inline[] = implode( "\n", $inline_js['body'] );
                }

            }

		}   // end function loadPreset
		
		/**
		 *
		 *
		 *
		 *
		 **/
		public function printPreset() {
			$this->tpl->setTemplate('labjsloader.tpl');
			$data = array();
		    if ( count( $this->scripts ) ) {
				$data['scripts'] = implode( "\n          ", $this->scripts );
			}
			if ( count( $this->inline ) ) {
				$data['inline']  = implode( "\n          ", $this->inline  );
			}
			$this->scripts = array();
			$this->inline  = array();
			$output   = $this->tpl->parseTemplate( $data );
			$checksum = md5($output);
			$fileh    = fopen( dirname(__FILE__).'/../presets/tmp_'.$checksum.'.js', 'w' );
			fwrite( $fileh, $output );
			fclose( $fileh );
			echo '<script type="text/javascript" src="'.$this->sanitizeURI(LA_LIB_URL.'/libraryadmin/presets/tmp_'.$checksum.'.js').'"></script>';
			// remove old files
			$dir  = dirname(__FILE__).'/../presets/';
			$dirh = opendir($dir);
			if ( $dirh ) {
			    while( ( $file = readdir($dirh) ) !== false ) {
			        if ( ! preg_match( '/^tmp_.*\.js$/', $file ) ) {
			            continue;
					}
					if ( filemtime($dir.$file) < ( time() - 60 * 60 ) ) { # 1 hour
					    unlink($dir.$file);
					}
			    }
			}
        }   // end function printPreset()

        /**
		 *
		 *
		 *
		 *
		 **/
        private function __sanitize( $file, $lib_path ) {
            // set the new header; be compatible to jQueryAdmin
            return str_ireplace(
                array( '{WB_URL}/modules', 'jqueryadmin', '/modules/../modules/', '/modules/..//modules/' ),
                array( '{LIB_URL}'       , $lib_path    , '/modules/'           , '/modules/'             ),
                $file
            );
        }
        
    }
}

?>
