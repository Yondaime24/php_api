<?php
use App\Models\url;
require_once "vendor/autoload.php";
$account = url::get('account');
$user_id = url::get('user_id');
$balance = url::get('balance');
$wallet_balance = url::get('wallet_balance');
?>
<script src="assets/js/jquery.min.js"></script>
<script>
  var account = '<?=$account?>';
  var user_id = '<?=$user_id?>';
  var balance = '<?=$balance?>';
  var wallet_balance = '<?=$wallet_balance?>';
  $.ajax({
    url: 'route.php?r=add',
    type: 'post',
    data: {account: account, user_id: user_id, balance: balance, wallet_balance: wallet_balance}
  }).then(function(resp) {
    var data = JSON.parse(resp);
    alert(data);
  });
</script>
