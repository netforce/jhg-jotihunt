<p>De opdrachten die we tot nu toe hebben gekregen:</p>
<table>
	<tr align="left">
		<th>Naam</th>
		<th>Coordinator</th>
		<th>Deadline</th>
		<th>Status</th>
		<th>Punten</th>
	</tr>
<?php
	$index = 0;
	
	$sql=mysql_query('SELECT * FROM opdrachten ORDER BY id');
	while ($row=mysql_fetch_array($sql)){
	$index++;
	
	$id = $row['id'];
	$naam = $row['naam'];
	$coordinator_id = $row['coordinator'];
	$deadline = $row['deadline'];
	$status = $row['status'];
	$punten = $row['punten'];
	$sql2 = mysql_query("SELECT naam FROM deelnemers WHERE id='$coordinator_id'");
	$coordinator = mysql_fetch_array($sql2);

?>
<tr id="<?=$index;?>">
	<td>
		<a href="http://jotihunt.net/?soort=opdracht" target="_blank"><?=$naam?></a>
	</td>
	<td>
		<a href="telefoonlijst#<?=$coordinator_id;?>"><?=$coordinator[0];?></a>
	</td>
	<td>
		<?=$deadline; ?>
	</td>
	<td>
		<?php
		switch($status){
			case 0: echo "Wordt aan gewerkt"; break; 
			case 1: echo "Ingestuurd"; break; 
			case 2: echo "<span class='green'>Goedgekeurd</span>"; break; 
			case 3: echo "<span class='red'>Afgekeurd</span>"; break; 
		}
		?>
	</td>
	<td>
		<?=$punten; ?>
	</td>
</tr>
<?php 
	}//endofWhile
	?>
</table>