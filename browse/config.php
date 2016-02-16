<?php
	
	error_reporting(0);																						// ERROR LOG AUSSCHALTEN
	session_start();																						// SESSION STARTEN
	
	$DBHOST = "localhost";																					// IP-ADRESSE - HOST DER DATENBANK
	$DBUSER = "root";																						// BENUTZERNAME DER DATENBANK
	$DBPASS = "";																							// PASSWORT DER DATENBANK
	$DBNAME = "ausbildungsnachweis";																		// NAME DER DATENBANK
	
	$DBCONNECT = mysql_connect($DBHOST,$DBUSER,$DBPASS,$DBNAME) or die ("Verbindung fehlgeschlagen.");		// VERBINDUNG ZUR DATENBANK HERSTELLEN
	$DBSELECT = mysql_select_db($DBNAME) or die ("Datenbank konnte nicht gefunden werden.");				// DATENBANK AUSWÄHLEN

?>