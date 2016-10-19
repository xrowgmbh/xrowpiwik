<?php
/**
 * Implements xrowpiwik
 *
 */
class xrowPiwikServerCallFunctions
{
    public static function doPiwikTrack()
    {
        $xp_ini = eZINI::instance('xrowpiwik.ini');
        //$siteID = 1;
        $disableCookies = false;
       /* if( $xp_ini->hasVariable('General', 'PiwikSiteID') )
        {
            $siteID = (int) trim($xp_ini->variable('General', 'PiwikSiteID'));
        }*/
        if( $xp_ini->hasVariable('General', 'DisableCookies') && trim($xp_ini->variable('General', 'DisableCookies')) == 'enabled')
        {
            $disableCookies = true;
        }
        $piwikRequest = trim($xp_ini->variable('General', 'URL'));
        $return = file_get_contents("extension/xrowpiwik/src/piwik/piwik.js");
        $return .="<!-- Piwik -->
               jQuery(document).ready(function($)
               {
                   var pkBaseURL = \"" . $piwikRequest ."/\";
                   try {
                            if (!isNaN($(\"body\").attr(\"data-piwikmainid\")) && $(\"body\").attr(\"data-piwikmainid\") > 0)
                            {
                                var mainpiwikid=$(\"body\").attr(\"data-piwikmainid\");
                                var piwikTracker0 = Piwik.getTracker(pkBaseURL + \"\", mainpiwikid );";
        if($disableCookies)
        {
            $return .="
                                piwikTracker0.disableCookies();";
        }
        $return .="
                                piwikTracker0.trackPageView();
                                piwikTracker0.enableLinkTracking();
                            }
                       }
                       catch( err ) {}
                   });

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
