  if ( typeof $LAB == "undefined" || typeof $LAB == "undefined" ) {
    var fileref = document.createElement("script");
    fileref.setAttribute( "type", "text/javascript" );
    fileref.setAttribute( "src", "{{ LA_LIB_URL }}/libraryadmin/js/LAB.min.js" );
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
          {{ scripts }}
{{ :if inline }}
          .wait(function(){
			{{ inline }}
          })
{{ :ifend }}
	  ;
    }
  }
  tryReady(0);
