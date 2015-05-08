    <input{{ :if attributes }} {{ attributes }}{{ :ifend }}{{ :if tooltip }} title="{{ tooltip }}"{{ :ifend }} />
    {{ :if pwstrength }}
    <div id="passwordStrengthDiv_{{ name }}" class="passwordStrengthDiv is0" title="{{ :lang Password strength }}">
        <span class="poor">&nbsp;</span>
	</div>
    {{ :ifend }}
    