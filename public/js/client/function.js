$(document).ready(function () {
    $("#clientTable").DataTable({
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
    }).buttons().container().appendTo('#clientTable_wrapper .col-md-6:eq(0)');
});

function createClient(clie_id = null, show = null,type = null){

    if (show == true) {
        openModal("Datos de Cliente")
    }

    if (clie_id == null && show == null) {
        openModal("Creación de Cliente")
    }

    if (show == false) {
        openModal("Modificación de Cliente")
    }

    url = clie_id == null ? 'formClient' : 'formClient/' + clie_id + '/' + show;
 
    $.ajax({
        type: 'get',
        url: url,
        success: (data) => {
            // console.log(data)

            $('#adminModalBody').html('');
            $('#adminModalBody').html(data);

            //typeDocument(type);
            initSelectTwoModal()
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

// Metodo para guardar cliente
function saveClient(){
    let idPers = document.getElementById('idPerson').value;
    let idClient = document.getElementById('idCliente').value;

    $(".rSocial").prop("disabled", false);
    //var data = $('.form-send-client').serialize();

    url = idPers == 0 ? 'saveClient' : 'updateClient/' + idClient;

    $.ajax({
        type: 'POST',
        url: url, 
        //data:data,
        data: new FormData($('.form-send-client')[0]),
        contentType: false,
        processData: false,
        success: (data) => {
            hideModal();
            $('#tbody_client').html('');
            $('#tbody_client').html(data);
    
            alertSuccess()
        },
        error: (data) => {
            alertDanger();
            $(".rSocial").prop("disabled", true);
            if (typeof data.responseJSON.errors == "object") {
                onFail(data.responseJSON.errors);
            } else {
                onDangerUniqueMessage(data.responseJSON.message);
            }
        }
    });

    return 0;
}


//Metodo de eliminar
function deleteClient(client_id){
    swal({
        title: '¿Estás seguro',
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
                url: 'deleteClient/' + client_id,
                success: (data) => {
         
                    $('#tbody_client').html('');
                    $('#tbody_client').html(data);
                    swal({
                        title: '¡Anulado!',
                        text: 'Se ha cambiado el estado con éxito',
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
            return 0;

        }
      })
}

function validExistPerson() {
    let idClient = document.getElementById('idCliente').value;
    let idPerson = document.getElementById('idPerson').value;
    
    if (idClient && !idPerson) {
        $.ajax({
            url: 'showClient/' + idClient,
            type: 'GET',
            dataType: 'json',
            success: function (dataJson) {
                if (dataJson.data.length) {
                    onDangerUniqueMessage('Esta identificación ya existe en la base de datos')
                    $('#idCliente').val('')
                }
            },
            error: (error) => {
                //console.log(dataJson);
                console.log("error", error);
            }
        });
    }
}
