<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>blog</title>
<meta http-equiv="Content-Type" content="application/xhtml+xml;
charset=UTF-8" />
<link rel="alternate stylesheet" href="st.css" type="text/css" />
<link rel="alternate stylesheet" href="st1.css" type="text/css" />
<link rel="alternate stylesheet" href="st2.css" type="text/css" />
<link id="pagestyle" href="style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="cssChanger.js"></script>
	<script>

function checked() {
	return document.getElementById("check").checked; 
}

function checkValues() {
	return document.getElementById("nick").value && document.getElementById("message").value; // Jesli wpisane zwraca true
}

(function poll(){
    $.ajax({ url: "server", success: function(data){
        //Update your dashboard gauge
        salesGauge.setValue(data.value);
    }, dataType: "json", complete: poll, timeout: 30000 });
})();
function update() {
	
	document.getElementById("chat").innerHTML = ""; 

	var xmlhttp;
	if (window.XMLHttpRequest) { // Dla przegladarek IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else { // Dla przegladarek IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
var bloggValue = encodeURIComponent(document.getElementById("blogg").value);
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==3 && xmlhttp.status==200) { // Ladowanie polaczenia
			if (checked()) { 
				document.getElementById("chat").innerHTML=xmlhttp.responseText;
			}
		}
		if (xmlhttp.readyState==4) { // Zamykanie polaczenia
			//xmlhttp.open("GET","messages.php",true);
			//xmlhttp.send();
			xmlhttp.open("GET", "messages.php?blogg="+bloggValue, true); 
			xmlhttp.send();
			
		}
	}	
	xmlhttp.open("GET", "messages.php?blogg="+bloggValue, true); 
	xmlhttp.send();
	//xmlhttp.open("GET", "messages.php", true); // Specyfikacja typu polaczenia
	//xmlhttp.send(); // Wyslanie zapytania do serwera
}


function send() {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	var nickValue = encodeURIComponent(document.getElementById("nick").value); 
	var messageValue = encodeURIComponent(document.getElementById("message").value); 
	var bloggValue = encodeURIComponent(document.getElementById("blogg").value); 

	xmlhttp.open("GET", "send.php?message="+messageValue+"&nick="+nickValue+"&blogg="+bloggValue, true); 
	xmlhttp.send();
	
	

	document.getElementById("message").value = ""; 
}
</script>
</head>
<body onload="onload2()">
<?php include 'menu.php'?> 
<form action="blog.php" method="GET" >
  <p>WYBIERZ BLOG:<br/>
  <input type="text" name="name" value="" />
  <br/> <br/>

  <input type="submit" value="WYŚLIJ" />
  <input type="reset" value="WYCZYŚĆ" />
 </p>
</form> 
<?php
$nazwa_bloga=$_GET['name'];
if($nazwa_bloga=="")
	{
		echo "<h3>Lista blogow:</h3>";
		$links = array();
		foreach(glob('*', GLOB_ONLYDIR) as $sName)
		{
			$links[$sName] = "http://localhost/ppp/formularz_1/blog.php?name=".$sName;
		}
	
		foreach($links as $k => $v) {
			
			echo '<a href="'.$v. '">' . $k . '</a>'.'<br/>'; 
		}
	}
