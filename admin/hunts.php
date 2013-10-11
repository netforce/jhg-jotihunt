<?php $page='hunts'; include('inc/functions.inc.php');?>
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
		<h2>Hunts</h2>
		<?php
		include('connect.php');
		if(isset($_POST['hdnCmd'])){
			logUpdate($page);
			//*** Add Condition ***//
			if($_POST["hdnCmd"] == "Add"){
				$query = "INSERT INTO hunts SET ";
				$query .="team='".$_POST["addTeam"]."', ";
				$query .="code='".$_POST["addCode"]."', ";
				$query .="tijdstip='".$_POST["addTijdstip"]."', ";
				$query .="lat='".$_POST["addLat"]."', ";
				$query .="lng='".$_POST["addLng"]."', ";
				$query .="status='".$_POST["addStatus"]."', ";
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
				$query = "UPDATE hunts SET ";
				$query .="team='".$_POST["editTeam"]."', ";
				$query .="code='".$_POST["editCode"]."', ";
				$query .="tijdstip='".$_POST["editTijdstip"]."', ";
				$query .="lat='".$_POST["editLat"]."', ";
				$query .="lng='".$_POST["editLng"]."', ";
				$query .="status='".$_POST["editStatus"]."', ";
				$query .="punten='".$_POST["editPunten"]."' ";
				$query .="WHERE id = '".$_POST["hdnEditHuntID"]."' ";
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
			$query = "DELETE FROM hunts ";
			$query .="WHERE id = '".$_GET["huntid"]."' ";
			$result = mysql_query($query);
			if(!$result)
			{
				echo "Error while deleting: [".mysql_error()."]";
			}
			//header("location:$_SERVER[PHP_SELF]");
			//exit();
		}
		$query = "SELECT * FROM hunts";
		$result = mysql_query($query) or die ("Error Query [".$query."]");
		?>
		<form name="form" method="post" action="<?=$_SERVER["PHP_SELF"];?>">
		<input type="hidden" name="hdnCmd" value="">
		<table>
			<tr>
				<th> <div align="center">Team </div></th>
				<th> <div align="center">Code </div></th>
				<th><div align="center">Tijdstip </div></th>
				<th> <div align="center">Lat </div></th>
				<th> <div align="center">Long </div></th>
				<th> <div align="center">Status </div></th>
				<th> <div align="center">Punten </div></th>
				<th> <div align="center">Edit </div></th>
				<th> <div align="center">Delete </div></th>
			</tr>
		<?php
		while($row = mysql_fetch_array($result)){

			if(isset($_GET['action']) && isset($_GET['huntid']) && $_GET['action']=='edit' && $_GET['huntid']==$row['id']){

				?>
				<tr><!--EditMode-->
					<input type="hidden" name="hdnEditHuntID" size="5" value="<?=$row["id"];?>">
					<td>					<input type="text" name="editTeam" size="5" value="<?=$row["team"];?>"></td>
					<td>					<input type="text" name="editCode" size="10" value="<?=$row["code"];?>"></td>
					<td>					<input type="text" name="editTijdstip" size="16" value="<?=$row["tijdstip"];?>"></td>
					<td align="right">		<input type="text" name="editLat" size="5" value="<?=$row["lat"];?>"></td>
					<td align="right">		<input type="text" name="editLng" size="5" value="<?=$row["lng"];?>"></td>
					<td align="right">		<select name="editStatus">
												<option value="0"<?php if($row['status']==0) echo' selected'; ?>>Ingezonden</option>
												<option value="1"<?php if($row['status']==1) echo' selected'; ?>>Goedgekeurd</option>
												<option value="2"<?php if($row['status']==2) echo' selected'; ?>>Afgekeurd</option>
											</select>
					</td>					
					<td align="right">		<input type="text" name="editPunten" size="2" value="<?=$row["punten"];?>"></td>
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
				<td>				<?=$row["team"];?>		</td>
				<td>				<?=$row["code"];?>		</td>
				<td>				<?=$row["tijdstip"];?>	</td>
				<td align="right">	<?=$row["lat"];?>		</td>
				<td align="right">	<?=$row["lng"];?>		</td>
				<td align="right">	<?php switch($row["status"]){
										case 0:
											echo'Ingezonden';
										break;
										case 1:
											echo'<span class="greenconfirmation">Goedgekeurd</span>';
										break;
										case 2:
											echo'Afgekeurd';
										break;
										}
									?>	</td>
				<td align="right">	<?=$row["punten"];?>	</td>
				<td align="center">	<a href="<?=$_SERVER["PHP_SELF"];?>?action=edit&huntid=<?=$row["id"];?>" class="edit">Edit</a></td>
				<td align="center">	<a href="javaScript:if(confirm('Wilt u dit echt verwijderen?')==true){window.location='<?=$_SERVER["PHP_SELF"];?>?action=del&huntid=<?=$row["id"];?>';}" class="delete">Delete</a></td>
			</tr>
		<?php
			}
			
		}
		?>
		  <tr><!--Add-->
			<td>					<input type="text" name="addTeam" size="5" maxlength="7" />	</td>
			<td>					<input type="text" name="addCode" size="10" />	</td>
			<td>					<input type="text" name="addTijdstip" size="16" /></td>
			<td>					<input type="text" name="addLat" size="5"  maxlength="12"/>	</td>
			<td align="right">		<input type="text" name="addLng" size="5" />	</td>
			<td align="right">		<select name="addStatus" />
										<option value="0">Ingezonden</option>
										<option value="1">Goedgekeurd</option>
										<option value="2">Afgekeurd</option>
									</select>
			</td>
			<td align="right">		<input type="text" name="addPunten" size="2" value="0" />	</td>
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