<?php $page='telefoonlijst'; include('inc/functions.inc.php');?>
<!DOCTYPE html> 
<html>
<head>
	<title>Admin - Jotihunt</title>
	<?php require('inc/headers.inc.php'); ?>
	<script language="JavaScript" type="text/javascript">
	<!--
	function checkIfOther(val, target){
		 var element=document.getElementById(target);
		 if(val=='4')
		   element.style.display='block';
		 else  
		   element.style.display='none';
	}
	function showhide(id){
		document.getElementById(id).style.display = (document.getElementById(id).style.display == "none") ? "" : "none";
	}
	//-->
	</script>
</head>
<body>
<div id="wrapper">

	<div id="top">
		<?php require('inc/top.inc.php'); ?>	
	</div><!--/#top-->


	<div id="main">
		<h2>Telefoonlijst</h2>
		<?php
		include('connect.php');

		if(isset($_POST['hdnCmd'])){
			logUpdate($page);
			//*** Add Condition ***//
			if($_POST["hdnCmd"] == "Add"){
				$activs = "";
				$query = "INSERT INTO deelnemers SET ";
				$query .="naam='".$_POST["addNaam"]."', ";
				for($i=0; $i<30; $i++){
					if($i<29){
						if($_POST["addActiviteiten$i"] == 4){//if "Anders"
							$activs .= addslashes($_POST["addAnders$i"])."_";
						}else{
							$activs .= $_POST["addActiviteiten$i"]."_";
						}
					}else{//Laatste heeft geen underscore nodig
						if($_POST["addActiviteiten$i"] == 4){//if "Anders"
							$activs .= addslashes($_POST["addAnders$i"]);
						}else{
							$activs .= $_POST["addActiviteiten$i"];
						}
					}
				}
				$query .="activiteiten='".$activs."', ";
				$query .="tel='".$_POST["addTel"]."', ";
				$query .="whatsapp='".$_POST["addWhatsapp"]."', ";
				$query .="chauffeur='".$_POST["addChauffeur"]."', ";
				$query .="punten='".$_POST["addPunten"]."'";
				$result = mysql_query($query);
				if(!$result)
				{
					echo "Error while saving: [".mysql_error()."]";
				}
				//header("location:$_SERVER[PHP_SELF]");
				//exit();
			}

			//*** Update Condition ***//
			if($_POST["hdnCmd"] == "Update"){
			$editActivs = "";
				$query = "UPDATE deelnemers SET ";
				$query .="naam='".$_POST["editNaam"]."', ";
				for($i=0; $i<30; $i++){
					if($i<29){
						if($_POST["editActiviteiten$i"] == 4){//if "Anders"
							$editActivs .= addslashes($_POST["editAnders$i"])."_";
						}else{
							$editActivs .= $_POST["editActiviteiten$i"]."_";
						}
					}else{//Laatste heeft geen underscore nodig
						if($_POST["editActiviteiten$i"] == 4){//if "Anders"
							$editActivs .= addslashes($_POST["editAnders$i"]);
						}else{
							$editActivs .= $_POST["editActiviteiten$i"];
						}
					}
				}
				$query .="activiteiten='".$editActivs."', ";
				$query .="tel='".$_POST["editTel"]."', ";
				$query .="whatsapp='".$_POST["editWhatsapp"]."', ";
				$query .="chauffeur='".$_POST["editChauffeur"]."', ";
				$query .="punten='".$_POST["editPunten"]."' ";
				$query .="WHERE id = '".$_POST["hdnactionid"]."' ";
				$result = mysql_query($query);
				if(!$result)
				{
					echo "Error while updating: [".mysql_error()."]";
				}
				//header("location:$_SERVER[PHP_SELF]");
				//exit();
			}
		}//end if isset(hdnCmd)

		//*** Delete Condition ***//
		if(isset($_GET["action"]) && $_GET["action"] == "del"){
			$query = "DELETE FROM deelnemers ";
			$query .="WHERE id = '".$_GET["actionid"]."' ";
			$result = mysql_query($query);
			if(!$result)
			{
				echo "Error while deleting: [".mysql_error()."]";
			}
			//header("location:$_SERVER[PHP_SELF]");
			//exit();
		}
		$query = "SELECT * FROM deelnemers ORDER BY naam";
		$result = mysql_query($query) or die ("Error Query [".$query."]");
		?>
		<form name="form" method="post" action="<?=$_SERVER["PHP_SELF"];?>">
		<input type="hidden" name="hdnCmd" value="">
		<table>
			<tr>
				<th> <div align="center">Naam</div></th>
				<th> <div align="center">Activiteiten</div></th>
				<th><div align="center">Telefoon</div></th>
				<th> <div align="center">Whatsapp</div></th>
				<th> <div align="center">Chauffeur</div></th>
				<th> <div align="center">Punten</div></th>
				<th></th>
				<th></th>
			</tr>
		<?php
		while($row = mysql_fetch_array($result)){

			if(isset($_GET['action']) && isset($_GET['actionid']) && $_GET['action']=='edit' && $_GET['actionid']==$row['id']){
		
				?>
				<tr><!--EditMode-->
					<input type="hidden" name="hdnactionid" size="5" value="<?=$row["id"];?>">
					<td align="right">		<input type="text" name="editNaam" size="15" value="<?=$row["naam"];?>"></td>
					<td align="right">
						<span onclick="showhide('editAct')" style="cursor:pointer;">+ Activiteiten</span>
						<div id="editAct" style="display:none">

						<?php 
							$activiteiten_arr = array_pad(explode("_", $row['activiteiten'], 30), 30, "niks");
							
							for($i=0; $i<30; $i++){
								$sluitdivwanthetisnuzolaat=0;
								if($i==15)echo'<hr />';
								$j=$i+9; 
								while($j>=24){
									$j=$j-24;
								}
								
								if($j == date("G")){$sluitdivwanthetisnuzolaat=1;echo "<div class='currentHourMarker'>";}
								echo $j.":00";
								
						?>
								<select name="editActiviteiten<?=$i?>" title="<?php $j++; echo "tot ".$j.":00";?>" onchange="checkIfOther(this.value, 'editAnders<?=$i?>')">
									<option value=" ">Activiteit:</option>
									<option value="0"<?php if($activiteiten_arr[$i] == "0") echo" selected";?>>Hunten</option>
									<option value="1"<?php if($activiteiten_arr[$i] == "1") echo" selected";?>>Puzzelen</option>
									<option value="2"<?php if($activiteiten_arr[$i] == "2") echo" selected";?>>Opdrachten</option>
									<option value="3"<?php if($activiteiten_arr[$i] == "3") echo" selected";?>>Slapen</option>
									<option value="4"<?php if($activiteiten_arr[$i] != "0" && $activiteiten_arr[$i] != "1" && $activiteiten_arr[$i] != "2" && $activiteiten_arr[$i] != "3") echo" selected";?>>Anders...</option>
								</select>
								<input type="text" name="editAnders<?=$i?>" id="editAnders<?=$i?>" <?php if($activiteiten_arr[$i] != "0" && $activiteiten_arr[$i] != "1" && $activiteiten_arr[$i] != "2" && $activiteiten_arr[$i] != "3"){echo"style='display:inline' value='".$activiteiten_arr[$i]."'";}else{echo"style='display:none'";};?>/>
								<br />
						<?php 
								if($sluitdivwanthetisnuzolaat==1){echo "</div>";}
							} 
						?>
						</div>
					</td>
					<td align="right">		<input type="text" name="editTel" size="5" value="<?=$row["tel"];?>"></td>
					<td>
						<select name="editWhatsapp">
							<option value="0"<?php if($row['whatsapp'] == '0') echo" selected";?>>Nee</option>
							<option value="1"<?php if($row['whatsapp'] == '1') echo" selected";?>>Ja</option>
						</select>
					</td>
					<td>
						<select name="editChauffeur">
							<option value="0"<?php if($row['whatsapp'] == '0') echo" selected";?>>Nee</option>
							<option value="1"<?php if($row['whatsapp'] == '1') echo" selected";?>>Ja</option>
						</select>
					</td>
					<td align="right">		<input type="text" name="editPunten" size="5" value="<?=$row["punten"];?>"></td>
					<td colspan="2" align="right"><div align="center">
						<input name="btnAdd" type="button" id="btnUpdate" value="Update" OnClick="form.hdnCmd.value='Update';form.submit();">
						<input name="btnAdd" type="button" id="btnCancel" value="Cancel" OnClick="window.location='<?=$_SERVER["PHP_SELF"];?>';">
					</div></td>
				</tr>
			  <?php
				//}
			}else{
			
	
				// dag: date('d');
				// uur: date('G');
				
				if(date('d') <= 19 && date('n') == 9){
					$currentHour = date('G') - 9; // 09:00 's ochtends is uur 0
				}else if(date('d') > 19 && date('n') == 9){
					$currentHour = date('G') - 24;
				}else{
					$currentHour = 1;
				}
			
		  ?>
			<tr><!--Default-->
				<td><?=$row['naam']?></td>
				<td><?php
						$activiteiten_arr = array_pad(explode("_", $row['activiteiten'], 30), 30, "Niets");
						echo "<table width='300px'><tr><td width='60'>Net</td><td width='100px'>Nu</td><td>Straks</td></tr><tr>";
						for($j=0; $j<3; $j++){
							echo ($j=='1') ? "<td class='currentActivity'>" : "<td>";
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
						echo"</tr></table>";
					?>
				</td>
				<td><?=$row['tel']?></td>
				<td>	<?php switch($row["whatsapp"]){
										case 0:
											echo'Nee';
										break;
										case 1:
											echo'Ja';
										break;
										}
									?>	
				</td>
				<td>	<?php switch($row["chauffeur"]){
										case 0:
											echo'Nee';
										break;
										case 1:
											echo'Ja';
										break;
										}
									?>	
				</td>
				<td align="right">	<?=$row["punten"];?>		</td>
				<td align="center">	<a href="<?=$_SERVER["PHP_SELF"];?>?action=edit&actionid=<?=$row["id"];?>" class="edit">Edit</a></td>
				<td align="center">	<a href="javascript:if(confirm('Wilt u dit echt verwijderen?')==true){window.location='<?=$_SERVER["PHP_SELF"];?>?action=del&actionid=<?=$row["id"];?>';}" class="delete">Delete</a></td>
			</tr>
		<?php
			}
			
		}
		?>
		  <tr><!--Add-->
			<td align="right">		<input type="text" name="addNaam" size="15" />	</td>
			<td align="right">
				<span onclick="showhide('addAct')" style="cursor:pointer;">+ Activiteiten</span>
				<div id="addAct" style="display:none">
				<?php 
					for($i=0; $i<30; $i++){
						$sluitdivwanthetisnuzolaat = 0;
						if($i==15)echo'<hr />';
						$j=$i+9; 
						while($j>=24){
							$j=$j-24;
						}
						
						if($j == date("G")){$sluitdivwanthetisnuzolaat=1;echo "<div class='currentHourMarker'>";}
						echo $j.":00";
				?>
						<select name="addActiviteiten<?=$i?>" title="<?php $j++; echo "tot ".$j.":00";?>" onchange="checkIfOther(this.value, 'addAnders<?=$i?>')">
							<option value=" ">Activiteit:</option>
							<option value="0">Hunten</option>
							<option value="1">Puzzelen</option>
							<option value="2">Opdrachten</option>
							<option value="3">Slapen</option>
							<option value="4">Anders...</option>
						</select>
						<input type="text" name="addAnders<?=$i?>" id="addAnders<?=$i?>" style="display:none;"/>
						<br />
				<?php 
						if($sluitdivwanthetisnuzolaat == '1'){echo "</div>";}
					} 
				?>
				</div>
			</td>
			<td align="right">		<input type="text" name="addTel" size="5" />	</td>
			<td title="Whatsapp?">
				<select name="addWhatsapp">
					<option value="0">Nee</option>
					<option value="1">Ja</option>
				</select>
			</td>
			<td title="Chauffeur?">
				<select name="addChauffeur">
					<option value="0">Nee</option>
					<option value="1">Ja</option>
				</select>
			</td>
			<td align="right">		<input type="text" name="addPunten" size="5" value="0" />	</td>
			<td colspan="2" align="center">
				<input type="button" value="Voeg toe" OnClick="form.hdnCmd.value='Add';form.submit();">
			</td>
		  </tr>
		</table>
		</form>
		<?php
		mysql_close();
		?>
	</div><!--/#main-->


	<div id="sidebar">
		<div id="nav">
			<?php require('inc/menu.inc.php'); ?>
		</div>
	</div><!--/#sidebar-->
	
	<div style="clear:both"></div>
	<div id="footer">
		<?php include('inc/footer.inc.php'); ?>	
	</div>

</div>
</body>
</html>