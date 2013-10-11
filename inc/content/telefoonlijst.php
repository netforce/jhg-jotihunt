<p>De autoritten die op dit moment gaande zijn:</p>
<table>
	<tr align="left">
		<th rowspan="2">Naam</th>
		<th colspan="3">Activiteiten</th>
		<th>Tel</th>
		<th title="Whatsapp?">Whapp?</th>
		<th title="Rijbewijs?">Rijbew?</th>
		<th>Punten</th>
	</tr>
	<tr>
		<th class="activityTable">net</th>
		<th>nu</th>
		<th class="activityTable">straks</th>
	</tr>
<?php
	
	$sql=mysql_query('SELECT * FROM deelnemers ORDER BY naam');
	while ($row=mysql_fetch_array($sql)){
	
	$id = $row['id'];
	$naam = $row['naam'];
	$activiteiten_arr = array_pad(explode("_", $row['activiteiten'], 30), 30, "Niets");
	$tel = $row['tel'];
	$whatsapp = $row['whatsapp'];
	$chauffeur = $row['chauffeur'];
	$punten = $row['punten'];

?>
<tr id="<?=$id;?>">
	<td>
		<?=$naam;?>
	</td>
		<?php
	
			// dag: date('d');
			// uur: date('G');
			
			if(date('d') <= 19 && date('n') == 9){
				$currentHour = date('G') - 9; // 09:00 's ochtends is uur 0
			}else if(date('d') > 19 && date('n') == 9){
				$currentHour = date('G') - 24;
			}else{
				$currentHour = 1;
			}
			
			for($j=0; $j<3; $j++){
				echo ($j==0)? "<td class='activityTable' title='Vorig uur'>" : ( $j==1? "<td title='Nu'>": "<td class='activityTable' title='Volgend uur'>");
			
				switch($activiteiten_arr[$currentHour-1+$j]){
					case "0":
						echo "Hunten ";
					break;
					case "1":
						echo "Puzzelen ";
					break;
					case "2":
						echo "Opdrachten ";
					break;
					case "3":
						echo "Slapen ";
					break;
					default:
						echo $activiteiten_arr[$currentHour-1+$j]." ";
					break;
				}
				echo"</td>";
			}
		?>
	<td>
		<?=$tel;?>
	</td>
	<td>
		<?php
		echo ($whatsapp == '1')? "Ja" : "Nee";
		?>
	</td>
	<td>
		<?php
		echo ($chauffeur == '1')? "Ja" : "Nee";
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