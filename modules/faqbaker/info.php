<?php


/*
 Website Baker Project <http://www.websitebaker.org/>
 Copyright (C) 2004-2007, Ryan Djurovich

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

/*
v1.45
Whats New (thorn, doc, 2007/08/24)
- Some fixes for UTF-8 and umlauts-handling.
- bugfix: under some circumstances it was possible to add a question without a category, with the result,
  that this question couldn't be edited or deleted anymore.
- some more fixes to consider magic quotes settings in php.ini:
  replaced stripslashes() with the WB function strip_slashes()
  replaced addslashes() with the WB function add_slashes()
- fix: replaced preg_replace() by strtr() in view.php, because preg_replace() can't handle '$' in cat/question-string.

v1.4.3
Whats New (Ploc 2007/08/20 plub2007@acampado.net)
+ Added french language file.

v1.4.2
Whats New (Ploc 2007/08/11 plub2007@acampado.net)
+ Added stripslashes that were missing since the adding of addslashes.

v1.4.1 
Whats New (Robert Joseph 2007/05/25 websitebaker@vizmotion.com)
+ Added addslashes to the saving of questions, answers and categories. This allows 
    questions and answers to have ' in them.
    
v1.4
Whats New (Rob Smith 2006/11/08) 
+ Fixed special chars problem in answers when HTMLArea is used

v1.3
Whats New (Matthias Gallas 2006/11/08) 
+ Fixed missing back to top link
+ Fixed special chars problem in answers

v1.2
Whats New (Matthias Gallas 2006/11/05) 
+ Added Questions and answers are searchable now
+ Added multilanguage support
+ Added german language file
+ Fixed all Copyright notices
+ Fixed old entries in the info.php
+ Fixed install script now supports MySql5 strict mode
+ Fixed categories with no names couldn't be stored anymore
+ Changed the whole layout of the Modify windows
+ Changed Minor changes in the view.php for header and footer

v1.1
Whats New (RobSmith 2006/10/08) 
+ Corrections to make it support multiple sections within a single site
+ WYSIWYG Addition
*/

$module_directory = 'faqbaker';
$module_name = 'F.A.Q. Baker';
$module_function = 'page';
$module_version = '1.46';
$module_platform = '2.6.x';
$module_author = 'Craig Rodway, Rob Smith, Matthias Gallas, ploc, thorn, doc';
$module_license = 'GNU General Public License';
$module_description = 'A Frequently Asked Questions manager.';

?>
