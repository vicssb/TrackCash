<?php
namespace App\Http\Controllers;
use App\Entity\Pedido;
use App\Model\pedidoModel;


use Illuminate\Http\Request;

class PedidoController extends Controller
{
    private $pedidoModel;

    protected $request;

    //Constructor
    public function __construct()
		{
           // $this->pedidoModel = new PedidoModel();
		}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($data = null)
    {
        $pedido = $this->convertType($data);
        $result = $this->validate($pedido);

        if($result != ""){
          return json_encode(["result" => $result]);
        }
    
        return json_encode(["result" =>$this->pedidoModel->create($pedido)]);
      }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        if($id <= 0)
        return json_encode(["result" => "invalid id"]);

        return $this->gameModel->readById($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id = 0, $data = null)
    {
        $pedido = $this->convertType($data);
        $pedido->setId_order($id);

        $result = $this->validate($pedido, true);

        if($result != ""){
        return json_encode(["result" => $result]);
    }

    return  json_encode(["result" => $this->pedidoModel->update($pedido)]);
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //DELETE ============================================
  function delete($id = 0){
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    if($id <= 0)
      return json_encode(["result" => "invalid id_order"]);

    $result =  $this->pedidoModel->delete($id);

    return  json_encode(["result" => $result]);
  }


  //GET - Retorna um pedido pelo ID
  function readById($id = 0){
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    if($id <= 0)
      return json_encode(["result" => "invalid id"]);

      return $this->pedidoModel->readById($id);
  }

  //GET - Retorna todos os pedidos
  function readAll(){
    return $this->pedidoModel->readAll();
  }

    private function convertType($data){
        return new Pedido(
        null,
        (isset($data['name']) ? filter_var($data['name'], FILTER_SANITIZE_STRING) : null),
        (isset($data['point_sale']) ? filter_var($data['point_sale'], FILTER_SANITIZE_STRING) : null),
        (isset($data['status']) ? filter_var($data['status'], FILTER_SANITIZE_STRING) : null)
        (isset($data['date']) ? filter_var($data['date'], FILTER_SANITIZE_STRING) : null)
        (isset($data['total']) ? filter_var($data['total'], FILTER_SANITIZE_STRING) : null)
        (isset($data['partial_total']) ? filter_var($data['partial_total'], FILTER_SANITIZE_STRING) : null)
        (isset($data['shipment_value']) ? filter_var($data['shipment_value'], FILTER_SANITIZE_STRING) : null)
        );
    }


  
 
}
