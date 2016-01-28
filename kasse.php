<?php
	session_start();
	error_reporting(0);
	include ('header.php');
?>
<body>
<?php 
	include ('navigation.php');
	if (!isset($_SESSION['Username']) and $_GET['action'] == "add")
			{ ?>
			<div id="admin-login">
				<li><p class='error'>Fehlgeschlagen: <i>Sie müssen sich erst anmelden.</i></p></li>
				<li><center><a href="index.php" class='error'>Anmelden</a></center></li>			
			</div>	
	<?php
			}
		else
			{ ?>
			<div id="admin-bericht">
			<?php
				error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
			if (isset($_GET['action']))
			{
					$DBHOST = "localhost";
					$DBUSER = "root";
					$DBPASS = "";
					$DBNAME = "private";
					
					$DBCONN = mysql_connect($DBHOST,$DBUSER,$DBPASS) or die ("Verbindung fehlgeschlagen");
					$DBSELE = mysql_select_db ($DBNAME,$DBCONN);
				
					$TBLNAM = "Kasse"; 
					$TBLRES = "Kasse_ID , Kasse_Name , Kasse_Betrag , Kasse_Datum , Kasse_Beschreibung";
					
				if ($_GET['action'] == "add")
				{ ?>
					<h1>Neuer Eintrag</h1>
						<form action="<?php echo $_SERVER['PHP_SELF'];?>?action=add" method="post">
							<table>
							<tr>
								<td width="200px">Name:</td>
								<td width="800px"><input type="text" name="Kasse_name" autocomplete="off">
							</tr>
							<tr>
								<td>Betrag:</td>
								<td><input type="text" name="Kasse_value" autocomplete="off">
							</tr>
							<tr>
								<td>Datum:</td>
								<td><input type="text" name="Kasse_date" autocomplete="off" value="<?php echo date("d.m.Y");?>"></td>
							</tr>
							<tr>
								<td>Beschreibung:</td>
								<td><textarea name="Kasse_desc" id="editor1"></textarea></td>
								<script>
									CKEDITOR.replace( 'editor1' );
								</script>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" name="Kasse_submit" value="hinzufügen"></td>
							</tr>
							</table>
						</form>
				<?php
				}
				else if ($_GET['action'] == "show")
					{					
						$ShowKasseSelect = "SELECT * FROM $TBLNAM ORDER BY Kasse_Datum DESC LIMIT 7";
						$ShowKasseQuery = mysql_query($ShowKasseSelect);
						$wochentage = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");
						?>
						<h1>Ü B E R S I C H T</h1>
						<?php
								$SelectSparkasseInformation	= "SELECT * FROM $TBLNAM";
								$QuerySparkasseInformation	= mysql_query($SelectSparkasseInformation);
								$DoesExistSparkasseInformation = mysql_num_rows($QuerySparkasseInformation);
								$MathSparkasseInformation = "SELECT SUM(ROUND(Kasse_Betrag, 2)) AS Kasse_Betrag FROM $TBLNAM";
								$MathQuerySparkasseInformation	= mysql_query($MathSparkasseInformation);
								$MathFetchSparkasseInformation = mysql_fetch_assoc($MathQuerySparkasseInformation);
						
								if ($DoesExistSparkasseInformation == 0 )
								{
									echo "<p> Es befindet sich derzeit nichts in der Kasse.</p>";
									die;
								}
								else
								{
									echo "<p> Es befinden sich derzeit <u>&nbsp;".$MathFetchSparkasseInformation['Kasse_Betrag']."€&nbsp;</u> in der Kasse.</p>";
								}
						?><br>
						<table width="100%" border="1">
							<tr>
								<th width="25%">Name</th>
								<th width="10%">Betrag</th>
								<th width="10%">Datum</th>
								<th width="65%">Beschreibung</th>
							</tr>
						<?php while ($ShowKasseRow = mysql_fetch_array($ShowKasseQuery))
						{ 
							$getday = $ShowKasseRow['Kasse_Datum'];
							$zeit = strtotime($getday);
						?>
					<tr>
						<td><?php echo $ShowKasseRow['Kasse_Name'];?></td>
						<td><center><?php echo $ShowKasseRow['Kasse_Betrag'];?>€</center></td>
						<td><center><?php echo $ShowKasseRow['Kasse_Datum'];?><br><?php echo $wochentage[date("w", $zeit)];?></center></td>
						<td><?php echo $ShowKasseRow['Kasse_Beschreibung'];?></td>
					</tr>
					
						<?php } ?>
						</table>
					<?php }
					else if ($_GET['action'] == "edit")
					{
						echo "edit";
					}
					else 
					{
						header("Location: index.php");
					}
			}	
			
			if (isset($_POST['Kasse_submit']))
			{
				if (isset($_GET['action']))
				{				
					if ($_GET['action'] == "add")
					{
						$Kasse_Name = $_POST['Kasse_name'];
						$Kasse_Value = $_POST['Kasse_value'];
						$Kasse_Date = $_POST['Kasse_date'];
						$Kasse_Desc = $_POST['Kasse_desc'];
						$Kasse_Day  = date("w");
						
					if ($Kasse_Date == "")
					{
						$Kasse_Date = date("d.m.Y");
					}		
							$KasseKasseInsert = "INSERT INTO Kasse (Kasse_Name , Kasse_Betrag , Kasse_Datum , Kasse_Beschreibung) VALUES ('$Kasse_Name', '$Kasse_Value','$Kasse_Date', '$Kasse_Desc')";
							$KasseKasseQuery  = mysql_query($KasseKasseInsert);
							
							if (!$KasseKasseQuery)
							{
								echo "<p class='error'>Es ist ein Fehler aufgetreten.</p>";
							}							
							echo "<p class='msg'>Erfolgreich eingetragen.</p>";							
						}							
					}					
				}
			}
			?>
	<?php	
?>
</div>
	


