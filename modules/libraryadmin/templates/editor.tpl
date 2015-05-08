  <script type="text/javascript" src="{{ LA_LIB_URL }}/libraryadmin/inc/CodeMirror-2.12/lib/codemirror.js"></script>
  <script type="text/javascript" src="{{ LA_LIB_URL }}/libraryadmin/inc/CodeMirror-2.12/mode/javascript/javascript.js"></script>

  <div class="boxshadow">
    <div style="float: right;">
      <a href="{{ LA_THIS_LIB_URL }}" title="{{ :lang Back }}"><img src="{{ LA_IMG_URL }}/back.png" alt="{{ :lang Back }}" /></a>
    </div>
    <h2>{{ :lang Edit preset }}: {{ name }}</h2>
  </div><br />
  
  <div>
    {{ :lang You may see files included more than once here. Don't mind. They will be filtered in the frontend. }}
  </div><br />
  
  {{ :if info }}{{ info }}{{ :ifend }}
  
  <br style="clear: right;" />
  
  <div style="border: 1px solid #ccc;">
  <form id="libraryadmindlg" method="post" action="{{ BASE_URL }}">
    <input type="hidden" name="lib" id="lib" value="{{ lib }}" />
    <input type="hidden" name="subdir" id="subdir" value="{{ subdir }}" />
    <input type="hidden" name="edit" id="edit" value="{{ file }}" />
    <input type="hidden" name="type" id="type" value="{{ type }}" />
    <textarea name="code" id="code" cols="120" rows="50">{{ code }}</textarea><br /><br />
    <input type="submit" name="save" value="{{ :lang Save }}" class="button" />
    <input type="submit" name="save_back" value="{{ :lang Save & Back }}" class="button" />
    <input type="submit" name="cancel" value="{{ :lang Cancel }}" class="button" />
  </form>

  <script type="text/javascript">
      var content = document.getElementById("code").value;
      editor = CodeMirror.fromTextArea(
          document.getElementById("code"),
          {
              theme: "default",
              lineNumbers: true,
              matchBrackets: true,
              value: content
          }
      );
      var custom = "<"+"!"+"-- custom -->\n<script type=\"text/javascript\">\n"+"// ----- insert your custom code here -----\n"+"</"+"script>\n"+"<!-- end custom -->\n";
      var div    = document.createElement("div");
      div.style.backgroundColor='#eee';
      var button = document.createElement("input");
          button.type  = "button";
          button.value = "{{ :lang Add custom code }}";
          button.onclick = function(){ var current_code = editor.getValue(); editor.setValue( current_code + custom ); setTimeout( "editor.refresh()", 500 ); };
      div.appendChild(button);
      wrapper = editor.getWrapperElement();
      wrapper.insertBefore(div,wrapper.childNodes[0]);

      setTimeout( "editor.refresh()", 500 );
  </script>
  </div>