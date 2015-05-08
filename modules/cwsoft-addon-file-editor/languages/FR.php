<?php
/**
 * Admin tool: cwsoft-addon-file-editor
 *
 * This tool allows you to "edit", "delete", "create", "upload" or "backup" files of installed 
 * Add-ons such as modules, templates and languages via the WebsiteBaker backend. This enables
 * you to perform small modifications on installed Add-ons without downloading the files first.
 *
 * This file contains the French text outputs of the module.
 * 
 * LICENSE: GNU General Public License 3.0
 * 
 * @platform    CMS WebsiteBaker 2.8.x
 * @package     cwsoft-addon-file-editor
 * @author      cwsoft (http://cwsoft.de)
 * @translation quinto
 * @copyright   cwsoft
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
*/

// German module description
$module_description = 'Le module cwsoft-addon-file-editor est un outil qui permet de modifier les fichiers textes et images des extensions install&eacute;es. Vous trouverez plus de d&eacute;tails sur <a href="https://github.com/cwsoft/websitebaker-addon-file-editor#readme">GitHub</a>.';

// initialize global $LANG variable as array if needed
global $LANG;
if (! isset($LANG) || (isset($LANG) && ! is_array($LANG))) {
    $LANG = array();
}

// Text outputs overview page (templates/addons_overview.htt)
$LANG['ADDON_FILE_EDITOR'][1] = array(
    'TXT_DESCRIPTION'               => 'La liste ci-dessous montre toutes les extensions lisibles par PHP. Vous pouvez modifier les fichiers en ' .
									   'cliquant sur le nom de l&apos;extension. L&apos;ic&ocirc;ne de t&eacute;l&eacute;chargement permet de cr&eacute;er instantan&eacute;ment ' .
									   'une sauvegarde installable de votre extension.',
    'TXT_FTP_NOTICE'                => 'Les extensions soulign&eacute;es en rouge ne sont pas modifiables par PHP. Cela peut arriver en cas '.
									   'd&apos;installation de l&apos;extension via FTP. Vous aurez besoin d&apos;<a class="link" target="_blank" href="{URL_ASSISTANT}">' .
                                       'activer le support FTP </a> afin de modifier les fichiers de ces extensions.',
    'TXT_HEADING'                   => 'Extensions Install&eacute;es (Modules, Th&egrave;mes, Fichiers de Langues)',
    'TXT_HELP'                      => 'Aide',

    'TXT_RELOAD'                    => 'Recharger',
    'TXT_ACTION_EDIT'               => 'Modifier',
    'TXT_ACTION_DELETE'             => 'Supprimer',
    'TXT_FTP_SUPPORT'               => ' (Acc&egrave;s FTP en &eacute;criture requis pour modification)',

    'TXT_MODULES'                   => 'Module',
    'TXT_LIST_OF_MODULES'           => 'Liste des modules install&eacute;s',
    'TXT_EDIT_MODULE_FILES'         => 'Modifier les fichiers du module',
    'TXT_ZIP_MODULE_FILES'          => 'T&eacute;l&eacute;charger les fichiers du module',

    'TXT_TEMPLATES'                 => 'Th&egrave;mes',
    'TXT_LIST_OF_TEMPLATES'         => 'Liste des th&egrave;mes install&eacute;s',
    'TXT_EDIT_TEMPLATE_FILES'       => 'Modifier les fichiers du th&egrave;me',
    'TXT_ZIP_TEMPLATE_FILES'        => 'T&eacute;l&eacute;charger les fichiers du th&egrave;me',

    'TXT_LANGUAGES'                 => 'Fichiers de Langues',
    'TXT_LIST_OF_LANGUAGES'         => 'Liste des fichiers de Langues install&eacute;s',
    'TXT_EDIT_LANGUAGE_FILES'       => 'Modifier le fichier de langue',
    'TXT_ZIP_LANGUAGE_FILES'        => 'T&eacute;l&eacute;charger le fichier de langue',
);

// Text outputs filemanager page (templates/filemanager.htt)
$LANG['ADDON_FILE_EDITOR'][2] = array(
    'TXT_EDIT_DESCRIPTION'          => 'Le gestionnaire de fichiers permet de modifier, renommer, créeacute;er, effacer et envoyer des fichiers. '.
									   '<br />Cliquez sur les fichiers textes et images pour les ouvrir en mode modification ou visualisation.',
    'TXT_BACK_TO_OVERVIEW'          => 'retour &agrave; la vue d&apos;ensemble des Extensions',

    'TXT_MODULE'                    => 'Module',
    'TXT_TEMPLATE'                  => 'Th&egrave;me',
    'TXT_LANGUAGE'                  => 'Fichier de Langue',
    'TXT_FTP_SUPPORT'               => ' (acc&egrave;s FTP en &eacute;criture requis pour modification)',

    'TXT_RELOAD'                    => 'Recharger',
    'TXT_CREATE_FILE_FOLDER'        => 'Cr&eacute;er Fichier/Dossier',
    'TXT_UPLOAD_FILE'               => 'Envoyer un Fichier',
    'TXT_VIEW'                      => 'Visualiser',
    'TXT_EDIT'                      => 'Modifier',
    'TXT_UNZIP'                     => 'D&eacute;compacter',
    'TXT_RENAME'                    => 'Renommer',
    'TXT_DELETE'                    => 'Supprimer',

    'TXT_FILE_INFOS'                => 'Informations sur le fichier',
    'TXT_FILE_ACTIONS'              => 'Actions',
    'TXT_FILE_TYPE_TEXTFILE'        => 'Fichier texte',
    'TXT_FILE_TYPE_FOLDER'          => 'Dossier',
    'TXT_FILE_TYPE_IMAGE'           => 'Fichier image',
    'TXT_FILE_TYPE_ARCHIVE'         => 'Fichier d&apos;archive',
    'TXT_FILE_TYPE_OTHER'           => 'Fichier Inconnu',

    'DATE_FORMAT'                   => 'd/m/y / h:i a',
);

