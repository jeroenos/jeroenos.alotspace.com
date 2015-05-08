  if ( typeof $LAB == "undefined" || typeof $LAB == "undefined" ) {
    var fileref = document.createElement("script");
    fileref.setAttribute( "type", "text/javascript" );
    fileref.setAttribute( "src", "http://localhost/wb/modules/libraryadmin/js/LAB.min.js" );
    if (typeof fileref != "undefined" ) { document.getElementsByTagName("head")[0].appendChild(fileref); }
  }
  var filesadded = "";

  function tryReady(time_elapsed) {
    // Continually polls to see if LAB is loaded.
    if ( typeof $LAB == "undefined" || typeof $LAB == "undefined" ) {
      if (time_elapsed <= 5000) {
        setTimeout("tryReady(" + (time_elapsed + 200) + ")", 200);
      } else {
        alert("Timed out while loading LABjs.")
      }
    }
    else {
      $LAB.setGlobalDefaults({Debug:true})
          .script("http://localhost/wb/modules/libraryadmin/plugins/lytebox/lytebox.js").wait()
          .script("http://localhost/wb/modules/libraryadmin/plugins/modaldbox/redips-dialog-min.js").wait()
          .script("http://localhost/wb/modules/libraryadmin/plugins/toggle/toggle.js").wait()
          .wait(function(){
			
  if ( filesadded.indexOf("[http://localhost/wb/modules/libraryadmin/plugins/lytebox/lytebox.css]") == -1 ) {
    var fileref=document.createElement("link")
    fileref.setAttribute("rel", "stylesheet");
    fileref.setAttribute("type", "text/css");
    fileref.setAttribute("media", "screen");
    fileref.setAttribute("href", "http://localhost/wb/modules/libraryadmin/plugins/lytebox/lytebox.css");
    if (typeof fileref!="undefined") {
        document.getElementsByTagName("head")[0].appendChild(fileref);
        filesadded+="[http://localhost/wb/modules/libraryadmin/plugins/lytebox/lytebox.css]";
    }
  }

          
  if ( filesadded.indexOf("[http://localhost/wb/modules/libraryadmin/plugins/modaldbox/redips-dialog.css]") == -1 ) {
    var fileref=document.createElement("link")
    fileref.setAttribute("rel", "stylesheet");
    fileref.setAttribute("type", "text/css");
    fileref.setAttribute("media", "screen");
    fileref.setAttribute("href", "http://localhost/wb/modules/libraryadmin/plugins/modaldbox/redips-dialog.css");
    if (typeof fileref!="undefined") {
        document.getElementsByTagName("head")[0].appendChild(fileref);
        filesadded+="[http://localhost/wb/modules/libraryadmin/plugins/modaldbox/redips-dialog.css]";
    }
  }

          
  if ( filesadded.indexOf("[http://localhost/wb/modules/libraryadmin/plugins/toggle/tv.css]") == -1 ) {
    var fileref=document.createElement("link")
    fileref.setAttribute("rel", "stylesheet");
    fileref.setAttribute("type", "text/css");
    fileref.setAttribute("media", "screen");
    fileref.setAttribute("href", "http://localhost/wb/modules/libraryadmin/plugins/toggle/tv.css");
    if (typeof fileref!="undefined") {
        document.getElementsByTagName("head")[0].appendChild(fileref);
        filesadded+="[http://localhost/wb/modules/libraryadmin/plugins/toggle/tv.css]";
    }
  }

          
  if ( filesadded.indexOf("[http://localhost/wb/modules/libraryadmin/assets/css_tooltips/bubble/bubble.css]") == -1 ) {
    var fileref=document.createElement("link")
    fileref.setAttribute("rel", "stylesheet");
    fileref.setAttribute("type", "text/css");
    fileref.setAttribute("media", "screen");
    fileref.setAttribute("href", "http://localhost/wb/modules/libraryadmin/assets/css_tooltips/bubble/bubble.css");
    if (typeof fileref!="undefined") {
        document.getElementsByTagName("head")[0].appendChild(fileref);
        filesadded+="[http://localhost/wb/modules/libraryadmin/assets/css_tooltips/bubble/bubble.css]";
    }
  }

          
  window.onload = function () {
    REDIPS.dialog.init();          // initialize dialog
    REDIPS.dialog.op_high = 40;    // set maximum transparency to 40%
    REDIPS.dialog.fade_speed = 18; // set fade spead (delay is 18ms)
  };
          })

	  ;
    }
  }
  tryReady(0);

