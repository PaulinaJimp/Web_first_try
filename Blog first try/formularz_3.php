<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>formularz 1</title>
<meta http-equiv="Content-Type" content="application/xhtml+xml;
charset=UTF-8" />
<link id="pagestyle" href="style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="cssChanger.js"></script>
</head>
<body onload="onload2()">
<?php include 'menu.php'?> 
<form action="koment.php" method="post">
  <p>rodzaj komentarza:<br/>
  <select name="opinia" multiple="multiple" > 
  <option  value="pozytywny">pozytywny</option>
  <option  value="negatywny">negatywny</option>
  <option  value="neutralny">neutralny</option>
</select>
  <br/>
  imię/nazwisko/pseudonim:<br/>
  <input type="text" name="name" value="" />
 <br/>
	komentarz:<br/>
<textarea name="about" rows="4" cols="50"></textarea>
  <br/>
<br/>
  <input type="submit" value="WYŚLIJ" />
  <input type="reset" value="WYCZYŚĆ" />
  <input type="text" name="nazwa_wpisu" style="display: none" value="<?php echo $_GET['wpis'];?>"/><br/>
  <input type="text" name="nazwa_bloga" style="display : none" value="<?php echo $_GET['blog'];?>"/><br/>
 </p>
</form> 


</body>
</html>
