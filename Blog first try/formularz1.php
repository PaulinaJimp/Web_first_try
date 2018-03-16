<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>formularz 1</title>
<meta http-equiv="Content-Type" content="application/xhtml+xml;

charset=UTF-8" />
<link rel="alternate stylesheet" href="st.css" type="text/css" />
<link rel="alternate stylesheet" href="st1.css" type="text/css" />
<link rel="alternate stylesheet" href="st2.css" type="text/css" />
<link id="pagestyle" href="style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="cssChanger.js"></script>
</head>
<body onload="onload2()">
<?php include 'menu.php'?> 
<form action="nowy.php" method="post">
  <p>nazwa blogu:<br/>
  <input type="text" name="blog_name" value="" />
  <br/>
  nazwa użytkownika:<br/>
  <input type="text" name="user_name" value="" />
 <br/>
	hasło:<br/>
<input type="password" name="passwd" value="" />
  <br/>
	opis blogu:<br/>
<textarea name="about" rows="4" cols="50"></textarea>
  <br/>
<br/>
  <input type="submit" value="WYŚLIJ" />
  <input type="reset" value="WYCZYŚĆ" />
 </p>
</form> 


</body>
</html>
