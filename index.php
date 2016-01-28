<?php
	session_start();
	error_reporting(0);
	include ('header.php');
?>
<body>
	<?php include ('navigation.php');?>
	<div id="admin-login">
    <?php 
		if (!isset($_SESSION['Username']))
		{
	?>
    	<form action="index.php" method="post">
            <li><h1>A d m i n b e r e i c h</h1></li>
            <li><input type="text" placeholder="Benutzername" name="Username" autocomplete="off" <?php if(isset($_POST['Username'])){ echo "value=".$_POST['Username']."";}?>></li>
            <li><input type="password" placeholder="Passwort" name="Password" autocomplete="off"></li>
            <li><center><input type="submit" value="Anmelden" name="Login"></center></li>
        </form>
        <?php 	
		}
		else
		{
		?>
        <li><h1>A d m i n b e r e i c h</h1></li>
		<form action="index.php" method="post">
        <li><center><input type="submit" value="Abmelden" name="Logout"></center></li>
        <li><center><p class="error">Sie sind bereits eingeloggt.</p></center></li>
        </form>        <?php
		}		
		?>
        <?php
			if (isset($_POST['Login']))
				{
					$Benutzername =  $_POST['Username'];
					$Passwort = md5($_POST['Password']);
					
					if ($Benutzername == "" OR $Passwort == "")
					{
						echo "<li><p class='error'>Fehlgeschlagen: <i>Bitte füllen Sie alle Felder aus.</i></p></li>";
					}
					else 
					{
						require('connect.php');						
						mysql_connect($DBHOST,$DBUSER,$DBPASS) or die ("<li><p class='error'>Fehlgeschlagen: <i>Verbindung zur Datenbank fehlgeschlagen.</i></p></li>");
						mysql_select_db($DBNAME) or die ("<li><p class='error'>Fehlgeschlagen: <i>Verbindung zur Datenbank fehlgeschlagen.</i></p></li>");
						
						$GetIPAdress = $_SERVER['REMOTE_ADDR'];
						$GetCurrentDate = date("H:i:s - d.m.Y");
						$SelectUserInformation = "SELECT AdminArea_Username , AdminArea_Password FROM adminarea WHERE AdminArea_Username='$Benutzername'";
						$QueryUserInformation = mysql_query($SelectUserInformation) or die ("<li><p class='error'>Fehlgeschlagen: <i>Daten konnten nicht verarbeitet werden.</i></p></li>");
						$NumUserInformation = mysql_num_rows($QueryUserInformation);
						if ($NumUserInformation == 1)
						{
							$FetchUserInformation = mysql_fetch_array($QueryUserInformation);
							if ($Passwort == $FetchUserInformation['AdminArea_Password'])
							{
								$UpdateUserInformation = "UPDATE adminarea SET AdminArea_LastLogin='$GetCurrentDate' , AdminArea_IPAdress='$GetIPAdress' WHERE AdminArea_Username='$Benutzername'";
								$QueryUpdateUserInformation = mysql_query($UpdateUserInformation) or die ("<li><p class='error'>Fehlgeschlagen: <i>Daten konnten nicht verarbeitet werden.</i></p></li>");
								$_SESSION['Username'] = $Benutzername;
								header ("Location: index.php");
							}
							else
							{
								echo "<li><p class='error'>Fehlgeschlagen: <i>Die eingebenen Daten sind falsch.</i></p></li>";
							}					
						}
						else
						{
							echo "<li><p class='error'>Fehlgeschlagen: <i>Die eingebenen Daten sind falsch.</i></p></li>";
						}
						
					}
				}
		?>        
        <?php
			if (isset($_POST['Logout']))
			{
				$_SESSION = array();
				session_destroy();
				header ("Location: index.php");
			}	?>
</div>
</body>
</html>