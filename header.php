<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <title>Adminbereich</title>
	<?php if(!isset($_SESSION['Username'])) { echo "<link rel='stylesheet' type='text/css' href='admin.css'>";}?>
    <?php if(isset($_SESSION['Username'])) { echo "<link rel='stylesheet' type='text/css' href='l-admin.css'>";}?>
	<script src="ckeditor/ckeditor.js"></script>
</head>