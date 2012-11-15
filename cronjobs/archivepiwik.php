<?php 
echo "Archiveing Piwik-Reports\n";
system("sudo rm -Rf {$_SERVER['PWD']}/extension/xrowpiwik/src/piwik/tmp/;
		mkdir {$_SERVER['PWD']}/extension/xrowpiwik/src/piwik/tmp/;
		chmod -R 777 {$_SERVER['PWD']}/extension/xrowpiwik/src/piwik/tmp/;
		sed -i 's/TEST_PHP_BIN in php5 php php-cli php-cgi/TEST_PHP_BIN in php5 php php-cli php-cgi \/usr\/local\/zend\/bin\/php/g' {$_SERVER['PWD']}/extension/xrowpiwik/src/piwik/misc/cron/archive.sh;
		sh extension/xrowpiwik/src/piwik/misc/cron/archive.sh url={$_SERVER['HOSTNAME']}extension/xrowpiwik/src/piwik;
		sudo rm -Rf {$_SERVER['PWD']}/extension/xrowpiwik/src/piwik/tmp/");
echo "Archiveing Piwik-Reports DONE!\n";