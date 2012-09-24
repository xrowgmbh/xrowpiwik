<?php
$Module = array( 'name' => 'xrowPIWIK', 'variable_params' => true );
$ViewList = array();
$ViewList['xrowpiwik'] = array(
    'functions' => array( 'xrowpiwik' ),
    'default_navigation_part' => 'xrowpiwiknavigationpart',
    'ui_context' => 'administration',
    'script' => 'xrowpiwik.php',
    'params' => array(),
    'unordered_params' => array(  )
);

$FunctionList = array();
$FunctionList['xrowpiwik'] = array();

?>