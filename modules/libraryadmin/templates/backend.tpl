   <script type="text/javascript">
     setCookie( '__la_open_tab', '{{ __la_open_tab }}', 30 );
   </script>
   
    <table class="rightalign">
      <tr>
        <td>{{ header }}</td>
      </tr>
    </table>

    {{ :comment This table lists all available component lists, i.e. components to choose from. }}
    <div class="rightalign">
      {{ plugins_and_components }}
    </div>

    {{ :comment This is the left part of the page. It contains the list of already defined presets. }}
    <h2>{{ :lang Presets }}</h2>

    <h3>{{ library_name }} {{ :lang folder }}
      <a class="tt" href="{{ LA_THIS_LIB_URL }}&amp;type=lib&amp;subdir={{ subdir }}&amp;config=1&amp;preset_name=%5Bnew%5D">
        <img src="{{ LA_IMG_URL }}/add_16.png" />
        <span class="tooltip"><span class="top"></span><span class="middle">{{ :lang Click here to add a new preset to this library. }}</span><span class="bottom"></span></span>
      </a>
    </h3>
    <ul>
    {{ :loop presets }}
      <li>
        <a class="tt" href="{{ LA_THIS_LIB_URL }}&amp;type=lib&amp;subdir={{ subdir }}&amp;config=1&amp;preset_name={{ file }}">
          <img src="{{ LA_IMG_URL }}/modify_16.png" />
          <span class="tooltip"><span class="top"></span><span class="middle">{{ :lang Click here to configure the preset. }}</span><span class="bottom"></span></span></a>
        <a class="tt" href="{{ LA_THIS_LIB_URL }}&amp;type=lib&amp;subdir={{ subdir }}&amp;edit={{ file }}">
          <img src="{{ LA_IMG_URL }}/edit_16.png" />
          <span class="tooltip"><span class="top"></span><span class="middle">{{ :lang Click here to edit the preset's source code. }}</span><span class="bottom"></span></span>
        </a>
        {{ :if can_delete }}
        <a class="tt" href="{{ LA_THIS_LIB_URL }}&amp;type=lib&amp;subdir={{ subdir }}&amp;delete={{ file }}" onclick="REDIPS.dialog.show(250, 100, '{{ :lang Are you sure? }}', '{{ :lang Cancel }}', 'OK|dlgconfirm|'+this.href, '{{ :lang Close }}' );return false;">
          <img src="{{ LA_IMG_URL }}/delete_16.png" />
          <span class="tooltip"><span class="top"></span><span class="middle">{{ :lang Click here to delete this preset. }}</span><span class="bottom"></span></span>
        </a>
        {{ :else }}
        <img style="width: 20px;" src="{{ LA_IMG_URL }}/blank.gif" />
        {{ :ifend }}
        <span{{ :if selected }} style="font-weight: bold;"{{ :ifend }}>{{ title }}</span>
        {{ :if icon }}<a class="tt" href="#"/><img src="{{ LA_IMG_URL }}/{{ icon }}" /><span class="tooltip"><span class="top"></span><span class="middle">{{ :lang Page }}: {{ name }}</span><span class="bottom"></span></span></a>{{ :ifend }}
      </li>
    {{ :loopend }}
    </ul>
    <br /><br />

    {{ :if template_presets }}
    <h3>{{ :lang Template }} {{ :lang folder }} ({{ TEMPLATE }})
      <a class="tt" href="{{ LA_THIS_LIB_URL }}&amp;file=%5Bnew%5D&amp;type=template&amp;subdir={{ TEMPLATE }}" title="{{ :lang You may add a new Preset to this folder by clicking the Plus-Symbol and filling out the form }}">
      <img src="{{ LA_IMG_URL }}/add_16.png" alt="Add" />
      <span class="tooltip"><span class="top"></span><span class="middle">{{ :lang Click here to add a new preset. }}</span><span class="bottom"></span></span>
      </a>
      <a href="#" onclick="toggle_by_id('template_presets','inline-block','tpltoggle')" title="{{ :lang open/close }}"><span id="tpltoggle" class="tv_closed">&nbsp;</span></a>
    </h3>
    <ul id="template_presets" style="display: none">
      {{ :loop template_presets }}
      <li>
        <a class="tt" href="{{ LA_THIS_LIB_URL }}&amp;config=1&amp;preset_name={{ file }}">
          <img src="{{ LA_IMG_URL }}/modify_16.png" />
          <span class="tooltip"><span class="top"></span><span class="middle">{{ :lang Click here to configure the preset. }}</span><span class="bottom"></span></span>
        </a>
        <a class="tt" href="{{ LA_THIS_LIB_URL }}&amp;edit={{ file }}">
          <img src="{{ LA_IMG_URL }}/edit_16.png" />
          <span class="tooltip"><span class="top"></span><span class="middle">{{ :lang Click here to edit the preset's source code. }}</span><span class="bottom"></span></span>
        </a>
        <span{{ :if selected }} style="font-weight: bold;"{{ :ifend }}>{{ title }}</span>
      </li>
      {{ :loopend }}
    </ul><br /><br />
    {{ :ifend }}

    {{ :if module_presets }}
    <h3>{{ :lang Module folders }} <a href="#" onclick="javascript:toggle_by_id('module_presets','inline-block','modtoggle');setCookie( '__la_mod_toggle', document.getElementById('module_presets').style.display, 30 );return false;" title="{{ :lang open/close }}"><span id="modtoggle" class="tv_closed">&nbsp;</span></a></h3>
    
    <span id="module_presets" style="display: none;">
    {{ :loop module_presets }}
        <h4>{{ module }}</h4>
        <ul>
        {{ :loop presets }}
          <li>
            <a class="tt" href="{{ LA_THIS_LIB_URL }}&amp;type=module&amp;subdir={{ subdir }}&amp;config=1&amp;preset_name={{ file }}">
              <img src="{{ LA_IMG_URL }}/modify_16.png" />
              <span class="tooltip"><span class="top"></span><span class="middle">{{ :lang Click here to configure the preset. }}</span><span class="bottom"></span></span>
            </a>
            <a class="tt" href="{{ LA_THIS_LIB_URL }}&amp;type=module&amp;subdir={{ subdir }}&amp;edit={{ file }}">
              <img src="{{ LA_IMG_URL }}/edit_16.png" />
              <span class="tooltip"><span class="top"></span><span class="middle">{{ :lang Click here to edit the preset's source code. }}</span><span class="bottom"></span></span>
            </a>
            <span{{ :if selected }} style="font-weight: bold;"{{ :ifend }}>{{ title }}</span>
          </li>
        {{ :loopend }}
        </ul>
    {{ :loopend }}
    </span>
    {{ :ifend }}

    <br style="clear: both;" />
    
    <script type="text/javascript">
      var open = getCookie( '__la_mod_toggle' );
      if ( open == 'inline-block' ) {
        toggle_by_id('module_presets','inline-block','modtoggle');
        setCookie( '__la_mod_toggle', document.getElementById('module_presets').style.display, 30 );
      }
    </script>
