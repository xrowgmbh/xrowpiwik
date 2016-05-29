<?php
/**
 * Piwik - Open source web analytics
 * 
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html Gpl v3 or later
 * @version $Id: $
 * 
 * @package Piwik
 */

// PIWIK_USER_PATH
// - Override the default to relocate config and tmp files
//   This facilitates a "best practice" of preventing direct access to php
//   files.  Also useful with shared hosting to separate shared code from
//   user/account-specific configuration.
// - default is the same as PIWIK_DOCUMENT_ROOT
define('PIWIK_USER_PATH', dirname(__FILE__));

// PIWIK_INCLUDE_PATH
// - Override the default to relocate files loaded by index.php and piwik.php.
//   This facilitates a "best practice" of preventing direct access to php
//   files.
// - default is the same as PIWIK_DOCUMENT_ROOT
define('PIWIK_INCLUDE_PATH', dirname(__FILE__));

// PIWIK_ENABLE_SESSION_START
// - Allows dashboard to parallel load widgets increasing responsiveness
// - Note: requires more concurrent mysql connections (see my.cnf's max_connections)
// - default is enabled; set to 0 to disable
define('PIWIK_ENABLE_SESSION_START', 0);

// PIWIK_DISPLAY_ERRORS
// - When set to 0, no error will be output in the Piwik interface.
//   This is useful for users that do not want Piwik to show any error. 
//   By default, we choose to display all PHP Warnings, Notices and Error
//   messages because it helps us find and diagnose bugs.
// - default is 1 (On); recommend 0 (Off) for production servers
define('PIWIK_DISPLAY_ERRORS', 1);

ini_set('memory_limit', '3G');
