    <div style="text-align: right;">
      [ <a href="http://jquery.websitebakers.com/forum/" target="_blank">{{ :lang Support Forum }}</a>
      | <a href="http://jquery.websitebakers.com/" target="_blank">{{ :lang Download libraries and plugins }}</a>
      | <a href="http://www.webbird.de/" target="_blank">{{ :lang German Homepage }}</a>
      ]
    </div><br /><br />
    {{ :if libs }}
    {{ :loop libs }}
      <div class="boxshadow">
        <div class="libname"><a href="{{ CURRENT_URL }}&amp;lib={{ library_path }}">{{ library_name }}</a></div>
        <div class="libinfo">
		  {{ :if library_logo }}<img src="{{ LA_LIB_URL }}/{{ library_path }}/{{ library_logo }}" title="Logo" alt="Logo" style="float:right;" />{{ :ifend }}
          <span class="libversion">
            <span class="label">{{ :lang Library version }}:</span>
            {{ library_version }}
          </span><br />
          <span class="label">{{ :lang Module version }}:</span>
            {{ module_version }}
          </span><br />
          <span>
            <span class="label">{{ :lang Preset suffix }}:</span>
            {{ preset_suffix }}
          </span><br />
          <span>
            <span class="label">{{ :lang More info }}:</span>
            {{ library_info }}
          </span>
        </div>
        <br style="clear: right;" />
      </div><br /><br />
    {{ :loopend }}
    {{ :else }}
      <div class="la_error">
        {{ :lang No libraries found! You must install some libraries to work with this module. }}
      </div>
    {{ :ifend }}