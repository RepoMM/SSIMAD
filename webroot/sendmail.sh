#!/bin/bash

	name=$1 #Nombre
	f_file=$2 #Lista correos

#	if [ "$(pgrep -x $(basename $0))" != "$$" ]; then
#		 echo "Error: another instance of $(basename $0) is already running"
# 		exit 1
#	fi
	


	while [ "$(pgrep -x $(basename $0))" != "$$" ]
	do
		echo "Espere..."
		sleep 10
	done



		#while [ $count -lt 5 ]
		while read line
		do
			echo "Se está ejecutando"
			sleep 10
			echo $name "ha publicado un mensaje en siaefi"
		done < $f_file


	


