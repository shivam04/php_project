function change (element) {
	var x = element.id; 
	var n = x.split('ike');
	var id = n[1];
	if(element.rel=="Like"){
		element.innerHTML="Unlike";
		element.rel = "Unlike";
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("likes"+id).innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "like_post.php?q=" + id+"&action=like", true);
        xmlhttp.send();
    }
    else{
        var x = element.id; 
        var n = x.split('ike');
        var id = n[1];
    	var xmlhttp = new XMLHttpRequest();
    	element.innerHTML = "Like";
    	element.rel = "Like";
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("likes"+id).innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "like_post.php?q=" + id+"&action=unlike", true);
        xmlhttp.send();
    }
}
function change_cursor (element) {
	element.style.cursor = "pointer";
	element.style.color = "red";
}
function back_change (element) {
	element.style.color = "blue";
}
function onTestChange(element) {
    var x = element.id; 
    var n = x.split('mnt');
    var id = n[1];
    var key = window.event.keyCode;
    var value = element.value;
    if (key == 13) {
        if(value==""){
            alert ("Enter Some Text in a comment box");
        }
        else{
            element.value = "";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("cmnts"+id).innerHTML = xmlhttp.responseText;
            }
        }
            xmlhttp.open("GET", "comment.php?q=" + id+"&cmnt="+value, true);
            xmlhttp.send();
        }
    }
}
function show_reply (element) {
    var x = element.id;
    var n = x.split('eply');
    var id = n[1];
    var x = document.getElementById('show_reply'+id);
    if(x.style.display=='none')
    x.style.display = 'block';
    else
        x.style.display = 'none';
}
function doReply (element) {
    var x = element.id; 
    var n = x.split('ply');
    var id = n[1];
    var key = window.event.keyCode;
    var value = element.value;
    if (key == 13) {
        var cd = document.getElementById("reply"+id).innerHTML;
        var inc = cd.split('ply ');
        //alert (inc[1]);
        var ans = parseInt(inc[1])+1;
        if(value==""){
            alert ("Enter Some Text in a reply box");
        }
        else{
            element.value = "";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("reply"+id).innerHTML = "Reply "+ans;
                document.getElementById("replies"+id).innerHTML = xmlhttp.responseText;
            }
        }
            xmlhttp.open("GET", "reply.php?q=" + id+"&reply="+value, true);
            xmlhttp.send();
        }
    }
}
function cchange (element) {
    var x = element.id; 
    var n = x.split('ike');
    var id = n[1];
    if(element.rel=="Like"){
        element.innerHTML="Unlike";
        element.rel = "Unlike";
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("clikes"+id).innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "like_cmnt.php?q=" + id+"&action=like", true);
        xmlhttp.send();
    }
    else{
        var x = element.id; 
        var n = x.split('ike');
        var id = n[1];
        var xmlhttp = new XMLHttpRequest();
        element.innerHTML = "Like";
        element.rel = "Like";
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("clikes"+id).innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "like_cmnt.php?q=" + id+"&action=unlike", true);
        xmlhttp.send();
    }
}
function showResult(str) {
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
function ccchange (element) {
    var x = element.id; 
    var n = x.split('ike');
    var id = n[1];
    if(element.rel=="Like"){
        element.innerHTML="Unlike";
        element.rel = "Unlike";
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("rlikes"+id).innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "like_reply.php?q=" + id+"&action=like", true);
        xmlhttp.send();
    }
    else{
        var x = element.id; 
        var n = x.split('ike');
        var id = n[1];
        var xmlhttp = new XMLHttpRequest();
        element.innerHTML = "Like";
        element.rel = "Like";
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("rlikes"+id).innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "like_reply.php?q=" + id+"&action=unlike", true);
        xmlhttp.send();
    }
}
function friendRequestSend(element){
    var id = element.id;
    var n = id.split('end');
    var u_n = n[1];

    var xmlhttp = new XMLHttpRequest();
    if(element.value=="Add Friend"){
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                console.log(xmlhttp.responseText);
                element.value=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","friend_request.php?q=" + u_n+"&action=add"+"&value=" +element.value, true);
        xmlhttp.send();
    }
    else if(element.value=="Cancel Request"||element.value=="Unfriend"||element.value=="Delete Request"){
        var val = document.getElementsByClassName("friend"+u_n);
        if(element.value=="Delete Request"){
            val[0].style.display="none";
        }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                element.value=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","friend_request.php?q=" + u_n+"&action=cancel"+"&value=" +element.value, true);
        xmlhttp.send();
    }
    else if(element.value=="Confirm Request"){
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                element.value=xmlhttp.responseText;
                var val = document.getElementsByClassName("friend"+u_n);
                val[1].style.display = "none";
            }
        }
        xmlhttp.open("GET","friend_request.php?q=" + u_n+"&action=confirm"+"&value=" +element.value, true);
        xmlhttp.send();
    }
}