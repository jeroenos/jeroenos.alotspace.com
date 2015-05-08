  <div class="boxshadow">
    <div style="float: right;">
      <a href="{{ LA_THIS_LIB_URL }}" title="{{ :lang Back }}"><img src="{{ LA_IMG_URL }}/back.png" alt="{{ :lang Back }}" /></a>
    </div>
    <h2>{{ :lang Available Backup files }}</h2>
  </div><br />
  
  {{ :if info }}<div class="success">{{ info }}</div>{{ :ifend }}
  
  <br style="clear: right;" />
  
  <div>
	<ul>
	{{ :loop backups }}
	  <li>
        <a style="margin-right:25px;" class="tt" href="{{ LA_THIS_LIB_URL }}&amp;backups=1&amp;delete={{ filename }}" onclick="REDIPS.dialog.show(250, 100, '{{ :lang Are you sure? }}', '{{ :lang Cancel }}', 'OK|dlgconfirm|'+this.href, '{{ :lang Close }}' );return false;">
          <img src="{{ LA_IMG_URL }}/delete_16.png" />
          <span class="tooltip"><span class="top"></span><span class="middle">{{ :lang Click here to delete this backup file. }}</span><span class="bottom"></span></span>
        </a>
	    <a class="tt" href="{{ backup_url }}/{{ filename }}">
		  {{ filename }}
		  <span class="tooltip"><span class="top"></span><span class="middle">{{ :lang Click here to download this backup file. }}</span><span class="bottom"></span></span>
		</a>
	  </li>
	{{ :loopend }}
	</ul>
  </div>