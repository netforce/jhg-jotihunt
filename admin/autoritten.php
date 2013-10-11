<?php $page='autoritten'; include('inc/functions.inc.php');?>
<!DOCTYPE html> 
<html>
<head>
	<title>Admin - Jotihunt</title>
	<?php require('inc/headers.inc.php'); ?>
</head>
<body>
<div id="wrapper">

	<div id="top">
		<?php require('inc/top.inc.php'); ?>	
	</div><!--/#top-->


	<div id="main">
		<h2>Autoritten</h2>
		<?php
		include('connect.php');

		if(isset($_POST['hdnCmd'])){
			logUpdate($page);
			//*** Add Condition ***//
			if($_POST["hdnCmd"] == "Add"){
				$query = "INSERT INTO autoritten SET ";
				$query .="chauffeur='".$_POST["addChauffeur"]."', ";
				$query .="bijrijders='";
				if($_POST["addBijrijders1"] != "") $query .= $_POST["addBijrijders1"];
				if($_POST["addBijrijders2"] != "") $query .= "_".$_POST["addBijrijders2"];
				if($_POST["addBijrijders3"] != "") $query .= "_".$_POST["addBijrijders3"];
				$query .= "', ";
				$query .="deelgebied='".$_POST["addDeelgebied"]."', ";
				$query .="tracker='".$_POST["addTracker"]."', ";
				$query .="vertrek='".$_POST["addVertrek"]."', ";
				$query .="retour='".$_POST["addRetour"]."'";
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
				$query = "UPDATE autoritten SET ";
				$query .="chauffeur='".$_POST["editChauffeur"]."', ";
				$query .="bijrijders='";
				if($_POST["editBijrijders1"] != "") $query .= $_POST["editBijrijders1"];
				if($_POST["editBijrijders2"] != "") $query .= "_".$_POST["editBijrijders2"];
				if($_POST["editBijrijders3"] != "") $query .= "_".$_POST["editBijrijders3"];
				$query .= "', ";
				$query .="deelgebied='".$_POST["editDeelgebied"]."', ";
				$query .="tracker='".$_POST["editTracker"]."', ";
				$query .="vertrek='".$_POST["editVertrek"]."', ";
				$query .="retour='".$_POST["editRetour"]."' ";
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
			$query = "DELETE FROM autoritten ";
			$query .="WHERE id = '".$_GET["actionid"]."' ";
			$result = mysql_query($query);
			if(!$result)
			{
				echo "Error while deleting: [".mysql_error()."]";
			}
			//header("location:$_SERVER[PHP_SELF]");
			//exit();
		}
		$query = "SELECT * FROM autoritten";
		$result = mysql_query($query) or die ("Error Query [".$query."]");
		?>
		<form name="form" method="post" action="<?=$_SERVER["PHP_SELF"];?>">
		<input type="hidden" name="hdnCmd" value="">
		<table>
			<tr>
				<th> <div align="center">Chauffeur</div></th>
				<th> <div align="center">Bijrijders</div></th>
				<th><div align="center">Deelgebied</div></th>
				<th> <div align="center">Tracker</div></th>
				<th> <div align="center">Vertrek</div></th>
				<th> <div align="center">Retour</div></th>
				<th></th>
				<th></th>
			</tr>
		<?php
		while($row = mysql_fetch_array($result)){

			if(isset($_GET['action']) && isset($_GET['actionid']) && $_GET['action']=='edit' && $_GET['actionid']==$row['id']){
		
				?>
				<tr><!--EditMode-->
					<input type="hidden" name="hdnactionid" size="5" value="<?=$row["id"];?>">
					<td>
						<select name="editChauffeur">
							<?php
							$query2 = "SELECT id, naam FROM deelnemers WHERE chauffeur='1'";
							$result2 = mysql_query($query2) or die ("Error Query [".$query2."]");
							while($row2 = mysql_fetch_assoc($result2)){
								?>
								<option value="<?=$row2['id']?>"<?php if($row2['id'] == $row['chauffeur']) echo" selected";?>><?=$row2['naam']?></option>
								<?php
							}
							?>
						</select>
					</td>
					<td>
						<select name="editBijrijders1">
							<option>Bijrijder1:</option>
							<?php
							//split de bijrijders in stukken
							$bijrijders_arr = explode("_", $row['bijrijders']);

							//genereer select met alle deelnemers als options
							$query3 = "SELECT id, naam FROM deelnemers";
							$result3 = mysql_query($query3) or die ("Error Query [".$query3."]");
							while($row3 = mysql_fetch_assoc($result3)){
								?>
								<option value="<?=$row3['id']?>"<?php if(isset($bijrijders_arr[0]) && $bijrijders_arr[0] == $row3['id']) echo" selected";?>><?=$row3['naam']?></option>
								<?php
							}
							?>
						</select>
						<select name="editBijrijders2">
							<option>Bijrijder2:</option>
							<?php
							mysql_data_seek($result3, 0);
							while($row3 = mysql_fetch_assoc($result3)){
								?>
								<option value="<?=$row3['id']?>"<?php if(isset($bijrijders_arr[1]) && $bijrijders_arr[1] == $row3['id']) echo" selected";?>><?=$row3['naam']?></option>
								<?php
							}
							?>
						</select>
						<select name="editBijrijders3">
							<option>Bijrijder3:</option>
							<?php
							mysql_data_seek($result3, 0);
							while($row3 = mysql_fetch_assoc($result3)){
								?>
								<option value="<?=$row3['id']?>"<?php if(isset($bijrijders_arr[2]) && $bijrijders_arr[2] == $row3['id']) echo" selected";?>><?=$row3['naam']?></option>
								<?php
							}
							?>
						</select>

					</td>
					<td>
						<select name="editDeelgebied">
							<option value="1"<?php if($row['deelgebied'] == '1') echo" selected";?>>Alpha</option>
							<option value="2"<?php if($row['deelgebied'] == '2') echo" selected";?>>Bravo</option>
							<option value="3"<?php if($row['deelgebied'] == '3') echo" selected";?>>Charlie</option>
							<option value="4"<?php if($row['deelgebied'] == '4') echo" selected";?>>Delta</option>
							<option value="5"<?php if($row['deelgebied'] == '5') echo" selected";?>>Echo</option>
							<option value="6"<?php if($row['deelgebied'] == '6') echo" selected";?>>Foxtrot</option>
						</select>
					</td>
					<td align="right">
						<select name="editTracker">
							<option value="0"<?php if($row['tracker'] == '1') echo" selected";?>>Nee</option>
							<option value="1"<?php if($row['tracker'] == '1') echo" selected";?>>Ja</option>
						</select>
					</td>
					<td align="right">		<input type="text" name="editVertrek" size="5" value="<?=$row["vertrek"];?>"></td>
					<td align="right">		<input type="text" name="editRetour" size="5" value="<?=$row["retour"];?>"></td>
					<td colspan="2" align="right"><div align="center">
						<input name="btnAdd" type="button" id="btnUpdate" value="Update" OnClick="form.hdnCmd.value='Update';form.submit();">
						<input name="btnAdd" type="button" id="btnCancel" value="Cancel" OnClick="window.location='<?=$_SERVER["PHP_SELF"];?>';">
					</div></td>
				</tr>
			  <?php
				//}
			}else{
		  ?>
			<tr><!--Default-->
				<td>				<?php 
										$query3 = "SELECT id, naam FROM deelnemers WHERE id='".$row['chauffeur']."'";
										$result3 = mysql_query($query3) or die ("Error Query [".$query3."]");
										while($row3 = mysql_fetch_assoc($result3)){
											echo $row3['naam'];
										}
									?>		
				</td>
				<td>				<?php 
										$bijrijders_arr = explode("_", $row['bijrijders']);
										for($i=0; $i<count($bijrijders_arr); $i++){
											$query3 = "SELECT id, naam FROM deelnemers WHERE id='".$bijrijders_arr[$i]."'";
											$result3 = mysql_query($query3) or die ("Error Query [".$query3."]");
											while($row3 = mysql_fetch_assoc($result3)){
												echo $row3['naam']."<br />";
											}
										}
									?>		
				</td>
				<td>	<?php switch($row["deelgebied"]){
										case 1:
											echo'Alpha';
										break;
										case 2:
											echo'Bravo';
										break;
										case 3:
											echo'Charlie';
										break;
										case 4:
											echo'Delta';
										break;
										case 5:
											echo'Echo';
										break;
										case 6:
											echo'Foxtrot';
										break;
										}
									?>	
				</td>
				<td align="right">	<?php echo($row["tracker"] =='1')? "Ja": "Nee";?>		</td>
				<td align="right">	<?=$row["vertrek"];?>		</td>
				<td align="right">	<?=$row["retour"];?>		</td>
				<td align="center">	<a href="<?=$_SERVER["PHP_SELF"];?>?action=edit&actionid=<?=$row["id"];?>" class="edit">Edit</a></td>
				<td align="center">	<a href="javascript:if(confirm('Wilt u dit echt verwijderen?')==true){window.location='<?=$_SERVER["PHP_SELF"];?>?action=del&actionid=<?=$row["id"];?>';}" class="delete">Delete</a></td>
			</tr>
		<?php
			}
			
		}
		?>
		  <tr><!--Add-->
			<td>
				<select name="addChauffeur">
					<option>Chauffeur:</option>
					<?php
					$query = "SELECT id, naam FROM deelnemers WHERE chauffeur='1'";
					$result = mysql_query($query) or die ("Error Query [".$query."]");
					while($row = mysql_fetch_assoc($result)){
						?>
						<option value="<?=$row['id']?>"><?=$row['naam']?></option>
						<?php
					}
					?>
				</select>
			</td>
			<td>
				<select name="addBijrijders1">
					<option value="">Bijrijder1:</option>
					<?php
					$query = "SELECT id, naam FROM deelnemers ORDER BY naam";
					$result = mysql_query($query) or die ("Error Query [".$query."]");
					while($row = mysql_fetch_assoc($result)){
						?>
						<option value="<?=$row['id']?>"><?=$row['naam']?></option>
						<?php
					}
					?>
				</select>
				<select name="addBijrijders2">
					<option value="">Bijrijder2:</option>
					<?php
					mysql_data_seek($result, 0);
					while($row = mysql_fetch_assoc($result)){
						?>
						<option value="<?=$row['id']?>"><?=$row['naam']?></option>
						<?php
					}
					?>
				</select>
				<select name="addBijrijders3">
					<option value="">Bijrijder3:</option>
					<?php
					mysql_data_seek($result, 0);
					while($row = mysql_fetch_assoc($result)){
						?>
						<option value="<?=$row['id']?>"><?=$row['naam']?></option>
						<?php
					}
					?>
				</select>
			</td>
			<td>	
				<select name="addDeelgebied">
					<option value="1">Alpha</option>
					<option value="2">Bravo</option>
					<option value="3">Charlie</option>
					<option value="4">Delta</option>
					<option value="5">Echo</option>
					<option value="6">Foxtrot</option>
				</select>
			</td>
			<td>
				<select name="addTracker">
					<option value="0">Nee</option>
					<option value="1">Ja</option>
				</select>
			</td>
			<td align="right">		<input type="text" name="addVertrek" size="5" value="<?=date('j-m-Y H:i');?>" />	</td>
			<td align="right">		<input type="text" name="addRetour" size="5" />	</td>
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