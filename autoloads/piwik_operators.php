<?php
class piwikOps
{
    function piwikOps()
    {
        $this->Operators = array( 'click_tracker' );
    }
    function operatorList()
    {
        return array( 'click_tracker' );
    }
    function namedParameterPerOperator()
    {
        return true;
    }
    function namedParameterList()
    {
        return array( 'click_tracker' => array() );
    }
    function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {
        switch ( $operatorName )
        {
            case 'click_tracker':
                $piwik_ini = eZINI::instance("xrowpiwik.ini");
                $current_siteaccess = $GLOBALS['eZCurrentAccess'];
                $current_siteaccess = $current_siteaccess["name"];
                $clickheat_server = "https://" . $_SERVER['HTTP_HOST'] . "/extension/xrowpiwik/src/piwik/plugins/ClickHeat/libs/click.php";
                $clickheat_quota = 3;
                $piwi_site_id = $piwik_ini->variable( 'General', 'PiwikSiteID' );
                
                if ( $piwik_ini->variable( 'General', 'ClickHeatTracking' ) == 'enabled' AND is_numeric( $piwi_site_id ) )
                {
                    $codeSnippet = "initClickHeat();";
                    if( ( $clickheatSettings = $piwik_ini->variable( 'ClickHeatSettings', 'DoTrackingFor' ) ) != 'all' )
                    {
                        $checkDevice = explode( ',', $clickheatSettings );
                        if (count($checkDevice) < 3) {
                            if (count($checkDevice) == 1) {
                                if (in_array('desktop', $checkDevice)) {
                                    $codeSnippet = "if(browsercorWidth > 1109) {
                                                        initClickHeat();
                                                    }";
                                }
                                elseif (in_array('tablet', $checkDevice)) {
                                    $codeSnippet = "if(browsercorWidth <= 1109 && browsercorWidth >= 600) {
                                                        initClickHeat();
                                                    }";
                                }
                                elseif (in_array('mobile', $checkDevice)) {
                                    $codeSnippet = "if(browsercorWidth <= 599) {
                                                        initClickHeat();
                                                    }";
                                }
                            }
                            elseif (count($checkDevice) == 2) {
                                if (in_array('desktop', $checkDevice) && in_array('tablet', $checkDevice)) {
                                    $codeSnippet = "if(browsercorWidth >= 600) {
                                                        initClickHeat();
                                                    }";
                                }
                                elseif (in_array('desktop', $checkDevice) && in_array('mobile', $checkDevice)) {
                                    $codeSnippet = "if(browsercorWidth > 1109 && browsercorWidth < 600) {
                                                        initClickHeat();
                                                    }";
                                }
                                elseif (in_array('tablet', $checkDevice) && in_array('mobile', $checkDevice)) {
                                    $codeSnippet = "if(browsercorWidth <= 1109) {
                                                        initClickHeat();
                                                    }";
                                }
                            }
                        }
                    }
                    $js_string = '<script type="text/javascript">
                                    $(document).ready(function(){
                                        var browsercorWidth = document.documentElement.clientWidth;
                                        if (browsercorWidth > screen.width)
                                            browsercorWidth = screen.width;
                                        if (browsercorWidth > window.innerWidth)
                                            browsercorWidth = window.innerWidth;
                                        clickHeatSite = '. $piwi_site_id .';
                                        clickHeatGroup = "'. $current_siteaccess .'";
                                        clickHeatQuota = '. $clickheat_quota .';
                                        clickHeatServer = "'. $clickheat_server .'";
                                        '.$codeSnippet.'
                                    });
                               </script>';
                }
                else
                {
                    $js_string = "";
                }

                $operatorValue = $js_string;
            break;
        }
    }
    
}
?>