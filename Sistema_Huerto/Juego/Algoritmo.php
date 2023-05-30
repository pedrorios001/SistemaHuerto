<?php
	session_start();
	$Usuario = $_SESSION["Usuario"];
	$Contrasena = $_SESSION["Contrasena"];		
	$db = new mysqli("localhost", $Usuario, $Contrasena, "Huerto");
	if ($db->connect_error) {
		die("Conexión fallida: " . $conn->connect_error);
	} else {
		$totFruta = $_POST['fruta1'] + $_POST['fruta2'] + $_POST['fruta3'] + $_POST['fruta4'];
		if($totFruta > 22){
			$totFruta = ($totFruta - $totFruta % 10)/10 + $totFruta % 10;
		}
		$db->query("INSERT INTO Eleccion VALUES( NULL, '" . $_SESSION['Usuario'] . "', '" . $_POST['fruta1'] . "', '" . $_POST['fruta2'] . "', '" . $_POST['fruta3'] . "', '" . $_POST['fruta4'] . "', CURDATE(), '" . $_POST['ElecModo'] . "')");
		switch($_POST['ElecModo']){
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
		$DescriTot = $db->query("SELECT (Descripcion) FROM Des_Conjunto WHERE ID_Des_Conjunto = '" . $totFruta . "'");
		$Descripcion = $DescriTot->fetch_object();
		echo "Descripción síntesis(Udishere): " . $Descripcion->Descripcion . "       ";
		$DescriTot->free_result();
		$Valor = ($_POST['fruta1'] - 1) * 22 + $_POST['fruta3'];
/*		$Valor2 = ($_POST['fruta3'] - 1) * 22 + $_POST['fruta1'];
		if($Valor1 < $Valor2){
			$Valor = $Valor1;
		}else{
			$Valor = $Valor2;
		}*/
		$DescriImpares = $db->query("SELECT (" . $ModoJ . ") FROM Des_Impares WHERE ID_Des_Impar = '" . $Valor . "'");
		$Descripcion = $DescriImpares->fetch_object();	
		echo "\nDescripción actual: " . $Descripcion->$ModoJ . "       ";
		$DescriImpares->free_result();
		$Valor = ($_POST['fruta2'] - 1) * 22 + $_POST['fruta4'];
/*		$Valor2 = ($_POST['fruta4'] - 1) * 22 + $_POST['fruta2'];
		if($Valor1 < $Valor2){
			$Valor = $Valor1;
		}else{
			$Valor = $Valor2;
		}*/
		$DescriPares = $db->query("SELECT (" . $ModoJ . ") FROM Des_Pares WHERE ID_Des_Par = '" . $Valor . "'");
		$Descripcion = $DescriPares->fetch_object();
		echo "\nDescripción futura(evolución probable): " . $Descripcion->$ModoJ . "       ";
		$DescriPares->free_result();
		$db->close();
	}
?>
