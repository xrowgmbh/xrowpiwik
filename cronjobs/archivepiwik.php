<?php 
echo "Archiveing Piwik-Reports\n";
echo "CHMOD -Rf 777 {$_SERVER['PWD']}/ezpublish_legacy/extension/xrowpiwik/src/piwik/tmp/climulti\n";
system("chmod -Rf 777 {$_SERVER['PWD']}/ezpublish_legacy/extension/xrowpiwik/src/piwik/tmp/climulti");
system("sed -i 's/TEST_PHP_BIN in php5 php php-cli php-cgi/TEST_PHP_BIN in php5 php php-cli php-cgi \/usr\/local\/zend\/bin\/php/g' {$_SERVER['PWD']}/ezpublish_legacy/extension/xrowpiwik/src/piwik/misc/cron/archive.sh;
        sh extension/xrowpiwik/src/piwik/misc/cron/archive.sh url={$_SERVER['HOSTNAME']}extension/xrowpiwik/src/piwik;");
echo "Archiveing Piwik-Reports DONE!\n";