// General text outputs for the file handler templates
$LANG['ADDON_FILE_EDITOR'][3] = array(
    'ERR_WRONG_PARAMETER'           => 'Les param&egrave;tres sp&eacute;cifi&eacute;s sont incorrects ou incomplets',
    'TXT_MODULE'                    => 'Module',
    'TXT_TEMPLATE'                  => 'Th&egrave;me',
    'TXT_LANGUAGE'                  => 'Fichier de Langue',
    'TXT_ACTION'                    => 'Action',
    'TXT_ACTUAL_FILE'               => 'Fichier en Cours',
    'TXT_SUBMIT_CANCEL'             => 'Annuler',
);    

// Text outputs file handler (templates/action_handler_edit_textfile.htt)
$LANG['ADDON_FILE_EDITOR'][4] = array(
    'TXT_ACTION_EDIT_TEXTFILE'      => 'Modifier le fichier texte',
    'TXT_SUBMIT_SAVE'               => 'Sauvegarder',
    'TXT_SUBMIT_SAVE_BACK'          => 'Sauvegarder &amp; retour',
    'TXT_ACTUAL_FILE'               => 'Fichier en Cours',
    'TXT_SAVE_SUCCESS'              => 'Modifications sur le fichier Sauvegard&eacute;es.',
    'TXT_SAVE_ERROR'                => 'Impossible d&apos;enregistrer le fichier. Veuillez v&eacute;rifier les permissions.',
);

// Text outputs file handler (templates/action_handler_rename_file_folder.htt)
$LANG['ADDON_FILE_EDITOR'][5] = array(
    'TXT_ACTION_RENAME_FILE'        => 'Renommer Fichier/Dossier',
    'TXT_OLD_FILE_NAME'             => 'Fichier/Dossier (ancien)',
    'TXT_NEW_FILE_NAME'             => 'Fichier/Dossier (nouveau)',
    'TXT_SUBMIT_RENAME'             => 'Renommer',
    'TXT_RENAME_SUCCESS'            => 'Fichier/Dossier renomm&eacute; avec succ&egrave;s.',
    'TXT_RENAME_ERROR'              => 'Impossible de renommer le fichier. Veuillez v&eacute;rifier les permissions.',
    'TXT_ALLOWED_FILE_CHARS'        => '[a-zA-Z0-9.-_]',
);

// Text outputs file handler (templates/action_handler_delete_file_folder.htt)
$LANG['ADDON_FILE_EDITOR'][6] = array(
    'TXT_ACTION_DELETE_FILE'        => 'Supprimer Fichier/Dossier',
    'TXT_SUBMIT_DELETE'             => 'Supprimer',
    'TXT_ACTUAL_FOLDER'             => 'Dossier en Cours',
    'TXT_DELETE_WARNING'            => '<strong>Note: </strong>La suppression de fichiers et dossiers est irr&eacute;avertible. N&apos;oubliez pas ' .
                                       'que la suppression d&apos;un dossier entra&icirc;ne aussi la suppression de tous les fichiers et dossiers qu&apos;il contient.',
    'TXT_DELETE_SUCCESS'            => 'Fichier/Dossier supprim&eacute; avec succ&egrave;s.',
    'TXT_DELETE_ERROR'              => 'Impossible de supprimer le fichier. Veuillez v&eacute;rifier les permissions.<br /><em>Note: Pour supprimer un dossier ' .
                                       'par FTP, assurez-vous qu&apos;il ne contient aucun autre dossier ou fichier.</em>'
);

// Text outputs file handler (templates/action_handler_create_file_folder.htt)
$LANG['ADDON_FILE_EDITOR'][7] = array(
    'TXT_ACTION_CREATE_FILE'        => 'Cr&eacute;er fichier/dossier',
    'TXT_CREATE'                    => 'Cr&eacute;er',
    'TXT_FILE'                      => 'Fichier',
    'TXT_FOLDER'                    => 'Dossier',
    'TXT_FILE_NAME'                 => 'File name',
    'TXT_ALLOWED_FILE_CHARS'        => '[a-zA-Z0-9.-_]',
    'TXT_TARGET_FOLDER'             => 'Dossier cible',
    'TXT_SUBMIT_CREATE'             => 'Cr&eacute;er',
    'TXT_CREATE_SUCCESS'            => 'Fichier/Dossier Cr&eacute;&eacute; avec succ&egrave;s.',
    'TXT_CREATE_ERROR'              => 'Impossible de cr&eacute;er le fichier/dossier. Veuillez v&eacute;rifier les permissions et le nom du fichier.',
    'TXT_INVALID_FILENAME'          => 'Le nom du fichier ou du dossier sp&eacute;cifi&eacute; est invalide.',
);

