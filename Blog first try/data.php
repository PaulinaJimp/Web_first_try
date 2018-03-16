<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>formularz 1</title>
<meta http-equiv="Content-Type" content="application/xhtml+xml;
charset=UTF-8" />
<link id="pagestyle" href="style.css" rel="stylesheet" type="text/css"/>
<link rel="alternate stylesheet" href="st.css" type="text/css" />
<link rel="alternate stylesheet" href="st1.css" type="text/css" />
<link rel="alternate stylesheet" href="st2.css" type="text/css" />
<script type="text/javascript" src="cssChanger.js"></script>
<script type="text/javascript">
	var pom=1;
	
	function czas() {
		if(pom==1)
		{	
			var date = new Date();
			var element = document.getElementById('time');
			var cz = ( '0'+date.getHours()).slice(-2) + ':' +( '0'+date.getMinutes()).slice(-2);
			element.value = cz;
			//element.innerHTML= cz;
			var element2 = document.getElementById('date');
			var da= date.getFullYear() + '-'+date.getMonth()+1  + '-'+( '0'+date.getDate()).slice(-2) ;
			element2.value = da;
			//element2.innerHTML = da;
			setTimeout("czas()",1000);
		}
	}
	function spr_date() {
		var element = document.getElementById('date');
		var str = element.value;
		var res = str.split("-");
		if(!str.match(/(\d{4})-(\d{2})-(\d{2})/) || str.length!=10)
			{
				pom=1;
				czas();
			}
		else{
			var year = parseInt(res[0]);
			var month = parseInt(res[1]);
			var day = parseInt(res[2]);
			if( year<2000 || month>13 || month<1 || day>31)
				{
					pom=1;
					czas();
				}
			else{
				if((month==2 && day>29) || (month<7 && month%2==0 && day>30) || (month>8 && month%2==1 && day>30))
					{
						pom=1;
						czas();
					}
				}
			}
	}
	function spr_time() {
		var element = document.getElementById('time');
		var str = element.value;
		var res = str.split(":");
		var hour=parseInt(res[0]);
		var minute=parseInt(res[1]);
		if(!str.match(/(\d{2}):(\d{2})/) || str.length!=5 || hour<0 || hour>24 || minute>60 || minute<0 || (hour==24 && minute>0))
			{
				pom=1;
				czas();
			}
	}
	function stop(){
		pom=0;
	}
function moreFilesFunction() {
            var nextInput = document.createElement('INPUT');
            nextInput.type = "file";
            nextInput.className = "files";

            var myForm = document.getElementById("myForm");
            var i = document.getElementsByClassName("files");

            nextInput.name = "file" + (i.length + 1);
            //console.log(nextInput.type);

            var butt = document.getElementById("moreFilesButton");
            myForm.insertBefore(document.createElement("br"), butt);
            var newLabel = document.createElement("label");
            newLabel.innerHTML = "Załącznik" + (i.length + 1) + ":";
            myForm.insertBefore(newLabel, butt);
            myForm.insertBefore(document.createElement("br"), butt);
            myForm.insertBefore(nextInput, butt);
            myForm.insertBefore(document.createElement("br"), butt);

            var numberOfFiles = document.getElementById("numberOfFiles");
            numberOfFiles.value = i.length + 1;
        }
</script>
</head>
<body onload="czas();onload2()">
<?php include 'menu.php'?> 
<form action="wpis.php" method="post" enctype="multipart/form-data" id="myForm">
  NAZWA UŻYTKOWNIKA: <br><input type="text" name="user_name" value=""><br>
HASŁO: <br><input type="password" name="passwd" value=""><br><br>
WPIS:<br>
<textarea name="about" rows="4" cols="50"></textarea><br>
  DATA: <br><input type="text" name="data" value="" id="date" onclick="stop()" onchange="spr_date()"><br><br>
  CZAS: <br><input type="text" name="time" value="" id="time" onclick="stop()" onchange="spr_time()"><br><br> 
  <label> Załącznik1: </label><br><input type="file" name="file1" class="files"><br><br>
        <input type="button" value="KOLEJNY PLIK" id="moreFilesButton" onclick="moreFilesFunction()"><br><br>
        <input type="text" value="1" hidden="hidden" id="numberOfFiles" name="numberOfFiles">
<br/>
  <input type="submit" value="WYŚLIJ" />
  <input type="reset" value="WYCZYŚĆ" />
 </p>
</form> 

</body>
</html>
