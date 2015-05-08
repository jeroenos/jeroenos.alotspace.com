<?php

/*******************************************************************************
    Library Admin - Parser
    (c) 2010, 2011 Bianka Martinovic - All rights reserved
    http://www.webbird.de/
*******************************************************************************/

if ( ! class_exists( 'simple_html_dom_node' ) ) {
    include_once dirname(__FILE__).'/simplehtmldom/simple_html_dom.php';
}

if ( ! class_exists( 'DomParser' ) ) {

    class DomParser {

        // accessor to HTML DOM Object
        public  $_html          = NULL;

        private $_linked_css    = array();
        private $_inline_css    = array();
        private $_linked_js     = array();
        private $_inline_js     = array();
        private $_conditionals  = array();
        private $_core          = array();

        private $_debug  = false;
        #private $_debug = true;

        function __construct() {
            $this->_html = new simple_html_dom();
        }

        function __destruct() {
            $this->_html->clear();
        }

        function parseHTML ( $content ) {
            $this->_html->load( $content );
        }   // end function parseHTML ()

        function getHTML( $item ) {
            $found = $this->find( $item, 0 );
            if ( $found ) {
                return $found->innertext;
            }
            return NULL;
        }   // end function getHTML()

        /**
         * accessor to simple_html_dom->find method
         **/
        public function find( $selector, $idx=null ) {
            return $this->_html->find( $selector, $idx );
        }   // end function find()

        /***************************************************************************
         * analyze the page; optionally add the contents of the preset
         *
         * @access public
         * @param  string  $filter
         * @param  object  $preset
         * @param  array   $core_files
         * @param  string  $core_regexp
         *
         * @return string  parsed page
         **************************************************************************/
        public function analyze( $filter = "#.*#", $preset = NULL, $core_files = array(), $core_regex = NULL, $lib_path = NULL ) {
        
            $more_contents = array();

            // *************************************************************
            // analyze the current page object
            // *************************************************************
            // extract JS from the page; remove matches
            foreach ( array( 'head', 'body' ) as $pos ) {
                $h   = $this->find($pos, 0);
                $this->__ExtractCSS( $h, true );
                // leave JS in the body alone
                if ( $pos != 'body' ) {
                	$this->__ExtractLinkedJS( $h, $core_regex, true );
                	$this->__ExtractInlineJS( $h, $core_regex, true );
				}
            }

            // *************************************************************
            // analyze the preset
            // *************************************************************
            if ( is_object( $preset ) ) {
                if ( get_class( $preset ) != "DomParser" ) {
                    echo "Invalid object class: '".get_class( $preset )."'!";
                    die;
                }
                else {
                    foreach ( array( 'head', 'body' ) as $pos ) {
                        $h   = $preset->find($pos, 0);
                        $this->__ExtractCSS( $h, true );
                        $this->__ExtractLinkedJS( $h, $core_regex, true );
                        $this->__ExtractInlineJS( $h, $core_regex, true );
                        $remaining = trim($h->innertext);
                        if ( ! empty( $remaining ) ) {
                            $more_contents[$pos] = $remaining;
                        }
                    }
                }
            }   // if ( is_object( $preset ) )

            // now we have all CSS and JS in our arrays, so re-add them
            $header = array();
            
            // *************************************************************
            // add CSS
            // *************************************************************
            if ( count($this->_linked_css) > 0 ) {
                foreach ( $this->_linked_css as $media => $files ) {
                    $files = array_unique( $files );
                    foreach ( $files as $file ) {
                        $header[] = '<link rel="stylesheet" type="text/css" href="'.$file.'" media="'.$media.'" />';
                        if ( isset( $this->_conditionals[$file] ) ) {
                            $header[] = $this->_conditionals[$file];
                            unset($this->_conditionals[$file]);
                        }
                    }
                }
            }
            if ( count($this->_inline_css) > 0 ) {
                foreach ( $this->_inline_css as $content ) {
                    $header[] = '<style type="text/css">'.$content.'</style>';
                }
            }

            // *************************************************************
            // add core files
            // *************************************************************
            if ( count($core_files) > 0 ) {
                foreach( $core_files as $file ) {
                    if (
                          ! in_array( $file, $this->_core )
                       && ! in_array( LA_LIB_URL.'/'.$file, $this->_core )
                    ) {
                        $this->_core[] = LA_LIB_URL.'/'.$file;
                    }
                }
            }
            if ( count($this->_core) ) {
                $this->_core = array_unique($this->_core);
                foreach( $this->_core as $item ) {
                    $header[] = '<script type="text/javascript" src="'.$item.'"></script>';
                }
            }
            
            // *************************************************************
            // add linked js
            // *************************************************************
            if ( isset($this->_linked_js['head']) && count($this->_linked_js['head']) > 0 ) {
                $this->_linked_js['head'] = array_unique($this->_linked_js['head']);
                foreach( $this->_linked_js['head'] as $item ) {
                    $header[] = '<script type="text/javascript" src="'.$item.'"></script>';
                }
            }
            
            // *************************************************************
            // add inline JavaScript
            // *************************************************************
            if ( count( $this->_inline_js ) > 0 && isset($this->_inline_js['head']) && count( $this->_inline_js['head'] ) > 0 ) {
                $this->_inline_js['head'] = array_unique( $this->_inline_js['head'] );
                $header[] = '<script type="text/javascript">';
                $header[] = implode( "\n    ", $this->_inline_js['head'] );
                $header[] = '</script>';
            }

            // *************************************************************
            // add remaining preset contents (if any)
            // *************************************************************
            if ( count( $more_contents ) ) {
                if ( isset( $more_contents['head'] ) ) {
                    $header[] = $more_contents['head'];
                }
            }

            // set the new header; be compatible to jQueryAdmin
            $new_header = str_ireplace(
                              array( '{WB_URL}/modules', 'jqueryadmin', '/modules/../modules/', '/modules/..//modules/' ),
                              array( '{LIB_URL}'       , $lib_path    , '/modules/'           , '/modules/'             ),
                              implode( "\n  ", $header )
                          );
                          
            // this is for jQuery only
            $new_header = preg_replace( '#\$\(document\)\.ready\(\s*?function\s*\(\s*?\)#i', 'jQuery(document).ready(function($)', $new_header );
            
            $head = $this->find( 'head', 0 );
            if ( is_object($head) ) {
                $head->innertext
                    .= "\n  "
                    .  $new_header
                    .  "\n\n";
            }

            $body = $this->find('body',0);

            // *************************************************************
            // add linked JS to the body
            // *************************************************************
            if ( isset($this->_linked_js['body']) && count($this->_linked_js['body']) > 0 ) {
                $this->_linked_js['body'] = array_unique($this->_linked_js['body']);
                foreach( $this->_linked_js['body'] as $item ) {
                    $body->innertext .= '<script type="text/javascript" src="'.$item.'"></script>';
                }
            }
            
            // *************************************************************
            // add inline JS to the body
            // *************************************************************
            if ( isset($this->_inline_js['body']) && count( $this->_inline_js['body'] ) > 0 ) {
                $add_to_body
                    = str_ireplace(
                          array( '{WB_URL}/modules', 'jqueryadmin' ),
                          array( '{LIB_URL}'       , $lib_path     ),
                          implode( "\n    ", $this->_inline_js['body'] )
                      );
                $body->innertext .= '<script type="text/javascript">'
                                 .  $add_to_body
                                 .  '</script>';
            }
            if ( count( $more_contents ) ) {
                if ( isset( $more_contents['body'] ) ) {
                    $body->innertext .= $more_contents['body'];
                }
            }
            
            $content = $this->_html->save();
            
            // old paths
            $content = str_ireplace(
                         array(
                             'jquery-1.4.2',
                             'jquery-ui-1.8',
                         ),
                         array(
                             'jquery-core',
                             'jquery-ui',
                         ),
                         $content
                     );
                     
			// remove custom markup
			$content = preg_replace( "/<!--\s*(end\s)?custom\s*-->/i", '', $content );

            // remove empty lines
            $content = preg_replace( "/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/s", "\n", $content );

            return $content;

        }   // end function analyze

        /**
         *
         *
         *
         *
         **/
        public function getLinkedCSS() {
            return $this->_linked_css;
        }   // end function getLinkedCSS()
        
        public function getCSS() {
            return $this->_inline_css;
        }   // end function getCSS()

        /**
         *
         *
         *
         *
         **/
        public function getLinkedJS() {
            return $this->_linked_js;
        }   // end function getLinkedJS()
        
        /**
         *
         **/
        public function getJS() {
            return $this->_inline_js;
        }

        // *************************************************************************
        // find CSS; push to internal arrays
        // *************************************************************************
        private function __ExtractCSS( $object, $remove = false ) {

            if ( is_object( $object ) ) {

                // find linked (external) css
                $found = $object->find( 'link' );
                foreach ( $found as $obj ) {
                    if ( $obj->rel == 'stylesheet' ) {
                        $src   = $obj->href;
                        $media = ( isset($obj->media) ? $obj->media : 'screen' );
                        if ( ! isset($this->_linked_css[ $src ]) ) {
                            $this->_linked_css[$media][] = $src;
                        }
                        if ( $remove ) {
                            $obj->outertext = '';
                        }
                        $next = $obj->next_sibling();
                        if ( is_object($next) && $next->nodetype === HDOM_TYPE_COMMENT && preg_match( '/\[if\s/i', $next->outertext ) ) {
                            $this->_conditionals[$src] = $next->outertext;
                            $next->outertext = '';
                        }
                    }
                }

                // find inline CSS
                $found = $object->find( 'style' );
                foreach ( $found as $obj ) {
                    if ( $obj->tag == 'style' ) {
                        $this->_inline_css[] = $obj->outertext;
                        if ( $remove ) {
                            $obj->outertext = '';
                        }
                        $next = $obj->next_sibling();
                        if ( is_object($next) && $next->nodetype === HDOM_TYPE_COMMENT && preg_match( '/\[if\s/i', $next->outertext ) ) {
                            $this->_conditionals[$src] = $next->outertext;
                            $next->outertext = '';
                        }
                    }
                }

            }

        }   // end function __ExtractCSS()

        // *************************************************************************
        // find linked JavaScript (i.e. <script src="...">)
        // *************************************************************************
        private function __ExtractLinkedJS( $object, $core_regex, $remove = false, $filter = "#.*#" ) {

            if ( ! is_object( $object ) ) { return array(); }

            $js      = array();
            $head_js = array();
            $pos     = $object->tag;
            $found   = $object->find( 'script' );

            foreach ( $found as $obj ) {

                if ( $this->_debug ) {
                    echo "current script object outertext:<br />";
                    echo "<textarea cols=\"100\" rows=\"20\" style=\"width: 100%;\">";
                    print_r( $obj->outertext );
                    echo "</textarea>";
                }

                // no source (can be inline JS)
                if ( ! isset( $obj->src ) ) {
                    if ( $this->_debug ) {
                        echo "no src attribute, skipping<br />";
                    }
                    continue;
                }

                $src = $obj->src;

                // find core files
                if ( $core_regex && preg_match( $core_regex, $src, $cmatch ) ) {
                    if ( $this->_debug ) {
                        echo "found core script:<br /><textarea cols=\"100\" rows=\"20\" style=\"width: 100%;\">$core_regex\n";
                        print_r( $cmatch );
                        echo "</textarea>";
                    }
                    if ( ! in_array( $src, $this->_core ) ) {
                        $this->_core[] = $src;
                    }
                    if ( $remove ) {
                        $obj->outertext = '';
                    }
                    continue;
                }

                // skip files that don't match given filter
                if ( $filter && ! preg_match( $filter, $src ) ) {
                    if ( $this->_debug ) {
                        echo "src does not match filter [$filter], skipping<br />";
                    }
                    continue;
                }

                $file = basename( $src );
                if ( ! isset( $this->_linked_js[ $file ] ) ) {
                    $this->_linked_js[$pos][$file] = $src;
                }

                if ( $remove ) {
                    $obj->outertext = '';
                }
            }

        }   // end function __ExtractLinkedJS()

        // *************************************************************************
        // find inline JavaScript (<script>...code...</script>)
        // *************************************************************************
        private function __ExtractInlineJS( $object, $core_regex, $remove = false ) {

            if ( ! is_object( $object ) ) { return array(); }

            $pos   = $object->tag;
            $found = $object->find( 'script' );
            
            foreach ( $found as $obj ) {

                if ( isset( $obj->src ) ) {
                    continue;
                }

                $this->_inline_js[$pos][] = $obj->innertext;

                if ( $remove ) {
                    $obj->outertext = '';
                }

            }

        }   // end function __ExtractInlineJS()

    }

}