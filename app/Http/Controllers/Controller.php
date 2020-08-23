<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Entity\Pedido;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function validate(Pedido $pedido, $update = false){

        if($update && $pedido->getId_order() <= 0)
        return "invalid id_order";

        if($pedido->getName() <= 0)
        return "invalid name";

        if($pedido->getPoint_sale() <= 0)
        return  "invalid point_sale";

        if($pedido->getStatus()  <= 0)
        return "invalid status";

        if($pedido->getDate()  <= 0)
        return "invalid date";
       
        if($pedido->getTotal()  <= 0)
        return "invalid total";
       
        if($pedido->getPartial_total()  <= 0)
        return "invalid partial_total";
       
        if($pedido->getShipment_value()  <= 0)
        return "invalid shipment_value";

        return "";
  }
}
