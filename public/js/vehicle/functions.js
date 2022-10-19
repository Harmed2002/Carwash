$(document).ready(function () {
    $("#vehicleTable").DataTable({
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
    }).buttons().container().appendTo('#vehicleTable_wrapper .col-md-6:eq(0)');

});


function createVehicle(id_vehicle = null, show = null, yearSelected = null) {
    
    if (id_vehicle == null && show == null) {
        openModal("Creación de Vehículo")
    }

    if (show == true) {
        openModal("Datos de Vehículo")
    }

    if (show == false) {
        openModal("Modificación de Vehículo");
    }

    url = id_vehicle = null ? 'formVehicle' : 'formVehicle/' + id_vehicle + '/' + show;

    $.ajax({
        type: 'GET',
        url: url,
        success: (data) => {
      
            $('#adminModalBody').html('');
            $('#adminModalBody').html(data);

            initSelectTwoModal();
            populateYears(yearSelected); // Lleno el combo del año del modelo

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

function saveVehicle(){
    //let idPers = document.getElementById('idPerson').value;
    let idVehicle= document.getElementById('idVehicle').value;

    url = idVehicle == 0 ? 'saveVehicle' : 'updateVehicle/' + idVehicle;
    var data = $('.form-send-vehicle').serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
  
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {

            hideModal();
            $('#tbody_vehicle').html('');
            $('#tbody_vehicle').append(data);

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

function deleteVehicle(idVehicle) {
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
                url: 'deleteVehicle/' + idVehicle,
                success: (data) => {
              
                    $('#tbody_vehicle').html('');
                    $('#tbody_vehicle').append(data);

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

/*function validExistVehicle() {
    let placa = document.getElementById('placa').value;
    
    if (placa) {
        $.ajax({
            url: 'showVehicle/' + idVehicle,
            type: 'GET',
            dataType: 'json',
            success: function (dataJson) {
                if (dataJson.data.length) {
                    onDangerUniqueMessage('Este vehículo identificación ya existe en la base de datos')
                    $('#idProv').val('')
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
}*/


function populateYears(yearSelected) {
    var date = new Date();
    var year = date.getFullYear();
    var ctrlYear = document.getElementById("year");

    if (ctrlYear)
    {
        // Hacer que este año y los 30 años anteriores estén en el <select>
        for (var i = 0; i <= 30; i++) {
            var option = document.createElement("option");
            //option.textContent = year - i;
            option.value = year - i;
            option.text = year - i;

            ctrlYear.appendChild(option);
            if (yearSelected == option.value)
            {
                option.selected = true;
            }
        }
    }
  }