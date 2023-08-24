<?php
use App\Models\url;
require_once "vendor/autoload.php";
$doc_id = url::get('doc_id');
?>
<script src="assets/js/jquery.min.js"></script>
<script>
  var doc_id = '<?=$doc_id?>';
  $.ajax({
    url: 'route.php?r=delete',
    type: 'post',
    data: {doc_id: doc_id}
  }).then(function(resp) {
    var data = JSON.parse(resp);
    alert(data);
  });
</script>