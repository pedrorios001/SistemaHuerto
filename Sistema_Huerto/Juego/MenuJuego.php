<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Menú del Juego</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.32" />
	<link rel="stylesheet" type="text/css" href="../CSS/style.css">
</head>

<body>
	<script>
		var Parametros = "width=800, height=500, left=50, top=50, resizable=no, menubar=yes, toolbar=no, directories=no, location=no, scrollbars=no, status=no";
	</script>
	<header style="background-color:green; padding:20x; ">
		<a align="right" href="../Logout.php">Cerrar Sesión</a>
	</header>
	<div align="center">
		<h1>Seleccione un modo de juego</h1>
		<br /><br /><br /><br /><br /><br />
		<button type="button" width="50%" height="10%" onClick="open('./Juego/MenuJuego.php', 'Saludables', Parametros);">Juego</button><br /><br />
		<button type="button" width="50%" height="10%" onClick="open('ValidarUsuario.php', 'Amargos', Parametros);">Usuarios pendientes de validación</button><br /><br />
		<button type="button" width="50%" height="10%" onClick="open('AdministrarF.php', 'Familiares', Parametros);">Gestión de la fruta</button><br /><br />
		<button type="button" width="50%" height="10%" onClick="open('AdministrarDesF.php', 'Transgenicos', Parametros);">Gestión de las descripciones síntesis(Udishere)</button><br /><br />
		<button type="button" width="50%" height="10%" onClick="open('AdministrarDesFrutaP.php', 'Vinero', Parametros);">Gestión de las descripciones actuales</button><br /><br />
	</div>
</body>

</html>

</html>
