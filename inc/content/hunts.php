<p>Lopende en afgelopen hunts:</p>
<table>
	<tr align="left">
		<th>Team</th>
		<th>Code</th>
		<th>Tijdstip</th>
		<th>Locatie</th>
		<th>Status</th>
		<th>Punten</th>
	</tr>
<?php
	$totaalpunten = 0;
	$index = 0;
	$sql=mysql_query('SELECT * FROM hunts ORDER BY id');
	while ($row=mysql_fetch_array($sql)){
	
	$index++;
	$id[$index] = $row['id'];
	$team[$index] = $row['team'];
	$code = $row['code'];
	$tijdstip = $row['tijdstip'];
	$lat[$index] = $row['lat'];
	$lng[$index] = $row['lng'];
	$status = $row['status'];
	$punten = $row['punten'];
	
	$totaalpunten += $punten;
?>
<tr id="<?=$index;?>">
	<td width="10">
		<a href="http://jotihunt.net/<?php echo strtolower($team[$index]).".html"?>" target="_blank"><?=$team[$index]?></a>
	</td>
	<td width="140">
		<?=$code?>
	</td>
	<td width="50">
		<?=$tijdstip?>
	</td>
	<td width="90px">
		<div class="coords-wgs" onmouseover="ConvertToRD(this)" onmouseout="hideTooltip(this)">
			<a href="https://maps.google.nl/maps?hl=nl&q=<?php echo $lat[$index]."+".$lng[$index]?>" target="_blank"><?php echo $lat[$index]." ".$lng[$index]?></a>
			<span class="rdtag"></span>
		</div>
	</td>
	<td>
		<?php 
			switch($status){
				case 0:
					echo "Ingezonden";
				break;
				case 1:
					echo "<span class='green'>Goedgekeurd</span>";
				break;
				case 2:
					echo "<span class='red'>Afgekeurd</span>";
				break;
			}
		?>
	</td>
	<td align="right">
		<?php echo $punten?>
	</td>
</tr>
<?php 
	}//endofWhile
	?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="right" style="border-top: 1px solid #333;"><?php echo $totaalpunten?></td>
	</tr>
</table>

<div id="map"></div>
<script type="text/javascript">
var map = new GMaps({
		div: '#map',
		width: '90%',
		height: '400px',
		lat: 52.1,
		lng: 5.82,
		zoom: 8,

});
drawAreas();
<?php
	for($i=1; $i < 6; $i++){
	?>
		map.addMarker({
			lat: <?=$lat[$i];?>,
			lng: <?=$lng[$i];?>,
			title: '<?=$team[$i];?>',
			infoWindow: {
				content: '<a href="hunts#<?=$i;?>"><?=$team[$i];?></a><p><?=$lat[$i];?> <?=$lng[$i];?></p>'
			}
		});

	<?php 
	}
?>
</script>