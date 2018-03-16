<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Lab PHP</title>
</head>
<body>
	<?php include 'menu.php'?> 

    <?php
	$dir_com = $_POST['nazwa_wpisu'].'.k';
	$dir_name = $_POST['nazwa_bloga'];
	if(!file_exists($dir_name.'/'.$dir_com))
	{mkdir($dir_name.'/'.$dir_com,0777);
		$indexFile = fopen($dir_name."/".$dir_com."/index.php", "w") or die("nie udalo mi sie stworzyc pliku index.php");
		fwrite($indexFile,"<?php header('Location: ../../blog.html?error=nie%20masz%20uprawnien%20odwiedzac%20katalogow'); ?>");
		fclose($indexFile);
		chmod($dir_name."/".$dir_com."/index.php",0755);
		}
	
	$dir = opendir($dir_name.'/'.$dir_com); # This is the directory it will count from
    $fi = new FilesystemIterator($dir_name.'/'.$dir_com, FilesystemIterator::SKIP_DOTS);
	$count = iterator_count($fi);
	$count--;
	if($count<0)
		$count =0;
	$plikk = fopen($dir_name.'/'.$dir_com.'/'.$count,"w"); 
	$option = isset($_POST['opinia']) ? $_POST['opinia'] : false;
    if ($option) {
      fputs($plikk,htmlentities($_POST['opinia'], ENT_QUOTES, "UTF-8")."\r\n");
    } 
	fputs($plikk, date('Y-m-d').', '.date('H:i:s')."\r\n");
	fputs($plikk, $_POST['name']."\r\n");
	fputs($plikk, $_POST['about']."\r\n");
	fclose($plikk);
	#$adres='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
 
	#echo 'Adres dokumentu to <b>'.$adres.'</b>';
	header("Location: blog.php?name=".$dir_name);
	exit();
    ?>

	
</body>
</html>