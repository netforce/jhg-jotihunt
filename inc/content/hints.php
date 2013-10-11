<p>De hints die we tot nu toe hebben gekregen:</p>
<table>
	<tr align="left">
		<th>Naam</th>
		<th>Tijdstip</th>
		<th>Opgelost?</th>
	</tr>
<?php
	$index = 0;
	
	$sql=mysql_query('SELECT * FROM hints ORDER BY id');
	while ($row=mysql_fetch_array($sql)){
	$index++;
	
	$id = $row['id'];
	$naam = $row['naam'];
	$tijdstip = $row['tijdstip'];
	$opgelost = $row['opgelost'];
	$lats = $row['lats'];
	$lngs = $row['lngs'];

	$opgelost_arr = array_pad(explode("_", $row['opgelost']), 5,"0");
	$lats_arr = array_pad(explode("_", $row['lats']), 5,"0");
	$lngs_arr = array_pad(explode("_", $row['lngs']), 5,"0");
?>
<tr id="<?=$index;?>">
	<td width="10">
		<a href="http://jotihunt.net/?soort=hint" target="_blank"><?=$naam?></a></p>
	</td>
	<td width="100">
		<?=$tijdstip?>
	</td>
	<td width="200">
		<table>
		<?php
			for($i=1; $i < 6; $i ++){
			echo "<tr><td>";
				switch($i){
					case 1: echo ($opgelost_arr[$i] == 1)? "<span class='green'>Alpha</span>" : "Alpha"; break;
					case 2: echo ($opgelost_arr[$i] == 1)? "<span class='green'>Bravo</span>" : "Bravo"; break;
					case 3: echo ($opgelost_arr[$i] == 1)? "<span class='green'>Charlie</span>" : "Charlie"; break;
					case 4: echo ($opgelost_arr[$i] == 1)? "<span class='green'>Delta</span>" : "Delta"; break;
					case 5: echo ($opgelost_arr[$i] == 1)? "<span class='green'>Echo</span>" : "Echo"; break;
					case 6: echo ($opgelost_arr[$i] == 1)? "<span class='green'>Foxtrot</span>" : "Foxtrot"; break;
				}
		?>
				</td><td>
				<div class="coords-wgs" onmouseover="ConvertToRD(this)" onmouseout="hideTooltip(this)">
					<a href="https://maps.google.nl/maps?hl=nl&q=<?php echo $lats_arr[$i]."+".$lngs_arr[$i]?>" target="_blank"><?php echo $lats_arr[$i]." ".$lngs_arr[$i]?></a>
					<span class="rdtag"></span>
				</div>
				</td>
			</tr>
		<?php 
			}
		?>
		</table>
	</td>
</tr>
<?php 
	}//endofWhile
	?>
</table>