<?php
	$totaalpunten=0;

	$sql=mysql_query('SELECT * FROM updated ORDER BY id DESC LIMIT 1');
	$row_updated = mysql_fetch_array($sql);
	$lastMod = $row_updated['timestamp'];


	//Alle punten optellen en gelijk alle table uitlezen voor verder gebruik ($row_TABLENAME[])
	$sql=mysql_query('SELECT * FROM hunts');
	while ($row_hunts=mysql_fetch_array($sql)){	
		$totaalpunten += $row_hunts['punten'];
		$hunts_team[] = $row_hunts['team'];
		$hunts_tijdstip[] = $row_hunts['tijdstip'];
	}
	$sql=mysql_query('SELECT * FROM hints');
	while ($row_hints=mysql_fetch_array($sql)){	
		$hints_naam[] = $row_hints['naam'];
		$hints_tijdstip[] = $row_hints['tijdstip'];
	}
	$sql=mysql_query('SELECT * FROM tegenhunts');
	while ($row_tegenhunts=mysql_fetch_array($sql)){	
		$totaalpunten += $row_tegenhunts['punten'];
		$tegenhunts_gebeurtenis[] = $row_tegenhunts['gebeurtenis'];
	}
	$sql=mysql_query('SELECT * FROM opdrachten');
	while ($row_opdrachten=mysql_fetch_array($sql)){	
		$totaalpunten += $row_opdrachten['punten'];
		$opdrachten_naam[] = $row_opdrachten['naam'];
		$opdrachten_status[] = $row_opdrachten['status'];
	}
	$sql=mysql_query('SELECT * FROM foto');
	while ($row_foto=mysql_fetch_array($sql)){	
		$totaalpunten += $row_foto['punten'];
		$foto_lat[] = $row_foto['lat'];
		$foto_lng[] = $row_foto['lng'];
		$foto_status[] = $row_foto['status'];
	}
	$sql=mysql_query('SELECT * FROM autoritten');
	while ($row_auto=mysql_fetch_array($sql)){	
		$auto_chauffeur[] = $row_auto['chauffeur'];
		$auto_bijrijders[] = $row_auto['bijrijders'];
	}
	$sql=mysql_query('SELECT * FROM hunts WHERE status="1"');
	while ($row_vossen=mysql_fetch_array($sql)){	
		$vossen_lat[] = $row_vossen['lat'];
		$vossen_lng[] = $row_vossen['lng'];
		$vossen_tijdstip[] = $row_vossen['tijdstip'];
	}
	
