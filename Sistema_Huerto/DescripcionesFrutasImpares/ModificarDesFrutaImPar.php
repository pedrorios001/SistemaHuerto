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
		session_start();
		$Usuario = $_SESSION["Usuario"];
		$Contrasena = $_SESSION["Contrasena"];		
		$db = new mysqli("localhost", $Usuario, $Contrasena, "Huerto");
		if ($db->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
		}else{
			$result = $db->query("select * from Des_Impares where ID_Des_Impar =" . $_POST['ID_Des_ImPar']);
			$fila = $result->fetch_object();
			if(isset($fila)){
				$db->query("update Des_Impares set " . $_POST['Gestion'] . " = '" . $_POST['Descripcion'] . "' where ID_Des_Impar =" . $_POST['ID_Des_ImPar']);
				echo "Datos modificados";
			}else{
				echo "No existe una Descripción con ese Identificador";
			}
		}
		echo "<br /><br /><a href='./AdministrarDesFrutaImPar.php' >Inicio</a>";
	?>
</body>

</html>
