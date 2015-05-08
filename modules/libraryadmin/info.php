<?php

$module_directory     = 'libraryadmin';
$module_name          = 'LibraryAdmin';
$module_function      = 'tool';
$module_version       = '1.14';
$module_platform      = '2.8.x';
$module_author        = 'Bianka Martinovic';
$module_license       = '(c) 2011 Bianka Martinovic. All rights reserved.';
$module_description   = 'Include nearly any kind of JavaScript and/or CSS Library into your pages, using an easy-to-use backend';
$module_guid          = 'B195B52D-17F7-45F4-A777-97DE6A31D272';

/*

    Release History
    
    1.0 - Initial Release
    
    1.1 - fixed occurance of 'jQueryAdmin' in a comment
        - added file size check to avoid warning on empty preset
        - fixed path to formbuilder.css (it's now css/default/skin.css)
        - fixed default use of 'localhost' for DB connection
        - fixed potential wrong component selection when editing preset (lib_jquery -> UI Theme, for example)
        
    1.2 - Fix: Edit preset failed for module folders (wrong path)
        - New: Toggle state of module folders now stored in a cookie
        - Removed obsolete function editPreset()
        - openBug: Wrong components marked when editing preset configuration
        
    1.3 - Fix: Under some circumstances, LA loaded both custom.preset and
          loader.preset from a plugin's directory

    1.4 - Added 'subdir' param to droplet LibInclude
        - do not load jQuery Core in the backend when run on LEPTON (already in place)
        - completely new method to load JS in the backend (fixing IE issues)
        - updated REDIPS (assets/plugins/modaldbox) to new version 1.5.0
        - updated CodeMirror to new version 2.12
        - Fix: Wrong components marked when editing preset configuration

    1.5 - Fixed some issues with backend presets
    
    1.6 - Added some backward compatibility for jQueryAdmin Plugins with backend presets (convert paths)
        - Fixed some issues with backend presets (forgot to load inline JS in head...)
        
    1.7 - Fixed core files path for backend presets
        - Fixed save path for module presets
        - Upgraded Lytebox to v4.0
        
	1.7a - Fix for core files not loaded on top in backend
	
	1.8  - jQuery core no longer loaded in WB 2.8.2
	
	1.9  - removed frontend.css
		 - remove <!-- [end ]custom --> from parse result
		 - recognize conditional comments and keep them in place
		 - plugins folder moved up from assets subdir
		 - fix: show readme in Lytebox
		 - fix: Confirmation did not work when clicking on delete icon
		 - fix: don't touch javascript in the body
		 - fix: module version empty on [Info] tab
		 - new: ability to delete a plugin (automatically creates a backup)
		 - new: ability to export a plugin
		 - new: list backup files (=exported plugins)
		 - new: Uploaded plugins are checked for a file with 'jquery' as name part;
		   this may help to upload plugins into the right tab (=lib)
		 - new: Plugins may set a var $lib_needed in the config.php to require
		   a lib; example:
    	   $lib_needed = 'lib_jquery';
    	   
	1.10 - moved from head.js to LABjs; head.js is no longer maintained
		   affects backend presets only
		 - JS from backend presets is now stored in temp. JS (experimental)
		 - new: active plugins/components are 'highlighted' (shown bold)
		 - fix: presets in module folders not saved (wrong path)
		 - fix: page number not overtaken from select box (double id preset_name)
		 
	1.11 - added icon.png (for use with Lepton 2.x)
		 - renamed css/backend.css to css/admin.css (as Lepton2 loads css/backend.css automatically)
		 - added css/backend.css for Lepton2 to fix some layout issues with new Backend Theme
		 - updated Lytebox to v5.4
		 
	1.12 - fix for LEPTON v2.0 (no more table 'mod_droplets')
	
	1.13 - fix: conditional comments wrapping JS were removed (CSS was ok)
	
	1.14 - fix: preserve custom code also if all components are removed

*/

?>