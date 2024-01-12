<?php
        if (!isset($_GET['banda'])) {
	        header("Location: buscabanda.php");
    	exit;
        }

        $nome = trim($_GET['banda'])."%";

            $dbh = new PDO("mysql:host=localhost;dbname=thetown", "root", "root");

                $sth = $dbh->prepare('SELECT * FROM `banda` WHERE `nome_banda` LIKE :nome_banda');
                $sth->bindParam(':nome_banda', $nome, PDO::PARAM_STR);
                $sth->execute();

                    $resultados = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Resultado da busca</title>
    <link rel="stylesheet" href="CSSLISTALEGAL.css"/>
</head>
<body>

<div id=interface>
<h2>Resultado da busca</h2>
<?php
if (count($resultados)) {
	foreach($resultados as $Resultado) {
?>

<table>
			<tr>
				<th>Código da Banda</th>
				<th>Nome da Banda</th>
				<th>Dia do Show</th>
				<th>Duração</th>
				<th>Horario de Inicio</th>
				<th>Horario Final</th>
				<th>Nome do Palco</th>
			</tr>

<?php

                    echo "<tr>";
					echo "<td>" . $Resultado['cod_banda'] . "</td>";
					echo "<td>" . $Resultado['nome_banda'] . "</td>";
						echo "<td>" . $Resultado['DiaShow'] . "</td>";
						echo "<td>" . $Resultado['DuracaoShow'] . "</td>";
						echo "<td>" . $Resultado['HorarioShowInicio'] . "</td>";
						echo "<td>" . $Resultado['HorarioShowFinal'] . "</td>";
						echo "<td>" . $Resultado['NomePalco'] . "</td>";
					echo "</tr>";
?>
</table>

<p><a href="..\aula_menu.php">Menu Principal</a></p>

<br>
<?php
} } else {
?>
<label>Não foram encontrados resultados pelo termo buscado.</label>
<?php
}
?>
</body>
</html>