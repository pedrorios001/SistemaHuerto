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
				if ($_POST['Gestion'] != "Consultar"){
					$result = $db->query("select * from Des_Pares where ID_Des_Par = " . $_POST['ID_Des_Par']);
					$fila = $result->fetch_object();
				}
				$Des_Par = $_POST['Des_Par'];
				switch($_POST['Gestion']){
					case "Agregar":
						echo $fila->$Des_Par;
						if(!isset($fila)){
							$sql = "insert into Des_Pares (ID_Des_Par, " . $Des_Par . ") values (" . $_POST['ID_Des_Par'] . ", '" . $_POST['Descripcion'] . "')";
							if ($db->query($sql) === TRUE) {
								echo "Datos agregados";
							} else {
								echo "Registro inválido" . $sql . "<br>" . $db->error;
							}
						}else{
							if($fila->$Des_Par == ''){
								$db->query("update Des_Pares set " . $Des_Par . " = '" . $_POST['Descripcion'] . "' where ID_Des_Par =" . $_POST['ID_Des_Par']);
								echo "Datos agregados";
							}else{		
								echo "Ya existe una Descripción con ese Identificador";
							}
						}
						break;
					
					case "Modificar":
						if(isset($fila)){
							echo "<form action='./ModificarDesFrutaPar.php' method='POST'>";
							echo "<input type='number' min='1' max='22' name='ID_Des_Par' value=" . $fila->ID_Des_Par . " readonly/><span>Valor</span><br /><br />";
							echo "<input type='text' name='Gestion' value='" . $Des_Par . "' required readonly/><span>Función</span><br /><br />";							
							echo "<input type='text' name='Descripcion' value='" . $fila->$Des_Par . "' maxlength='800' required/><span>Descripción</span><br /><br />";
							echo "<input type='submit' value='Enviar'/>";
							echo "<input type='reset'>";
							echo "</form>";
						}else{
							echo "No existe una Descripción con ese Identificador";
						}
						break;
					
					case "Eliminar":
						if(isset($fila)){
							$db->query("update Des_Pares set " . $Des_Par . " = '' where ID_Des_Par =" . $_POST['ID_Des_Par']);
							echo "Datos eliminados";
						}else{
							echo "No existe una Descripción con ese Identificador";
						}
						break;
						
					case "Consultar":
						$result = $db->query("select * from Des_Pares");
						$numfilas = $result->num_rows;
						echo "<table>";
						echo "<thead>";
						echo "<td>Valor</td>";
						echo "<td>Descripción</td>";
						echo "</thead>";
						for ($x=0; $x<$numfilas; $x++) {
							$fila = $result->fetch_object();
							echo "<tr>";
							echo "<td>" . $fila->ID_Des_Par . "</td>";
							
							switch($_POST['Des_Par']){
								
								case "Saludables":
									echo "<td>" . $fila->Saludables . "</td>";
									break;
									
								case "Amargos":
									echo "<td>" . $fila->Amargos . "</td>";
									break;
								
								case "Familiares":
									echo "<td>" . $fila->Familiares . "</td>";
									break;
									
								case "Transgenicos":
									echo "<td>" . $fila->Transgenicos . "</td>";
									break;
									
								case "Vinero":
									echo "<td>" . $fila->Vinero . "</td>";
									break;
							}
							echo "</tr>";
						}
						echo "</table>";
						echo "<hr />";
						$result->free();
						$db->close();
						break;
				}
				echo "<br /><br /><a href='./AdministrarDesFrutaPar.php' >Inicio</a>";
			}
		?>

</body>

</html>
