    // base class for all menu types
    var classname = "dropdown";
    var elem = document.getElementById("nav");
    if ( typeof elem != "undefined" && elem != null) {
      // add specific class
      if ( typeof DROPDOWNTYPE != "undefined" ) {
        if ( DROPDOWNTYPE == "horizontal" ) {
          classname = classname + " " + "dropdown-horizontal";
        }
        if ( DROPDOWNTYPE == "vertical" ){
          classname = classname + " " + "dropdown-vertical";
        }
      }
      else {
        classname = classname + " " + "dropdown-horizontal";
      }
      // add additional classes the preset may define
      if ( typeof DROPDOWNCLASSES != "undefined" ) {
        classname = classname + " " + DROPDOWNCLASSES;
      }
      // set class attribute
      elem.className = classname;
    }
