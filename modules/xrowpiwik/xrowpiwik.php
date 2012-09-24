<?php
//
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: xrowpiwik
// SOFTWARE RELEASE: 1.0.0
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
// 
//   This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
// 
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

/**
 * File containing the showdata view of vincentz_import module.
 *
 * @package xrowpiwik
 */

require_once( "kernel/common/template.php" );

$module = $Params['Module'];
$http = eZHTTPTool::instance();
$tpl = templateInit();
$viewParameters = array();
$availableTranslations = eZContentLanguage::fetchList();
$thisUrl = '/xrowpiwik/xrowpiwik';
$tpl->setVariable( 'baseurl', $thisUrl );

$Result = array();
$Result['content'] = "<iframe src=\"/extension/xrowpiwik/src/piwik/index.php\" width='98%' height='780' frameborder='0'></iframe>";
#include 'extension/xrowpiwik/src/piwik/index.php';
#eZExecution::cleanExit(); 
#$tpl->fetch( "design:xrowpiwik/xrowpiwik.tpl" );
$Result['left_menu'] = "design:xrowpiwik/backoffice_left_menu.tpl";
$Result['path'] = array( array( 'url' => false,
                                'text' => "xrow PIWIK" ) );

?>