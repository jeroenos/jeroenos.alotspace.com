    <form method="post" action="{{ CURRENT_URL }}" enctype="multipart/form-data" name="upload">
	  <input type="hidden" name="upload" value="1" />
      <fieldset class="fieldset">
        <img src="{{ LA_IMG_URL }}/upload.png" style="float: right;" />
        <input type="hidden" name="lib" value="{{ lib }}" />
        <input type="hidden" name="type" value="{{ type }}" />
        <legend>{{ :lang Upload plugin }}</legend>
        {{ :lang Please note: Plugins are always uploaded into the current library! }}<br /><br />
        <input type="file" name="userfile" size="50" class="input file" /><br /><br />
        <script type="text/javascript">document.upload.userfile.focus();</script>
        <input type="submit" class="submit button" value="{{ :lang Upload }}" name="submit" />
        <input type="submit" class="submit button" value="{{ :lang Cancel }}" name="cancel" />
      </fieldset>
    </form>
    
    {{ :if plugins }}
    <br /><br />
    <div style="width: 30%; margin-left: 15px;">
      <h2>{{ :lang Already installed plugins }}</h2>
      {{ plugins }}
    </div>
    {{ :ifend }}