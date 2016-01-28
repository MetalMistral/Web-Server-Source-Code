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
				
					$TBLNAM = "Bericht"; 
					$TBLRES = "Bericht_ID , Bericht_Datum , Bericht_Beschreibung";
					
				if ($_GET['action'] == "add")
				{ ?>
					<h1>Neuer Eintrag</h1>
						<form action="<?php echo $_SERVER['PHP_SELF'];?>?action=add" method="post">
							<table>
							<tr>
								<td width="200px">Datum:</td>
								<td width="800px"><input type="text" name="nachweis_date" autocomplete="off" value="<?php echo date("d.m.Y");?>"></td>
							</tr>
							<tr>
								<td>Beschreibung:</td>
								<td><textarea name="nachweis_desc" id="editor1"></textarea></td>
								<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" name="nachweis_submit" value="hinzufügen"></td>
							</tr>
							</table>
						</form>
				<?php
				}
				else if ($_GET['action'] == "show")
					{
						$ShowNachweisSelect = "SELECT * FROM $TBLNAM ORDER BY Bericht_Datum DESC LIMIT 7";
						$ShowNachweisQuery = mysql_query($ShowNachweisSelect);
						$wochentage = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");
						?>
						<h1>Ü B E R S I C H T</h1>
						<?php
						$RowQuery = mysql_num_rows($ShowNachweisQuery);
						if ($RowQuery == 0) 
						{
							echo "<p> Es befindet sich derzeit nichts im Bericht.</p>";
							die;
						}
						?>
						<table width="100%" border="1">
							<tr>
								<th width="10%">Datum</th>
								<th width="90%">Beschreibung</th>
							</tr>
						<?php while ($ShowNachweisRow = mysql_fetch_array($ShowNachweisQuery))
						{ 
							$getday = $ShowNachweisRow['Bericht_Datum'];
							$zeit = strtotime($getday);
						?>
					<tr>
						<td><center><?php echo $ShowNachweisRow['Bericht_Datum'];?><br><?php echo $wochentage[date("w", $zeit)];?></center></td>
						<td><?php echo $ShowNachweisRow['Bericht_Beschreibung'];?></td>
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
			
			if (isset($_POST['nachweis_submit']))
			{
				if (isset($_GET['action']))
				{				
					if ($_GET['action'] == "add")
					{
						$Nachweis_Date = $_POST['nachweis_date'];
						$Nachweis_Desc = $_POST['nachweis_desc'];
						$Nachweis_Day  = date("w");
						
					if ($Nachweis_Date == "")
					{
						$Nachweis_Date = date("d.m.Y");
					}					
						$CheckIfEntryExistsSelect = "SELECT Bericht_Datum FROM $TBLNAM WHERE Bericht_Datum LIKE '$Nachweis_Date'";
						$CheckIfEntryExistsQuery  = mysql_query($CheckIfEntryExistsSelect, $DBCONN);
						$CheckIfEntryExistsCount  = mysql_num_rows ($CheckIfEntryExistsQuery);
						
						if ($CheckIfEntryExistsCount == 1)
						{
							echo "<p class='msg'>Es existiert bereits einen Eintrag mit dem folgenden Datum ".$Nachweis_Date.".</p>";
						}
						else
						{
							$NachweisBerichtInsert = "INSERT INTO Bericht (Bericht_Datum , Bericht_Beschreibung) VALUES ('$Nachweis_Date', '$Nachweis_Desc')";
							$NachweisBerichtQuery  = mysql_query($NachweisBerichtInsert);
							
							if (!$NachweisBerichtQuery)
							{
								echo "<p class='msg'>Es ist ein Fehler aufgetreten.</p>";
							}							
							echo "<p class='msg'>Erfolgreich eingetragen.</p>";							
						}							
					}					
				}
			}
			?>
	<?php	}
?>
</div>
	


