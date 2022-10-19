$(document).ready(function () {
    $("#typeVehicleTable").DataTable({
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
    }).buttons().container().appendTo('#typeVehicleTable_wrapper .col-md-6:eq(0)');

});


function createVehicleType(idType = null, show = null) {
    if (idType == null && show == null) {
        openModal("Creación de Tipo de Vehículo")
    }

    if (show == true) {
        openModal("Datos de Tipo de Vehículo")
    }

    if (show == false) {
        openModal("Modificación de Tipo de Vehículo");
    }

    url = idType = null ? 'formVehicleType' : 'formVehicleType/' + idType + '/' + show;

    $.ajax({
        type: 'GET',
        url: url,
        success: (data) => {
      
            $('#adminModalBody').html('');
            $('#adminModalBody').html(data);

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

function saveVehicleType(){
    let id= document.getElementById('id').value;

    url = id == 0 ? 'saveVehicleType' : 'updateVehicleType/' + id;
    var data = $('.form-send-vehicleType').serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {

            hideModal();
            $('#tbody_typeVehicle').html('');
            $('#tbody_typeVehicle').append(data);

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

function deleteVehicleType(id) {
    swal({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Anular!'
    }).then((result) => {

        if (result) {
            $.ajax({
                type: 'GET',
                url: 'deleteVehicleType/' + id,
                success: (data) => {
              
                    $('#tbody_typeVehicle').html('');
                    $('#tbody_typeVehicle').append(data);

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

        }
    })

    return 0;
}
