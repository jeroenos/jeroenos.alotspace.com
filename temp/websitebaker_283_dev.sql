-- phpMyAdmin SQL Dump
-- version 4.3.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 05, 2015 at 05:05 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `websitebaker_283_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `wb_addons`
--

CREATE TABLE IF NOT EXISTS `wb_addons` (
  `addon_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `directory` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `function` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `platform` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `license` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_addons`
--

INSERT INTO `wb_addons` (`addon_id`, `type`, `directory`, `name`, `description`, `function`, `version`, `platform`, `author`, `license`) VALUES
(108, 'module', 'form', 'Form', 'This module allows you to create customised online forms, such as a feedback form. Thank-you to Rudolph Lartey who help enhance this module, providing code for extra field types, etc.', 'page', '2.8.4', '2.8.x', 'Ryan Djurovich & Rudolph Lartey - additions John Maats - PCWacht', 'GNU General Public License'),
(106, 'module', 'captcha_control', 'Captcha and Advanced-Spam-Protection (ASP) Control', 'Admin-Tool to control CAPTCHA and ASP', 'tool', '1.2.0', '2.7 | 2.8.x', 'Thomas Hornik (thorn)', 'GNU General Public License'),
(107, 'module', 'jsadmin', 'Javascript Admin', 'This module adds Javascript functionality to the Website Baker Admin to improve some of the UI interactions. Uses the YahooUI library.', 'tool', '1.4.0', '2.7 | 2.8.x', 'Stepan Riha, Swen Uth', 'BSD License'),
(105, 'module', 'wysiwyg', 'WYSIWYG', 'This module allows you to edit the contents of a page using a graphical editor', 'page', '2.9.0', '2.8.2', 'Ryan Djurovich', 'GNU General Public License'),
(138, 'module', 'newsreader', 'Newsreader', 'This module handels XML and RDF/RSS (0.9x, 1.0, 2.0) newsfeeds.', 'page', '0.1.6', '2.6.x', 'Robert Hase, adm_prg[AT]muc-net.de, Matthias Gallas, Dietrich Roland Pehlke', 'GNU General Public License'),
(104, 'module', 'menu_link', 'Menu Link', 'This module allows you to insert a link into the menu.', 'page', '2.8', '2.8.x', 'Ryan Djurovich, thorn', 'GNU General Public License'),
(139, 'module', 'faqbaker', 'F.A.Q. Baker', 'A Frequently Asked Questions manager.', 'page', '1.46', '2.6.x', 'Craig Rodway, Rob Smith, Matthias Gallas, ploc, thorn, doc', 'GNU General Public License'),
(102, 'module', 'code', 'Code', 'This module allows you to execute PHP commands (limit access to users you trust!!)', 'page', '2.8.3', '2.7 | 2.8.x', 'Ryan Djurovich', 'GNU General Public License'),
(101, 'module', 'output_filter', 'Frontend Output Filter', 'This module allows to filter the output before displaying it on the frontend. Support for filtering mailto links and mail addresses in strings.', 'tool', '0.4', '2.8.3', 'Christian Sommer(doc), WB-Project, Werner v.d. Decken(DarkViper)', 'GNU General Public License'),
(100, 'module', 'fckeditor', 'FCKeditor', 'This module allows you to edit the contents of a page using <a href="http://www.fckeditor.net/" target="_blank">FCKeditor v2.6.6</a>.', 'wysiwyg', '2.9.7.1', '2.7 | 2.8.x', 'Christian Sommer, P. Widlund, S. Braunewell, M. Gallas, Wouldlouper, Aldus, Luisehahne', 'GNU General Public License'),
(115, 'template', 'wb_theme', 'WB Theme', 'Default backend theme for Website Baker 2.8.', 'theme', '2.8.1', '2.8.3', 'Johannes Tassilo Gruber', '<a href="http://www.gnu.org/licenses/gpl.html">GNU General Public License</a>'),
(114, 'template', 'argos_theme', 'Argos Theme', 'Enhanced backend theme for Website Baker 2.8.', 'theme', '1.7.0', '2.8.3', 'Jurgen Nijhuis (Argos Media) & Ruud Eisinga', '<a href="http://www.gnu.org/licenses/gpl.html">GNU General Public License</a>'),
(113, 'template', 'allcss', 'All CSS', 'Default template for Website Baker. This template is designed with one goal in mind: to completely control layout with CSS. In case you were wondering, that is where the name came from.', 'template', '2.71', '2.7', 'Ryan Djurovich, C. Sommer', '<a href="http://www.gnu.org/licenses/gpl.html">GNU General Public License</a>'),
(112, 'template', 'blank', 'Blank Template', 'This template is for use on page where you do not want anything wrapping the content.', 'template', '2.70', '2.7', 'Ryan Djurovich, C. Sommer', '<a href="http://www.gnu.org/licenses/gpl.html">GNU General Public License</a>'),
(99, 'module', 'SecureFormSwitcher', 'SecureForm Switcher', 'This module switch between the <strong>SingleTab SecureForm</strong> and <strong>MultiTab SecureForm</strong>.', 'tool', '0.6.6', '2.8.2', 'D. W&ouml;llbrrink (Luisehahne),  Florian Meerwinck (instantflorian), Michael Tentschert (test&ouml;r)', 'GNU General Public License'),
(110, 'template', 'round', 'Round', 'Default template for Website Baker. Simular to the box template, but with rounded edges.', 'template', '2.71', '2.7', 'Ryan Djurovich, C. Sommer', '<a href="http://www.gnu.org/licenses/gpl.html">GNU General Public License</a>'),
(111, 'template', 'response-blue', 'response-blue', 'Responsive Webdesign: For use with all modern browsers', 'template', '0.50', '2.7.x', 'Design by Chio Maisriml, www.beesign.com', 'Creative Commons Attribution Licence 3.0. You can modify and use this template, but read licence.txt first'),
(98, 'module', 'show_menu2', 'show_menu2', 'A code snippet for the Website Baker CMS providing a complete replacement for the builtin menu functions. See <a href="http://code.jellycan.com/show_menu2/" target="_blank">http://code.jellycan.com/show_menu2/</a> for details or view the <a href="http://localhost/wb/modules/show_menu2/README.en.txt" target="_blank">readme</a> file.', 'snippet', '4.9.6', '2.7 | 2.8.2', 'Brodie Thiesfield', 'GNU General Public License'),
(96, 'module', 'libraryadmin', 'LibraryAdmin', 'Include nearly any kind of JavaScript and/or CSS Library into your pages, using an easy-to-use backend', 'tool', '1.14', '2.8.x', 'Bianka Martinovic', '(c) 2011 Bianka Martinovic. All rights reserved.'),
(97, 'module', 'news', 'News', 'This page type is designed for making a news page.', 'page', '3.5.6', '2.8.2', 'Ryan Djurovich, Rob Smith, Werner v.d.Decken', 'GNU General Public License'),
(95, 'module', 'droplets', 'Droplets', 'This tool allows you to manage your local Droplets.', 'tool', '1.2.0', '2.8.x', 'Ruud and pcwacht', 'GNU General Public License'),
(94, 'module', 'addon_monitor', 'AddonMonitor', 'This AdminTool''s entire purpose is to give you a handy way to overview all the installed add-ons on your WebsiteBaker CMS System. You will be able to see whether or not your installed modules are in use and where.', 'tool', '0.5.2', '2.8.x', 'Christian M. Stefan (Stefek)', 'GNU/GPL v.2'),
(92, 'module', 'wrapper', 'Wrapper', 'This module allows you to wrap your site around another using an inline frame', 'page', '2.8.3', '2.7 | 2.8.x', 'Ryan Djurovich', 'GNU General Public License'),
(93, 'module', 'wblib', 'wblib', 'WebBird''s Base Libraries - Modules bundle useful for module development, including FormBuilder, Template Engine, Form Data Validator, SQL Abstraction, and more', 'library', '0.87', '2.8', 'Bianka Martinovic (http://www.webbird.de/)', 'GNU General Public License'),
(109, 'module', 'cwsoft-addon-file-editor', 'cwsoft-addon-file-editor', 'The cwsoft-addon-file-editor allows you to edit text- and image files of installed Add-ons via the backend. For details see <a href="https://github.com/cwsoft/websitebaker-addon-file-editor#readme">GitHub</a>.', 'tool', '2.7.6', '2.8.x', 'cwsoft (http://cwsoft.de)', '<a href="http://www.gnu.org/licenses/gpl-3.0.html">GNU General Public Licencse (GPL) v3.0</a>'),
(116, 'language', 'DA', 'Dansk', '', '', '2.8', '2.8.x', 'Allan Christensen', 'GNU General Public License'),
(117, 'language', 'DE', 'Deutsch', '', '', '3.0', '2.9', 'Stefan Braunewell, Matthias Gallas', 'GNU General Public License'),
(118, 'language', 'BG', 'Bulgarian', '', '', '2.8', '2.8.x', 'Hristo Benev(&#1061;&#1088;&#1080;&#1089;&#1090;&#1086; &#1041;&#1077;&#1085;&#1077;&#1074;)', 'GNU General Public License'),
(119, 'language', 'IT', 'Italiano', '', '', '2.8', '2.8.x', 'Roberto Rossi', 'GNU General Public License'),
(120, 'language', 'ET', 'Eesti', '', '', '2.8', '2.8.x', 'Heiko H&auml;ng', 'GNU General Public License'),
(121, 'language', 'EN', 'English', '', '', '2.8', '2.8.x', 'Ryan Djurovich, Christian Sommer', 'GNU General Public License'),
(122, 'language', 'SE', 'Svenska', '', '', '2.8', '2.8.x', 'Markus Eriksson, Peppe Bergqvist', 'GNU General Public License'),
(123, 'language', 'HU', 'Magyar', '', '', '2.8', '2.8.x', 'Zsolt + Robert', 'GNU General Public License'),
(124, 'language', 'HR', 'Hrvatski', '', '', '2.8', '2.8.x', 'Vedran Presecki', 'GNU General Public License'),
(125, 'language', 'FR', 'Fran&ccedil;ais', '', '', '2.8', '2.8.x', 'Marin Susac', 'GNU General Public License'),
(126, 'language', 'FI', 'Suomi', '', '', '2.8', '2.8.x', 'Jontse', 'GNU General Public License'),
(127, 'language', 'CA', 'Catalan', '', '', '2.8', '2.8.x', 'Carles Escrig (simkin)', 'GNU General Public License'),
(128, 'language', 'ES', 'Spanish', '', '', '2.8', '2.8.x', 'Samuel Mateo, Jr. | samuelmateo.com', 'GNU General Public License'),
(129, 'language', 'NL', 'Nederlands', '', '', '2.8', '2.8.x', 'Bramus, CodeALot, Luckyluke, Argos', 'GNU General Public License'),
(130, 'language', 'TR', 'T&uuml;rk', '', '', '2.8', '2.8.x', 'Atakan KO&Ccedil;', 'GNU General Public License'),
(131, 'language', 'PL', 'Polski', '', '', '2.8', '2.8.x', 'Marek Stepien;', 'GNU General Public License'),
(132, 'language', 'LV', 'Latvie&scaron;u', '', '', '2.8', '2.8.x', 'Kri&scaron;janis Rijnieks', 'GNU General Public License'),
(133, 'language', 'CS', '&#268;e&scaron;tina', '', '', '2.8', '2.8.x', 'WebStep, s.r.o.', 'GNU General Public License'),
(134, 'language', 'PT', 'Portuguese (Brazil)', '', '', '2.8', '2.8.x', 'Daniel Neto', 'GNU General Public License'),
(135, 'language', 'SK', 'Slovensky', '', '', '2.8', '2.8.x', 'Michal Kurtulik - YONIX.SK', 'GNU General Public License'),
(136, 'language', 'NO', 'Norsk', '', '', '2.8', '2.8.x', 'Odd Egil Hansen (oeh)', 'GNU General Public License'),
(137, 'language', 'RU', 'Russian', '', '', '2.8', '2.8.x', 'Kirill Karakulko (kirill@nadosoft.com)', 'GNU General Public License');

-- --------------------------------------------------------

--
-- Table structure for table `wb_groups`
--

CREATE TABLE IF NOT EXISTS `wb_groups` (
  `group_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `system_permissions` text COLLATE utf8_unicode_ci NOT NULL,
  `module_permissions` text COLLATE utf8_unicode_ci NOT NULL,
  `template_permissions` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_groups`
--

INSERT INTO `wb_groups` (`group_id`, `name`, `system_permissions`, `module_permissions`, `template_permissions`) VALUES
(1, 'Administrators', 'pages,pages_view,pages_add,pages_add_l0,pages_settings,pages_modify,pages_intro,pages_delete,media,media_view,media_upload,media_rename,media_delete,media_create,addons,modules,modules_view,modules_install,modules_uninstall,templates,templates_view,templates_install,templates_uninstall,languages,languages_view,languages_install,languages_uninstall,settings,settings_basic,settings_advanced,access,users,users_view,users_add,users_modify,users_delete,groups,groups_view,groups_add,groups_modify,groups_delete,admintools', '', ''),
(2, '\\web redacteuren', 'pages,pages_view,pages_add,pages_add_l0,pages_settings,pages_modify,pages_intro,pages_delete,media,media_view,media_upload,media_rename,media_delete,media_create,addons,languages,languages_view,languages_install,languages_uninstall', 'wblib,addon_monitor,droplets,libraryadmin,show_menu2,SecureFormSwitcher,fckeditor,output_filter,captcha_control,jsadmin,cwsoft-addon-file-editor', '');

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_captcha_control`
--

