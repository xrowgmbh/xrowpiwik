<?php 
echo "Archiveing Piwik-Reports\n";
system("sh extension/xrowpiwik/src/piwik/misc/cron/archive.sh url={$_SERVER['HOSTNAME']}extension/xrowpiwik/src/piwik");