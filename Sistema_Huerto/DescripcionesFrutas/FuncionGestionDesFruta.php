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
				$result = $db->query("select * from Des_Conjunto where ID_Des_Conjunto =" . $_POST['ID_Des_Conjunto']);
				$fila = $result->fetch_object();
				switch($_POST['Gestion']){
					case "Agregar":
						if(!isset($fila)){
							$sql = "insert into Des_Conjunto (ID_Des_Conjunto, Descripcion) values (" . $_POST['ID_Des_Conjunto'] . ", '" . $_POST['Descripcion'] . "')";
							if ($db->query($sql) === TRUE) {
								echo "Datos agregados";
							} else {
								echo "Registro inválido" . $sql . "<br>" . $db->error;
							}
						}else{
							echo "Ya existe una Descripción con ese valor";
						}
						break;
					
					case "Modificar":
						if(isset($fila)){
							echo "<form action='./ModificarDesFruta.php' method='POST'>";
							echo "<input type='number' name='ID_Des_Conjunto' min='1' max='22' value=" . $fila->ID_Des_Conjunto . " readonly required/><span>Valor</span><br /><br />";
							echo "<input type='text' name='Descripcion' value='" . $fila->Descripcion . "' maxlength='800' required/><span>Descripción</span><br /><br />";
							echo "<input type='submit' value='Enviar'/>";
							echo "<input type='reset'>";
							echo "</form>";
						}else{
							echo "No existe una Descripción con ese valor";
						}
						break;
					
					case "Eliminar":
						if(isset($fila)){
							$db->query("delete from Des_Conjunto where ID_Des_Conjunto = " . $_POST['ID_Des_Conjunto']);
							echo "Datos eliminados";
						}else{
							echo "No existe una Descripción con ese valor";
						}
						break;
				}
				echo "<br /><br /><a href='./AdministrarDesFruta.php' >Inicio</a>";
			}
		?>

</body>

</html>
