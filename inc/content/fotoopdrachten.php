<p>De <a href="http://jotihunt.net/?soort=fotoopdracht" target="_blank">foto-opdrachten</a> die we tot nu toe hebben gekregen:</p>
<table>
	<tr align="left">
		<th>Locatie</th>
		<th>Status</th>
		<th>Punten</th>
	</tr>
<?php
	$index = 0;
	
	$sql=mysql_query('SELECT * FROM foto ORDER BY id');
	while ($row=mysql_fetch_array($sql)){
	$index++;
	
	$id = $row['id'];
	$lat[$index] = $row['lat'];
	$lng[$index] = $row['lng'];
	$status = $row['status'];
	$punten = $row['punten'];

?>
<tr id="<?=$index;?>">
	<td width="100">
		<div class="coords-wgs" onmouseover="ConvertToRD(this)" onmouseout="hideTooltip(this)">
			<a href="https://maps.google.nl/maps?hl=nl&q=<?php echo $lat[$index]."+".$lng[$index]; ?>" target="_blank"><?php echo $lat[$index]." ".$lng[$index]; ?></a>
			<span class="rdtag"></span>
		</div>
	</td>
	<td>
		<?php
		switch($status){
			case 0: echo "Open"; break; 
			case 1: echo "Opgepakt"; break; 
			case 2: echo "Opgelost"; break; 
			case 3: echo "Onderweg"; break; 
			case 4: echo "Ingestuurd"; break; 
			case 5: echo "<span class='green'>Goedgekeurd</span>"; break; 
			case 6: echo "<span class='red'>Afgekeurd</span>"; break; 
		}
		?>
	</td>
	<td width="20">
		<?=$punten;?>
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
			infoWindow: {
				content: '<a href="fotoopdrachten#<?=$i;?>"><?=$lat[$i]." ".$lng[$i];?></a>'
			}
		});

	<?php 
	}
?>
</script>