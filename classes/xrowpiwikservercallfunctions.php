<?php
/**
 * Implements xrowpiwik
 *
 */
class xrowPiwikServerCallFunctions
{
    /**
     * PIWIK.ORG Integration
     *
     * @param mixed $args
     */
    public static function piwik( $args )
    {
        /**
        * Piwik - Open source web analytics
        *
        * @link http://piwik.org
        * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
        * @version $Id: piwik.php 6859 2012-08-22 09:04:47Z matt $
        *
        * @package Piwik
        */
        #$xp_ini = eZINI::instance('xrowpiwik.ini');
        define('PIWIK_DOCUMENT_ROOT', 'extension/xrowpiwik/src/piwik');
        define('PIWIK_USER_PATH', 'extension/xrowpiwik/src/piwik');
        define('PIWIK_INCLUDE_PATH', 'extension/xrowpiwik/src/piwik');
        
        require_once 'extension/xrowpiwik/src/piwik/piwik.php';
        
    }
    
    public static function doPiwikTrack()
    {
        $xp_ini = eZINI::instance('xrowpiwik.ini');
        $siteID = 1;
        $disableCookies = false;
        if( $xp_ini->hasVariable('General', 'PiwikSiteID') )
        {
            $siteID = (int) trim($xp_ini->variable('General', 'PiwikSiteID'));
        }
        if( $xp_ini->hasVariable('General', 'DisableCookies') && trim($xp_ini->variable('General', 'DisableCookies')) == 'enabled')
        {
            $disableCookies = true;
        }
        $piwikRequest = "/ezjscore/call/xrowpiwik::piwik";
        $return = file_get_contents("extension/xrowpiwik/src/piwik/piwik.js");
        $return .="<!-- Piwik -->
                   var pkBaseURL = \"" . $piwikRequest ."/\";
                   try {
                        var piwikTracker = Piwik.getTracker(pkBaseURL + \"\", " . $siteID . ");";
        if($disableCookies)
        {
            $return .="
                        piwikTracker.disableCookies();";
        }
        $return .="
                        piwikTracker.trackPageView();
                        piwikTracker.enableLinkTracking();
                   }
                   catch( err ) {}

                   <!-- SecondPiwikID Feature -->
                   jQuery(document).ready(function($)
                   {
                       var pkBaseURL = \"" . $piwikRequest ."/\";
                       try
                       {
                           if (!isNaN($(\"body\").attr(\"data-piwikID\")) && $(\"body\").attr(\"data-piwikID\") > 0)
                           {
                               var secondpiwikid=$(\"body\").attr(\"data-piwikID\");
                               var piwikTracker2 = Piwik.getTracker(pkBaseURL + \"\", secondpiwikid );";
        if($disableCookies)
        {
            $return .="
                               piwikTracker2.disableCookies();";
        }
        $return .="
                               piwikTracker2.trackPageView();
                               piwikTracker2.enableLinkTracking();
                           }
                       }
                       catch( err ) {}
                   });
                   <!-- End Piwik Tracking Code -->";
        return $return;
    }
}