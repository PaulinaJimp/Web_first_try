function onload2() {
    var cookies = document.cookie;
    //alert(cookies);
    swapStyleSheet(cookies.split("=")[1]);
    var uList = document.createElement('ul');
	var stylesList = [];
	for (var i = 0; (styl = document.getElementsByTagName("link")[i]); i++) {
		var title = document.getElementsByTagName("link")[i].getAttribute("href");
		if(document.getElementsByTagName("link")[i].getAttribute("id")!="pagestyle")
		stylesList.push(title);
	}
    //var stylesList = ["st1.css", "st2.css", "st.css"];
    for (var i = 0; i < stylesList.length; i++) {
        var liElem = document.createElement('li');
        liElem.innerHTML = stylesList[i].split(".")[0];
        //if (i === 2) liElem.innerHTML = "domyślny";
        liElem.setAttribute("styleName", stylesList[i]);
        liElem.addEventListener("click", liOnclick);
        uList.appendChild(liElem);
    }
    document.body.appendChild(uList);
}

document.body.addEventListener("load", onload2, false);

function swapStyleSheet(sheet) {
    document.getElementById("pagestyle").setAttribute("href", sheet);
}

function liOnclick(event) {
    var liElem = event.target;
    var stylename = liElem.getAttribute("styleName");
    //console.log(liElem.getAttribute("styleName"));
    swapStyleSheet(stylename);
    document.cookie = "defaultStyle=" + stylename;
}