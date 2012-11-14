<?php 
echo "Archiveing Piwik-Reports\n";
system("sudo rm -Rf {$_SERVER['PWD']}/extension/xrowpiwik/src/piwik/tmp/;
		mkdir {$_SERVER['PWD']}/extension/xrowpiwik/src/piwik/tmp/;
		chmod -R 777 {$_SERVER['PWD']}/extension/xrowpiwik/src/piwik/tmp/;
		sh extension/xrowpiwik/src/piwik/misc/cron/archive.sh url={$_SERVER['HOSTNAME']}extension/xrowpiwik/src/piwik;
		sudo rm -Rf {$_SERVER['PWD']}/extension/xrowpiwik/src/piwik/tmp/");
echo "Archiveing Piwik-Reports DONE!\n";