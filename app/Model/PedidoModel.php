<?php
namespace App\Model;
use App\Entity\Pedido;
use App\Util\Serialize;

class PedidoModel{
  private $fileName;
  private $listPedido = []; //Object type Pedido

  public function __construct(){
    $this->fileName = "../database/pedido.db";
    $this->load();
  }

  public function readAll(){
    return (new Serialize())->serialize($this->listPedido);
  }

  public function readById($id){

    foreach($this->listPedido as $g){
      if($g->ge() == $id)
      return (new Serialize())->serialize($g);
    }

    return json_encode([]);
  }

  public function create(Pedido $pedido){
    $pedido->setId_order($this->getLastId());

    $this->listPedido[] = $pedido;
    $this->save();

    return "ok";
  }

  public function update(Pedido $pedido){
    $result = "not found";

    for($i = 0; $i < count($this->listPedido); $i++){
      if($this->listPedido[$i]->getId() == $pedido->getId_order()){
        $this->listPedido[$i] = $pedido;
        $result = "ok";
      }
    }

    $this->save();

    return $result;
  }

  public function delete($id){
    $result = "not found";
    for($i = 0; $i < count($this->listPedido); $i++){
      if($this->listPedido[$i]->getId() == $id){
        unset($this->listPedido[$i]);
        $result = "ok";
      }
    }

    $this->listPedido = array_filter(array_values($this->listPedido));

    $this->save();
    return $result;
  }
  //Internal Method
  private function save(){
    $temp = [];

    foreach($this->listPedido as $g){
      $temp[]       = [
        "id"        => $g->g(),
        "name"    => $g->getName(),
        "point_sale" => $g->getPoint_sale(),
        "status"   => $g->getStatus(),
        "date"   => $g->getdate(),
        "total"   => $g->getTotal(),
        "partial_total"   => $g->getPartial_total(),
        "shipment_value"   => $g->getShipment_value()        
      ];

      $fp = fopen($this->fileName, "w");
      fwrite($fp, json_encode($temp));
      fclose($fp);
    }
  }

   private function load(){
    if(!file_exists($this->fileName) || filesize($this->fileName) <= 0)
    return [];

    $fp = fopen($this->fileName, "r");
    $str = fread($fp, filesize($this->fileName));
    fclose($fp);

    $arrayPedido = json_decode($str);

    foreach($arrayPedido as $g){
      $this->listPedido[] = new Pedido(
        $g->id,
        $g->name,
        $g->point_sale,
        $g->status,
        $g->date,
        $g->total,
        $g->partial_total,
        $g->shipment_value
      );
    }
  }

  private function getLastId(){
    $lastId = 0;

    foreach($this->listPedido as $g){
      if($g->getId() > $lastId)
      $lastId = $g->getId();
    }

    return ($lastId + 1);
  }

}