?>
<div style="position: absolute; top: 35px; right: 20px;"><?="Update: ".date('H:i (d M)',strtotime($lastMod));?></div>
<p>Welkom op de Jotihunt-website van SJH en HHW! Offici&euml;le Jotihunt-website: <a href="http://jotihunt.net/" target="_blank">Jotihunt</a></p>
<div id="statistieken">
	<div id="punten" class="stats statspunten" style="float:none;">
		<h3>Punten</h3>
		<span><?php echo $totaalpunten?></span>
	</div>
	<div id="hunts" class="stats">
		<h3>Laatste Hunts</h3>
		<span>
				<?php
				if(isset($hunts_team) && count($hunts_team)>0){
					echo "<ul>";
					for($i=count($hunts_team)-1; $i>count($hunts_team)-6; $i--){//laatste 5
						if($i>=0){
				?>
				<li>
					<span class="left-note"><?=$hunts_tijdstip[$i];?></span>
					<a href="hunts#<?=$i+1;?>"><?php echo $hunts_team[$i];?></a>
				</li>
				
				<?php
						}
					}
					echo "</ul>";
				}else{
					echo "Geen hunts beschikbaar";
				}
				?>
		</span>
	</div>
	<div id="hints" class="stats">
		<h3>Laatste Hints</h3>
		<span>
				<?php
				if(isset($hints_naam) && count($hints_naam)>0){
					echo "<ul>";
					for($i=count($hints_naam)-1; $i>count($hints_naam)-6; $i--){//laatste 5
						if($i>=0){
				?>
				<li>
					<span class="left-note"><?=$hints_tijdstip[$i];?></span>
					<a href="hints#<?=$i+1;?>"><?php echo $hints_naam[$i];?></a>
				</li>
				
				<?php 
						}
					}
					echo "</ul>";
				}else{
					echo "Geen hints beschikbaar";
				}
				?>
		</span>
	</div>
	<div id="opdrachten" class="stats" style="clear:both">
		<h3>Laatste Opdrachten</h3>
		<span>
				<?php
				if(isset($opdrachten_naam) && count($opdrachten_naam)>0){
					echo "<ul>";
					for($i=count($opdrachten_naam)-1; $i>count($opdrachten_naam)-6; $i--){//laatste 5
						if($i>=0){
				?>
				<li>
					<?php 
					switch($opdrachten_status[$i]){
						case 0:
							echo "<span class='left-note' title='Wordt aan gewerkt'>Bezig</span>";
						break;
						case 1:
							echo "<span class='left-note' title='Ingestuurd'>Ingestuurd</span>";
						break;
						case 2:
							echo "<span class='left-note' title='Goedgekeurd'>Goed</span>";
						break;
						case 3:
							echo "<span class='left-note' title='Afgekeurd'>Fout</span>";
						break;
					}
					?>
					<a href="opdrachten#<?=$i+1;?>"><?php echo $opdrachten_naam[$i];?></a>
				</li>
				
			<?php 
						}
					}
					echo "</ul>";
				}else{
					echo "Geen opdrachten beschikbaar";
				}
			?>
		</span>
	</div>
	<div id="foto" class="stats">
		<h3>Laatste Foto-Opdrachten</h3>
		<span>
				<?php
				if(isset($foto_lat) && count($foto_lat)>0){
					echo "<ul>";
					for($i=count($foto_lat)-1; $i>count($foto_lat)-6; $i--){//laatste 5
						if($i>=0){
				?>
				<li>
				<?php 
					switch($foto_status[$i]){
						case 0:
							echo "<span class='left-note' title='Open'>Open</span>";
						break;
						case 1:
							echo "<span class='left-note' title='Opgepakt'>Opgepakt</span>";
						break;
						case 2:
							echo "<span class='left-note' title='Opgelost'>Opgelost</span>";
						break;
						case 3:
							echo "<span class='left-note' title='Onderweg'>Onderweg</span>";
						break;
						case 4:
							echo "<span class='left-note' title='Ingestuurd'>Ingestuurd</span>";
						break;
						case 5:
							echo "<span class='left-note' title='Goedgekeurd'>Goed</span>";
						break;
						case 6:
							echo "<span class='left-note' title='Afgekeurd'>Fout</span>";
						break;
					}
					?>
					<div class="coords-wgs" onmouseover="ConvertToRD(this, 'inline')">
						<a href="foto#<?=$i+1;?>" title="<?php echo $foto_lat[$i]." ".$foto_lng[$i]?>"><?php echo $foto_lat[$i]." ".$foto_lng[$i]?></a>
					</div>
					<a href="https://maps.google.nl/maps?hl=nl&q=<?php echo $foto_lat[$i]."+".$foto_lng[$i]?>" target="_blank" style="font-size: 10px !important; position: absolute; right: 0">(kaart)</a>
				</li>
				
				<?php 
						}
					}
					echo "</ul>";
				}else{
					echo "Geen foto-opdrachten beschikbaar";
				}
				?>
		</span>
	</div>
	<div id="autoritten" class="stats" style="clear:both">
		<h3>Huidige Autoritten</h3>
		<span>
			<?php
				if(isset($auto_bijrijders) && count($auto_bijrijders)>0){
					echo "<ul>";
					for($i=count($auto_bijrijders)-1; $i>=0; $i--){//allemaal
						if($i>=0){
				?>
				<li>
					<a href="autoritten#<?=$i+1;?>" style="margin:0;">
				<?php 
					$sql = "SELECT id, naam FROM deelnemers WHERE id='".$auto_chauffeur[$i]."'";
					$result = mysql_query($sql) or die ("Error Query [".$sql."]");
					while($row3 = mysql_fetch_assoc($result)){
						echo $row3['naam'];
					}
					?>
					</a>
					<span style="position:absolute; right:10px"><?php if($auto_bijrijders[$i] != ""){ echo "+".count(explode("_", $auto_bijrijders[$i]));}?></span>
				</li>
				
				<?php 
						}
					}
					echo "</ul>";
				}else{
					echo "Momenteel geen autoritten";
				}
				?>
		</span>
	</div>
	<div id="vossen" class="stats">
		<h3>Vossen</h3>
		<span>
			<?php
				if(isset($vossen_lat) && count($vossen_lat)>0){
					echo "<ul>";
					for($i=count($vossen_lat)-1; $i>count($vossen_lat)-6; $i--){//laatste 5
						if($i>=0){
				?>
				<li>
					<span class="left-note"><?=$vossen_tijdstip[$i];?></span>
				
					<div class="coords-wgs" onmouseover="ConvertToRD(this, 'inline')">
						<a href="vossen#<?=$i+1;?>" title="<?php echo $vossen_lat[$i]." ".$vossen_lng[$i]?>"><?php echo $vossen_lat[$i]." ".$vossen_lng[$i]?></a>
					</div>
					<a href="https://maps.google.nl/maps?hl=nl&q=<?php echo $vossen_lat[$i]."+".$vossen_lng[$i]?>" target="_blank" style="font-size: 10px !important; position: absolute; right: 0">(kaart)</a>
				</li>
				
				<?php 
						}
					}
					echo "</ul>";
				}else{
					echo "Geen vossen beschikbaar";
				}
			?>
		</span>
	</div>

</div>