  <div class="boxshadow">
    <div style="float: right;">
      <a href="{{ LA_THIS_LIB_URL }}" title="{{ :lang Back }}"><img src="{{ LA_IMG_URL }}/back.png" alt="{{ :lang Back }}" /></a>
    </div>
    <h2>{{ :lang Configure plugin }}: {{ plugin }}</h2>
    <br style="clear: right;" />
  </div><br /><br />

  {{ :lang Please consult the Plugin documentation for details on how to set these options! }}<br /><br />
  {{ :lang Please note: After changing the settings, you will have to renew your presets to make the new settings take effect! }}
  <br /><br />
  
  {{ :if info }}<div class="success">{{ info }}</div>{{ :ifend }}

  <form id="configure" method="post" action="{{ CURRENT_URL }}">
    
    <input type="hidden" name="config" id="config" value="1" />
    <input type="hidden" name="lib" id="lib" value="{{ lib }}" />
    <input type="hidden" name="subdir" id="subdir" value="{{ subdir }}" />
    <input type="hidden" name="plugin" id="plugin" value="{{ plugin }}" />
    <table style="width: 100%;">
      {{ form }}
    </table>
    
    <input type="submit" class="submit button" value="{{ :lang Save }}" name="save" id="save" />
    <input type="submit" class="submit button" value="{{ :lang Save & Back }}" name="save_back" id="save_back" />
    <input type="submit" class="submit button" value="{{ :lang Cancel }}" name="cancel" id="cancel" />
      
  </form>
