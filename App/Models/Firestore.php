<?php
namespace App\Models;

use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Firestore\DocumentReference;
use Google\Cloud\Firestore\CollectionReference;

class Firestore
{
  private FirestoreClient $firestore;
  private string $collectionName;
  private string $documentName;

  public function __construct()
  {
    $this->firestore = new FirestoreClient([
      "keyFilePath" => "Keys/service_account.json",
      "projectId" => "fcbpay-website-7c029",
    ]);
  }

  public function setCollectionName(string $name): Firestore
  {
    $this->collectionName = $name;
    return $this;
  }

  public function setDocumentName(string $name): Firestore
  {
    !empty($this->collectionName) || die("Please provide document name, It's required! \r\n To do so, use setCollectionName(name) function");
    
    $this->documentName = $name;
    return $this;
  }

  //Get document from the collection
  public function getDocument(): ?DocumentReference
  {
    !empty($this->documentName) || die("Please provide document name, It's required! \r\n To do so, use setDocumentName(name) function");
  
    $collection = $this->firestore->collection($this->collectionName);
  
    if(!$collection->documents()->isEmpty()) {
      return $collection->document($this->documentName);
    }

    return null;

  }

  //Get all data or some key
  public function getData(string $key = "")
  {
    if(!empty($key)) {
      return $this->getDocument()->snapshot()->get($key);
    } else {
      return $this->getDocument()->snapshot()->data();
    }
  }

  //Add new document
  public function newDocument(array $data): string
  {
    !empty($this->collectionName) || die("Please provide collection name with function setCollectionName(name) before deleting the document");
    return $this->firestore->collection($this->collectionName)->add($data)->id();
  }

  //Delete document
  public function deleteDocument(string $name): array
  {
    !empty($this->collectionName) || die("Please provide collection name with function setCollectionName(name) before deleting the document");
    return $this->firestore->collection($this->collectionName)->document($name)->delete();
  }

  //Update document
  public function updateDocument(string $key, $value)
  {
    !empty($this->collectionName) || die("Please provide collection name with function setCollectionName(name) before deleting the document");

    $status = $this->firestore->collection($this->collectionName)->document($this->documentName)->update([
      [
      "path" =>  $key,
      "value" => $value,
      ],
    ], [
      "merge" => true,
    ]);

    return $status["updateTime"];

  }

}