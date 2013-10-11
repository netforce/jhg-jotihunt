<?php $page='hints'; include('inc/functions.inc.php');?>
<!DOCTYPE html> 
<html>
<head>
	<title>Admin - Jotihunt</title>
	<?php require('inc/headers.inc.php'); ?>
	<style type="text/css">
		input[type="text"][disabled] {
			background-color: #AAA;
		}
	</style>
	<script type="text/javascript">
	<!--
	function checkIfCoords(val, target){
		 var element=document.getElementById(target);
		 if(val=='1')
		   element.disabled = false;
		 else  
		   element.disabled = true;
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
		<h2>Hints</h2>
		<?php
		include('connect.php');

		if(isset($_POST['hdnCmd'])){
			logUpdate($page);
			//*** Add Condition ***//
			if($_POST["hdnCmd"] == "Add"){
				$tmp_arr = "";
				$tmp_lats = "";
				$tmp_lngs = "";
				
				$query = "INSERT INTO hints SET ";
				$query .="naam='".$_POST["addNaam"]."', ";
				$query .="tijdstip='".$_POST["addTijdstip"]."', ";
				for($i=0; $i<6; $i++){
					if($i<5){
						if($_POST["addOpgelost$i"] == 1){
							$tmp_arr .= "1_";
							$tmp_lats .= $_POST["addLats$i"]."_";
							$tmp_lngs .= $_POST["addLngs$i"]."_";
						}else{
							$tmp_arr .= "0_";
							$tmp_lats .= "0_";
							$tmp_lngs .= "0_";
						}
					}else{//Laatste heeft geen underscore nodig
						if($_POST["addOpgelost$i"] == 1){
							$tmp_arr .= "1";
							$tmp_lats .= $_POST["addLats$i"];
							$tmp_lngs .= $_POST["addLngs$i"];
						}else{
							$tmp_arr .= "0";
							$tmp_lats .= "0";
							$tmp_lngs .= "0";
						}
					}
				}
				$query .="opgelost='".$tmp_arr."', ";
				$query .="lats='".$tmp_lats."', ";
				$query .="lngs='".$tmp_lngs."'";
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
				$editTmp_arr = "";
				$editTmp_lats = "";
				$editTmp_lngs = "";
				
				$query = "UPDATE hints SET ";
				$query .="naam='".$_POST["editNaam"]."', ";
				$query .="tijdstip='".$_POST["editTijdstip"]."', ";
				for($i=0; $i<6; $i++){
					if($i<5){
						if($_POST["editOpgelost$i"] == 1){
							$editTmp_arr .= "1_";
							$editTmp_lats .= $_POST["editLats$i"]."_";
							$editTmp_lngs .= $_POST["editLngs$i"]."_";
						}else{
							$editTmp_arr .= "0_";
							$editTmp_lats .= "0_";
							$editTmp_lngs .= "0_";
						}
					}else{//Laatste heeft geen underscore nodig
						if($_POST["editOpgelost$i"] == 1){
							$editTmp_arr .= ["1"];
							$editTmp_lats .= $_POST["editLats$i"];
							$editTmp_lngs .= $_POST["editLngs$i"];
						}else{
							$editTmp_arr .= "0";
							$editTmp_lats .= "0";
							$editTmp_lngs .= "0";
						}
					}
				}
				echo $editTmp_arr, $editTmp_lats, $editTmp_lngs;
				$query .="opgelost='".$editTmp_arr."', ";
				$query .="lats='".$editTmp_lats."', ";
				$query .="lngs='".$editTmp_lngs."'";
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
			$query = "DELETE FROM hints ";
			$query .="WHERE id = '".$_GET["actionid"]."' ";
			$result = mysql_query($query);
			if(!$result)
			{
				echo "Error while deleting: [".mysql_error()."]";
			}
			//header("location:$_SERVER[PHP_SELF]");
			//exit();
		}
		$query = "SELECT * FROM hints ORDER BY id";
		$result = mysql_query($query) or die ("Error Query [".$query."]");
		?>
		<form name="form" method="post" action="<?=$_SERVER["PHP_SELF"];?>">
		<input type="hidden" name="hdnCmd" value="">
		<table>
			<tr>
				<th><div align="center">Hintnaam</div></th>
				<th><div align="center">Tijdstip</div></th>
				<th><div align="center" style="width:120px">Opgelost</div></th>
				<th><div align="center">Lats</div></th>
				<th><div align="center">Longs</div></th>
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
					<td align="right">		<input type="text" name="editTijdstip" size="15" value="<?=$row["tijdstip"];?>"></td>
					<td align="right">
					
						<?php 
							$opgelost_arr = array_pad(explode("_", $row['opgelost'], 6), 6, "0");
							$lats_arr = array_pad(explode("_", $row['lats'], 6), 6, "");
							$lngs_arr = array_pad(explode("_", $row['lngs'], 6), 6, "");
							
							for($i=0; $i<6; $i++){
										
						?>
							<?php
								switch($i){
									case 0: echo"Alpha: "; break;
									case 1: echo"Bravo: "; break;
									case 2: echo"Charlie: "; break;
									case 3: echo"Delta: "; break;
									case 4: echo"Echo: "; break;
									case 5: echo"Foxtrot: "; break;
								}
							?>
								<select name="editOpgelost<?=$i?>" onchange="checkIfCoords(this.value, 'editLats<?=$i?>');checkIfCoords(this.value, 'editLngs<?=$i?>')">
									<option value="0"<?php if($opgelost_arr[$i] == "0") echo" selected";?>>Nee</option>
									<option value="1"<?php if($opgelost_arr[$i] == "1") echo" selected";?>>Ja</option>
								</select>
								<br />
						<?php 
							} 
						?>
					</td>
					<td>
						<?php
							for($i=0; $i<6; $i++){
						?>
						<input type="text" tabindex="<?=$i?>" name="editLats<?=$i?>" id="editLats<?=$i?>" title="Breedtegraad" <?php if($opgelost_arr[$i] != "0"){echo"style='display:inline' value='".$lats_arr[$i]."'";}else{echo"disabled";};?>/>
						<?php
							} 
						?>
					</td>
					<td>
						<?php
							for($i=0; $i<6; $i++){
						?>
						<input type="text" tabindex="<?=$i?>" name="editLngs<?=$i?>" id="editLngs<?=$i?>" title="Lengtegraad" <?php if($opgelost_arr[$i] != "0"){echo"style='display:inline' value='".$lngs_arr[$i]."'";}else{echo"disabled";};?>/>
						<?php
							} 
						?>
					</td>
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
				<td><?=$row['naam']?></td>
				<td><?=$row['tijdstip']?></td>
				<td><?php 	
						for($i=0; $i<6; $i++){
							$opgelost_arr = explode("_", $row['opgelost']);
							switch($i){
								case 0: echo"Alpha: "; break;
								case 1: echo"Bravo: "; break;
								case 2: echo"Charlie: "; break;
								case 3: echo"Delta: "; break;
								case 4: echo"Echo: "; break;
								case 5: echo"Foxtrot: "; break;
							}
							echo($opgelost_arr[$i] == "1")? "<span class='greenconfirmation'>Opgelost</span>" : "Niet opgelost";
							echo"<br />";
						}
					?>
				</td>
				<td><?php 	
						$lats_arr = array_pad(explode("_", $row['lats'], 6), 6, "0");
						for($i=0; $i<6; $i++){
							echo $lats_arr[$i];
							echo "<br />";
						}
					?>
				</td>
				<td><?php 	
						$lngs_arr = array_pad(explode("_", $row['lngs'], 6), 6, "0");
						for($i=0; $i<6; $i++){
							echo $lngs_arr[$i];
							echo "<br />";
						}
					?>
				</td>
				<td align="center">	<a href="<?=$_SERVER["PHP_SELF"];?>?action=edit&actionid=<?=$row["id"];?>" class="edit">Edit</a></td>
				<td align="center">	<a href="javascript:if(confirm('Wilt u dit echt verwijderen?')==true){window.location='<?=$_SERVER["PHP_SELF"];?>?action=del&actionid=<?=$row["id"];?>';}" class="delete">Delete</a></td>
			</tr>
		<?php
			}
			
		}
		?>
		  <tr><!--Add-->
			<td align="right">		<input type="text" name="addNaam" size="15" title="Hintnaam" />	</td>
			<td align="right">		<input type="text" name="addTijdstip" size="10" title="Tijdstip" />	</td>
			<td align="right">
				<?php 
					for($i=0; $i<6; $i++){
						switch($i){
								case 0: echo"Alpha: "; break;
								case 1: echo"Bravo: "; break;
								case 2: echo"Charlie: "; break;
								case 3: echo"Delta: "; break;
								case 4: echo"Echo: "; break;
								case 5: echo"Foxtrot: "; break;
							}
							
				?>
						<select name="addOpgelost<?=$i?>" title="Opgelost?" onchange="checkIfCoords(this.value, 'addLats<?=$i?>');checkIfCoords(this.value, 'addLngs<?=$i?>')">
							<option value="0">Nee</option>
							<option value="1">Ja</option>
						</select>
						<br />
				<?php 
					} 
				?>
			</td>
			<td align="right">
				<?php
					for($i=0; $i<6;$i++){
				?>
					<input type="text" name="addLats<?=$i?>" id="addLats<?=$i?>" size="18" disabled />
				<?php
					}
				?>
			</td>
			<td align="right">
				<?php
					for($i=0; $i<6;$i++){
				?>
					<input type="text" name="addLngs<?=$i?>" id="addLngs<?=$i?>" size="18" disabled />
				<?php
					}
				?>
			</td>
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