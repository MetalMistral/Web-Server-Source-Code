<div id="admin-nav">
	<?php if(!isset($_SESSION['Username'])) echo" <li><a href='index.php'>Anmelden</a></li>"; ?>
	<?php if(isset($_SESSION['Username'])) echo" <li><a href='index.php'>Abmelden</a></li>"; ?>
	<li><a href="nachweis.php?action=show">Nachweis</a></li>
	<?php if(isset($_SESSION['Username'])) echo" <li><a href='nachweis.php?action=add'>+</a></li>"; ?>
	<li><a href="kasse.php?action=show">Kasse</a></li>
	<?php if(isset($_SESSION['Username'])) echo" <li><a href='kasse.php?action=add'>+</a></li>"; ?>
</div>
	


