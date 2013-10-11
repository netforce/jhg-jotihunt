<?php $page='tegenhunts'; include('inc/functions.inc.php');?>
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
		<h2>Tegenhunts</h2>
		<?php
		include('connect.php');
		if(isset($_POST['hdnCmd'])){
			logUpdate($page);
			//*** Add Condition ***//
			if($_POST["hdnCmd"] == "Add"){
				$query = "INSERT INTO tegenhunts SET ";
				$query .="gebeurtenis='".addslashes($_POST["addGebeurtenis"])."', ";
				$query .="timestamp='".$_POST["addTimestamp"]."', ";
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
				$query = "UPDATE tegenhunts SET ";
				$query .="gebeurtenis='".addslashes($_POST["editGebeurtenis"])."', ";
				$query .="timestamp='".$_POST["editTimestamp"]."', ";
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
			$query = "DELETE FROM tegenhunts ";
			$query .="WHERE id = '".$_GET["actionid"]."' ";
			$result = mysql_query($query);
			if(!$result)
			{
				echo "Error while deleting: [".mysql_error()."]";
			}
			//header("location:$_SERVER[PHP_SELF]");
			//exit();
		}
		$query = "SELECT * FROM tegenhunts";
		$result = mysql_query($query) or die ("Error Query [".$query."]");
		?>
		<form name="form" method="post" action="<?=$_SERVER["PHP_SELF"];?>">
		<input type="hidden" name="hdnCmd" value="">
		<table>
			<tr>
				<th> <div align="center">Datum/Tijd</div></th>
				<th> <div align="center">Gebeurtenis</div></th>
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
					<td style="vertical-align:top;"><input type="text" name="editTimestamp" size="15"  maxlength="50" value="<?=$row['timestamp'];?>" /></td>
					<td style="vertical-align:top;">		
						<textarea name="editGebeurtenis" style="width: 280px;height: 50px;" maxlength="200" title="Gebeurtenis. Maximaal 200 tekens"><?=$row['gebeurtenis'];?></textarea>
					</td>
					<td style="vertical-align:top;"><input type="text" name="editPunten" size="4"  maxlength="12" value="<?=$row['punten'];?>" /></td>
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
				<td align="right">	<?=$row["timestamp"];?>		</td>
				<td>	<?php echo nl2br($row["gebeurtenis"]);?>		</td>
				<td align="right">	<?=$row["punten"];?>		</td>
				<td align="center">	<a href="<?=$_SERVER["PHP_SELF"];?>?action=edit&actionid=<?=$row["id"];?>" class="edit">Edit</a></td>
				<td align="center">	<a href="javaScript:if(confirm('Wilt u dit echt verwijderen?')==true){window.location='<?=$_SERVER["PHP_SELF"];?>?action=del&actionid=<?=$row["id"];?>';}" class="delete">Delete</a></td>
			</tr>
		<?php
			}
			
		}
		?>
		  <tr><!--Add-->
			<td style="vertical-align:top;"><input type="text" name="addTimestamp" size="15"  maxlength="50" value="<?=date('j-m-Y H:i');?>" /></td>
			<td align="right" style="vertical-align:top;">		
				<textarea name="addGebeurtenis" style="width: 280px;height: 100px;" maxlength="200" title="Gebeurtenis. Maximaal 200 tekens"></textarea>
			</td>
			<td style="vertical-align:top;"><input type="text" name="addPunten" size="4"  maxlength="12" value="0" /></td>
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