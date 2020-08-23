<?php
namespace App\Entity;

class Pedido{

    private $id_order;
    private $name;
    private $point_sale;
    private $status;
    private $date;
    private $total;
    private $partial_total;
    private $shipment_value;

    //Constructor

    public function __construct($id_order = 0, $name = '', $point_sale = '', $status = '',
                              $date = '', $total = '', $partial_total = '', $shipment_value = ''){
		
        $this->id_order = $id_order;
        $this->name =  $name;
        $this->point_sale = $point_sale;
        $this->status = $status;
        $this->date = $date;
        $this->total = $total;
        $this->partial_total = $partial_total;
        $this->shipment_value = $shipment_value;
    }

    //Setters and Getters
    public function setId_order($id_order) { $this->id_order = $id_order; }
    public function getId_order() { return $this->id_order; }
    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }
    public function setPoint_sale($point_sale) { $this->point_sale = $point_sale; }
    public function getPoint_sale() { return $this->point_sale; }
    public function setStatus($status) { $this->status = $status; }
    public function getStatus() { return $this->status; }
    public function setDate($date) { $this->date = $date; }
    public function getDate() { return $this->date; }
    public function setTotal($total) { $this->total = $total; }
    public function getTotal() { return $this->total; }
    public function setPartial_total($partial_total) { $this->partial_total = $partial_total; }
    public function getPartial_total() { return $this->partial_total; }
    public function setShipment_value($shipment_value) { $this->shipment_value = $shipment_value; }
    public function getShipment_value() { return $this->shipment_value; }








/*
    private $id_order;
    private $name;
    private $point_sale;
    private $status;
    private $date;
    private $total;
    private $partial_total;
    private $shipment_value;

    //Constructor

    public function __construct($id_order = 0, $name = '', $point_sale = '', $status = '',
                              $date = '', $total = '', $partial_total = '', $shipment_value = ''){
		
        $this->id_order = $id_order;
        $this->name =  $name;
        $this->point_sale = $point_sale;
        $this->status = $status;
        $this->date = $date;
        $this->total = $total;
        $this->partial_total = $partial_total;
        $this->shipment_value = $shipment_value;
    }
    
    //Setters
	public function setId_order($id_order){
        $this->id_order = $id_order;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function setPoint_sale($point_sale){
		$this->point_sale = $point_sale;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function setDate($date){
		$this->date = $date;
	}

	public function setTotal($total){
		$this->total = $total;
	}

	public function setPartial_total($partial_total){
		$this->partial_total = $partial_total;
	}

	public function setShipment_value($shipment_value){
		$this->shipment_value = $shipment_value;
	}

    //Getter
	public function getId_order(){
		return  $this->id_order;
	}

	public function getId(){
		return $this->id;
	}

	public function getId(){
		return $this->id;
	}

	public function getId(){
		return $this->id;
	}

	public function getId(){
		return $this->id;
	}

	public function getId(){
		return $this->id;
	}

	public function getId(){
		return $this->id;
	}

	public function getId(){
		return $this->id;
	}
*/

}