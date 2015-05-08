    {{ :include header.tpl }}
    {{ :if libs }}
    <div id="tabs">
      <ul>
      {{ :loop libs }}
      <li class="tab{{ :if current }} current{{ :ifend }}">
        <a href="{{ BASE_URL }}&amp;lib={{ library_path }}">{{ library_name }}</a>
      </li>
      {{ :loopend }}
      <li class="tab{{ :if current }} current{{ :ifend }}" style="float: right;" id="home">
        <a href="{{ BASE_URL }}&amp;info=1">{{ :lang Info }}</a>
      </li>
      </ul>
    </div>
    {{ :ifend }}

    <div id="outer" class="boxshadow">
      {{ :if info }}{{ info }}{{ :ifend }}
      <div id="inner">

      {{ :if not current }}
      <div id="upload" class="boxshadow" style="float: right; border: 1px solid #ccc;">
        <a href="{{ BASE_URL }}&amp;lib={{ lib }}&amp;upload=1&amp;type=plugin">
          {{ :lang Upload plugin }}
        </a>
      </div>
      {{ :if has_backups }}
	  <div id="backups" class="boxshadow" style="float: right; border: 1px solid #ccc;">
        <a href="{{ BASE_URL }}&amp;lib={{ lib }}&amp;backups=1">
          {{ :lang Show backups }}
        </a>
      </div>
      {{ :ifend }}
	  <br style="clear: both;" /><br />
      {{ :ifend }}

      {{ content }}
      </div>
      <div id="version">
      {{ MODULE_NAME }} v{{ MODULE_VERSION}}<br />
      <span style="font-size: smaller;">
      &copy; 2011 <a href="http://www.webbird.de/" target="_blank">BlackBird Webprogrammierung</a><br />
      All rights reserved
      </span>
      </div>
    </div>
    <br style="clear: left;" />
    {{ :include footer.tpl }}