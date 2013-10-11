<?php $page='fotoopdrachten'; include('inc/functions.inc.php');?>
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
		<h2>Foto-opdrachten</h2>
		<?php
		include('connect.php');
		if(isset($_POST['hdnCmd'])){
			logUpdate($page);
			//*** Add Condition ***//
			if($_POST["hdnCmd"] == "Add"){
				$query = "INSERT INTO foto SET ";
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
				$query = "UPDATE foto SET ";
				$query .="lat='".$_POST["editLat"]."', ";
				$query .="lng='".$_POST["editLng"]."', ";
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
			$query = "DELETE FROM foto ";
			$query .="WHERE id = '".$_GET["actionid"]."' ";
			$result = mysql_query($query);
			if(!$result)
			{
				echo "Error while deleting: [".mysql_error()."]";
			}
			//header("location:$_SERVER[PHP_SELF]");
			//exit();
		}
		$query = "SELECT * FROM foto";
		$result = mysql_query($query) or die ("Error Query [".$query."]");
		?>
		<form name="form" method="post" action="<?=$_SERVER["PHP_SELF"];?>">
		<input type="hidden" name="hdnCmd" value="">
		<table>
			<tr>
				<th> <div align="center">Lat</div></th>
				<th> <div align="center">Long</div></th>
				<th> <div align="center">Status</div></th>
				<th> <div align="center">Punten</div></th>
				<th> <div align="center">Edit</div></th>
				<th> <div align="center">Delete</div></th>
			</tr>
		<?php
		while($row = mysql_fetch_array($result)){

			if(isset($_GET['action']) && isset($_GET['actionid']) && $_GET['action']=='edit' && $_GET['actionid']==$row['id']){

				?>
				<tr><!--EditMode-->
					<input type="hidden" name="hdnEditactionid" size="5" value="<?=$row["id"];?>">
					<td align="right">		<input type="text" name="editLat" size="5" value="<?=$row["lat"];?>"></td>
					<td align="right">		<input type="text" name="editLng" size="5" value="<?=$row["lng"];?>"></td>
					<td align="right">		<select name="editStatus">
												<option value="0"<?php if($row['status']==0) echo' selected'; ?>>Open</option>
												<option value="1"<?php if($row['status']==1) echo' selected'; ?>>Opgepakt</option>
												<option value="2"<?php if($row['status']==2) echo' selected'; ?>>Opgelost</option>
												<option value="3"<?php if($row['status']==3) echo' selected'; ?>>Onderweg</option>
												<option value="4"<?php if($row['status']==4) echo' selected'; ?>>Ingestuurd</option>
												<option value="5"<?php if($row['status']==5) echo' selected'; ?>>Goedgekeurd</option>
												<option value="6"<?php if($row['status']==6) echo' selected'; ?>>Afgekeurd</option>
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
				<td align="right">	<?=$row["lat"];?>		</td>
				<td align="right">	<?=$row["lng"];?>		</td>
				<td align="right">	<?php switch($row["status"]){
										case 0:
											echo'Open';
										break;
										case 1:
											echo'Opgepakt';
										break;
										case 2:
											echo'Opgelost';
										break;
										case 3:
											echo'Onderweg';
										break;
										case 4:
											echo'Ingestuurd';
										break;
										case 5:
											echo'<span class="greenconfirmation">Goedgekeurd</span>';
										break;
										case 6:
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
			<td>					<input type="text" name="addLat" size="5"  maxlength="12"/>	</td>
			<td align="right">		<input type="text" name="addLng" size="5" />	</td>
			<td align="right">		<select name="addStatus" />
												<option value="0">Open</option>
												<option value="1">Opgepakt</option>
												<option value="2">Opgelost</option>
												<option value="3">Onderweg</option>
												<option value="4">Ingestuurd</option>
												<option value="5">Goedgekeurd</option>
												<option value="6">Afgekeurd</option>
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