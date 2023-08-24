<?php
use App\Models\Firestore;
use App\Models\url;
require_once "vendor/autoload.php";

class route {
  public function __construct() {
    $this->route = isset($_GET['r']) ? $_GET['r'] : '';
    $this->db = new Firestore;
    $this->collection = $this->db->setCollectionName('accounts');
  }
  
  public function run() {
    switch($this->route) {
      case "get":
        $doc_id = url::post('doc_id');
        $field = url::post('field');
        if($field == null) {
          $data = $this->collection->setDocumentName($doc_id)->getData();
        }else{
          $data = $this->collection->setDocumentName($doc_id)->getData($field);
        }
        print json_encode($data);
      break;
      case 'add':
        $account = url::post('account');
        $user_id = url::post('user_id');
        $balance = url::post('balance');
        $wallet_balance = url::post('wallet_balance');
        $res = $this->collection->newDocument([
          "wallet_balance" => $wallet_balance,
          "balance" => $balance,
          "user_id" => $user_id,
          "account" => $account,
        ]);
        print json_encode('Success!');
      break;
      case 'delete':
        $doc_id = url::post('doc_id');
        $this->collection->deleteDocument($doc_id);
        print json_encode('Deleted Successfully!');
      break;
      case 'update';
        $doc_id = url::post('doc_id');
        $field = url::post('field');
        $data = url::post('data');
        $this->collection->setDocumentName($doc_id)->updateDocument($field, $data);
        print json_encode('Updated Successfully!');
      break;
    }
  }
}
$route = new route();
$route->run();



