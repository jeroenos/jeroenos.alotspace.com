    var display = 'block';
    function toggle_by_id(id,style,parent_id) {
        var e = document.getElementById(id);
        var p = document.getElementById(parent_id);
        if ( style != '' ) {
            display = style;
        }
        if ( e.style.display != 'none' ) {
            display = e.style.display;
            e.style.display = 'none';
            if ( typeof p != 'undefined' ) {
                p.className = 'tv_closed';
            }
        }
        else {
            e.style.display = display;
            if ( typeof p != 'undefined' && typeof p != 'object' ) {
                p.className = 'tv_open';
            }
        }
    }

    function toggle_by_class(classname,style,parent_id) {
        var e = getElementsByClassName(classname);
        var p = document.getElementById(parent_id);
        if ( style != '' ) {
            display = style;
        }
        for( var i=0; i<e.length; i++ ) {
            if ( e[i].style.display != 'none' ) {
                display = e[i].style.display;
                e[i].style.display = 'none';
                if ( typeof p != 'undefined' ) {
                    p.className = 'tv_closed';
                }
            }
            else {
                e[i].style.display = display;
                if ( typeof p != 'undefined' ) {
                    p.className = 'tv_open';
                }
            }
        }
    }
    
    /*
	Developed by Robert Nyman, http://www.robertnyman.com
	Code/licensing: http://code.google.com/p/getelementsbyclassname/
*/
var getElementsByClassName = function (className, tag, elm){
	if (document.getElementsByClassName) {
		getElementsByClassName = function (className, tag, elm) {
			elm = elm || document;
			var elements = elm.getElementsByClassName(className),
				nodeName = (tag)? new RegExp("\\b" + tag + "\\b", "i") : null,
				returnElements = [],
				current;
			for(var i=0, il=elements.length; i<il; i+=1){
				current = elements[i];
				if(!nodeName || nodeName.test(current.nodeName)) {
					returnElements.push(current);
				}
			}
			return returnElements;
		};
	}
	else if (document.evaluate) {
		getElementsByClassName = function (className, tag, elm) {
			tag = tag || "*";
			elm = elm || document;
			var classes = className.split(" "),
				classesToCheck = "",
				xhtmlNamespace = "http://www.w3.org/1999/xhtml",
				namespaceResolver = (document.documentElement.namespaceURI === xhtmlNamespace)? xhtmlNamespace : null,
				returnElements = [],
				elements,
				node;
			for(var j=0, jl=classes.length; j<jl; j+=1){
				classesToCheck += "[contains(concat(' ', @class, ' '), ' " + classes[j] + " ')]";
			}
			try	{
				elements = document.evaluate(".//" + tag + classesToCheck, elm, namespaceResolver, 0, null);
			}
			catch (e) {
				elements = document.evaluate(".//" + tag + classesToCheck, elm, null, 0, null);
			}
			while ((node = elements.iterateNext())) {
				returnElements.push(node);
			}
			return returnElements;
		};
	}
	else {
		getElementsByClassName = function (className, tag, elm) {
			tag = tag || "*";
			elm = elm || document;
			var classes = className.split(" "),
				classesToCheck = [],
				elements = (tag === "*" && elm.all)? elm.all : elm.getElementsByTagName(tag),
				current,
				returnElements = [],
				match;
			for(var k=0, kl=classes.length; k<kl; k+=1){
				classesToCheck.push(new RegExp("(^|\\s)" + classes[k] + "(\\s|$)"));
			}
			for(var l=0, ll=elements.length; l<ll; l+=1){
				current = elements[l];
				match = false;
				for(var m=0, ml=classesToCheck.length; m<ml; m+=1){
					match = classesToCheck[m].test(current.className);
					if (!match) {
						break;
					}
				}
				if (match) {
					returnElements.push(current);
				}
			}
			return returnElements;
		};
	}
	return getElementsByClassName(className, tag, elm);
};