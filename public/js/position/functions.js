$(document).ready(function () {
    $("#positionTable").DataTable({
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
    }).buttons().container().appendTo('#positionTable_wrapper .col-md-6:eq(0)');

});


function createPosition(idPosition = null, show = null) {
    
    if (idPosition == null && show == null) {
        openModal("Creación de Cargo")
    }

    if (show == true) {
        openModal("Datos de Cargo")
    }

    if (show == false) {
        openModal("Modificación de Cargo");
    }

    url = idPosition = null ? 'formPosition' : 'formPosition/' + idPosition + '/' + show;

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

function savePosition(){
    //let idPers = document.getElementById('idPerson').value;
    let id= document.getElementById('id').value;

    url = id == 0 ? 'savePosition' : 'updatePosition/' + id;
    var data = $('.form-send-position').serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {

            hideModal();
            $('#tbody_position').html('');
            $('#tbody_position').append(data);

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

function deletePosition(id) {
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
                url: 'deletePosition/' + id,
                success: (data) => {
              
                    $('#tbody_position').html('');
                    $('#tbody_position').append(data);

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

    return 0;
}
