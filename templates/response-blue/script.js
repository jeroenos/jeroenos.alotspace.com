var ww = document.body.clientWidth;

function showloginbox() {
	//document.getElementById("showlogin").style.display = 'none';
	if(document.getElementById("login-box").style.display == 'none') {
		document.getElementById("login-box").style.display = 'block';
	} else {
		document.getElementById("login-box").style.display = 'none';
	}
}

function showmenu() {
	mm = document.getElementById("mobile").style.display;	
	if ( mm == 'block') {
		document.getElementById("mobile").style.display = 'none';
		document.getElementById("mobilemenu").style.display = 'block';
	} else {	
		document.getElementById("mobile").style.display = 'block';
		document.getElementById("mobilemenu").style.display = 'none';
	}
}

function menuremove() {
	mm = document.getElementById("mobile").style.display;
	if ( mm == 'block') {
		document.getElementById("mobile").style.display = 'none';
		document.getElementById("mobilemenu").style.display = 'block';
	} 
}
