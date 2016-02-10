<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
		<meta name="robots" content="noindex,nofollow">
		<title>&nbsp;</title>
		<link rel="stylesheet" type="text/css" href="stylesheet/main.css" media="screen">
		<link rel="stylesheet" type="text/css" href="stylesheet/print.css" media="print">	
	</head>
	
	<body>
	
	<a href="index.php?step=1">Arbeit</a>
	
	<!-- ######################################################## STEP 1 ######################################################## -->
	
	<?php if (isset($_GET['step']) and $_GET['step'] == 1)
	{ ?>
	<h1>STEP 1</h1>
	<form action="index.php?step=2" method="post">
		<input type="text" placeholder="Überschrift" name="TITLE">
		<input type="text" placeholder="Name des Überprüfers" name="TEACHER">
		<input type="text" placeholder="Anzahl der Schüler" name="MAX-PEOPLE" pattern="[0-9]{1,3}">
		<input type="text" placeholder="Maximale Anzahl der Punkte" name="MAX-POINTS" pattern="[0-9]{1,3}">
		<input type="submit" value="BESTÄTIGEN" name="SUBMIT">
	</form>
	<?php
	}
	?>
	
	<!-- ######################################################## STEP 2 ######################################################## -->
	
	<?php if (isset($_GET['step']) and $_GET['step'] == 2)
	{ 
		$_SESSION['TEACHER'] = strip_tags($_POST['TEACHER']);
		$_SESSION['TITLE'] = strip_tags($_POST['TITLE']);
		$_SESSION['MAX-POINTS'] = strip_tags($_POST['MAX-POINTS']);
		$_SESSION['MAX-PEOPLE'] = strip_tags($_POST['MAX-PEOPLE']);
		$t = $_SESSION['MAX-PEOPLE'];
	?>
	<h1>STEP 2</h1>
	<form action="index.php?step=3" method="post">
		<?php
			for ($i = 1 ; $i <= $t ; $i++)
			{
		?>
		<input type="text" placeholder="Name des Schülers" name="PEOPLE-NAME-<?php echo $i;?>">
		<input type="text" placeholder="Erreichte Punkte" name="REACHED-POINTS-<?php echo $i;?>" pattern="[0-9]{1,3}" value="<?php echo rand(0,$_SESSION['MAX-POINTS']);?>"><br><br>

		<?php
			}
		?>
		<input type="submit" value="BESTÄTIGEN" name="SUBMIT">
	</form>
	<?php
	}
	?>
	
	<!-- ######################################################## STEP 3 ######################################################## -->
	
	<?php if (isset($_GET['step']) and $_GET['step'] == 3)
	{ ?>
	<table width="100%" border="0">
		<tr>
			<td width="75%"><h2><?php echo $_SESSION['TITLE'];?></h2></td>
			<td width="25%"><?php echo "erstellt am ". date("d.m.Y");?></td>
		</tr>
	</table>
	
	<table width="100%" border="1">
		<tr>
			<th width="5%">Nr.</th>
			<th width="65%">Name</th>
			<th width="15%">erreichte Punkte</th>
			<th width="7%">in %</th>
			<th width="8%">Note</th>
		</tr>
	<?php	
	
		$Average = 0;
		$Note1 = 0;
		$Note2 = 0;
		$Note3 = 0;
		$Note4 = 0;
		$Note5 = 0;
		$Note6 = 0;
		for ($Schul = 1; $Schul <= $_SESSION['MAX-PEOPLE']; $Schul++)
		{
			$ZensurProzentSchul = number_format(Round(strip_tags($_POST["REACHED-POINTS-$Schul"]) / $_SESSION['MAX-POINTS'] * 100,1),1);
		
			echo "<tr>";
			echo "<td class=\"mitte\">". $Schul. "</td>";
			echo "<td>". strip_tags($_POST["PEOPLE-NAME-$Schul"]). "</td>";
			echo "<td class=\"rechts\">". strip_tags($_POST["REACHED-POINTS-$Schul"]). " von ".$_SESSION['MAX-POINTS']."</td>";
			echo "<td class=\"rechts\">". $ZensurProzentSchul."%";
						
			if ($ZensurProzentSchul <= 33)
			{
				$Zensur = "6";
				echo "<td class=\"mitte\">6</td>";
			}			
			else if ($ZensurProzentSchul <= 39 AND $ZensurProzentSchul <= 34)
			{
				$Zensur = "5.5";
				echo "<td class=\"mitte\">5-</td>";
			}
			else if ($ZensurProzentSchul <= 44 AND $ZensurProzentSchul <= 40)
			{
				$Zensur = "5";
				echo "<td class=\"mitte\">5</td>";
			}
			else if ($ZensurProzentSchul <= 49 AND $ZensurProzentSchul <= 45)
			{
				$Zensur = "5+";
				echo "<td class=\"mitte\">5+</td>";
			}
			else if ($ZensurProzentSchul <= 54 AND $ZensurProzentSchul <= 50)
			{
				$Zensur = "4.5";
				echo "<td class=\"mitte\">4-</td>";
			}
			else if ($ZensurProzentSchul <= 60 AND $ZensurProzentSchul <= 55)
			{
				$Zensur = "4";
				echo "<td class=\"mitte\">4</td>";
			}
			else if ($ZensurProzentSchul <= 65 AND $ZensurProzentSchul <= 61)
			{
				$Zensur = "4";
				echo "<td class=\"mitte\">4+</td>";
			}
			else if ($ZensurProzentSchul <= 70 AND $ZensurProzentSchul <= 66)
			{
				$Zensur = "3.5";
				echo "<td class=\"mitte\">3-</td>";
			}
			else if ($ZensurProzentSchul <= 75 AND $ZensurProzentSchul <= 71)
			{
				$Zensur = "3";
				echo "<td class=\"mitte\">3</td>";
			}
			else if ($ZensurProzentSchul <= 80 AND $ZensurProzentSchul <= 76)
			{
				$Zensur = "3";
				echo "<td class=\"mitte\">3+</td>";
			}
			else if ($ZensurProzentSchul <= 85 AND $ZensurProzentSchul <= 81)
			{
				$Zensur = "2.5";
				echo "<td class=\"mitte\">2-</td>";
			}
			else if ($ZensurProzentSchul <= 90 AND $ZensurProzentSchul <= 86)
			{
				$Zensur = "2";
				echo "<td class=\"mitte\">2</td>";
			}
			else if ($ZensurProzentSchul <= 95 AND $ZensurProzentSchul <= 91)
			{
				$Zensur = "2";
				echo "<td class=\"mitte\">2+</td>";
			}
			else if ($ZensurProzentSchul <= 97 AND $ZensurProzentSchul <= 96)
			{
				$Zensur = "1.5";
				echo "<td class=\"mitte\">1-</td>";
			}
			else if ($ZensurProzentSchul <= 99 AND $ZensurProzentSchul <= 98)
			{
				$Zensur = "1";
				echo "<td class=\"mitte\">1</td>";
			}
			else if ($ZensurProzentSchul >= 100 OR $ZensurProzentSchul <= 100)
			{
				$Zensur = "1";
				echo "<td class=\"mitte\">1+</td>";
			}	
			$Average = number_format($Average + $Zensur / $_SESSION['MAX-PEOPLE'],2);
			echo "</tr>";
			
			if ($Zensur == 1 OR $Zensur == 1.5) { $Note1++;};
			if ($Zensur == 2 OR $Zensur == 2.5) { $Note2++;};
			if ($Zensur == 3 OR $Zensur == 3.5) { $Note3++;};
			if ($Zensur == 4 OR $Zensur == 4.5) { $Note4++;};
			if ($Zensur == 5 OR $Zensur == 5.5) { $Note5++;};
			if ($Zensur == 6) { $Note6++;};
		}
	?>
		</table>
		<table width="100%" border="0">
		<tr>
			<td>überprüft von <?php echo $_SESSION['TEACHER'];?></td>
			<td class="mitte"><hr></td>
		</tr>
		</table>
		
		<table width="100%" border="1">
			<h1>Notenspiegel</h1>
			<tr>
				<th width="16.6%">1</th>
				<th width="16.6%">2</th>
				<th width="16.6%">3</th>
				<th width="16.6%">4</th>
				<th width="16.6%">5</th>
				<th width="16.6%">6</th>
			</tr>
			<tr>	
				<td class="mitte"><?php echo $Note1;?></td>
				<td class="mitte"><?php echo $Note2;?></td>
				<td class="mitte"><?php echo $Note3;?></td>
				<td class="mitte"><?php echo $Note4;?></td>
				<td class="mitte"><?php echo $Note5;?></td>
				<td class="mitte"><?php echo $Note6;?></td>
			</td>
			</tr>
		</table>
		<table>
		<tr>
			<td width="1%" class="rechts"><?php echo "Notendurchschnitt: &#216; ".$Average;?></td>
		</tr>
		</table>
		
	<?php
	}
	
	
	?>
	</body>
</html>