$(document).ready(function () {
    $("#table-supplier").DataTable({
        "language": {
            "url": "js/plugins/datatables/es.json"
        },
        "dom": 'Bfrtip',
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "iDisplayLength": 7,
        "bSort" : false
    }).buttons().container().appendTo('#table-supplier_wrapper .col-md-6:eq(0)');


});

function createSupplier(id_supplier = null, show = null, type=null) {
    
    if (id_supplier == null && show == null) {
        openModal("Creación de Proveedor")
    }

    if (show == true) {
        openModal("Datos de Proveedor")
    }

    if (show == false) {
        openModal("Modificación de Proveedor");
    }

    url = id_supplier = null ? 'formSupplier' : 'formSupplier/' + id_supplier + '/' + show;

    $.ajax({
        type: 'GET',
        url: url,
        success: (data) => {
      
            $('#adminModalBody').html('');
            $('#adminModalBody').html(data);

            typeDocument(type);
            initSelectTwoModal();

        },
        error: (data) => {
            alertDanger()
            if (typeof (data.responseJSON.errors) == 'object') {
                onFail(data.responseJSON.errors)
            } else {
                onDangerUniqueMessage(data.responseJSON.message)
            }
         }
    });
    return 0;

}

function sendSupplier(){
    // var pers_razonsocial =$('#pers_razonsocial').val();
    // $('.rSocial').val(pers_razonsocial )

    let idPers = document.getElementById('idPerson').value;
    let idSupplier = document.getElementById('idSupplier').value;

    url = idPers == 0 ? 'saveSupplier' : 'updateSupplier/' + idSupplier;
    var data = $('.form-send-supplier').serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
  
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {

            hideModal();
            $('#tbody_supplier').html('');
            $('#tbody_supplier').append(data);

            alertSuccess()

            // $("#adminModalBody").modal("hide");
        },
        error: (data) => {
            alertDanger()
            if (typeof (data.responseJSON.errors) == 'object') {
                onFail(data.responseJSON.errors)
            } else {
                onDangerUniqueMessage(data.responseJSON.message)
            }


        }
    });
    return 0;


}

function deleteSupplier(id_supplier) {

    swal({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Anular!'
    }).then((result) => {
        console.log(result);
        if (result) {


            $.ajax({
                type: 'get',
                url: 'deleteSupplier/' + id_supplier,
                success: (data) => {
              
                    $('#tbody_supplier').html('');
                    $('#tbody_supplier').append(data);

                    swal({

                        title: '¡Estado cambiado!',
                        text: 'Ha pasado a inactivo con éxito',
                        icon: "success",
                    })

                },
                error: (data) => {
                    alertDanger()
                    if (typeof (data.responseJSON.errors) == 'object') {
                        onFail(data.responseJSON.errors)
                    } else {
                        onDangerUniqueMessage(data.responseJSON.message)
                    }
                }
            });


        }
    })

    return 0;
}

//Metodo de eliminar
// function deleteSupplier(){
//     swal({
//         title: '¿Estás seguro',
//         text: "¡No podrás revertir esto!",
//         type: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Desea eliminarlo'
//       }).then((result) => {
//           console.log(result);
//         if (result) {

//             $.ajax({
//                 type: 'get',
//                 url: 'deleteMachineryNovelty/'+prod_id,
//                 success: (data) => {
         
//                     $('#tbody_production').html('');
//                     $('#tbody_production').html(data);
//                     swal({

//                         title: '¡Cambiado!',
//                         text: 'Se ha cambiado el estado con éxito',
//                         icon: "success",
//                       })
                
//                 },
//                 error: (data) => {
//                     alertDanger()
//                  }
//             });
//             return 0;

//         }
//       })
// }

function searchEconomica(){
            var actEconomica =$('#prov_codactividad_select').val();
            var  option = '';
            if(actEconomica.length>4){
                $.ajax({
                    type: 'post',
                    url: 'searchEconomica',
                    data:{
                        search:actEconomica
                    },
                   headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                    success: (data) => {
    
                        data.forEach(element => {
                            option += "<option class='form-control' value="+element.id+">"+element.acte_nombre+"</option>";
                        });
                        // option +='</ul>';
                        $('#prov_codactividad').html('');
                        $('#prov_codactividad').append(option);
              
                        
                    },
                    error: (data) => {
                        alertDanger()
                        if (typeof (data.responseJSON.errors) == 'object') {
                            onFail(data.responseJSON.errors)
                        } else {
                            onDangerUniqueMessage(data.responseJSON.message)
                        }
                     }
                });
            }else{
                $('#prov_codactividad').html('');
            }

            return 0;
}

function codeVerification(){

    let tipoId = $('#TipoId').val();
    let nit  = $('#idProv').val();
    let result = 0;

    if(tipoId == "NIT" && nit.length >= 9){
        let array = nit.split('');
        let sum = 0;
 
        var arraySeriel = [41, 37, 29, 23, 19, 17, 13, 7, 3]
        for (let index = 0; index < array.length; index++) {

            var element =  parseInt(array[index]) * arraySeriel[index];
            sum +=element 
            
            //console.log(element)
        }
        let div =  sum/11;
        var decPart =parseFloat('0.'+(div+"").split(".")[1]);
        var mul =Math.round(decPart*11);

        if (mul == 0 || mul ==1) {
            result = mul;
        }else{

            result = 11 - mul;
        }

        $('#digVerif').val(result)

    }else{

        $('#digVerif').val('')
    }
  
}

function validExistPerson() {
    let idSupplier = document.getElementById('idProv').value;
    let idPerson = document.getElementById('idPerson').value;
    
    if (idSupplier && !idPerson) {
        $.ajax({
            url: 'showSupplier/' + idSupplier,
            type: 'GET',
            dataType: 'json',
            success: function (dataJson) {
                if (dataJson.data.length) {
                    onDangerUniqueMessage('Esta identificación ya existe en la base de datos')
                    $('#idProv').val('')
                    $('#digVerif').val('')
                }
            },
            error: (error) => {
                //console.log("error", error);

                alertDanger()
                if (typeof (data.responseJSON.errors) == 'object') {
                    onFail(data.responseJSON.errors)
                } else {
                    onDangerUniqueMessage(data.responseJSON.message)
                }
            }
        });
    }
}