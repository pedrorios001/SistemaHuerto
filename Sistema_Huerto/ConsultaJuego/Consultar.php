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
			if($db->connect_errno){
				echo "Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
			}else{
				switch($_POST['Gestion']){
					case "Consulta_Usuario":
						$result = $db->query("select * from Eleccion where ID_Usuario = '" . $_POST['ID_Usuario'] . "'");
						break;
					
					case "Consulta_Fecha":
						$result = $db->query("select * from Eleccion where Fecha between '" . $_POST['FechaIni'] . "' and '" . $_POST['FechaFin'] . "'");
						break;
					
				}
				$fila = $result->fetch_object();
				if(!isset($fila)){
					echo "No existen registros con esos valores de busqueda";
				}else{
					echo "<hr />";
					$numfilas = $result->num_rows;
					echo "<form action='./ConsultaParticular.php' method='POST' target='_self'>";
					echo "<table>";
					echo "<thead>";
					echo "<td>Id_Usuario</td>";
					echo "<td>Primer Fruta</td>";
					echo "<td>Segunda Fruta</td>";
					echo "<td>Tercer Fruta</td>";
					echo "<td>Cuarta Fruta</td>";
					echo "<td>Fecha</td>";
					echo "<td>Opción</td>";
					echo "</thead>";
					for ($x=0; $x<$numfilas; $x++) {
						echo "<tr>";
						echo "<td><input type='checkbox' name='Eleccion[]' value = '" . $fila->ID_Eleccion . "' />" . $fila->ID_Usuario . "</td>";
						echo "<td>" . $fila->ID_Fruta1 . "</td>";
						echo "<td>" . $fila->ID_Fruta2 . "</td>";
						echo "<td>" . $fila->ID_Fruta3 . "</td>";
						echo "<td>" . $fila->ID_Fruta4 . "</td>";
						echo "<td>" . $fila->Fecha . "</td>";
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
						echo "<td>" . $ModoJ . "</td>";
						echo "</tr>";
						$fila = $result->fetch_object();
					}
					echo "</table>";
					echo "<hr />";
					echo "<input type='submit' value='Enviar' />";
					$result->free();
					$db->close();
				}
				echo "<br /><br /><a href='./EleccionConsulta.php' >Inicio</a>";
			}
		?>

</body>

</html>
