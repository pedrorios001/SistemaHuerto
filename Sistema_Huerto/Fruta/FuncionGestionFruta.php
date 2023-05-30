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
				$result = $db->query("select * from Frutas where Valor=" . $_POST['Valor']);
				$fila = $result->fetch_object();
				switch($_POST['Gestion']){
					case "Agregar":
						if(!isset($fila)){
							$sql = "insert into Frutas(Nombre, Valor) values('" . $_POST['Nombre'] . "', " . $_POST['Valor'] . ")";
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
							echo "<form action='./ModificarFruta.php' method='POST'>";
							echo "<input type='text' name='ID_Fruta' value='" . $fila->ID_Fruta . "' readonly/><span>Identificador</span><br /><br />";
							echo "<input type='text' name='Nombre' value='" . $fila->Nombre . "' maxlength='30' required/><span>Nombre</span><br /><br />";
							echo "<input type='number' name='Valor' min='1' max='22' value='" . $fila->Valor . "'required/><span>Valor</span><br /><br />";
							echo "<input type='submit' value='Enviar'/>";
							echo "<input type='reset'>";
							echo "</form>";
						}else{
							echo "No existe una fruta con ese valor";
						}
						break;
					
					case "Eliminar":
						if(isset($fila)){
							$db->query("delete from Frutas where Valor = " . $_POST['Valor']);
							echo "Datos eliminados";
						}else{
							echo "No existe una fruta con ese valor";
						}
						break;
				}
				echo "<br /><br /><a href='./AdministrarFruta.php' >Inicio</a>";
			}
		?>

</body>

</html>
