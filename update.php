<?php
use App\Models\url;
require_once "vendor/autoload.php";
  $doc_id = url::get('doc_id');
  $field = url::get('field');
  $data = url::get('data');
?>
<script src="assets/js/jquery.min.js"></script>
<script>
  var doc_id = '<?=$doc_id?>';
  var field = '<?=$field?>';
  var data = '<?=$data?>';
  $.ajax({
    url: 'route.php?r=update',
    type: 'post',
    data: {doc_id: doc_id, field: field, data: data}
  }).then(function(resp) {
    var data = JSON.parse(resp);
    alert(data);
  });
</script>