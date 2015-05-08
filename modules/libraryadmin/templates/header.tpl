    <script type="text/javascript">
      if ( typeof jQuery != 'undefined' ) {
        jQuery(document).ready(function($) {
          var btnclass = "ui-button ui-widget ui-state-default ui-corner-all";
          $('input[type="submit"]').each( function() { $(this).addClass(btnclass); } );
          $('input[type="button"]').each( function() { $(this).addClass(btnclass); } );
          $('input[type="reset"]' ).each( function() { $(this).addClass(btnclass); } );
          $('button'              ).each( function() { $(this).addClass(btnclass); } );
        });
      }
    </script>

    <div id="libadmin">
      <h2>LibraryAdmin</h2>
    