// Text outputs file handler (templates/action_handler_upload_file.htt)
$LANG['ADDON_FILE_EDITOR'][8] = array(
    'TXT_ACTION_UPLOAD_FILE'        => 'Envoi de fichier',
    'TXT_SUBMIT_UPLOAD'             => 'Envoi',

    'TXT_FILE'                      => 'Fichier',
    'TXT_TARGET_FOLDER'             => 'Dossier cible',

    'TXT_UPLOAD_SUCCESS'            => 'Fichier envoy&eacute; avec succ&egrave;s.',
    'TXT_UPLOAD_ERROR'              => 'Impossible d&apos;envoyer le fichier. Veuillez v&eacute;rifier les permissions et la taille du fichier.',
);

// Text outputs for the download handler 
$LANG['ADDON_FILE_EDITOR'][9] = array(
    'ERR_TEMP_PERMISSION'           => 'PHP ne poss&egrave;de pas les droits en &eacute;criture sur le dossier (/temp) de WebsiteBaker.',
    'ERR_ZIP_CREATION'              => 'Impossible de cr&eacute;er le fichier d&apos;archive.',
    'ERR_ZIP_DOWNLOAD'              => 'Erreur lors du t&eacute;l&eacute;chargement du fichier de sauvegarde.<br /><a href="{URL}">T&eacute;l&eacute;charger</a> manuellement.',
);

// Text outputs for the FTP checking (templates/ftp_connection_check.htt)
$LANG['ADDON_FILE_EDITOR'][10] = array(
    'TXT_FTP_HEADING'               => 'Assistant de Configuration FTP',
    'TXT_FTP_DESCRIPTION'           => 'L&apos;assistant FTP vous aide pour la mise en place et le test du support FTP pour cwsoft-addon-file-editor.',

    'TXT_FTP_SETTINGS'              => 'R&eacute;glages FTP Actuels',
    'TXT_FTP_SUPPORT'               => 'Support FTP',
    'TXT_ENABLE'                    => 'Activ&eacute;',
    'TXT_DISABLE'                   => 'D&eacute;sactiv&eacute;',
    'TXT_FTP_SERVER'                => 'Serveur',
    'TXT_FTP_USER'                  => 'Utilisateur',
    'TXT_FTP_PASSWORD'              => 'Mot de passe',
    'TXT_FTP_PORT'                  => 'Port',
    'TXT_FTP_START_DIR'             => 'R&eacute;pertoire racine',

    'TXT_FTP_CONNECTION_TEST'       => 'V&eacute;rifier la Connection FTP',
    'TXT_CHECK_FTP_CONNECTION'      => 'Pressez le bouton ci-dessous pour v&eacute;rifier l&apos;&eacute;tat de la connexion &agrave; votre serveur FTP.',
    'TXT_FTP_CHECK_NOTE'            => '<strong>Note: </strong>Le test de connexion peut durer 15 secondes.',
    'TXT_SUBMIT_CHECK'              => 'Connecter',
    'TXT_FTP_LOGIN_OK'              => 'Connexion au serveur FTP r&acute;ussie. Le support FTP est activ&eacute;.',
    'TXT_FTP_LOGIN_FAILED'          => 'Connexion au serveur FTP &acute;chou&acute;e. Veuillez v&eacute;rifier vos r&eacute;glages FTP. ' .
                                       '<br /><strong>Note: </strong>Le r&eacute;pertoire racine doit pointer vers votre dossier WebsiteBaker.',
);

// Text outputs file handler (templates/action_handler_unzip_file.htt)
$LANG['ADDON_FILE_EDITOR'][11] = array(
    'TXT_ACTION_UNZIP_ARCHIVE'      => 'D&eacute;compacter le fichier d&apos;archive',
    'TXT_FILE_TO_UNZIP'             => 'Fichier &agrave; d&eacute;compacter',
    'TXT_TARGET_FOLDER'             => 'Dossier cible',
    'TXT_SUBMIT_UNZIP'              => 'D&eacute;compacter',
    'TXT_UNZIP_WARNING'             => '<strong>Note: </strong>D&eacute;compacter un fichier d&apos;archive peut &eacute;craser irr&eacute;versiblement les fichiers existants dans le dossier cible.',
    'TXT_UNZIP_SUCCESS'             => 'Fichier d&apos;archive d&eacute;compact&eacute; avec succ&egrave;s.',
    'TXT_UNZIP_ERROR'               => 'Le d&eacute;compactage du fichier d&apos;archive a &eacute;chou&eacute;. Veuillez v&eacute;réifier que l&apos;archive est bien au format ZIP et que le dossier cible poss&egrave;de bien la permission d&apos;&eacute;criture pour PHP.',
);