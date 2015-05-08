	<div class="fbradiogroup fb{{type}}"{{ :if tooltip }} title="{{ tooltip }}"{{ :ifend }}>
    {{ :loop options }}
    <span class="fbopt{{ :if checked }} fbchecked{{ :ifend }}">
      <input {{ attributes }} {{ checked }} />
	    <label for="{{ id }}">{{ text }}</label>
		{{ :if break }}<br />{{ :ifend }}
	</span>
    {{ :loopend }}
    </div>
