#!/bin/bash

# Variables (CONFIG)
DIR="/var/www/ibot"
EXEC="bot.php"			# SA-MP Server executable
SCREENNAME="ibot" 			# Screen name
DESC="iBot"		# Description
#FULLPATH=$PATH$EXEC

# Functions
function startServer {
	if ! screen -list | grep -q $SCREENNAME; then
		if [ -d $DIR ]; then
			cd $DIR
			if [ -f $EXEC ]; then
				screen -dmS $SCREENNAME php $EXEC
				echo "$DESC wystartował !"
			else
				echo "Error: uprawnienia ($EXEC) nie zostały znalezione !"
			fi
		else
			echo "Error: katalog ($DIR) nie został znaleziony !"
		fi
	else
		echo "Serwer jest już uruchomiony!"	
	fi
}

function stopServer {
#	CHECK=`ps u -C $EXEC | grep -vc USER`
#	if [ $CHECK -eq 0 ]; then
	if ! screen -list | grep -q $SCREENNAME; then
		echo "$DESC nie jest uruchomiony."
	else
#		killall $EXEC
		PROCESS=$(screen -ls |grep $SCREENNAME)
		kill $(echo $PROCESS |cut -f1 -d'.')
		echo "$DESC został wyłączony!"
	fi
}

function serverStatus {

	if screen -list | grep -q $SCREENNAME; then
  		echo "$DESC jest uruchomiony."
  	else
  		echo "$DESC nie jest uruchomiony."
	fi
}

# Main
case "$1" in
	start)
		startServer
		;;

	stop)
		stopServer
		;;

	restart)
		stopServer
		sleep 5
		startServer
		;;

	status)
		serverStatus
		;;


	*)
		echo "Wpisz: $0 {start|stop|restart|status}"
		exit 1
		;;
esac
exit
