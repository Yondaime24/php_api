<?php
use App\Models\url;
require_once "vendor/autoload.php";
  $doc_id = url::get('doc_id');
  $field = url::get('field');
?>
<script src="assets/js/jquery.min.js"></script>
<script>
  var doc_id = '<?=$doc_id?>';
  var field = '<?=$field?>';
  $.ajax({
    url: 'route.php?r=get',
    type: 'post',
    data: {doc_id: doc_id, field: field}
  }).then(function(resp) {
    var data = JSON.parse(resp);
    if (field == ''){
      alert('Account: ' + data.account + '\n' + 'Balance: ' + data.balance + '\n' + 'User ID: ' + data.user_id + '\n' + 'WAllet Balance: ' + data.wallet_balance)
    }else{
      alert(data);
    }
  });
</script>