    {{ :if info_msg }}
    <div class="{{ info_class }}">{{ info_msg }}</div>
    {{ :ifend }}

    <form method="post" action="{{ CURRENT_URL }}" name="configure">
      <input type="hidden" name="config" id="config" value="1" />
      <input type="hidden" name="subdir" id="subdir" value="{{ subdir }}" />
      <input type="hidden" name="lib" id="lib" value="{{ lib }}" />
      <input type="hidden" name="type" id="type" value="{{ type }}" />
      {{ :if ! is_new }}<input type="hidden" name="preset_name" id="preset_name" value="{{ preset_name }}" />{{ :ifend }}
      <table>
        <tr>
          <td>{{ header }}</td>
        </tr>
      </table>
      
      <input type="submit" class="submit button" value="{{ :lang Save }}" name="save" id="save" />
      <input type="submit" class="submit button" value="{{ :lang Cancel }}" name="cancel" id="cancel" />

      {{ :comment This table lists all available component lists, i.e. components to choose from. }}
      <table>
        <tr>
          <td>
            <h2>{{ :lang Plugins }}</h2>
            {{ plugins }}
          </td>
          {{ :loop components }}
          <td>
            {{ list }}
          </td>
          {{ :loopend }}
        </tr>
      </table>
    
      <input type="submit" class="submit button" value="{{ :lang Save }}" name="save" id="save" />
      <input type="submit" class="submit button" value="{{ :lang Cancel }}" name="cancel" id="cancel" />

    </form>