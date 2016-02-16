<?php require ("config.php"); ?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
		<meta name="robots" content="noindex,nofollow">
		<title>&nbsp;</title>
		<link rel="stylesheet" type="text/css" href="stylesheet/main.css">

	</head>
	
	<body onload="zeit()">
	
	<?php
	
	include ("config.php");
	/*
		Place code to connect to your DB here.
	*/
	$tbl_name="ausbildungsnachweis";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 2;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['num'];
	
	/* Setup vars for query. */
	$targetpage = "index.php"; 	//your file name  (the name of this file)
	$limit = 5; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name LIMIT $start, $limit";
	$result = mysql_query($sql);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\">� previous</a>";
		else
			$pagination.= "<span class=\"disabled\">� previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next �</a>";
		else
			$pagination.= "<span class=\"disabled\">next �</span>";
		$pagination.= "</div>\n";		
	}
?>

	<?php
		while($row = mysql_fetch_array($result))
		{ ?>
	
		<div id="ausbildungsnachweis">
        	<div id="ausbildungsnachweis-überschrift">
            	<h1>Ausbildungsnachweis Nr. <span><?php echo $row['Ausbildungsnachweis_ID'];?></span></h1>
            </div>
            <div id="ausbildungsnachweis-überschrift-sub-1">
            	<h2>Name: <span><?php echo $row['Ausbildungsnachweis_Name'];?></span></h2>                
            </div>
            <div id="ausbildungsnachweis-überschrift-sub-2">
            	<p>für die Woche vom <span><?php echo $row['Ausbildungsnachweis_WocheStart'];?></span> bis <span><?php echo $row['Ausbildungsnachweis_WocheEnde'];?></span></p>
            </div>
            <div id="ausbildungsnachweis-überschrift-sub-3">
            	<p>Ausbildungsjahr:<span><?php echo $row['Ausbildungsnachweis_JahrStart']." / ".$row['Ausbildungsnachweis_JahrEnde'];?></span></p>
            </div>
            <table width="100%" border="1" cellpadding="0" cellspacing="0">
            	<tr>
                	<th width="5%" ></th>
                    <th width="55%" class="mitte">Ausgeführte Arbeiten, Unterricht, Unterweisungen usw.</th>
                    <th width="10%" class="mitte">Einzelstunden</th>
                    <th width="10%" class="mitte">Gesamtstunden</th>
                    <th width="20%" class="mitte">Ausbildungsabteilung</th>
                </tr>
                <tr>
                	<td class="vertikal" rowspan="5" ></td> <!-- WOCHENTAG -->
                    <td>Mo_1</td>
                    <td></td>
                    <td rowspan="4"></td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td>Mo_2</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td>Mo_3</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td>Mo_4</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td>Mo_5</td>
                    <td></td>
                    <td class="mitte">8</td> <!-- STUNDEN -->
					<td class="mitte">Mo_Abteilung</td>
                </tr> 
                <tr>
                	<td class="vertikal" rowspan="5" ></td> <!-- WOCHENTAG -->
                    <td>Di_1</td>
                    <td>&nbsp;</td>
                    <td rowspan="4"></td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td>Di_2</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td>Di_3</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td>Di_4</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td>Di_5</td>
                    <td></td>
                    <td class="mitte">8</td> <!-- STUNDEN -->
					<td class="mitte">Di_Abteilung</td>
                </tr>  
                <tr>
                	<td class="vertikal" rowspan="5" ></td> <!-- WOCHENTAG -->
                    <td>Mi_1</td>
                    <td>&nbsp;</td>
                    <td rowspan="4"></td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td>Mi_2</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td>Mi_3</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td>Mi_4</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td>Mi_5</td>
                    <td></td>
                    <td class="mitte">8</td> <!-- STUNDEN -->
					<td class="mitte">Mi_Abteilung</td>
                </tr>
                <tr>
                	<td class="vertikal" rowspan="5" ></td> <!-- WOCHENTAG -->
                    <td>Do_1</td>
                    <td>&nbsp;</td>
                    <td rowspan="4"></td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td>Do_2</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td>Do_3</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td>Do_4</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td>Do_5</td>
                    <td></td>
                    <td class="mitte">8</td> <!-- STUNDEN -->
					<td class="mitte">Do_Abteilung</td>
                </tr>
                <tr>
                	<td class="vertikal" rowspan="5" ></td> <!-- WOCHENTAG -->
                    <td>Fr_1</td>
                    <td>&nbsp;</td>
                    <td rowspan="4"></td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td>Fr_2</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td>Fr_3</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td>Fr_4</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td>Fr_5</td>
                    <td></td>
                    <td class="mitte">8</td> <!-- STUNDEN -->
					<td class="mitte">Fr_Abteilung</td>
                </tr>   
                <tr>
                	<td class="vertikal" rowspan="3" ></td> <!-- WOCHENTAG -->
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td rowspan="2"></td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td>&nbsp;</td>
                    <td></td>
                    <td>&nbsp;</td> <!-- STUNDEN -->
                </tr>   
                <tr>
                	<td class="vertikal" rowspan="3" ></td> <!-- WOCHENTAG -->
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td rowspan="2"></td>
                    <td>&nbsp;</td>
                </tr>    
                <tr>
                	<td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td>&nbsp;</td>
                    <td></td>
                    <td>&nbsp;</td> <!-- STUNDEN -->
                </tr>
            </table>
			<div id="ausbildungsnachweis-gesamt">
				<div id="ausbildungsnachweis-gesamt-stunden"><i>Gesamtstunden</i></div>
				<div id="ausbildungsnachweis-gesamt-stunden-sub">
					<div id="ausbildungsnachweis-gesamt-stunden-text">40</div>
				</div>
			</div>
			
			<div id="box">
			<div id="s-box" class="ausbildungsnachweis-unten-linie">
				<span class="überschrift">Besondere Bemerkungen</span>
				<span class="sub-überschrift">Auszubildender</span>
			</div>
			
			<div id="s-box" class="ausbildungsnachweis-links-linie ausbildungsnachweis-unten-linie">
				<span class="sub-überschrift">Ausbildender bzw. Ausbilder</span>
			</div>
			<div id="s-box">
				<span class="s-überschrift">Für die Richtigkeit</span>
				<span class="datum">Datum</span>
				<span class="unterschrift-1">Unterschrift des Auszubildenden</span>
			</div>
			
			<div id="s-box" class="ausbildungsnachweis-links-linie">
				<span class="datum">Datum</span>
				<span class="unterschrift-2">Unterschrift des Ausbildenden bzw. Ausbilders</span>
			</div>
			
			</div>
		</div>
	<?php
		}
	?>

<?=$pagination?>
	
	
    	
	
	
		<span id="time"></span>
		<script src="js/time.js"></script>
	</body>
</html>