else
	{

	$znaleziono=0;
	foreach(glob('*', GLOB_ONLYDIR) as $sName)
		{
			if($sName==$nazwa_bloga)
			{$znaleziono=1;
			break;}
		}
	if ($znaleziono==0){
	echo "<p>nie ma bloga o takiej nazwie...</p>";
} else {
	
	//TUTAJ ZAZYNA WCZYTYWAĆ BLOGA!!
	
	echo '<h1>'.$sName.'</h1>';
	
	echo '

<!-- Trigger/Open The Modal -->
<button id="myBtn">Otwórz czat</button>


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      CZAT
	  <input type="checkbox" name="check" id="check" onchange="update()" value="">
	  <input type="text" name="blogg" id="blogg" hidden="hidden" value="'.$_GET['name'].'"/>
	  <br>
    </div>
    <div class="modal-body">
      <textarea rows="10" cols="80" id="chat" style="background: #FFF; width:100%; color:black" disabled></textarea><br/>
      
    </div>
    <div class="modal-footer">
  imię: <input type="text" name="nick" id="nick" />
  wiadomość: <input type="text" name="message" id="message" />
  <button type="button" value="Wyślij" onclick="if (checked() && checkValues()) { send(); } else { alert(\'Uruchom czat a następnie wpisz nick i wiadomość\'); }">Wyślij</button>
</form>
    </div>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById(\'myModal\');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>';
	$info = fopen($sName."/info","r");
	$index = 0;
	
	while(!feof($info)){
		$line = fgets($info);
		if ($index == 0){
			echo "<h3>Autor: ".$line."</h3>";
			$autor = $line;
		}
		else if ($index == 2)
		echo "<p><b>Opis bloga:</b> <br/>".$line;
		else if  ($index > 2)
			echo $line."</p>";
		$index +=1;
	}
	fclose($info);

	$dir = opendir($sName);

	echo '<h2>Wpisy</h2>';
	$jestZal = 0;
	$jestWpis = 0;
	$zalacznikNr=1;
	
	
	foreach(new DirectoryIterator($sName) as $file)
		{
			if(!$file->isDot() )
			{
				if(strlen($file->getFilename())==16)
				{
				
				$jestWpis +=1;
		$index = 0;
		$koniec_wpisu=0;
		$wpis = fopen($sName.'/'.$file,"r");
		
		
		echo str_replace("\r\n","<br/>",fread(($wpis), filesize($sName."/".$file->getFilename()))) . "<br/>";
		echo '<p style="border-bottom: 2px solid black">'."<br/>";
		$koniec_wpisu=1;
		
		fclose($wpis);
		$wpiss = current(explode('.', $file));

		if($koniec_wpisu==1){
			
			echo '</p>';echo "załączniki:<br/>";
			//echo $wpiss;
		foreach(new DirectoryIterator($sName) as $file_z)
		{
			if(!$file_z->isDot() && $file_z!="index.php")
			{
			
			if(strlen($file_z->getFilename())>18 && preg_match('/'.$wpiss.'/',$file_z->getFilename()))
			{
				echo '<a href="'.$sName.'/'.$file_z->getFilename().'">'.$file_z->getFilename().'</a><br /><br/>';
			}
			}
		}

		echo '<br/><br/><a href="formularz_3.php?blog='.$sName.'&wpis='.$wpiss.'"><button>Dodaj komentarz</button></a><br/>';
		if(is_dir($sName.'/'.$wpiss.'.k'))
		{
		$dir2 = opendir($sName.'/'.$wpiss.'.k');
		echo '<h3>Komentarze</h3>';
		foreach(new DirectoryIterator($sName.'/'.$wpiss.'.k') as $komentarz)
		{
			if(!$komentarz->isDot() && $komentarz!="index.php")
			{
				$koment = fopen($sName.'/'.$wpiss.'.k/'.$komentarz, "r");
				$i = 0;
				while(!feof($koment)){
				$lin = fgets($koment);
				#if($lin == "")
				#	break;

				if($i==0){
					echo '<p>Rodzaj komentarza: '.$lin.'</p>';
				
				}
				elseif($i==1){
					echo '<p>Data i godzina: '.$lin.'</p>';
				}
				elseif($i==2){
					echo '<p>Autor: '.$lin.'</p>';
				}
				elseif($i>=3){
					echo "<b>".$lin."</b><br/>";
				}
				$i=$i + 1;
			}
				fclose($koment);
			
			}
		}
		closedir($dir2);
		}
			
			echo '</div>';
			$jestZal = 0;
		}
		}
				
				
		}
		}
	
	if($jestWpis == 0){
	echo '<p>nie ma jeszcze wpisów na tym blogu :c</p><a href="data.php"><button>Dodaj pierwszy</button></a>';	
	}
}
	}


?>
</body>
</html>