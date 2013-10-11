<?php $page='opdrachten'; include('inc/functions.inc.php');?>
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
		<h2>Opdrachten</h2>
		<?php
		include('connect.php');
		if(isset($_POST['hdnCmd'])){
			logUpdate($page);
			//*** Add Condition ***//
			if($_POST["hdnCmd"] == "Add"){
				$query = "INSERT INTO opdrachten SET ";
				$query .="naam='".$_POST["addNaam"]."', ";
				$query .="coordinator='".$_POST["addCoordinator"]."', ";
				$query .="deadline='".$_POST["addDeadline"]."', ";
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
				$query = "UPDATE opdrachten SET ";
				$query .="naam='".$_POST["editNaam"]."', ";
				$query .="coordinator='".$_POST["editCoordinator"]."', ";
				$query .="deadline='".$_POST["editDeadline"]."', ";
				$query .="status='".$_POST["editStatus"]."', ";
				$query .="punten='".$_POST["editPunten"]."' ";
				$query .="WHERE id = '".$_POST["hdnEditactionid"]."' ";
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
			$query = "DELETE FROM opdrachten ";
			$query .="WHERE id = '".$_GET["actionid"]."' ";
			$result = mysql_query($query);
			if(!$result)
			{
				echo "Error while deleting: [".mysql_error()."]";
			}
			//header("location:$_SERVER[PHP_SELF]");
			//exit();
		}
		$query = "SELECT * FROM opdrachten";
		$result = mysql_query($query) or die ("Error Query [".$query."]");
		?>
		<form name="form" method="post" action="<?=$_SERVER["PHP_SELF"];?>">
		<input type="hidden" name="hdnCmd" value="">
		<table>
			<tr>
				<th> <div align="center">Naam </div></th>
				<th> <div align="center">Coordinator </div></th>
				<th> <div align="center">Deadline </div></th>
				<th> <div align="center">Status </div></th>
				<th> <div align="center">Punten </div></th>
				<th> <div align="center">Edit </div></th>
				<th> <div align="center">Delete </div></th>
			</tr>
		<?php
		while($row = mysql_fetch_array($result)){

			if(isset($_GET['action']) && isset($_GET['actionid']) && $_GET['action']=='edit' && $_GET['actionid']==$row['id']){

				?>
				<tr><!--EditMode-->
					<input type="hidden" name="hdnEditactionid" size="5" value="<?=$row["id"];?>">
					<td align="right">		<input type="text" name="editNaam" size="5" value="<?=$row["naam"];?>"></td>
					<td align="right">
						<select name="editCoordinator">
							<option>Coordinator:</option>
							<?php
							
							//genereer select met alle deelnemers als options
							$query3 = "SELECT id, naam FROM deelnemers";
							$result3 = mysql_query($query3) or die ("Error Query [".$query3."]");
							while($row3 = mysql_fetch_assoc($result3)){
								?>
								<option value="<?=$row3['id']?>"<?php if($row['coordinator'] == $row3['id']) echo" selected";?>><?=$row3['naam']?></option>
								<?php
							}
							?>
						</select>
					</td>
					<td align="right">		<input type="text" name="editDeadline" size="5" value="<?=$row["deadline"];?>"></td>
					<td align="right">		
						<select name="editStatus">
							<option value="0"<?php if($row['status']==0) echo' selected'; ?>>Wordt aan gewerkt</option>
							<option value="1"<?php if($row['status']==1) echo' selected'; ?>>Ingestuurd</option>
							<option value="2"<?php if($row['status']==2) echo' selected'; ?>>Goedgekeurd</option>
							<option value="3"<?php if($row['status']==3) echo' selected'; ?>>Afgekeurd</option>
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
				<td align="right">	<?=$row["naam"];?>		</td>
				<td align="right">
					<?php 
						$query3 = "SELECT id, naam FROM deelnemers WHERE id='".$row['coordinator']."'";
						$result3 = mysql_query($query3) or die ("Error Query [".$query3."]");
						while($row3 = mysql_fetch_assoc($result3)){
							echo $row3['naam'];
						}
					?>	
				</td>
				<td align="right">	<?=$row["deadline"];?>		</td>
				<td align="right">	<?php switch($row["status"]){
										case 0:
											echo'Wordt aan gewerkt';
										break;
										case 1:
											echo'Ingestuurd';
										break;
										case 2:
											echo'<span class="greenconfirmation">Goedgekeurd</span>';
										break;
										case 3:
											echo'Afgekeurd';
										break;
										}
									?>	</td>
				<td align="right">	<?=$row["punten"];?>	</td>
				<td align="center">	<a href="<?=$_SERVER["PHP_SELF"];?>?action=edit&actionid=<?=$row["id"];?>" class="edit">Edit</a></td>
				<td align="center">	<a href="javaScript:if(confirm('Wilt u dit echt verwijderen?')==true){window.location='<?=$_SERVER["PHP_SELF"];?>?action=del&actionid=<?=$row["id"];?>';}" class="delete">Delete</a></td>
			</tr>
		<?php
			}
			
		}
		?>
		  <tr><!--Add-->
			<td>					<input type="text" name="addNaam" size="5"  maxlength="12"/>	</td>
			<td align="right">
				<select name="addCoordinator">
					<option>Coordinator:</option>
					<?php
					
					//genereer select met alle deelnemers als options
					$query3 = "SELECT id, naam FROM deelnemers";
					$result3 = mysql_query($query3) or die ("Error Query [".$query3."]");
					while($row3 = mysql_fetch_assoc($result3)){
						?>
						<option value="<?=$row3['id']?>"<?php if($row['coordinator'] == $row3['id']) echo" selected";?>><?=$row3['naam']?></option>
						<?php
					}
					?>
				</select>
			</td>
			<td align="right">		<input type="text" name="addDeadline" size="5" />	</td>
			<td align="right">		<select name="addStatus" />
										<option value="0">Wordt aan gewerkt</option>
										<option value="1">Ingestuurd</option>
										<option value="2">Goedgekeurd</option>
										<option value="3">Afgekeurd</option>
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