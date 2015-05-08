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
        $rootUrl = "//" . eZSys::hostname() . eZSys::indexDir();
        $piwikRequest = $rootUrl . "/ezjscore/call/xrowpiwik::piwik";

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
                
                <!-- ThirdPiwikID Feature -->
                   jQuery(document).ready(function($)
                   {
                       var pkBaseURL = \"" . $piwikRequest ."/\";
                       try
                       {
                           if (!isNaN($(\"body\").attr(\"data-piwik3ID\")) && $(\"body\").attr(\"data-piwik3ID\") > 0)
                           {
                               var thirdpiwikid=$(\"body\").attr(\"data-piwik3ID\");
                               var piwikTracker3 = Piwik.getTracker(pkBaseURL + \"\", thirdpiwikid );";
        if($disableCookies)
        {
            $return .="
                               piwikTracker3.disableCookies();";
        }
        $return .="
                               piwikTracker3.trackPageView();
                               piwikTracker3.enableLinkTracking();
                           }
                       }
                       catch( err ) {}
                   });
                
                
                <!-- HomePiwikID Feature -->
                   jQuery(document).ready(function($)
                   {
                       var pkBaseURL = \"" . $piwikRequest ."/\";
                       try
                       {
                           if (!isNaN($(\"body\").attr(\"data-piwikIndexID\")) && $(\"body\").attr(\"data-piwikIndexID\") > 0)
                           {
                               var indexpiwikid=$(\"body\").attr(\"data-piwikIndexID\");
                               var piwikTracker4 = Piwik.getTracker(pkBaseURL + \"\", indexpiwikid );";
        if($disableCookies)
        {
            $return .="
                               piwikTracker4.disableCookies();";
        }
        $return .="
                               piwikTracker4.trackPageView();
                               piwikTracker4.enableLinkTracking();
                           }
                       }
                       catch( err ) {}
                   });
                
                
                   <!-- End Piwik Tracking Code -->";
        return $return;
    }
}
