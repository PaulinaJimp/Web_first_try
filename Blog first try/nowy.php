<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Lab PHP</title>
</head>
<body>
	<?php
	$x=$_POST['blog_name'];
	$name_file=$x."/info";
	if(!is_dir($x))
	{mkdir($x,0777);
	$indexFile = fopen($x."/index.php", "w") or die("nie udalo mi sie stworzyc pliku index.php");
	fwrite($indexFile,"<?php header('Location: ../blog.php?error=nie%20masz%20uprawnien%20odwiedzac%20katalogow'); ?>");
	fclose($indexFile);
	chmod($x."/index.php",0755);
	
	
	$plik = fopen($name_file,"w");
	fputs($plik, $_POST['user_name']."\r\n");
	fputs($plik, md5($_POST['passwd'])."\r\n");
	fputs($plik, $_POST['about']."\r\n");
	
	fclose($plik);
	header("Location: blog.php?name=".$x);
	exit();
	}
	else {echo "KATALOG JUŻ ISTNIEJE";}
	
		
?>
	
</body>
</html>
