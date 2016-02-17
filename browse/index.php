<?php require ("config.php"); ?>
<!DOCTYPE html>
<html lang="de">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<meta name="robots" content="noindex,nofollow">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>&nbsp;</title>
	<link rel="stylesheet" type="text/css" href="stylesheet/ausgabe.css">
	</head>
	
<body>
	<?php
		if (isset($_GET['print']) AND isset($_GET['id']))
		{
			$AusbildungsnachweisID = $_GET['id'];
			
			$SelectAusbildungsnachweisInfo = mysql_query("SELECT * FROM Ausbildungsnachweis WHERE Ausbildungsnachweis_ID = '$AusbildungsnachweisID'");
			$RowsAusbildungsnachweisInfo = mysql_num_rows($SelectAusbildungsnachweisInfo);
			
			if ($RowsAusbildungsnachweisInfo == 0)
			{
				echo "Unbefugter Zugriff.";
			}
			else
			{
			
			$FetchAusbildungsnachweisInfo = mysql_fetch_array($SelectAusbildungsnachweisInfo);
			
			$GesamtStunden = $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mo_Gesamt'] +
							 $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Di_Gesamt'] +
							 $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mi_Gesamt'] +
							 $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Do_Gesamt'] +
							 $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Fr_Gesamt'];
			
	?>
	<div id="ausbildungsnachweis">
        	<div id="ausbildungsnachweis-überschrift">
            	<h1>Ausbildungsnachweis Nr. <span><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_ID'];?></span></h1>
            </div>
            <div id="ausbildungsnachweis-überschrift-sub-1">
            	<h2>Name: <span><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Name'];?></span></h2>                
            </div>
            <div id="ausbildungsnachweis-überschrift-sub-2">
            	<p>für die Woche vom <span><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_WocheStart'];?></span> bis <span><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_WocheEnde'];?></span></p>
            </div>
            <div id="ausbildungsnachweis-überschrift-sub-3">
            	<p>Ausbildungsjahr:<span><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_JahrStart']." / ".$FetchAusbildungsnachweisInfo['Ausbildungsnachweis_JahrEnde'];?></span></p>
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
                	<td class="mitte" rowspan="5" ><img src="print/montag.jpg"></td> <!-- WOCHENTAG -->
                    <td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mo_1']; ?></td>
                    <td></td>
                    <td rowspan="4"></td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mo_2']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mo_3']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mo_4']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mo_5']; ?></td>
                    <td></td>
                    <td class="mitte"><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mo_Gesamt']; ?></td> <!-- STUNDEN -->
					<td class="mitte"><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mo_Abteilung']; ?></td>
                </tr> 
                <tr>
                	<td class="mitte" rowspan="5" ><img src="print/dienstag.jpg"></td> <!-- WOCHENTAG -->
                    <td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Di_1']; ?></td>
                    <td>&nbsp;</td>
                    <td rowspan="4"></td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Di_2']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Di_3']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Di_4']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Di_5']; ?></td>
                    <td></td>
                    <td class="mitte"><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Di_Gesamt']; ?></td> <!-- STUNDEN -->
					<td class="mitte"><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Di_Abteilung']; ?></td>
                </tr>  
                <tr>
                	<td class="mitte" rowspan="5" ><img src="print/mittwoch.jpg"></td> <!-- WOCHENTAG -->
                    <td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mi_1']; ?></td>
                    <td>&nbsp;</td>
                    <td rowspan="4"></td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mi_2']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mi_3']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mi_4']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mi_5']; ?></td>
                    <td></td>
                    <td class="mitte"><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mi_Gesamt']; ?></td> <!-- STUNDEN -->
					<td class="mitte"><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Mi_Abteilung']; ?></td>
                </tr>
                <tr>
                	<td class="mitte" rowspan="5" ><img src="print/donnerstag.jpg"></td> <!-- WOCHENTAG -->
                    <td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Do_1']; ?></td>
                    <td>&nbsp;</td>
                    <td rowspan="4"></td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Do_2']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Do_3']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Do_4']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Do_5']; ?></td>
                    <td></td>
                    <td class="mitte"><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Do_Gesamt']; ?></td> <!-- STUNDEN -->
					<td class="mitte"><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Do_Abteilung']; ?></td>
                </tr>
                <tr>
                	<td class="mitte" rowspan="5" ><img src="print/freitag.jpg"></td> <!-- WOCHENTAG -->
                    <td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Fr_1']; ?></td>
                    <td>&nbsp;</td>
                    <td rowspan="4"></td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Fr_2']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>  
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Fr_3']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Fr_4']; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr> 
                <tr>
                	<td><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Fr_5']; ?></td>
                    <td></td>
                    <td class="mitte"><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Fr_Gesamt']; ?></td> <!-- STUNDEN -->
					<td class="mitte"><?php echo $FetchAusbildungsnachweisInfo['Ausbildungsnachweis_Fr_Abteilung']; ?></td>
                </tr>   
                <tr>
                	<td class="mitte" rowspan="3" ><img src="print/samstag.jpg"></td> <!-- WOCHENTAG -->
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
                	<td class="mitte" rowspan="3" ><img src="print/sonntag.jpg"></td> <!-- WOCHENTAG -->
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
					<div id="ausbildungsnachweis-gesamt-stunden-text"><?php echo $GesamtStunden; ?></div>
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
  		}
	?>
</body>
</html>