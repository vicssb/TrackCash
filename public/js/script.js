"use strict"

//EVENTS
$(document).ready(function(){
  console.clear();
  readAll();

  $('#modalViewPedido').on('hidden.bs.modal', function (e) {
    document.getElementById("gameInfo").innerHTML = "";
  });
});

$("#btnNew").click(function(){
  openModalCreate(true);
});

$("#frmPedido").submit(function(e){
  sendForm();
  e.preventDefault();
});

//FUNCTIONS
function edit(id){
  if(id <= 0)
    return;

  readById(id, false);
}

function openModalCreate(reset = true){
  $('#modalNewPedido').modal('show');

  if(reset)
  resetForm();
}

function hideModalCreate(){
  $('#modalNewPedido').modal('hide');
}

function openModalViewPedido(id){
  readById(id, true);
  $('#modalViewPedido').modal('show');
}

function confirmDelete(id){
  if(!confirm("Deseja realmente remover?"))
  return;

  deletePedido(id);
}

//SEND
function sendForm(){
  var obj = {
    id : $("#txtId").val(),
    titulo : $("#txtName").val(),
    descricao : $("#txtPoint_sale").val(),
    status : $("#txtStatus").val(),
    date : $("#txtDate").val(),
    total : $("#txtTotal").val(),
    partial_total : $("#txtPartial,_total").val(),
    shipment_value : $("#txtShipment_value").val()
  };

  var result = validate(obj);
  $("#dvAlert").text(result);

  if(result != ""){
    return;
  }

  if(obj.id == 0){
    create(obj);
  }else{
    update(obj);
  }
}

function validate(obj){
  if(obj.id < 0){
    return "- ID inválido";
  }

  if(obj.name.length < 0){
    return "- name inválido";
  }

  if(obj.point_sale.length < 0){
    return "- point_sale inválida";
  }

  if(obj.status.length < 0){
    return "- status inválida";
  }

  if(obj.total.length < 0){
    return "- total inválida";
  }

  if(obj.partial_total.length < 0){
    return "- partial_total inválida";
  }

  if(obj.point_sale.length < 0){
    return "- point_sale inválida";
  }

  if(obj.shipment_value.length < 0){
    return "- shipment_value inválida";
  }

 

  return "";
}

function resetForm(){
  $("#txtId").val("0");
  $("#txtname").val("");
  $("#txtpoint_sale").val("");
  $("#txtStatus").val("");
  $("#txtDate").val("");
  $("#txtTotal").val("");
  $("#txtPartial_total").val("");
  $("#txtShipment_value").val("");
  $("#dvAlert").html("&nbsp;");
  $("#btnSubmit").attr("disabled", false);
}

function createViewModal(data){
  document.getElementById("titleView").innerHTML = data.Titulo;
  //$("#titleView").html(data.Titulo);
  document.getElementById("gameInfo").innerHTML = "<div class='videoWrapper'>"+
  "<iframe width='560' height='315' src='https://www.youtube.com/embed/"+data.Videoid+"' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>"+
  "</div>"+
  "<hr class='border-info'>"+
  "<div>"+data.Descricao+"</div>";
}

function createTable(data){
  if(data.length < 1)
  return;

  var section = document.getElementById("section");
  section.innerHTML = "";

  for(var i = 0; i < data.length; i++){
    var col = "<div class='col-md-4 mt-3'>"+
    "<div class='card border-primary'>"+
    "<div class='card-header'>"+ data[i].Titulo +"</div>"+
    "<div class='card-body'>"+
    "<div class='videoWrapper'>"+
    "<iframe width='560' height='315' src='https://www.youtube.com/embed/"+ data[i].Videoid +"' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>"+
    "</div>"+
    "</div>"+
    "<div class='card-footer'>"+
    "<div class='row'>"+
    "<div class='col-md-3'>"+
    "<button type='button' name='button' class='mb-2 w-100 btn btn-outline-warning' onclick='edit("+ data[i].Id +");'>Edit</button>"+
    "</div>"+
    "<div class='col-md-6'>"+
    "<button type='button' name='button' class='mb-2 w-100 btn btn-outline-success' onclick='openModalViewGame("+ data[i].Id +")'>View</button>"+
    "</div>"+
    "<div class='col-md-3'>"+
    "<button type='button' name='button' class='mb-2 w-100 btn btn-outline-danger' onclick='confirmDelete("+ data[i].Id +")'>Del</button>"+
    "</div>"+
    "</div>"+
    "</div>"+
    "</div>"+
    "</div>";

    section.innerHTML += col;
  }
}

function editModal(data){
  if(data == null)
  return;

  $("#txtId").val(data.id_order);
  $("#txtName").val(data.name);
  $("#txtPoint_sale").val(data.point_sale);
  $("#txtStatus").val(data.status);
  $("#txtDate").val(data.date);
  $("#txtTotal").val(data.total);
  $("#txtPartial_total").val(data.partial_total);
  $("#txtShipment_value").val(data.shipment_value);

  openModalCreate(false);
}
//=========AJAX

//Requisição AJAX para consultar
function create(obj){
  $.ajax({
    url : "api/game",
    type : "POST",
    data : obj,
    dataType : "json",
    beforeSend : function(){
      //Chama antes de enviar
      $("#btnSubmit").attr("disabled", true);
    },
    success : function(data){
      //Tudo estiver OK
      console.log(data);
      if(data.result == "ok"){
        hideModalCreate();
        readAll();
      }else{
        $("#dvAlert").html("Houve um erro ao tentar cadastrar");
      }
    },
    erro :  function(error){
      //Quando houver um erro
      console.log(error);
      $("#dvAlert").html("Houve um erro ao tentar cadastrar");
    },
    complete : function(){
      //Quando finaliza a operação
      $("#btnSubmit").attr("disabled", false);
    }
  });
}

function update(obj){
  $.ajax({
    url : "api/game/" + obj.id,
    type : "PUT",
    data : obj,
    dataType : "json",
    beforeSend : function(){
      //Chama antes de enviar
      $("#btnSubmit").attr("disabled", true);
    },
    success : function(data){
      //Tudo estiver OK
      console.log(data);
      if(data.result == "ok"){
        hideModalCreate();
        readAll();
      }else{
        $("#dvAlert").html("Houve um erro ao tentar alterar");
      }
    },
    erro : function(error){
      //Quando houver um erro
      console.log(error);
      $("#dvAlert").html("Houve um erro ao tentar alterar");
    },
    complete : function(){
      //Quando finaliza a operação
      $("#btnSubmit").attr("disabled", false);
    }
  });
}

function readAll(){
  $.ajax({
    url : "api/game",
    type : "GET",
    data : {},
    dataType : "JSON",
    success : function(data){
      console.table(data);
      createTable(data);
    },
    error : function(error){
      console.log(error);
    }
  });
}

//view = true || false; Show modal or edit modal
function readById(id, view){
  $.ajax({
    url : "api/game/" + id,
    data : {},
    type : "GET",
    dataType : "JSON",
    success : function(data){
      if(view){
        //SHOW MODAL
        createViewModal(data);
      }else{
        //EDIT MODAL
        editModal(data);
      }
    }
  });
}

function deletePedido(id){
  $.ajax({
    url : "api/game/" + id,
    type : "DELETE",
    dataType : "JSON",
    data : {},
    success : function(data){
      console.log(data);
      if(data.result = "ok"){
        readAll();
      }
    },
    error : function(error){
      console.log(error);
    }
  });
}
