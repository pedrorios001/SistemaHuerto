#!/bin/bash

for i in `seq 1 22`; do
	for j in `seq 1 22`; do
		if  [ $i -ne $j ] ;
		then
			k=$((k+1));
			echo -e "$((($i-1)*22+$j))\tSaludables impar_$k\tAmargos impar_$k\t Familiares impar_$k\tTransgénicos impar_$k\tDe Viñero impar_$k" >> DescripImpar.txt
		fi
	done
done
