<p>De locaties van de vossen die tot nu toe zijn gevonden:</p>
<table>
	<tr align="left">
		<th>Team</th>
		<th>Code</th>
		<th>Tijdstip</th>
		<th>Locatie</th>
		<th>Punten</th>
	</tr>
<?php
	$index = 0;
	
	$sql=mysql_query("SELECT * FROM hunts WHERE status='1' ORDER BY id");
	while ($row=mysql_fetch_array($sql)){
	$index++;
	
	$id = $row['id'];
	$team[$index] = $row['team'];
	$code = $row['code'];
	$tijdstip = $row['tijdstip'];
	$lat[$index] = $row['lat'];
	$lng[$index] = $row['lng'];
	$status = $row['status'];
	$punten = $row['punten'];

?>
<tr id="<?=$index;?>">
	<td width="10">
		<a href="http://jotihunt.net/<?php echo strtolower($team[$index]).".html"?>" target="_blank"><?=$team[$index];?></a>
	</td>
	<td width="140">
		<?=$code?>
	</td>
	<td width="50">
		<?=$tijdstip?>
	</td>
	<td width="90px">
		<div class="coords-wgs" onmouseover="ConvertToRD(this)" onmouseout="hideTooltip(this)">
			<a href="https://maps.google.nl/maps?hl=nl&q=<?php echo $lat[$index]."+".$lng[$index];?>" target="_blank"><?php echo $lat[$index]." ".$lng[$index];?></a>
			<span class="rdtag"></span>
		</div>
	</td>
	<td align="right">
		<?php echo $punten?>
	</td>
</tr> 
<?php 
	}//endofWhile
	?>
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
	for($i=1; $i <= $index; $i++){
	?>
		map.addMarker({
			lat: <?=$lat[$i];?>,
			lng: <?=$lng[$i];?>,
			title: '<?=$team[$i];?>',
			infoWindow: {
				content: '<a href="vossen#<?=$i;?>"><?=$team[$i];?></a><p><?=$lat[$i]." ".$lng[$i];?></p>'
			}
		});

	<?php 
	}
?>
</script>