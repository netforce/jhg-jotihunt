<p>De autoritten die op dit moment gaande zijn:</p>
<table>
	<tr align="left">
		<th>Chauffeur</th>
		<th>Bijrijders</th>
		<th>Deelgebied</th>
		<th>Tracker</th>
		<th>Vertrek</th>
		<th>Retour</th>
	</tr>
<?php
	$index = 0;
	
	$sql=mysql_query('SELECT * FROM autoritten ORDER BY id');
	while ($row=mysql_fetch_array($sql)){
	$index++;
	
	$id = $row['id'];
	$chauffeur_id = $row['chauffeur'];
	$bijrijders = $row['bijrijders'];
	$deelgebied = $row['deelgebied'];
	$tracker = $row['tracker'];
	$vertrek = $row['vertrek'];
	$retour = $row['retour'];
	$sql2 = mysql_query("SELECT naam FROM deelnemers WHERE id='$chauffeur_id'");
	$chauffeur = mysql_fetch_array($sql2);

	$bijrijders_arr = explode("_", $row['bijrijders']);

?>
<tr id="<?=$index;?>">
	<td>
		<a href="telefoonlijst#<?=$chauffeur_id;?>"><?=$chauffeur[0];?></a>
	</td>
	<td width="200">
		<ul>
		<?php
			if(isset($bijrijders_arr) && count($bijrijders_arr)>0){
				foreach($bijrijders_arr as $bijrijder_id){
					$sql3 = mysql_query("SELECT naam FROM deelnemers WHERE id='$bijrijder_id'");
					$bijrijder = mysql_fetch_array($sql3);
					echo "<li><a href='telefoonlijst#".$bijrijder_id."'>".$bijrijder[0]."</a></li>";
				}
			}
		?>
		</ul>
	</td>
	<td>
		<?php
			switch($deelgebied){
				case 1: echo "<a href='http://jotihunt.net/alpha.html' target='_blank'>Alpha</a>"; break;
				case 2: echo "<a href='http://jotihunt.net/bravo.html' target='_blank'>Bravo</a>"; break;
				case 3: echo "<a href='http://jotihunt.net/charlie.html' target='_blank'>Charlie</a>"; break;
				case 4: echo "<a href='http://jotihunt.net/delta.html' target='_blank'>Delta</a>"; break;
				case 5: echo "<a href='http://jotihunt.net/echo.html' target='_blank'>Echo</a>"; break;
				case 6: echo "<a href='http://jotihunt.net/foxtrot.html' target='_blank'>Foxtrot</a>"; break;
			}
		?>
	</td>
	<td>
		<?php
		echo ($tracker == '1')? "Ja" : "Nee";
		?>
	</td>
	<td>
		<?=$vertrek; ?>
	</td>
	<td>
		<?=$retour; ?>
	</td>
</tr>
<?php 
	}//endofWhile
	?>
</table>