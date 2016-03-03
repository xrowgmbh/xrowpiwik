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
                $clickheat_server = "http://" . $_SERVER['HTTP_HOST'] . "/extension/xrowpiwik/src/piwik/plugins/ClickHeat/libs/click.php";
                $clickheat_quota = 3;
                $piwi_site_id = $piwik_ini->variable( 'General', 'PiwikSiteID' );
                
                if ( $piwik_ini->variable( 'General', 'ClickHeatTracking' ) == 'enabled' AND is_numeric($piwi_site_id) )
                {
                    $js_string = "{literal}<script type=\"text/javascript\">
                                                $(document).ready(function(){
                                                clickHeatSite = ". $piwi_site_id .";
                                                clickHeatGroup = '". $current_siteaccess ."';
                                                clickHeatQuota = ". $clickheat_quota .";
                                                clickHeatServer = '". $clickheat_server ."';
                                                initClickHeat();
                                                });
                                           </script>
                                          {/literal}";
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