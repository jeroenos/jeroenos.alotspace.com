<?php

/*******************************************************************************
    Library Admin
    (c) 2010 Bianka Martinovic - All rights reserved
    http://www.webbird.de/
*******************************************************************************/

/*
    This file initializes the Library Admin for use with Website Baker.
    It is the only file that uses anything from the WB core.
*/

define( 'LA_LIB_PATH', WB_PATH.'/modules'                     );
define( 'LA_LIB_URL' , WB_URL.'/modules'                      );
define( 'LA_IMG_URL' , LA_LIB_URL.'/libraryadmin/images'      );
define( 'LIB_INIT'   , true                                   );
define( 'UPLOAD_TEMP', WB_PATH.'/temp/'                       );
define( 'LA_TPL_PATH', WB_PATH.'/templates'                   );

define( 'LA_PLUGIN_DIR', '/plugins'                           );

// content of the automatically created index.php
define( 'INDEX_CONTENT', '<'.'?'.'php header(\'Location: '.LA_LIB_URL.'\'); ?>' );

global $database;
global $pages;
global $tool;
global $debug;
global $comp_toggle_default;
global $active_lib;

$comp_toggle_default = 'open';
#$comp_toggle_default = 'closed';
$debug = false;
#$debug = true;

if ( $database ) {
    if ( ! defined( 'TEMPLATE' ) ) {
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
}

if ( ! defined( 'TEMPLATE_DIR' ) )
{
    define( 'TEMPLATE_DIR', WB_URL.'/templates/'.TEMPLATE );
}

?>