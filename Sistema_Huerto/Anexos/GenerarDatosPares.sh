#!/bin/bash

for i in `seq 1 22`; do
	for j in `seq 1 22`; do
		if  [ $i -ne $j ] ;
		then
			k=$((k+1));
			echo -e "$((($i-1)*22+$j))\tSaludables par_$k\tAmargos par_$k\t Familiares par_$k\tTransgénicos par_$k\tDe Viñero par_$k" >> DescripPar.txt
		fi
	done
done
