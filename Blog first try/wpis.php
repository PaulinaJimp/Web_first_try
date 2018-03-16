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
    $objDir = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( './' ) );
    $znaleziony=0;
	$katalog="";
    foreach( $objDir as $objFile )
    {	
    if (basename($objFile) == "info") {
		$f = fopen($objFile, "r");
	if ($f) {
		$line1 = fgets($f);
		
		if($line1==$_POST['user_name']."\r\n")
		{
			$line2 = fgets($f);
			if($line2==md5($_POST['passwd'])."\r\n")
			{
				$znaleziony=1;
				$katalog=dirname($objFile);
				$newdate = str_replace("-", "", $_POST['data']);
				$newtime = str_replace(":","",$_POST['time']);
				$jakisnumer = (date("s")*strlen($_POST['user_name']))%100;
				$jakisnumer = str_pad($jakisnumer,2, "0",STR_PAD_LEFT);
				$newfile = $newdate . $newtime . date("s") . $jakisnumer;
				$plik = fopen(dirname($objFile)."/".$newfile,"w");
				if (!flock($plik, LOCK_EX))
					return 'Nie można zablokować pliku do zapisu.';
	
				if ($plik === false)
					return 'Nie można otworzyć pliku: "' . $file_path . '"';

				fputs($plik, $_POST['user_name']."\r\n");
				fputs($plik, $_POST['about']."\r\n");
				flock($plik, LOCK_UN);
				fclose($plik);
				$count =0;
				$max_rozmiar = 1024*1024;
				//if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
				//	$last = substr(strrchr($_FILES['file1']['name'], '.'), 1 );
				//	$count=$count+1;
				//	$plikk = fopen(dirname($objFile)."/".$newfile.$count.".".$last,"w");
				//	fputs($plikk, file_get_contents($_FILES['file1']['tmp_name']));
				//	fclose($plikk);
				//} 
				//if (is_uploaded_file($_FILES['file2']['tmp_name'])) {
				//	$last = substr(strrchr($_FILES['file1']['name'], '.'), 1 );
				//	$count=$count+1;
				//	$plikk = fopen(dirname($objFile)."/".$newfile.$count.".".$last,"w");
				//	fputs($plikk, file_get_contents($_FILES['file2']['tmp_name']));
				//	fclose($plikk);
				//}
				//if (is_uploaded_file($_FILES['file3']['tmp_name'])) {
				//	$last = substr(strrchr($_FILES['file1']['name'], '.'), 1 );
				//	$count=$count+1;
				//	$plikk = fopen(dirname($objFile)."/".$newfile.$count.".".$last,"w");
				//	fputs($plikk, file_get_contents($_FILES['file3']['tmp_name']));
				//	fclose($plikk);
				//}
				for ($j = 0; $j < sizeof($_FILES); $j++) {
                    if (sizeof($_FILES["file" . ($j + 1)]["name"]) > 0) {
						$last = substr(strrchr($_FILES["file" . ($j + 1)]['name'], '.'), 1 );
						$count=$count+1;
						$plikk = fopen(dirname($objFile)."/".$newfile.$count.".".$last,"w");
						fputs($plikk, file_get_contents($_FILES["file" . ($j + 1)]['tmp_name']));
						fclose($plikk);
                        //$uploaddir = $bname;
                        //$fileName = $_FILES["file" . ($j + 1)]["name"];
                        //$extension = explode(".", $fileName)[sizeof(explode(".", $fileName)) - 1];
                        //$uploadfile = $uploaddir . "/" . $fileDateHour . $i . $j . "." . $extension;
                        //echo $uploadfile;
                        //move_uploaded_file($_FILES["file" . ($j + 1)]["tmp_name"], $uploadfile);
                        //echo "ok";
                    }
                    echo $j;
                }

			}	
		}	
	}
		fclose($f);
    }
	}
	
	if($znaleziony==0)
	{
		echo "nie ma takiego blogu";
		#header("Location: dodaj_wpis.php?error=nie%20wypelniles%20formularza");
		#exit();
	}
	header("Location: blog.php?name=".substr($katalog,2));
	exit();
    ?>

	
</body>
</html>
