<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.32" />
	<link rel="stylesheet" type="text/css" href="../CSS/style.css">
</head>

<body>
<?php
	$Elec = $_POST['Eleccion'];
	if(empty($Elec)) {
		echo "No seleccionó ninguna casilla";
	} else {
		session_start();
		$Usuario = $_SESSION["Usuario"];
		$Contrasena = $_SESSION["Contrasena"];		
		$db = new mysqli("localhost", $Usuario, $Contrasena, "Huerto");
		if ($db->connect_error) {
			die("Conexión fallida: " . $conn->connect_error);
		} else {
			$numfilas = count($Elec);
			for ($x=0; $x<$numfilas; $x++) {
				$resultado = $db->query("select * from Eleccion where ID_Eleccion = '" . $Elec[$x] . "'");
				$fila = $resultado->fetch_object();
				echo "<table>";
					echo "<thead>";
					echo "<td>Id_Usuario</td>";
					echo "<td>Primer Fruta</td>";
					echo "<td>Segunda Fruta</td>";
					echo "<td>Tercer Fruta</td>";
					echo "<td>Cuarta Fruta</td>";
					echo "<td>Fecha</td>";
					echo "</thead>";
					echo "<tr>";
					echo "<td>" . $fila->ID_Usuario . "</td>";
					echo "<td>" . $fila->ID_Fruta1 . "</td>";
					echo "<td>" . $fila->ID_Fruta2 . "</td>";
					echo "<td>" . $fila->ID_Fruta3 . "</td>";
					echo "<td>" . $fila->ID_Fruta4 . "</td>";
					echo "<td>" . $fila->Fecha . "</td>";
					echo "</tr>";
				echo "</table>";
				$totFruta = $fila->ID_Fruta1 + $fila->ID_Fruta2 + $fila->ID_Fruta3 + $fila->ID_Fruta4;
				if($totFruta > 22){
					$totFruta = ($totFruta - $totFruta % 10)/10 + $totFruta % 10;
				}
				$DescriTot = $db->query("SELECT (Descripcion) FROM Des_Conjunto WHERE ID_Des_Conjunto = '" . $totFruta . "'");
				$Descripcion = $DescriTot->fetch_object();
				echo "Descripción síntesis: " . $Descripcion->Descripcion . "<br />";
				$DescriTot->free_result();
				$Valor1 = ($fila->ID_Fruta1 - 1) * 22 + $fila->ID_Fruta3;
				$Valor2 = ($fila->ID_Fruta3 - 1) * 22 + $fila->ID_Fruta1;
				if($Valor1 < $Valor2){
					$Valor = $Valor1;
				}else{
					$Valor = $Valor2;
				}
				switch($fila->ElecModo){
					case "S":
						$ModoJ = "Saludables";
						break;
						
					case "A":
						$ModoJ = "Amargos";
						break;
						
					case "F":
						$ModoJ = "Familiares";
						break;
						
					case "T":
						$ModoJ = "Transgenicos";
						break;
						
					case "V":
						$ModoJ = "Vinero";
						break;
				}
				$DescriImpares = $db->query("SELECT (" . $ModoJ . ") FROM Des_Impares WHERE ID_Des_Impar = '" . $Valor . "'");
				$Descripcion = $DescriImpares->fetch_object();	
				echo "La descripción actual es: " . $Descripcion->$ModoJ . "<br />";
				$DescriImpares->free_result();
				$Valor1 = ($fila->ID_Fruta2 - 1) * 22 + $fila->ID_Fruta4;
				$Valor2 = ($fila->ID_Fruta4 - 1) * 22 + $fila->ID_Fruta2;
				if($Valor1 < $Valor2){
					$Valor = $Valor1;
				}else{
					$Valor = $Valor2;
				}
				$DescriPares = $db->query("SELECT (" . $ModoJ . ") FROM Des_Pares WHERE ID_Des_Par = '" . $Valor . "'");
				$Descripcion = $DescriPares->fetch_object();
				echo "La descripción futura es(evolución probable): " . $Descripcion->$ModoJ . "<br />";
				$DescriPares->free_result();
				echo "<hr>";
			}
			$db->close();
		}
	}
	echo "<br /><br /><a href='./EleccionConsulta.php' >Inicio</a>";
?>
</body>

</html>
