<!doctype html>
<?php
ob_start();
 
?>
<html class="no-js" lang="<?=$currentLanguage->alias?>">
<head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="">
		<meta name="author" content="">		
		<title><?=$fe_preferences->name?> - <?=$currentPage->name?></title>
		<meta name="description" content="<?=$fe_preferences->description?>"/>
		<meta name="keywords" content="<?=$fe_preferences->keywords?>"/>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />		
		<link rel="shortcut icon" href="<?=$fe_preferences->favicon?>">
		<link href="/application/public/box/box.css" rel="stylesheet" type="text/css" />
		<link href="/application/public/box/box-flex.css" rel="stylesheet" type="text/css" />
		<link href="/application/public/assets/scripts/navbar/navbar.css" rel="stylesheet"/>
</head>
<body>
