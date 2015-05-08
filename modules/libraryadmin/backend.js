  setCookie=function(name, value, days){
    var expireDate  = new Date();
    var expstring   = expireDate.setDate(expireDate.getDate()+parseInt(days));
    document.cookie = name+"="+value+"; expires="+expireDate.toGMTString()+"; path=/";
  }
  getCookie=function(name){
    var re = new RegExp(name+"=[^;]+", "i");
    if (document.cookie.match(re)) {
      return document.cookie.match(re)[0].split("=")[1]; //return its value
    }
    return "";
  }
  function dlgconfirm(href) {
    window.location.href=href;
	return false;
  }
  