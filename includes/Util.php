<?php

function enhanceDate($date) {
    $newDate = explode(" ", $date);
    $hour = explode(":", $newDate[1]);
    $newDate = explode("-", $newDate[0]);
    return ($newDate[2]."/".$newDate[1]."/".$newDate[0]." (".$hour[0].":".$hour[1].")");
}
?>

<script>
    jQuery.each( [ "put", "delete" ], function( i, method ) {
  jQuery[ method ] = function( url, data, callback, type ) {
    if ( jQuery.isFunction( data ) ) {
      type = type || callback;
      callback = data;
      data = undefined;
    }

    return jQuery.ajax({
      url: url,
      type: method,
      dataType: type,
      data: data,
      success: callback
    });
  };
});
</script>