CREATE TABLE IF NOT EXISTS `wb_mod_captcha_control` (
  `enabled_captcha` int(11) NOT NULL DEFAULT '1',
  `enabled_asp` int(11) NOT NULL DEFAULT '1',
  `captcha_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'calc_text',
  `asp_session_min_age` int(11) NOT NULL DEFAULT '20',
  `asp_view_min_age` int(11) NOT NULL DEFAULT '10',
  `asp_input_min_age` int(11) NOT NULL DEFAULT '5',
  `ct_text` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_mod_captcha_control`
--

INSERT INTO `wb_mod_captcha_control` (`enabled_captcha`, `enabled_asp`, `captcha_type`, `asp_session_min_age`, `asp_view_min_age`, `asp_input_min_age`, `ct_text`) VALUES
(1, 1, 'calc_ttf_image', 20, 10, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_code`
--

CREATE TABLE IF NOT EXISTS `wb_mod_code` (
  `section_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_mod_code`
--

INSERT INTO `wb_mod_code` (`section_id`, `page_id`, `content`) VALUES
(0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_cwsoft-addon-file-editor`
--

CREATE TABLE IF NOT EXISTS `wb_mod_cwsoft-addon-file-editor` (
  `id` int(11) NOT NULL,
  `ftp_enabled` int(1) NOT NULL,
  `ftp_server` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ftp_user` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ftp_password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ftp_port` int(11) NOT NULL,
  `ftp_start_dir` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wb_mod_cwsoft-addon-file-editor`
--

INSERT INTO `wb_mod_cwsoft-addon-file-editor` (`id`, `ftp_enabled`, `ftp_server`, `ftp_user`, `ftp_password`, `ftp_port`, `ftp_start_dir`) VALUES
(1, 0, '-', '-', '', 21, '/');

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_droplets`
--

CREATE TABLE IF NOT EXISTS `wb_mod_droplets` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `modified_when` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `admin_edit` int(11) NOT NULL DEFAULT '0',
  `admin_view` int(11) NOT NULL DEFAULT '0',
  `show_wysiwyg` int(11) NOT NULL DEFAULT '0',
  `comments` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_mod_droplets`
--

INSERT INTO `wb_mod_droplets` (`id`, `name`, `code`, `description`, `modified_when`, `modified_by`, `active`, `admin_edit`, `admin_view`, `show_wysiwyg`, `comments`) VALUES
(1, 'EmailFilter', 'return '''';', 'Emailfiltering on your output - dummy Droplet', 1430733926, 1, 1, 0, 0, 0, 'usage:  [[EmailFilter]]'),
(2, 'LoginBox', '//:Absolute or relative url possible\n//:Remember to enable frontend login in your website settings.\n\n	global $wb,$page_id,$TEXT, $MENU, $HEADING;\n\n	$return_value = ''<div class="login-box">''."\\n";\n	$return_admin = '' '';\n	// Return a system permission\n	function get_permission($name, $type = ''system'')\n	{\n	   	global $wb;\n	// Append to permission type\n		$type .= ''_permissions'';\n		// Check if we have a section to check for\n		if($name == ''start'') {\n			return true;\n		} else {\n			// Set system permissions var\n			$system_permissions = $wb->get_session(''SYSTEM_PERMISSIONS'');\n			// Set module permissions var\n			$module_permissions = $wb->get_session(''MODULE_PERMISSIONS'');\n			// Set template permissions var\n			$template_permissions = $wb->get_session(''TEMPLATE_PERMISSIONS'');\n			// Return true if system perm = 1\n			if (isset($$type) && is_array($$type) && is_numeric(array_search($name, $$type))) {\n				if($type == ''system_permissions'') {\n					return true;\n				} else {\n					return false;\n				}\n			} else {\n				if($type == ''system_permissions'') {\n					return false;\n				} else {\n					return true;\n				}\n			}\n		}\n	}\n\n	function get_page_permission($page, $action=''admin'') {\n		if ($action!=''viewing''){ $action=''admin'';}\n		$action_groups=$action.''_groups'';\n		$action_users=$action.''_users'';\n		if (is_array($page)) {\n				$groups=$page[$action_groups];\n				$users=$page[$action_users];\n		} else {\n			global $database,$wb;\n			$results = $database->query("SELECT $action_groups,$action_users FROM ".TABLE_PREFIX."pages WHERE page_id = ''$page''");\n			$result = $results->fetchRow();\n			$groups = explode('','', str_replace(''_'', '''', $result[$action_groups]));\n			$users = explode('','', str_replace(''_'', '''', $result[$action_users]));\n		}\n\n		$in_group = FALSE;\n		foreach($wb->get_groups_id() as $cur_gid){\n		    if (in_array($cur_gid, $groups)) {\n		        $in_group = TRUE;\n		    }\n		}\n		if((!$in_group) AND !is_numeric(array_search($wb->get_user_id(), $users))) {\n			return false;\n		}\n		return true;\n	}\n\n// Get redirect\n	$redirect_url = ((isset($_SESSION[''HTTP_REFERER'']) && $_SESSION[''HTTP_REFERER''] != '''') ? $_SESSION[''HTTP_REFERER''] : WB_URL );\n   	$redirect_url = (isset($redirect) && ($redirect!='''') ? $redirect : $redirect_url);\n\n	if ( ( FRONTEND_LOGIN == ''enabled'') &&\n		    ( VISIBILITY != ''private'') &&\n		        ( $wb->get_session(''USER_ID'') == '''')  )\n	{\n		$return_value .= ''<form action="''.LOGIN_URL.''" method="post">''."\\n";\n		$return_value .= ''<input type="hidden" name="url" value="''.$redirect_url.''" />''."\\n";\n    	$return_value .= ''<fieldset>''."\\n";\n		$return_value .= ''<h1>''.$TEXT[''LOGIN''].''</h1>''."\\n";\n		$return_value .= ''<label for="username">''.$TEXT[''USERNAME''].'':</label>''."\\n";\n		$return_value .= ''<p><input type="text" name="username" id="username"  /></p>''."\\n";\n		$return_value .= ''<label for="password">''.$TEXT[''PASSWORD''].'':</label>''."\\n";\n		$return_value .= ''<p><input type="password" name="password" id="password"/></p>''."\\n";\n		$return_value .= ''<p><input type="submit" id="submit" value="''.$TEXT[''LOGIN''].''" class="dbutton" /></p>''."\\n";\n    	$return_value .= ''<ul class="login-advance">''."\\n";\n		$return_value .= ''<li class="forgot"><a href="''.FORGOT_URL.''"><span>''.$TEXT[''FORGOT_DETAILS''].''</span></a></li>''."\\n";\n\n		if (intval(FRONTEND_SIGNUP) > 0)\n	    {\n	        $return_value .= ''<li class="sign"><a href="''.SIGNUP_URL.''">''.$TEXT[''SIGNUP''].''</a></li>''."\\n";\n	    }\n	    $return_value .= ''</ul>''."\\n";\n	    $return_value .= ''</fieldset>''."\\n";\n		$return_value .= ''</form>''."\\n";\n\n	} elseif( (FRONTEND_LOGIN == ''enabled'') &&\n				(is_numeric($wb->get_session(''USER_ID''))) )\n	{\n			$return_value .= ''<form action="''.LOGOUT_URL.''" method="post" class="login-table">''."\\n";\n        	$return_value .= ''<fieldset>''."\\n";\n			$return_value .= ''<h1>''.$TEXT["LOGGED_IN"].''</h1>''."\\n";\n			$return_value .= ''<label>''.$TEXT[''WELCOME_BACK''].'', ''.$wb->get_display_name().''</label>''."\\n";\n			$return_value .= ''<p><input type="submit" name="submit" value="''.$MENU[''LOGOUT''].''" class="dbutton" /></p>''."\\n";\n	        $return_value .= ''<ul class="logout-advance">''."\\n";\n			$return_value .= ''<li class="preference"><a href="''.PREFERENCES_URL.''" title="''.$MENU[''PREFERENCES''].''">''.$MENU[''PREFERENCES''].''</a></li>''."\\n";\n\n			if ($wb->ami_group_member(''1''))  //change ot the group that should get special links\n	        {\n		        $return_admin .= ''<li class="admin"><a target="_blank" href="''.ADMIN_URL.''/index.php" title="''.$TEXT[''ADMINISTRATION''].''" class="blank_target">''.$TEXT["ADMINISTRATION"].''</a></li>''."\\n";\n				//you can add more links for your users like userpage, lastchangedpages or something\n				$return_value .= $return_admin;\n			}\n            //change ot the group that should get special links\n			if( get_permission(''pages_modify'') && get_page_permission( PAGE_ID ) )\n	        {\n				$return_value .= ''<li class="modify"><a target="_blank" href="''.ADMIN_URL.''/pages/modify.php?page_id=''.PAGE_ID.''" title="''.$HEADING[''MODIFY_PAGE''].''" class="blank_target">''.$HEADING[''MODIFY_PAGE''].''</a></li>''."\\n";\n	        }\n	        $return_value .= ''</ul>''."\\n";\n	        $return_value .= ''</fieldset>''."\\n";\n			$return_value .= ''</form>''."\\n";\n	}\n	$return_value .= ''</div>''."\\n";\n	return $return_value;\n', 'Puts a Login / Logout box on your page.', 1430733926, 1, 1, 0, 0, 0, 'Use: [[LoginBox?redirect=url]]'),
(3, 'Lorem', '$lorem = array();\n$lorem[] = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Ut odio. Nam sed est. Nam a risus et est iaculis adipiscing. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer ut justo. In tincidunt viverra nisl. Donec dictum malesuada magna. Curabitur id nibh auctor tellus adipiscing pharetra. Fusce vel justo non orci semper feugiat. Cras eu leo at purus ultrices tristique.<br /><br />";\n$lorem[] = "Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.<br /><br />";\n$lorem[] = "Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.<br /><br />";\n$lorem[] = "Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.<br /><br />";\n$lorem[] = "Cras consequat magna ac tellus. Duis sed metus sit amet nunc faucibus blandit. Fusce tempus cursus urna. Sed bibendum, dolor et volutpat nonummy, wisi justo convallis neque, eu feugiat leo ligula nec quam. Nulla in mi. Integer ac mauris vel ligula laoreet tristique. Nunc eget tortor in diam rhoncus vehicula. Nulla quis mi. Fusce porta fringilla mauris. Vestibulum sed dolor. Aliquam tincidunt interdum arcu. Vestibulum eget lacus. Curabitur pellentesque egestas lectus. Duis dolor. Aliquam erat volutpat. Aliquam erat volutpat. Duis egestas rhoncus dui. Sed iaculis, metus et mollis tincidunt, mauris dolor ornare odio, in cursus justo felis sit amet arcu. Aenean sollicitudin. Duis lectus leo, eleifend mollis, consequat ut, venenatis at, ante.<br /><br />";\n$lorem[] = "Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br /><br />"; \nif (!isset($blocks)) $blocks=1;\n$blocks = (int)$blocks - 1;\nif ($blocks <= 0) $blocks = 0;\nif ($blocks > 5) $blocks = 5;\n$returnvalue = "";\nfor ( $i=0 ; $i<=$blocks ; $i++) {\n    $returnvalue .= $lorem[$i];\n}\nreturn $returnvalue;', 'Create Lorum Ipsum text', 1430733926, 1, 1, 0, 0, 0, 'Use: [[Lorem?blocks=6]] (max 6 paragraphs)'),
(4, 'ModifiedWhen', 'global $database, $wb;\rif (PAGE_ID>0) {\r	$query=$database->query("SELECT modified_when FROM ".TABLE_PREFIX."pages where page_id=".PAGE_ID);\r	$mod_details=$query->fetchRow();\r	return "This page was last modified on ".date("d/m/Y",$mod_details[0]). " at ".date("H:i",$mod_details[0]).".";\r}', 'Displays the last modification time of the current page', 1430733926, 1, 1, 0, 0, 0, 'Use [[ModifiedWhen]]'),
(5, 'NextPage', '$info = show_menu2(0, SM2_CURR, SM2_START, SM2_ALL|SM2_BUFFER, ''[if(class==menu-current){[level] [sib] [sibCount] [parent]}]'', '''', '''', '''');\rlist($nLevel, $nSib, $nSibCount, $nParent) = explode('' '', $info);\r\r// show next\r$nxt = $nSib < $nSibCount ? $nSib + 1 : 0;\rif ($nxt > 0) {\rreturn show_menu2(0, SM2_CURR, SM2_START, SM2_ALL|SM2_BUFFER,	"[if(sib==$nxt){&gt;&gt; [a][menu_title]</a>}]", '''', '''', '''');\r}\relse return ''(no next)'';\r', 'Create a next link to your page', 1430733926, 1, 1, 0, 0, 0, 'Display a link to the next page on the same menu level'),
(6, 'Oneliner', '$line = file (dirname(__FILE__)."/example/oneliners.txt");\rshuffle($line);\rreturn $line[0]; \r', 'Create a random oneliner on your page', 1430733926, 1, 1, 0, 0, 0, 'Use: [[OneLiner]]. The file with the oneliner data is located in /modules/droplets/example/oneliners.txt'),
(7, 'ParentPage', '$info = show_menu2(0, SM2_CURR, SM2_START, SM2_ALL|SM2_BUFFER, ''[if(class==menu-current){[level] [sib] [sibCount] [parent]}]'', '''', '''', '''');\rlist($nLevel, $nSib, $nSibCount, $nParent) = explode('' '', $info);\r\r// show up level\rif ($nLevel > 0) {\r$lev = $nLevel - 1;\rreturn show_menu2(0, SM2_ROOT, SM2_CURR, SM2_CRUMB|SM2_BUFFER, "[if(level==$lev){[a][menu_title]</a>}]", '''', '''', '''');\r}\relse \rreturn ''(no parent)'';\r\r', 'Create a parent link to your page', 1430733926, 1, 1, 0, 0, 0, 'Display a link to the parent page of the current page'),
(8, 'PreviousPage', '$info = show_menu2(0, SM2_CURR, SM2_START, SM2_ALL|SM2_BUFFER, ''[if(class==menu-current){[level] [sib] [sibCount] [parent]}]'', '''', '''', '''');\rlist($nLevel, $nSib, $nSibCount, $nParent) = explode('' '', $info);\r\r// show previous\r$prv = $nSib > 1 ? $nSib - 1 : 0;\rif ($prv > 0) { \rreturn show_menu2(0, SM2_CURR, SM2_START, SM2_ALL|SM2_BUFFER, "[if(sib==$prv){[a][menu_title]</a> &lt;&lt;}]", '''', '''', '''');\r}\relse \rreturn ''(no previous)'';\r\r', 'Create a previous link to your page', 1430733926, 1, 1, 0, 0, 0, 'Display a link to the previous page on the same menu level'),
(9, 'RandomImage', '$folder=opendir(WB_PATH.MEDIA_DIRECTORY.''/''.$dir.''/.''); \r$names = array();\rwhile ($file = readdir($folder))  {\r	$ext=strtolower(substr($file,-4));\r	if ($ext==".jpg"||$ext==".gif"||$ext==".png"){\r		$names[count($names)] = $file; \r	}\r}\rclosedir($folder);\rshuffle($names);\r$image=$names[0]; \r$name=substr($image,0,-4);\rreturn ''<img src="''.WB_URL.MEDIA_DIRECTORY.''/''.$dir.''/''.$image.''" alt="''.$name.''" width="''.$width.''" height="''.$height.''"/>'';\r', 'Get a random image from a folder in the MEDIA folder.', 1430733926, 1, 1, 0, 0, 0, 'Commandline to use: [[RandomImage?dir=subfolder_in_mediafolder]]'),
(10, 'SearchBox', 'global $TEXT;\n$return_value = true;\nif (!isset($msg)) $msg=''search this site..'';\n$j = "onfocus=\\"if(this.value==''$msg''){this.value='''';this.style.color=''#000'';}else{this.select();}\\"\n        onblur=\\"if(this.value==''''){this.value=''$msg'';this.style.color=''#b3b3b3'';}\\"";\nif(SHOW_SEARCH) { \n	$return_value  = ''<div class="searchbox">'';\n	$return_value  .= ''<form action="''.WB_URL.''/search/index''.PAGE_EXTENSION.''" method="get" name="search" class="searchform" id="search">'';\n	$return_value  .= ''<input style="color:#b3b3b3;" type="text" name="string" size="25" class="textbox" value="''.$msg.''" ''.$j.''  />&nbsp;'';\n	$return_value  .= ''</form>'';\n	$return_value  .= ''</div>'';\n}\nreturn $return_value;\n', 'Create a searchbox', 1430733926, 1, 1, 0, 0, 0, 'Creates a serachbox on the position of [[searchbox]]. Optional parameter "?msg=the search message"'),
(11, 'SectionPicker', 'global $database, $wb, $TEXT, $DGTEXT;\r\n$content = '''';\r\n$sid = isset($sid) ? intval($sid) : 0;\r\nif( $sid ) {\r\n	$sql  = ''SELECT `module` FROM `''.TABLE_PREFIX.''sections` '';\r\n	$sql .= ''WHERE `section_id`=''.$sid;\r\n	if (($module = $database->get_one($sql))) {\r\n		if (is_readable(WB_PATH.''/modules/''.$module.''/view.php'')) {\r\n			$_sFrontendCss = ''/modules/''.$module.''/frontend.css'';\r\n			if(is_readable(WB_PATH.$_sFrontendCss)) {\r\n				$_sSearch = preg_quote(WB_URL.''/modules/''.$module.''/frontend.css'', ''/'');\r\n				if(preg_match(''/<link[^>]*?href\\s*=\\s*\\"''.$_sSearch.''\\".*?\\/>/si'', $wb_page_data)) {\r\n					$_sFrontendCss = '''';\r\n				}else {\r\n					$_sFrontendCss = ''<link href="''.WB_URL.$_sFrontendCss.''" rel="stylesheet" type="text/css" media="screen" />'';\r\n				}\r\n			} else { $_sFrontendCss = ''''; }\r\n			ob_start();\r\n			$oldSid = $section_id; // save old sectionID\r\n			$section_id = $sid;\r\n			require(WB_PATH.''/modules/''.$module.''/view.php'');\r\n			$content = $_sFrontendCss.ob_get_clean();\r\n			$section_id = $oldSid; // restore old sectionID\r\n		}\r\n	}\r\n}\r\nreturn $content;', 'Load the view.php from any other section-module', 1430733926, 1, 1, 0, 0, 0, 'Use [[SectionPicker?sid=123]]'),
(12, 'ShowRandomWysiwyg', 'global $database;\r\n	$content = '''';\r\n	if (isset($section)) {\r\n		if( preg_match(''/^[0-9]+(?:\\s*[\\,\\|\\-\\;\\:\\+\\#\\/]\\s*[0-9]+\\s*)*$/'', $section)) {\r\n			if (is_readable(WB_PATH.''/modules/wysiwyg/view.php'')) {\r\n			// if valid arguments given and module wysiwyg is installed\r\n				// split and sanitize arguments\r\n				$aSections = preg_split(''/[\\s\\,\\|\\-\\;\\:\\+\\#\\/]+/'', $section);\r\n				$section_id = $aSections[array_rand($aSections)]; // get random element\r\n				ob_start(); // generate output by wysiwyg module\r\n				require(WB_PATH.''/modules/wysiwyg/view.php'');\r\n				$content = ob_get_clean();\r\n			}\r\n		}\r\n	}\r\nreturn $content;', 'Randomly display one WYSIWYG section from a given list', 1430733926, 1, 1, 0, 0, 0, 'Use [[ShowRandomWysiwyg?section=10,12,15,20]] possible Delimiters: [ ,;:|-+#/ ]'),
(13, 'ShowWysiwyg', 'global $database;\r\n	$content = '''';\r\n	$section = isset($section) ? intval($section) : 0;\r\n	if ($section) {\r\n		if (is_readable(WB_PATH.''/modules/wysiwyg/view.php'')) {\r\n		// if valid section is given and module wysiwyg is installed\r\n			$iOldSectionId = intval($section_id); // save old SectionID\r\n			$section_id = $section;\r\n			ob_start(); // generate output by regulary wysiwyg module\r\n			require(WB_PATH.''/modules/wysiwyg/view.php'');\r\n			$content = ob_get_clean();\r\n			$section_id = $ioldSectionId; // restore old SectionId\r\n		}\r\n	}\r\nreturn $content;', 'Display one defined WYSIWYG section', 1430733926, 1, 1, 0, 0, 0, 'Use [[ShowSection?section=10]]'),
(14, 'SiteModified', 'global $database, $wb;\rif (PAGE_ID>0) {\r	$query=$database->query("SELECT max(modified_when) FROM ".TABLE_PREFIX."pages");\r	$mod_details=$query->fetchRow();\r	return "This site was last modified on ".date("d/m/Y",$mod_details[0]). " at ".date("H:i",$mod_details[0]).".";\r}', 'Create information on when your site was last updated.', 1430733926, 1, 1, 0, 0, 0, 'Create information on when your site was last updated. Any page update counts.'),
(15, 'Skype', 'return ''<img src="http://mystatus.skype.com/''.$user.''.png?t=''.time().''" alt="My Skype status" />'';', 'Your skype status as an image', 1430733926, 1, 1, 0, 0, 0, 'Commandline to use: [[skype?user=skypename]]'),
(16, 'Text2Image', '//clean up old files..\r\n$dir = WB_PATH.''/temp/'';\r\n$dp = opendir($dir) or die (''Could not open ''.$dir);\r\nwhile ($file = readdir($dp)) {\r\n	if ((preg_match(''/img_/'',$file)) && (filemtime($dir.$file)) <  (strtotime(''-10 minutes''))) {\r\n		unlink($dir.$file);\r\n	}\r\n}\r\nclosedir($dp);\r\n\r\n$imgfilename = ''img_''.rand().''_''.time().''.jpg'';\r\n//create image\r\n$padding = 0;\r\n$font = 3;  	\r\n\r\n$height = imagefontheight($font) + ($padding * 2);\r\n$width = imagefontwidth($font) * strlen($text) + ($padding * 2);\r\n$image_handle = imagecreatetruecolor($width, $height);\r\n$text_color = imagecolorallocate($image_handle, 0, 0, 0);\r\n$background_color = imagecolorallocate($image_handle, 255, 255, 255);\r\n$bg_height = imagesy($image_handle);\r\n$bg_width = imagesx($image_handle);\r\nimagefilledrectangle($image_handle, 0, 0, $bg_width, $bg_height, $background_color);\r\nimagestring($image_handle, $font, $padding, $padding, $text, $text_color);\r\nimagejpeg($image_handle,WB_PATH.''/temp/''.$imgfilename,100);\r\nimagedestroy($image_handle);\r\n\r\nreturn ''<img src="''.WB_URL.''/temp/''.$imgfilename.''" style="border:0px;margin:0px;padding:0px;vertical-align:middle;" />'';', 'Create an image from the textparameter', 1430733926, 1, 1, 0, 0, 0, 'Use [[text2image?text=The text to create]]'),
(18, 'LibInclude', 'include_once WB_PATH.''/modules/libraryadmin/include.php'';\r\n$backend_flag = false;\r\nif ( empty( $lib ) )       { $lib    = ''libraryadmin''; }\r\nif ( empty( $module ) )    { $module = NULL; }\r\nif ( empty( $preset ) )    { $preset = NULL; }\r\nif ( empty( $plugin ) )    { $plugin = NULL; }\r\nif ( empty( $subdir ) )    { $subdir = NULL; }\r\nif ( isset($backend) && $backend ) { $backend_flag = true; }\r\n$new_page = includePreset( $wb_page_data, $lib, $preset, $module, $plugin, $backend_flag, NULL, $subdir );\r\nif ( !empty($new_page) ) {\r\n    $wb_page_data = $new_page;\r\n}\r\nreturn true;\r\n', 'Include a LibraryAdmin Preset', 1430736604, 1, 1, 0, 0, 0, ''),
(19, 'LibLoader', 'include_once WB_PATH.''/modules/libraryadmin/include.php'';\r\n$new = libLoader( $wb_page_data, PAGE_ID );\r\nif ( ! empty($new) ) { $wb_page_data = $new; }\r\nreturn true;\r\n', 'Automatically include a LibraryAdmin Preset for the current page', 1430736604, 1, 1, 0, 0, 0, 'Use: [[LibLoader]]\r ');

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_faq_categories`
--

CREATE TABLE IF NOT EXISTS `wb_mod_faq_categories` (
  `section_id` int(10) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(10) NOT NULL,
  `cat_name` varchar(255) NOT NULL DEFAULT '',
  `pos` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wb_mod_faq_categories`
--

INSERT INTO `wb_mod_faq_categories` (`section_id`, `page_id`, `cat_id`, `cat_name`, `pos`) VALUES
(26, 25, 1, 'WebsiteBaker', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_faq_questions`
--

CREATE TABLE IF NOT EXISTS `wb_mod_faq_questions` (
  `section_id` int(10) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `question_id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL DEFAULT '0',
  `question` varchar(255) NOT NULL DEFAULT '',
  `answer` text NOT NULL,
  `pos` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wb_mod_faq_questions`
--

INSERT INTO `wb_mod_faq_questions` (`section_id`, `page_id`, `question_id`, `cat_id`, `question`, `answer`, `pos`) VALUES
(0, 0, 1, 0, '', '', 0),
(26, 25, 2, 1, 'Wat is WebsiteBaker?', '<p>WebsiteBaker is een open source contentmanagementsysteem geschreven in PHP. Het wordt gebruikt om informatie op het netwerk te publiceren. De belangrijkste drijfveer voor WebsiteBaker is gebruikersgemak. Er hoort een grafisch installatieprogramma bij, dat bedoeld is om een onervaren gebruiker eenvoudig content en informatie te laten publiceren.</p>', 1),
(26, 25, 3, 1, 'Wat is de doelgroep voor een WebsiyteBaker site?', '<p>WebsiteBaker is met name geschikt als websitebeheertool en CMS voor het midden- en kleinbedrijf:      </p>\r\n<ul>\r\n    <li>Gepersonaliseerde hoofdpagina''s.     </li>\r\n    <li>Portfoliopagina''s     </li>\r\n    <li>Clubpagina''s     </li>\r\n    <li>Zakelijke pagina''s</li>\r\n</ul>\r\n<p>&nbsp;</p>', 2),
(26, 25, 4, 1, 'Waar vind ik een overzicht van site''s die met WebsiteBaker zijn gerealiseerd?', '<p><a href="http://www.mywebsitebaker.com/">Op de volgende lokatie http://www.mywebsitebaker.com/</a></p>', 3);

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_faq_settings`
--

CREATE TABLE IF NOT EXISTS `wb_mod_faq_settings` (
  `section_id` int(10) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `header` text NOT NULL,
  `footer` text NOT NULL,
  `template_summary` text NOT NULL,
  `template_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wb_mod_faq_settings`
--

INSERT INTO `wb_mod_faq_settings` (`section_id`, `page_id`, `header`, `footer`, `template_summary`, `template_details`) VALUES
(26, 25, '', '', '[category]\r\n<strong>{CATEGORY}</strong>\r\n<br /><br />\r\n<ul>\r\n[question]\r\n<li style="padding:2px 0px;">\r\n<a href="{LINK}">{QUESTION}</a>\r\n</li>\r\n[/question]\r\n</ul>\r\n[/category]', '[category]\r\n<h3>{CATEGORY}</h3>\r\n<br />\r\n[question]\r\n<a name="{LINK}">\r\n<strong>Q. {QUESTION}</strong>\r\n</a>\r\n<br /><br />\r\n<p style="margin:0 16px;padding:0;text-align:justify;border:0;">\r\n{ANSWER}\r\n<br /><br />\r\n<span style="font-size:10px;"><a href="#top">^ TOP</a></span>\r\n</p>\r\n<br/><br/>\r\n[/question]\r\n[/category]');

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_form_fields`
--

CREATE TABLE IF NOT EXISTS `wb_mod_form_fields` (
  `field_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `required` int(11) NOT NULL DEFAULT '0',
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `extra` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_mod_form_fields`
--

INSERT INTO `wb_mod_form_fields` (`field_id`, `section_id`, `page_id`, `position`, `title`, `type`, `required`, `value`, `extra`) VALUES
(1, 0, 0, 0, '', '', 0, '', ''),
(2, 12, 12, 1, 'Conteatct', 'heading', 0, '', '<tr><td class="field_heading" colspan="2">{TITLE}{FIELD}</td></tr>'),
(4, 13, 12, 1, 'Via dit formulier kunt u in contact treden met mij', 'heading', 0, '', '<tr><td class="frm-field_heading" colspan="2">{TITLE}{FIELD}</td></tr>'),
(5, 13, 12, 2, 'Naam', 'textfield', 0, '', ''),
(6, 13, 12, 4, 'Opmerking', 'textarea', 0, '', ''),
(7, 13, 12, 5, 'Email adres', 'email', 0, '', ''),
(8, 13, 12, 3, 'Onderwerp', 'textfield', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_form_settings`
--

CREATE TABLE IF NOT EXISTS `wb_mod_form_settings` (
  `section_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `header` text COLLATE utf8_unicode_ci NOT NULL,
  `field_loop` text COLLATE utf8_unicode_ci NOT NULL,
  `footer` text COLLATE utf8_unicode_ci NOT NULL,
  `email_to` text COLLATE utf8_unicode_ci NOT NULL,
  `email_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email_fromname` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email_subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `success_page` text COLLATE utf8_unicode_ci NOT NULL,
  `success_email_to` text COLLATE utf8_unicode_ci NOT NULL,
  `success_email_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `success_email_fromname` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `success_email_text` text COLLATE utf8_unicode_ci NOT NULL,
  `success_email_subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `stored_submissions` int(11) NOT NULL DEFAULT '0',
  `max_submissions` int(11) NOT NULL DEFAULT '0',
  `use_captcha` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_mod_form_settings`
--

INSERT INTO `wb_mod_form_settings` (`section_id`, `page_id`, `header`, `field_loop`, `footer`, `email_to`, `email_from`, `email_fromname`, `email_subject`, `success_page`, `success_email_to`, `success_email_from`, `success_email_fromname`, `success_email_text`, `success_email_subject`, `stored_submissions`, `max_submissions`, `use_captcha`) VALUES
(0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0),
(13, 12, '<table class="frm-field_table" cellpadding="2" cellspacing="0" border="0" summary="form">', '<tr>\r\n<td class="frm-field_title">{TITLE}{REQUIRED}:</td>\r\n<td>{FIELD}</td>\r\n</tr>', '<tr>\r\n<td> </td>\r\n\r\n<td>\r\n\r\n<input type="submit" name="submit" value="{SUBMIT_FORM}" />\r\n\r\n</td>\r\n\r\n</tr>\r\n\r\n</table>\r\n', 'admin@mail.com', 'admin@mail.com', 'WB Mailer', '', 'none', '', 'admin@mail.com', 'WB Mailer', '', '', 50, 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_form_submissions`
--

CREATE TABLE IF NOT EXISTS `wb_mod_form_submissions` (
  `submission_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `submitted_when` int(11) NOT NULL DEFAULT '0',
  `submitted_by` int(11) NOT NULL DEFAULT '0',
  `body` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_mod_form_submissions`
--

INSERT INTO `wb_mod_form_submissions` (`submission_id`, `section_id`, `page_id`, `submitted_when`, `submitted_by`, `body`) VALUES
(1, 13, 12, 1430737011, 1, '===[Via dit formulier kunt u in contact treden met mij]===\n\nNaam: dddddd\n\nOpmerking: weww\n\nEmail adres: dd2S@ABBD.NL\n\n');

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_jsadmin`
--

CREATE TABLE IF NOT EXISTS `wb_mod_jsadmin` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `value` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_mod_jsadmin`
--

INSERT INTO `wb_mod_jsadmin` (`id`, `name`, `value`) VALUES
(1, 'mod_jsadmin_persist_order', 1),
(2, 'mod_jsadmin_ajax_order_pages', 1),
(3, 'mod_jsadmin_ajax_order_sections', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_menu_link`
--

CREATE TABLE IF NOT EXISTS `wb_mod_menu_link` (
  `section_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `target_page_id` int(11) NOT NULL DEFAULT '0',
  `redirect_type` int(11) NOT NULL DEFAULT '302',
  `anchor` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `extern` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_newsreader`
--

CREATE TABLE IF NOT EXISTS `wb_mod_newsreader` (
  `section_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `uri` varchar(255) NOT NULL DEFAULT '',
  `show_image` int(1) NOT NULL DEFAULT '1',
  `show_desc` int(1) NOT NULL DEFAULT '1',
  `show_limit` int(2) NOT NULL DEFAULT '15',
  `cycle` int(5) NOT NULL DEFAULT '0',
  `last_update` int(14) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `ch_title` varchar(255) NOT NULL DEFAULT '',
  `ch_link` varchar(255) NOT NULL DEFAULT '',
  `ch_desc` varchar(255) NOT NULL DEFAULT '',
  `img_title` varchar(255) NOT NULL DEFAULT '',
  `img_uri` varchar(255) NOT NULL DEFAULT '',
  `img_link` varchar(255) NOT NULL DEFAULT '',
  `coding_from` varchar(100) NOT NULL DEFAULT '',
  `coding_to` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wb_mod_newsreader`
--

INSERT INTO `wb_mod_newsreader` (`section_id`, `page_id`, `uri`, `show_image`, `show_desc`, `show_limit`, `cycle`, `last_update`, `content`, `ch_title`, `ch_link`, `ch_desc`, `img_title`, `img_uri`, `img_link`, `coding_from`, `coding_to`) VALUES
(25, 24, 'http://tweakers.mobi/rss/nieuws', 1, 1, 15, 86400, 1430825167, '', '', '', '', '', '', '', '--', '--');

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_news_comments`
--

CREATE TABLE IF NOT EXISTS `wb_mod_news_comments` (
  `comment_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `post_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `commented_when` int(11) NOT NULL DEFAULT '0',
  `commented_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_news_groups`
--

CREATE TABLE IF NOT EXISTS `wb_mod_news_groups` (
  `group_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_news_posts`
--

CREATE TABLE IF NOT EXISTS `wb_mod_news_posts` (
  `post_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `content_short` text COLLATE utf8_unicode_ci NOT NULL,
  `content_long` text COLLATE utf8_unicode_ci NOT NULL,
  `commenting` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `created_when` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `published_when` int(11) NOT NULL DEFAULT '0',
  `published_until` int(11) NOT NULL DEFAULT '0',
  `posted_when` int(11) NOT NULL DEFAULT '0',
  `posted_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_mod_news_posts`
--

INSERT INTO `wb_mod_news_posts` (`post_id`, `section_id`, `page_id`, `group_id`, `active`, `position`, `title`, `link`, `content_short`, `content_long`, `commenting`, `created_when`, `created_by`, `published_when`, `published_until`, `posted_when`, `posted_by`) VALUES
(1, 11, 10, 0, 1, 1, 'Apache virtual hosts configureren Ubuntu.', '/posts/apache-virtual-hosts-configureren-ubuntu-1', '<p><img width="63" height="73" align="left" alt="" src="http://localhost/wb/media/apache_logo.jpg" />Stel dat we een productie website hebben met het volgende domain:  jeroenos.dx.am. <br />\r\nAls ik deze site lokaal installeer, dan wil ik deze lokale site in de webbrowser benaderen met: jeroenos.dx.dev <br />\r\nDe lokale Drupal site staat in de directory: /home/jeroen/websites/jeroenos.dx.dev.<br />\r\nDit kan door lokaal een virtual host in te regelen. Op Ubuntu is dit in een aantal stappen eenvoudig in te regelen.</p>', '<p>Stel dat we een productie website hebben met het volgende domain:&nbsp; jeroenos.dx.am.<br />\r\nAls ik deze site lokaal installeer, dan wil ik deze lokale site in de webbrowser benaderen met: jeroenos.dx.dev<br />\r\nDe lokale Drupal site staat in de directory: /home/jeroen/websites/jeroenos.dx.dev</p>\r\n<p>Dit kan door lokaal een virtual host in te regelen. Op Ubuntu is dit in een aantal stappen eenvoudig in te regelen. Maak eerst een configuratie bestand voor de virtualhost, door in een terminal de volgende commando''s uit te voeren:</p>\r\n<pre>\r\nsudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/jeroenos.dx.am.conf\r\nsudo leafpad /etc/apache2/sites-available/jeroenos.dx.am.conf</pre>\r\n<p>Vervang nu de inhoud van het configuratie jeroenos.dx.am.conf, wat je nu in leafpad ziet, voor:</p>\r\n<pre>\r\n&lt;VirtualHost *:80&gt;\r\n     ServerAdmin webmaster@localhost\r\n     ServerName jeroenos.dx.dev\r\n     ServerAlias www.jeroenos.dx.dev\r\n     DocumentRoot /home/jeroen/websites/jeroenos.dx.dev\r\n     ErrorLog ${APACHE_LOG_DIR}/error.log\r\n     CustomLog ${APACHE_LOG_DIR}/access.log combined\r\n&nbsp;&nbsp;&nbsp;&nbsp; &lt;Directory&nbsp; /home/jeroen/websites/jeroenos.dx.dev &gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Options Indexes FollowSymLinks&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Order allow,deny\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Allow from all\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Require all granted\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AllowOverride All&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp; &lt;/Directory&gt;\r\n&lt;/VirtualHost&gt;</pre>\r\n<p>Pas vervolgens ook nog het hosts bestand aan met het volgende commando:</p>\r\n<pre>\r\nsudo leafpad /etc/hosts</pre>\r\n<p>Voeg hier de volgende regel toe:</p>\r\n<pre>\r\n127.0.1.1  jeroenos.dx.dev</pre>\r\n<p>De volgende stap is de configuratie effectueren met het volgende commando:</p>\r\n<pre>\r\nsudo a2ensite jeroenos.dx.am.conf</pre>\r\n<p>Onder water wordt er nu de directory /etc/apache2/sites-enabled/ een symbolic link aangemaakt naar het bestand /etc/apache2/sites-available/jeroenos.dx.am.conf.<br />\r\nTenslotte de Apache webserver herstarten:</p>\r\n<pre>\r\nsudo service apache2 restart</pre>', 'none', 1430602320, 1, 1430602320, 0, 1430731298, 1),
(2, 11, 10, 0, 1, 2, 'Een lege database tbv Drupal of Websitebaker website aanmaken.', '/posts/een-lege-database-tbv-drupal-of-websitebaker-website-aanmaken-2', '<p><img width="58" height="69" align="left" src="http://localhost/wb/media/wb-logo-box.png" alt="" />Een lege Drupal database en een database account met de juiste rechten op de database is snel gedaan in Mysql. Start een terminal en voer de volgende commando''s uit:</p>', '<p>Een lege Drupal of WebsiteBaker database en een database account met de juiste rechten op de database is snel gedaan in Mysql.<br />\r\nStart een terminal en voer de volgende commando''s uit:</p>\r\n<pre>\r\n$ mysql -u root -p\r\n\r\ncreate database jeroenos_dx_dev\r\n;\r\ncreate user ''jeroenos''@''localhost'' \r\n&nbsp; identified by ''jeroenos123''\r\n;\r\ngrant select, insert, update, delete, create, drop\r\n, index, alter, create temporary tables, lock tables \r\non  jeroenos_dx_dev.* \r\nto ''jeroenos''@''localhost''\r\n;\r\n</pre>', 'none', 1430731020, 1, 1430731020, 0, 1430731355, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_news_settings`
--

CREATE TABLE IF NOT EXISTS `wb_mod_news_settings` (
  `section_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `header` text COLLATE utf8_unicode_ci NOT NULL,
  `post_loop` text COLLATE utf8_unicode_ci NOT NULL,
  `footer` text COLLATE utf8_unicode_ci NOT NULL,
  `posts_per_page` int(11) NOT NULL DEFAULT '0',
  `post_header` text COLLATE utf8_unicode_ci NOT NULL,
  `post_footer` text COLLATE utf8_unicode_ci NOT NULL,
  `comments_header` text COLLATE utf8_unicode_ci NOT NULL,
  `comments_loop` text COLLATE utf8_unicode_ci NOT NULL,
  `comments_footer` text COLLATE utf8_unicode_ci NOT NULL,
  `comments_page` text COLLATE utf8_unicode_ci NOT NULL,
  `commenting` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `resize` int(11) NOT NULL DEFAULT '0',
  `use_captcha` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_mod_news_settings`
--

INSERT INTO `wb_mod_news_settings` (`section_id`, `page_id`, `header`, `post_loop`, `footer`, `posts_per_page`, `post_header`, `post_footer`, `comments_header`, `comments_loop`, `comments_footer`, `comments_page`, `commenting`, `resize`, `use_captcha`) VALUES
(11, 10, '<table cellpadding="0" cellspacing="0" class="loop-header">\n', '<tr class="post-top">\r\n<td class="post-title"><a href="[LINK]">[TITLE]</a></td>\r\n<td class="post-date">[PUBLISHED_DATE], [PUBLISHED_TIME]</td>\r\n</tr>\r\n<tr>\r\n<td class="post-short" colspan="2">\r\n[SHORT]\r\n<span style="visibility:[SHOW_READ_MORE];"><a href="[LINK]">[TEXT_READ_MORE]</a></span>\r\n</td>\r\n</tr>', '</table>\r\n<table cellpadding="0" cellspacing="0" class="page-header" style="display: [DISPLAY_PREVIOUS_NEXT_LINKS]">\r\n<tr>\r\n<td class="page-left">[PREVIOUS_PAGE_LINK]</td>\r\n<td class="page-center">[OF]</td>\r\n<td class="page-right">[NEXT_PAGE_LINK]</td>\r\n</tr>\r\n</table>', 0, '<table cellpadding="0" cellspacing="0" class="post-header">\r\n<tr>\r\n<td><h1>[TITLE]</h1></td>\r\n<td rowspan="3" style="display: [DISPLAY_IMAGE]">[GROUP_IMAGE]</td>\r\n</tr>\r\n<tr>\r\n<td class="public-info"><b>[TEXT_POSTED_BY] [DISPLAY_NAME] ([USERNAME]) [TEXT_ON] [PUBLISHED_DATE]</b></td>\r\n</tr>\r\n<tr style="display: [DISPLAY_GROUP]">\r\n<td class="group-page"><a href="[BACK]">[PAGE_TITLE]</a> &gt;&gt; <a href="[BACK]?g=[GROUP_ID]">[GROUP_TITLE]</a></td>\r\n</tr>\r\n</table>', '<p>[TEXT_LAST_CHANGED]: [MODI_DATE] [TEXT_AT] [MODI_TIME]</p>\r\n<a href="[BACK]">[TEXT_BACK]</a>', '<br /><br />\r\n<h2>[TEXT_COMMENTS]</h2>\r\n<table cellpadding="2" cellspacing="0" class="comment-header">', '<tr>\r\n<td class="comment_title">[TITLE]</td>\r\n<td class="comment_info">[TEXT_BY] [DISPLAY_NAME] [TEXT_ON] [DATE] [TEXT_AT] [TIME]</td>\r\n</tr>\r\n<tr>\r\n<td colspan="2" class="comment-text">[COMMENT]</td>\r\n</tr>', '</table>\r\n<br /><a href="[ADD_COMMENT_URL]">[TEXT_ADD_COMMENT]</a>', '<h1>[TEXT_COMMENT]</h1>\r\n<h2>[POST_TITLE]</h2>\r\n<br />', 'none', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_output_filter`
--

CREATE TABLE IF NOT EXISTS `wb_mod_output_filter` (
  `sys_rel` int(11) NOT NULL DEFAULT '0',
  `email_filter` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `mailto_filter` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `at_replacement` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '(at)',
  `dot_replacement` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '(dot)'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_mod_output_filter`
--

INSERT INTO `wb_mod_output_filter` (`sys_rel`, `email_filter`, `mailto_filter`, `at_replacement`, `dot_replacement`) VALUES
(0, '1', '1', '(at)', '(dot)');

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_wrapper`
--

CREATE TABLE IF NOT EXISTS `wb_mod_wrapper` (
  `section_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `height` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wb_mod_wysiwyg`
--

CREATE TABLE IF NOT EXISTS `wb_mod_wysiwyg` (
  `section_id` int(11) NOT NULL DEFAULT '0',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_mod_wysiwyg`
--

INSERT INTO `wb_mod_wysiwyg` (`section_id`, `page_id`, `content`, `text`) VALUES
(1, 1, '<h1>Doelgericht webdesign</h1>\r\n<p>Een interessante quote is de volgende:</p>\r\n<blockquote cite="http://nl.wikipedia.org/wiki/Alice%27s_Adventures_in_Wonderland"> Alice: &quot;Kan je me alsjeblieft vertellen welke richting ik uit zou moeten gaan vanaf hier?&quot; 	  <br />\r\nKat: &quot;Dat hangt voor een groot stuk af van waar je wil geraken.&quot;	  <br />\r\nAlice: &quot;Dat kan me niet echt schelen, als ik maar ergens uitkom.&quot; 	  <br />\r\nKat: &quot;Dan maakt het ook niet uit welke kant je uitgaat. Je zal altijd wel ergens uitkomen, zolang je maar lang genoeg doorstapt.&quot; </blockquote>\r\n<p><small>Lewis Carroll''s Alice in Wonderland</small></p>\r\n<p>Je komt inderdaad altijd wel ergens uit, maar het is de vraag of je op de plek gekomen bent waar je nu wil zijn en of je de beste route hebt gevolgd. Voor het ontwikkelen van een website is het meestal beter om een goed uitgedacht routeplan te hebben. Het is goed om van te voren na te denken over zaken als de doelgroep, het budget, de hosting, het beheer en of de gegevens op de site weinig of juist veel aan verandering onderhevig zijn. Pas hierna kan een goede afweging gemaakt worden welke technische middelen er gebruikt kunnen worden.</p>\r\n<p>Een website is een visitekaartje van een organisatie. Met de opkomst van smartphone''s en tablet''s is het belangrijk dat dit visitekaartje ook op deze mediums''s er goed uitziet, de website moet, wat je noemt, responsief zijn. Als een website traag is of op een de smartphone niet te lezen is, dan is de bezoeker meestal snel vertrokken en gaat ie misschien wel naar de concurrent.</p>\r\n<p>Het uitbesteden van het ontwikkelen van een website aan een specialist betaalt zich meestal vrij snel terug. Jeroenos is gespecialiseerd in web-ontwikkeling met Drupal en WebsiteBaker.</p>\r\n<div class="afbeelding">\r\n<p style="text-align: center;"><img width="133" height="161" alt="" src="{SYSVAR:MEDIA_REL}/wb-logo-box.png" /><img width="161" height="161" src="{SYSVAR:MEDIA_REL}/drupallogo00.gif" alt="" /></p>\r\n</div>', '<h1>Doelgericht webdesign</h1>\r\n<p>Een interessante quote is de volgende:</p>\r\n<blockquote cite="http://nl.wikipedia.org/wiki/Alice%27s_Adventures_in_Wonderland"> Alice: &quot;Kan je me alsjeblieft vertellen welke richting ik uit zou moeten gaan vanaf hier?&quot; 	  <br />\r\nKat: &quot;Dat hangt voor een groot stuk af van waar je wil geraken.&quot;	  <br />\r\nAlice: &quot;Dat kan me niet echt schelen, als ik maar ergens uitkom.&quot; 	  <br />\r\nKat: &quot;Dan maakt het ook niet uit welke kant je uitgaat. Je zal altijd wel ergens uitkomen, zolang je maar lang genoeg doorstapt.&quot; </blockquote>\r\n<p><small>Lewis Carroll''s Alice in Wonderland</small></p>\r\n<p>Je komt inderdaad altijd wel ergens uit, maar het is de vraag of je op de plek gekomen bent waar je nu wil zijn en of je de beste route hebt gevolgd. Voor het ontwikkelen van een website is het meestal beter om een goed uitgedacht routeplan te hebben. Het is goed om van te voren na te denken over zaken als de doelgroep, het budget, de hosting, het beheer en of de gegevens op de site weinig of juist veel aan verandering onderhevig zijn. Pas hierna kan een goede afweging gemaakt worden welke technische middelen er gebruikt kunnen worden.</p>\r\n<p>Een website is een visitekaartje van een organisatie. Met de opkomst van smartphone''s en tablet''s is het belangrijk dat dit visitekaartje ook op deze mediums''s er goed uitziet, de website moet, wat je noemt, responsief zijn. Als een website traag is of op een de smartphone niet te lezen is, dan is de bezoeker meestal snel vertrokken en gaat ie misschien wel naar de concurrent.</p>\r\n<p>Het uitbesteden van het ontwikkelen van een website aan een specialist betaalt zich meestal vrij snel terug. Jeroenos is gespecialiseerd in web-ontwikkeling met Drupal en WebsiteBaker.</p>\r\n<div class="afbeelding">\r\n<p style="text-align: center;"><img width="133" height="161" alt="" src="{SYSVAR:MEDIA_REL}/wb-logo-box.png" /><img width="161" height="161" src="{SYSVAR:MEDIA_REL}/drupallogo00.gif" alt="" /></p>\r\n</div>'),
(2, 2, '<h1>WebsiteBaker</h1>\r\n<p>[[LibLoader]]</p>\r\n<p>Deze site is gerealiseerd met behulp het het <a href="http://nl.wikipedia.org/wiki/WebsiteBaker">WebsiteBaker</a> CMS. Het doel van de site is ten eerste een visite kaartje voor mij te zijn. Verder is het een mooi platform om enige mogelijkheden van WebsiteBaker te laten zien.<br />\r\n<br />\r\nMijn motto tijdens het ontwerpen was het zogenaamde <a target="_blank" href="http://nl.wikipedia.org/wiki/KISS-principe">KISS-principe</a> en less is more. Liever een eenvoudige overzichtelijke site met een wat betere performance, dan veel toeters en bellen, maar traag.</p>\r\n<p>Ik heb getracht zoveel mogelijk gebruik te maken van basis functionaliteit van het WebsiteBaker CMS. Verder heb ik functionaliteit toegevoegd door een aantal modules uit de WebsiteBaker Community te installeren. Ik maak o.a gebruik van de <a href="http://jquery.lepton-cms.org/" target="_blank">LibraryAdmin/jQuery</a> module, waardoor het mogelijk wordt om de plugin''s uit de zogenaamde <a target="_blank" href="http://nl.wikipedia.org/wiki/JQuery">jQuery</a> bibliotheek op de website te gebruiken.<br />\r\nEen van deze plugin''s is de <a target="_blank" href="http://jquery.lepton-cms.org/plugins/foldergallery/jq-pirobox.php">Pirobox</a> plugin, klik maar eens op een van de onderstaande afbeeldingen en de plugin komt in actie.<br />\r\nOp de site van <a href="http://jquery.lepton-cms.org/plugins/general-view.php">Lepton</a> is een overzicht van de vele plugin welke in potentie op een WebsiteBaker welke site kunnen worden gebruikt.</p>\r\n<p>Tevens heb ik een aantal maatregelen genomen, die er toe bijdragen dat de site met de Google zoekmachine gevonden wordt. Dit proces noemt je SEO (Search Engine Optimalization). Klik op de volgende link om te zien, waar de site in de resulaten van de zoekamachine verschijnt <a href="https://www.google.nl/search?site=&amp;source=hp&amp;q=drupal+specialist+jeroenos&amp;oq=drupal+specialist+jeroenos" target="_blank">Google drupal specialist jeroenos</a></p>\r\n<p>Enige gebruikte producten zijn:</p>\r\n<div class="ceebox">\r\n<div class="producten">; <a title="Jquery" href="{SYSVAR:MEDIA_REL}/groot/jquerylogo.png"><img alt="" src="{SYSVAR:MEDIA_REL}/jquerylogo.png" /></a> <a title="PHP" href="{SYSVAR:MEDIA_REL}/php_logo.png"><img alt="" src="{SYSVAR:MEDIA_REL}/php_logo.png" /></a> <a title="MySQL" href="{SYSVAR:MEDIA_REL}/mysql-logo.png"><img alt="" src="{SYSVAR:MEDIA_REL}/mysql-logo.png" /></a>  <a title="Linux" href="{SYSVAR:MEDIA_REL}/220px-Tux.svg.png"><img alt="" src="{SYSVAR:MEDIA_REL}/220px-Tux.svg.png" /></a> <a title="Apache " href="{SYSVAR:MEDIA_REL}/apache_logo.jpg"><img src="{SYSVAR:MEDIA_REL}/apache_logo.jpg" alt="" /></a>  <a title="PhpMyAdmin" href="{SYSVAR:MEDIA_REL}/phpMyAdmin-Logo.png"><img src="{SYSVAR:MEDIA_REL}/phpMyAdmin-Logo.png" alt="" /></a> <a title="Firebug" href="{SYSVAR:MEDIA_REL}//Firebug.png"><img src="{SYSVAR:MEDIA_REL}//Firebug.png" alt="" /></a>   <a title="Gimp" href="{SYSVAR:MEDIA_REL}/groot/jquerylogo.png"><img src="{SYSVAR:MEDIA_REL}/TheGiMP24logo1.gif" alt="" /></a> <a title="Firefox" href="{SYSVAR:MEDIA_REL}/Firefox_4.jpg"><img src="{SYSVAR:MEDIA_REL}/Firefox_4.jpg" alt="" /></a></div>\r\n</div>', '<h1>WebsiteBaker</h1>\r\n<p>[[LibLoader]]</p>\r\n<p>Deze site is gerealiseerd met behulp het het <a href="http://nl.wikipedia.org/wiki/WebsiteBaker">WebsiteBaker</a> CMS. Het doel van de site is ten eerste een visite kaartje voor mij te zijn. Verder is het een mooi platform om enige mogelijkheden van WebsiteBaker te laten zien.<br />\r\n<br />\r\nMijn motto tijdens het ontwerpen was het zogenaamde <a target="_blank" href="http://nl.wikipedia.org/wiki/KISS-principe">KISS-principe</a> en less is more. Liever een eenvoudige overzichtelijke site met een wat betere performance, dan veel toeters en bellen, maar traag.</p>\r\n<p>Ik heb getracht zoveel mogelijk gebruik te maken van basis functionaliteit van het WebsiteBaker CMS. Verder heb ik functionaliteit toegevoegd door een aantal modules uit de WebsiteBaker Community te installeren. Ik maak o.a gebruik van de <a href="http://jquery.lepton-cms.org/" target="_blank">LibraryAdmin/jQuery</a> module, waardoor het mogelijk wordt om de plugin''s uit de zogenaamde <a target="_blank" href="http://nl.wikipedia.org/wiki/JQuery">jQuery</a> bibliotheek op de website te gebruiken.<br />\r\nEen van deze plugin''s is de <a target="_blank" href="http://jquery.lepton-cms.org/plugins/foldergallery/jq-pirobox.php">Pirobox</a> plugin, klik maar eens op een van de onderstaande afbeeldingen en de plugin komt in actie.<br />\r\nOp de site van <a href="http://jquery.lepton-cms.org/plugins/general-view.php">Lepton</a> is een overzicht van de vele plugin welke in potentie op een WebsiteBaker welke site kunnen worden gebruikt.</p>\r\n<p>Tevens heb ik een aantal maatregelen genomen, die er toe bijdragen dat de site met de Google zoekmachine gevonden wordt. Dit proces noemt je SEO (Search Engine Optimalization). Klik op de volgende link om te zien, waar de site in de resulaten van de zoekamachine verschijnt <a href="https://www.google.nl/search?site=&amp;source=hp&amp;q=drupal+specialist+jeroenos&amp;oq=drupal+specialist+jeroenos" target="_blank">Google drupal specialist jeroenos</a></p>\r\n<p>Enige gebruikte producten zijn:</p>\r\n<div class="ceebox">\r\n<div class="producten">; <a title="Jquery" href="{SYSVAR:MEDIA_REL}/groot/jquerylogo.png"><img alt="" src="{SYSVAR:MEDIA_REL}/jquerylogo.png" /></a> <a title="PHP" href="{SYSVAR:MEDIA_REL}/php_logo.png"><img alt="" src="{SYSVAR:MEDIA_REL}/php_logo.png" /></a> <a title="MySQL" href="{SYSVAR:MEDIA_REL}/mysql-logo.png"><img alt="" src="{SYSVAR:MEDIA_REL}/mysql-logo.png" /></a>  <a title="Linux" href="{SYSVAR:MEDIA_REL}/220px-Tux.svg.png"><img alt="" src="{SYSVAR:MEDIA_REL}/220px-Tux.svg.png" /></a> <a title="Apache " href="{SYSVAR:MEDIA_REL}/apache_logo.jpg"><img src="{SYSVAR:MEDIA_REL}/apache_logo.jpg" alt="" /></a>  <a title="PhpMyAdmin" href="{SYSVAR:MEDIA_REL}/phpMyAdmin-Logo.png"><img src="{SYSVAR:MEDIA_REL}/phpMyAdmin-Logo.png" alt="" /></a> <a title="Firebug" href="{SYSVAR:MEDIA_REL}//Firebug.png"><img src="{SYSVAR:MEDIA_REL}//Firebug.png" alt="" /></a>   <a title="Gimp" href="{SYSVAR:MEDIA_REL}/groot/jquerylogo.png"><img src="{SYSVAR:MEDIA_REL}/TheGiMP24logo1.gif" alt="" /></a> <a title="Firefox" href="{SYSVAR:MEDIA_REL}/Firefox_4.jpg"><img src="{SYSVAR:MEDIA_REL}/Firefox_4.jpg" alt="" /></a></div>\r\n</div>'),
(3, 3, '<h1>WebsiteBaker</h1>\r\n<p>[[LibLoader]]</p>\r\n<p>Deze site is gerealiseerd met behulp het het <a href="http://nl.wikipedia.org/wiki/WebsiteBaker">WebsiteBaker</a> CMS. Het doel van de site is ten eerste een visite kaartje voor mij te zijn. Verder is het een mooi platform om enige mogelijkheden van WebsiteBaker te laten zien.<br />\r\n<br />\r\nMijn motto tijdens het ontwerpen was het zogenaamde <a href="http://nl.wikipedia.org/wiki/KISS-principe" target="_blank">KISS-principe</a> en less is more. Liever een eenvoudige overzichtelijke site met een wat betere performance, dan veel toeters en bellen, maar traag.</p>\r\n<p>Ik heb getracht zoveel mogelijk gebruik te maken van basis functionaliteit van het WebsiteBaker CMS. Verder heb ik functionaliteit toegevoegd door een aantal modules uit de WebsiteBaker Community te installeren. Ik maak o.a gebruik van de <a target="_blank" href="http://jquery.lepton-cms.org/">LibraryAdmin/jQuery</a> module, waardoor het mogelijk wordt om de plugin''s uit de zogenaamde <a href="http://nl.wikipedia.org/wiki/JQuery" target="_blank">jQuery</a> bibliotheek op de website te gebruiken.<br />\r\nEen van deze plugin''s is de <a href="http://jquery.lepton-cms.org/plugins/foldergallery/jq-pirobox.php" target="_blank">Pirobox</a> plugin, klik maar eens op een van de onderstaande afbeeldingen en de plugin komt in actie.<br />\r\nOp de site van <a href="http://jquery.lepton-cms.org/plugins/general-view.php">Lepton</a> is een overzicht van de vele plugin welke in potentie op een WebsiteBaker welke site kunnen worden gebruikt.</p>\r\n<p>Tevens heb ik een aantal maatregelen genomen, die er toe bijdragen dat de site met de Google zoekmachine gevonden wordt. Dit proces noemt je SEO (Search Engine Optimalization). Klik op de volgende link om te zien, waar de site in de resulaten van de zoekamachine verschijnt <a target="_blank" href="https://www.google.nl/search?site=&amp;source=hp&amp;q=drupal+specialist+jeroenos&amp;oq=drupal+specialist+jeroenos">Google drupal specialist jeroenos</a></p>\r\n<p>Enige gebruikte producten zijn:</p>\r\n<div class="ceebox">\r\n<div class="producten">; <a href="{SYSVAR:MEDIA_REL}/groot/jquerylogo.png" title="Jquery"><img src="{SYSVAR:MEDIA_REL}/jquerylogo.png" alt="" /></a> <a href="{SYSVAR:MEDIA_REL}/php_logo.png" title="PHP"><img src="{SYSVAR:MEDIA_REL}/php_logo.png" alt="" /></a> <a href="{SYSVAR:MEDIA_REL}/mysql-logo.png" title="MySQL"><img src="{SYSVAR:MEDIA_REL}/mysql-logo.png" alt="" /></a>  <a href="{SYSVAR:MEDIA_REL}/220px-Tux.svg.png" title="Linux"><img src="{SYSVAR:MEDIA_REL}/220px-Tux.svg.png" alt="" /></a> <a href="{SYSVAR:MEDIA_REL}/apache_logo.jpg" title="Apache "><img alt="" src="{SYSVAR:MEDIA_REL}/apache_logo.jpg" /></a>  <a href="{SYSVAR:MEDIA_REL}/phpMyAdmin-Logo.png" title="PhpMyAdmin"><img alt="" src="{SYSVAR:MEDIA_REL}/phpMyAdmin-Logo.png" /></a> <a href="{SYSVAR:MEDIA_REL}//Firebug.png" title="Firebug"><img alt="" src="{SYSVAR:MEDIA_REL}//Firebug.png" /></a>   <a href="{SYSVAR:MEDIA_REL}/groot/jquerylogo.png" title="Gimp"><img alt="" src="{SYSVAR:MEDIA_REL}/TheGiMP24logo1.gif" /></a> <a href="{SYSVAR:MEDIA_REL}/Firefox_4.jpg" title="Firefox"><img alt="" src="{SYSVAR:MEDIA_REL}/Firefox_4.jpg" /></a></div>\r\n</div>', '<h1>WebsiteBaker</h1>\r\n<p>[[LibLoader]]</p>\r\n<p>Deze site is gerealiseerd met behulp het het <a href="http://nl.wikipedia.org/wiki/WebsiteBaker">WebsiteBaker</a> CMS. Het doel van de site is ten eerste een visite kaartje voor mij te zijn. Verder is het een mooi platform om enige mogelijkheden van WebsiteBaker te laten zien.<br />\r\n<br />\r\nMijn motto tijdens het ontwerpen was het zogenaamde <a href="http://nl.wikipedia.org/wiki/KISS-principe" target="_blank">KISS-principe</a> en less is more. Liever een eenvoudige overzichtelijke site met een wat betere performance, dan veel toeters en bellen, maar traag.</p>\r\n<p>Ik heb getracht zoveel mogelijk gebruik te maken van basis functionaliteit van het WebsiteBaker CMS. Verder heb ik functionaliteit toegevoegd door een aantal modules uit de WebsiteBaker Community te installeren. Ik maak o.a gebruik van de <a target="_blank" href="http://jquery.lepton-cms.org/">LibraryAdmin/jQuery</a> module, waardoor het mogelijk wordt om de plugin''s uit de zogenaamde <a href="http://nl.wikipedia.org/wiki/JQuery" target="_blank">jQuery</a> bibliotheek op de website te gebruiken.<br />\r\nEen van deze plugin''s is de <a href="http://jquery.lepton-cms.org/plugins/foldergallery/jq-pirobox.php" target="_blank">Pirobox</a> plugin, klik maar eens op een van de onderstaande afbeeldingen en de plugin komt in actie.<br />\r\nOp de site van <a href="http://jquery.lepton-cms.org/plugins/general-view.php">Lepton</a> is een overzicht van de vele plugin welke in potentie op een WebsiteBaker welke site kunnen worden gebruikt.</p>\r\n<p>Tevens heb ik een aantal maatregelen genomen, die er toe bijdragen dat de site met de Google zoekmachine gevonden wordt. Dit proces noemt je SEO (Search Engine Optimalization). Klik op de volgende link om te zien, waar de site in de resulaten van de zoekamachine verschijnt <a target="_blank" href="https://www.google.nl/search?site=&amp;source=hp&amp;q=drupal+specialist+jeroenos&amp;oq=drupal+specialist+jeroenos">Google drupal specialist jeroenos</a></p>\r\n<p>Enige gebruikte producten zijn:</p>\r\n<div class="ceebox">\r\n<div class="producten">; <a href="{SYSVAR:MEDIA_REL}/groot/jquerylogo.png" title="Jquery"><img src="{SYSVAR:MEDIA_REL}/jquerylogo.png" alt="" /></a> <a href="{SYSVAR:MEDIA_REL}/php_logo.png" title="PHP"><img src="{SYSVAR:MEDIA_REL}/php_logo.png" alt="" /></a> <a href="{SYSVAR:MEDIA_REL}/mysql-logo.png" title="MySQL"><img src="{SYSVAR:MEDIA_REL}/mysql-logo.png" alt="" /></a>  <a href="{SYSVAR:MEDIA_REL}/220px-Tux.svg.png" title="Linux"><img src="{SYSVAR:MEDIA_REL}/220px-Tux.svg.png" alt="" /></a> <a href="{SYSVAR:MEDIA_REL}/apache_logo.jpg" title="Apache "><img alt="" src="{SYSVAR:MEDIA_REL}/apache_logo.jpg" /></a>  <a href="{SYSVAR:MEDIA_REL}/phpMyAdmin-Logo.png" title="PhpMyAdmin"><img alt="" src="{SYSVAR:MEDIA_REL}/phpMyAdmin-Logo.png" /></a> <a href="{SYSVAR:MEDIA_REL}//Firebug.png" title="Firebug"><img alt="" src="{SYSVAR:MEDIA_REL}//Firebug.png" /></a>   <a href="{SYSVAR:MEDIA_REL}/groot/jquerylogo.png" title="Gimp"><img alt="" src="{SYSVAR:MEDIA_REL}/TheGiMP24logo1.gif" /></a> <a href="{SYSVAR:MEDIA_REL}/Firefox_4.jpg" title="Firefox"><img alt="" src="{SYSVAR:MEDIA_REL}/Firefox_4.jpg" /></a></div>\r\n</div>'),
(7, 6, '<p>[[LibLoader]]&nbsp;</p>\r\n<p>Dit is een demo van de Applezoom plugin</p>\r\n<div id="iphone">\r\n<div id="webpage"><img width="398" height="225" alt="" src="{SYSVAR:MEDIA_REL}/me.jpg" /></div>\r\n<div id="retina">&nbsp;</div>\r\n</div>', '<p>[[LibLoader]]&nbsp;</p>\r\n<p>Dit is een demo van de Applezoom plugin</p>\r\n<div id="iphone">\r\n<div id="webpage"><img width="398" height="225" alt="" src="{SYSVAR:MEDIA_REL}/me.jpg" /></div>\r\n<div id="retina">&nbsp;</div>\r\n</div>'),
(9, 8, '<p>[[LibLoader]]</p>\r\n<div class="ceebox"><a href="{SYSVAR:MEDIA_REL}/groot/me.jpg" title="It''s me again ..."><img width="72" height="72" src="{SYSVAR:MEDIA_REL}/me.jpg" alt="" /></a> <a href="{SYSVAR:MEDIA_REL}/groot/j_l_brommer_groot.jpg" title="Johnny and Lisa"><img width="84" height="72" src="{SYSVAR:MEDIA_REL}/j_l_brommer.png" alt="" /></a>&nbsp;&nbsp;</div>', '<p>[[LibLoader]]</p>\r\n<div class="ceebox"><a href="{SYSVAR:MEDIA_REL}/groot/me.jpg" title="It''s me again ..."><img width="72" height="72" src="{SYSVAR:MEDIA_REL}/me.jpg" alt="" /></a> <a href="{SYSVAR:MEDIA_REL}/groot/j_l_brommer_groot.jpg" title="Johnny and Lisa"><img width="84" height="72" src="{SYSVAR:MEDIA_REL}/j_l_brommer.png" alt="" /></a>&nbsp;&nbsp;</div>'),
(22, 21, '<h1>Youtube</h1>\r\n<p>Het is eenvoudig om inhoud van andere site''s te integreren of embedden. De onderstaande video staat op de Youtube site, maar het lijkt nu of hij op deze site staat.</p>\r\n<div class="afbeelding"><iframe width="600" height="400" frameborder="1" style="margin-right: 20px;" allowfullscreen="" src="https://www.youtube.com/embed/xn9LQZ5tdys?feature=player_detailpage"> \r\n  </iframe></div>\r\n<h1>Google Maps</h1>\r\n<p>En de onderstaande kaart staat op Google maps:</p>\r\n<div class="afbeelding"><iframe width="600" height="450" frameborder="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2387.3333164228598!2d6.591996499999991!3d53.24772625000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c9d286c03c0d2f%3A0x1300de5a70357e92!2s9737+SP+Groningen!5e0!3m2!1snl!2snl!4v1430832289363" style="border:0"></iframe></div>\r\n<div class="afbeelding">&nbsp;</div>\r\n<h1>&nbsp;Weerbericht</h1>\r\n<p><iframe align="left" width="120" height="224" frameborder="5" src="http://www.wetter24.de/meteo/hptool/index.php?cid=31X7099&amp;cityName=Groningen&amp;l=nl&amp;style=11&amp;v=de&amp;ver=2&amp;c1=000000&amp;c2=f8b920&amp;c3=000000&amp;c4=f8b920&amp;c5=000000&amp;c6=f8b920&amp;c7=f8b920&amp;f1a=1&amp;f1b=1&amp;f2a=1&amp;f2b=1&amp;f3a=1&amp;f3b=1&amp;ct1=1&amp;ct2=2&amp;ct3=6&amp;ct4=11&amp;ct5=12&amp;fcd=0" scrolling="no" style="margin-right: 20px;">\r\n</iframe> Het weerbericht van Groningen op je site ...&nbsp;</p>', '<h1>Youtube</h1>\r\n<p>Het is eenvoudig om inhoud van andere site''s te integreren of embedden. De onderstaande video staat op de Youtube site, maar het lijkt nu of hij op deze site staat.</p>\r\n<div class="afbeelding"><iframe width="600" height="400" frameborder="1" style="margin-right: 20px;" allowfullscreen="" src="https://www.youtube.com/embed/xn9LQZ5tdys?feature=player_detailpage"> \r\n  </iframe></div>\r\n<h1>Google Maps</h1>\r\n<p>En de onderstaande kaart staat op Google maps:</p>\r\n<div class="afbeelding"><iframe width="600" height="450" frameborder="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2387.3333164228598!2d6.591996499999991!3d53.24772625000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c9d286c03c0d2f%3A0x1300de5a70357e92!2s9737+SP+Groningen!5e0!3m2!1snl!2snl!4v1430832289363" style="border:0"></iframe></div>\r\n<div class="afbeelding">&nbsp;</div>\r\n<h1>&nbsp;Weerbericht</h1>\r\n<p><iframe align="left" width="120" height="224" frameborder="5" src="http://www.wetter24.de/meteo/hptool/index.php?cid=31X7099&amp;cityName=Groningen&amp;l=nl&amp;style=11&amp;v=de&amp;ver=2&amp;c1=000000&amp;c2=f8b920&amp;c3=000000&amp;c4=f8b920&amp;c5=000000&amp;c6=f8b920&amp;c7=f8b920&amp;f1a=1&amp;f1b=1&amp;f2a=1&amp;f2b=1&amp;f3a=1&amp;f3b=1&amp;ct1=1&amp;ct2=2&amp;ct3=6&amp;ct4=11&amp;ct5=12&amp;fcd=0" scrolling="no" style="margin-right: 20px;">\r\n</iframe> Het weerbericht van Groningen op je site ...&nbsp;</p>'),
(23, 22, '<p>De mogelijkeheden van WebsiteBaker zijn erg groot. <br />\r\nEen website kan worden uitgebreid en helemaal op maat worden gemaakt, doordat er zelf of door derden geschreven code kan worden&nbsp; toegevoegd.<br />\r\nVia het menu van deze pagina laat ik enige mogelijkheden zien.</p>\r\n<p>&nbsp;</p>', '<p>De mogelijkeheden van WebsiteBaker zijn erg groot. <br />\r\nEen website kan worden uitgebreid en helemaal op maat worden gemaakt, doordat er zelf of door derden geschreven code kan worden&nbsp; toegevoegd.<br />\r\nVia het menu van deze pagina laat ik enige mogelijkheden zien.</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `wb_pages`
--

CREATE TABLE IF NOT EXISTS `wb_pages` (
  `page_id` int(11) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `root_parent` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `target` varchar(7) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `page_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `menu_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `page_trail` text COLLATE utf8_unicode_ci NOT NULL,
  `template` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `visibility` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `position` int(11) NOT NULL DEFAULT '0',
  `menu` int(11) NOT NULL DEFAULT '0',
  `language` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `searching` int(11) NOT NULL DEFAULT '0',
  `admin_groups` text COLLATE utf8_unicode_ci NOT NULL,
  `admin_users` text COLLATE utf8_unicode_ci NOT NULL,
  `viewing_groups` text COLLATE utf8_unicode_ci NOT NULL,
  `viewing_users` text COLLATE utf8_unicode_ci NOT NULL,
  `modified_when` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_pages`
--

INSERT INTO `wb_pages` (`page_id`, `parent`, `root_parent`, `level`, `link`, `target`, `page_title`, `menu_title`, `description`, `keywords`, `page_trail`, `template`, `visibility`, `position`, `menu`, `language`, `searching`, `admin_groups`, `admin_users`, `viewing_groups`, `viewing_users`, `modified_when`, `modified_by`) VALUES
(1, 0, 0, 0, '/doelgericht-webdesign', '_top', 'Doelgericht webdesign', 'Doelgericht webdesign', '', '', '1', '', 'public', 1, 1, 'EN', 1, '1,2', '', '1', '1,2', 1430837525, 2),
(2, 0, 2, 0, '/over-mij', '_top', 'Over mij', 'Over mij', '', '', '2', '', 'public', 3, 1, 'EN', 1, '1,2', '', '1', '1,2', 1430837914, 2),
(3, 0, 3, 0, '/deze-site', '_top', 'Deze site', 'Deze site', '', '', '3', '', 'public', 4, 1, 'EN', 1, '1,2', '', '1', '1,2', 1430838212, 2),
(10, 0, 0, 0, '/blog', '_top', 'Blog', 'Blog', '', '', '10', '', 'public', 2, 1, 'EN', 1, '1,2', '', '1', '1,2', 1430731355, 1),
(6, 22, 22, 1, '/showcase/applezoom-voorbeeld', '_top', 'AppleZoom Voorbeeld', 'AppleZoom Voorbeeld', '', '', '22,6', '', 'public', 1, 1, 'EN', 1, '1,2', '', '1', '1,2', 1430837995, 2),
(8, 22, 22, 1, '/showcase/ceebox-fotogallerij', '_top', 'Ceebox fotogallerij', 'Ceebox fotogallerij', '', '', '22,8', '', 'public', 2, 1, 'EN', 1, '1,2', '', '1', '1,2', 1430838099, 2),
(12, 0, 12, 0, '/contact', '_top', 'Contact', 'Contact', '', '', '12', '', 'public', 7, 1, 'EN', 1, '1,2', '', '1', '1,2', 1430771723, 1),
(25, 0, 0, 0, '/faq', '_top', 'Faq', 'Faq', '', '', '25', '', 'public', 6, 1, 'EN', 1, '1,2', '', '1', '1,2', 1430835333, 2),
(21, 22, 22, 1, '/showcase/multimedia-embedden', '_top', 'Multimedia embedden', 'Multimedia embedden', '', '', '22,21', '', 'public', 3, 1, 'EN', 1, '1,2', '', '2,1', '1,2', 1430834823, 2),
(22, 0, 22, 0, '/showcase', '_top', 'Showcase', 'Showcase', '', '', '22', '', 'public', 5, 1, 'EN', 1, '1,2', '', '2,1', '1,2', 1430835003, 2),
(24, 22, 22, 1, '/showcase/tweakers-rss-feed', '_top', 'Tweakers rss feed', 'Tweakers rss feed', '', '', '22,24', '', 'public', 4, 1, 'EN', 1, '1,2', '', '1', '1,2', 1430819902, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wb_search`
--

CREATE TABLE IF NOT EXISTS `wb_search` (
  `search_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `extra` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_search`
--

INSERT INTO `wb_search` (`search_id`, `name`, `value`, `extra`) VALUES
(1, 'header', '<h1>[TEXT_SEARCH]</h1>\r\n\r\n<form name="searchpage" action="[WB_URL]/search/index.php" method="get">\r\n<table cellpadding="3" cellspacing="0" border="0" width="500">\r\n<tr>\r\n<td>\r\n<input type="hidden" name="search_path" value="[SEARCH_PATH]" />\r\n<input type="text" name="string" value="[SEARCH_STRING]" style="width: 100%;" />\r\n</td>\r\n<td width="150">\r\n<input type="submit" value="[TEXT_SEARCH]" style="width: 100%;" />\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan="2">\r\n<input type="radio" name="match" id="match_all" value="all"[ALL_CHECKED] />\r\n<label for="match_all">[TEXT_ALL_WORDS]</label>\r\n<input type="radio" name="match" id="match_any" value="any"[ANY_CHECKED] />\r\n<label for="match_any">[TEXT_ANY_WORDS]</label>\r\n<input type="radio" name="match" id="match_exact" value="exact"[EXACT_CHECKED] />\r\n<label for="match_exact">[TEXT_EXACT_MATCH]</label>\r\n</td>\r\n</tr>\r\n</table>\r\n\r\n</form>\r\n\r\n<hr />\r\n    ', ''),
(2, 'footer', '', ''),
(3, 'results_header', '[TEXT_RESULTS_FOR] ''<b>[SEARCH_STRING]</b>'':\r\n<table cellpadding="2" cellspacing="0" border="0" width="100%" style="padding-top: 10px;">', ''),
(4, 'results_loop', '<tr style="background-color: #F0F0F0;">\r\n<td><a href="[LINK]">[TITLE]</a></td>\r\n<td align="right">[TEXT_LAST_UPDATED_BY] [DISPLAY_NAME] ([USERNAME]) [TEXT_ON] [DATE]</td>\r\n</tr>\r\n<tr><td colspan="2" style="text-align: justify; padding-bottom: 5px;">[DESCRIPTION]</td></tr>\r\n<tr><td colspan="2" style="text-align: justify; padding-bottom: 10px;">[EXCERPT]</td></tr>', ''),
(5, 'results_footer', '</table>', ''),
(6, 'no_results', '<tr><td><p>[TEXT_NO_RESULTS]</p></td></tr>', ''),
(7, 'module_order', 'faqbaker,manual,wysiwyg', ''),
(8, 'max_excerpt', '15', ''),
(9, 'time_limit', '0', ''),
(10, 'cfg_enable_old_search', 'true', ''),
(11, 'cfg_search_keywords', 'true', ''),
(12, 'cfg_search_description', 'true', ''),
(13, 'cfg_show_description', 'true', ''),
(14, 'cfg_enable_flush', 'false', ''),
(15, 'template', '', ''),
(16, 'module', 'code', 'a:6:{s:7:"page_id";s:7:"page_id";s:5:"title";s:10:"page_title";s:4:"link";s:4:"link";s:11:"description";s:11:"description";s:13:"modified_when";s:13:"modified_when";s:11:"modified_by";s:11:"modified_by";}'),
(17, 'query_start', 'SELECT [TP]pages.page_id, [TP]pages.page_title,	[TP]pages.link, [TP]pages.description, [TP]pages.modified_when, [TP]pages.modified_by	FROM [TP]mod_code, [TP]pages WHERE ', 'code'),
(18, 'query_body', ' [TP]pages.page_id = [TP]mod_code.page_id AND [TP]mod_code.content [O] ''[W][STRING][W]'' AND [TP]pages.searching = ''1''', 'code'),
(19, 'query_end', '', 'code'),
(26, 'query_body', ' [TP]pages.page_id = [TP]mod_newsreader.page_id AND [TP]mod_newsreader.content [O] ''[W][STRING][W]'' AND [TP]pages.searching = ''1''', 'newsreader'),
(25, 'query_start', 'SELECT [TP]pages.page_id, [TP]pages.page_title, [TP]pages.link, [TP]pages.description, [TP]pages.modified_when, [TP]pages.modified_by FROM [TP]mod_newsreader, [TP]pages WHERE ', 'newsreader'),
(24, 'module', 'newsreader', 'a:6:{s:7:"page_id";s:7:"page_id";s:5:"title";s:10:"page_title";s:4:"link";s:4:"link";s:11:"description";s:11:"description";s:13:"modified_when";s:13:"modified_when";s:11:"modified_by";s:11:"modified_by";}'),
(27, 'query_end', '', 'newsreader'),
(28, 'module', 'faqbaker', 'a:6:{s:7:"page_id";s:7:"page_id";s:5:"title";s:10:"page_title";s:4:"link";s:4:"link";s:11:"description";s:11:"description";s:13:"modified_when";s:13:"modified_when";s:11:"modified_by";s:11:"modified_by";}'),
(29, 'query_start', 'SELECT [TP]pages.page_id, [TP]pages.page_title,	[TP]pages.link, [TP]pages.description, [TP]pages.modified_when, [TP]pages.modified_by	FROM [TP]mod_faq_questions, [TP]pages WHERE ', 'faqbaker'),
(30, 'query_body', '\r\n	[TP]pages.page_id = [TP]mod_faq_questions.page_id AND [TP]mod_faq_questions.question LIKE ''%[STRING]%''\r\n	OR [TP]pages.page_id = [TP]mod_faq_questions.page_id AND [TP]mod_faq_questions.answer LIKE ''%[STRING]%'' ', 'faqbaker'),
(31, 'query_end', '', 'faqbaker');

-- --------------------------------------------------------

--
-- Table structure for table `wb_sections`
--

CREATE TABLE IF NOT EXISTS `wb_sections` (
  `section_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `block` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `publ_start` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `publ_end` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_sections`
--

INSERT INTO `wb_sections` (`section_id`, `page_id`, `position`, `module`, `block`, `publ_start`, `publ_end`) VALUES
(1, 1, 1, 'wysiwyg', '1', '0', '0'),
(2, 2, 1, 'wysiwyg', '1', '0', '0'),
(3, 3, 1, 'wysiwyg', '1', '0', '0'),
(11, 10, 1, 'news', '1', '0', '0'),
(7, 6, 1, 'wysiwyg', '1', '0', '0'),
(9, 8, 1, 'wysiwyg', '1', '0', '0'),
(13, 12, 1, 'form', '1', '0', '0'),
(25, 24, 1, 'newsreader', '1', '0', '0'),
(26, 25, 1, 'faqbaker', '1', '0', '0'),
(22, 21, 1, 'wysiwyg', '1', '0', '0'),
(23, 22, 1, 'wysiwyg', '1', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `wb_settings`
--

CREATE TABLE IF NOT EXISTS `wb_settings` (
  `setting_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_settings`
--

INSERT INTO `wb_settings` (`setting_id`, `name`, `value`) VALUES
(1, 'website_description', ''),
(2, 'website_keywords', ''),
(3, 'website_header', ''),
(4, 'website_footer', 'Powered by Websitebaker'),
(5, 'wysiwyg_style', 'font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;'),
(6, 'er_level', '6135'),
(7, 'sec_anchor', 'wb_'),
(8, 'default_date_format', 'M d Y'),
(9, 'default_time_format', 'g:i A'),
(10, 'redirect_timer', '1500'),
(11, 'home_folders', 'true'),
(12, 'warn_page_leave', '1'),
(13, 'default_template', 'response-blue'),
(14, 'default_theme', 'wb_theme'),
(15, 'default_charset', 'utf-8'),
(16, 'multiple_menus', 'true'),
(17, 'page_level_limit', '4'),
(18, 'intro_page', 'false'),
(19, 'page_trash', 'disabled'),
(20, 'homepage_redirection', 'false'),
(21, 'page_languages', 'true'),
(22, 'wysiwyg_editor', 'fckeditor'),
(23, 'manage_sections', 'true'),
(24, 'section_blocks', 'true'),
(25, 'smart_login', 'true'),
(26, 'frontend_login', 'false'),
(27, 'frontend_signup', 'false'),
(28, 'search', 'public'),
(29, 'page_extension', '.php'),
(30, 'page_spacer', '-'),
(31, 'pages_directory', '/pages'),
(32, 'rename_files_on_upload', 'ph.*?,cgi,pl,pm,exe,com,bat,pif,cmd,src,asp,aspx,js'),
(33, 'media_directory', '/media'),
(34, 'wbmailer_routine', 'phpmail'),
(35, 'wbmailer_default_sendername', 'WB Mailer'),
(36, 'wbmailer_smtp_host', ''),
(37, 'wbmailer_smtp_auth', '1'),
(38, 'wbmailer_smtp_username', ''),
(39, 'wbmailer_smtp_password', ''),
(40, 'fingerprint_with_ip_octets', '2'),
(41, 'secure_form_module', 'mtab'),
(42, 'mediasettings', ''),
(43, 'wb_version', '2.8.3'),
(44, 'wb_revision', '1640'),
(45, 'wb_sp', 'SP3'),
(46, 'website_title', 'Jeroenos Webdesign'),
(47, 'default_language', 'EN'),
(48, 'app_name', 'wb_2756'),
(49, 'default_timezone', '7200'),
(50, 'operating_system', 'linux'),
(51, 'string_file_mode', '0666'),
(52, 'string_dir_mode', '0755'),
(53, 'server_email', 'admin@mail.com'),
(54, 'wb_secform_secret', '5609bnefg93jmgi99igjefg'),
(55, 'wb_secform_secrettime', '86400'),
(56, 'wb_secform_timeout', '7200'),
(57, 'wb_secform_tokenname', 'formtoken'),
(58, 'wb_secform_usefp', 'true'),
(59, 'wb_secform_useip', '2');

-- --------------------------------------------------------

--
-- Table structure for table `wb_users`
--

CREATE TABLE IF NOT EXISTS `wb_users` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `groups_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `remember_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `last_reset` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `timezone` int(11) NOT NULL DEFAULT '0',
  `date_format` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `time_format` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `language` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'DE',
  `home_folder` text COLLATE utf8_unicode_ci NOT NULL,
  `login_when` int(11) NOT NULL DEFAULT '0',
  `login_ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wb_users`
--

INSERT INTO `wb_users` (`user_id`, `group_id`, `groups_id`, `active`, `username`, `password`, `remember_key`, `last_reset`, `display_name`, `email`, `timezone`, `date_format`, `time_format`, `language`, `home_folder`, `login_when`, `login_ip`) VALUES
(1, 1, '1', 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 0, 'Administrator', 'admin@mail.com', 7200, '', '', 'EN', '', 1430835239, '127.0.0.1'),
(2, 2, '2', 1, 'jeroen', '324905aefb58c08771149a326741025c', '', 0, 'Jeroen de Jong', 'jongje@yahoo.com', -72000, '', '', 'EN', '', 1430837258, '127.0.0.1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wb_addons`
--
ALTER TABLE `wb_addons`
  ADD PRIMARY KEY (`addon_id`);

--
-- Indexes for table `wb_groups`
--
ALTER TABLE `wb_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `wb_mod_code`
--
ALTER TABLE `wb_mod_code`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `wb_mod_cwsoft-addon-file-editor`
--
ALTER TABLE `wb_mod_cwsoft-addon-file-editor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wb_mod_droplets`
--
ALTER TABLE `wb_mod_droplets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wb_mod_faq_categories`
--
ALTER TABLE `wb_mod_faq_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `wb_mod_faq_questions`
--
ALTER TABLE `wb_mod_faq_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `wb_mod_faq_settings`
--
ALTER TABLE `wb_mod_faq_settings`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `wb_mod_form_fields`
--
ALTER TABLE `wb_mod_form_fields`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `wb_mod_form_settings`
--
ALTER TABLE `wb_mod_form_settings`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `wb_mod_form_submissions`
--
ALTER TABLE `wb_mod_form_submissions`
  ADD PRIMARY KEY (`submission_id`);

--
-- Indexes for table `wb_mod_jsadmin`
--
ALTER TABLE `wb_mod_jsadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wb_mod_menu_link`
--
ALTER TABLE `wb_mod_menu_link`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `wb_mod_newsreader`
--
ALTER TABLE `wb_mod_newsreader`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `wb_mod_news_comments`
--
ALTER TABLE `wb_mod_news_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `wb_mod_news_groups`
--
ALTER TABLE `wb_mod_news_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `wb_mod_news_posts`
--
ALTER TABLE `wb_mod_news_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `wb_mod_news_settings`
--
ALTER TABLE `wb_mod_news_settings`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `wb_mod_wrapper`
--
ALTER TABLE `wb_mod_wrapper`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `wb_mod_wysiwyg`
--
ALTER TABLE `wb_mod_wysiwyg`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `wb_pages`
--
ALTER TABLE `wb_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `wb_search`
--
ALTER TABLE `wb_search`
  ADD PRIMARY KEY (`search_id`);

--
-- Indexes for table `wb_sections`
--
ALTER TABLE `wb_sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `wb_settings`
--
ALTER TABLE `wb_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `wb_users`
--
ALTER TABLE `wb_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wb_addons`
--
ALTER TABLE `wb_addons`
  MODIFY `addon_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `wb_groups`
--
ALTER TABLE `wb_groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wb_mod_cwsoft-addon-file-editor`
--
ALTER TABLE `wb_mod_cwsoft-addon-file-editor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wb_mod_droplets`
--
ALTER TABLE `wb_mod_droplets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `wb_mod_faq_categories`
--
ALTER TABLE `wb_mod_faq_categories`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wb_mod_faq_questions`
--
ALTER TABLE `wb_mod_faq_questions`
  MODIFY `question_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `wb_mod_form_fields`
--
ALTER TABLE `wb_mod_form_fields`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `wb_mod_form_submissions`
--
ALTER TABLE `wb_mod_form_submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wb_mod_news_comments`
--
ALTER TABLE `wb_mod_news_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wb_mod_news_groups`
--
ALTER TABLE `wb_mod_news_groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wb_mod_news_posts`
--
ALTER TABLE `wb_mod_news_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wb_pages`
--
ALTER TABLE `wb_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `wb_search`
--
ALTER TABLE `wb_search`
  MODIFY `search_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `wb_sections`
--
ALTER TABLE `wb_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `wb_settings`
--
ALTER TABLE `wb_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `wb_users`
--
ALTER TABLE `wb_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
