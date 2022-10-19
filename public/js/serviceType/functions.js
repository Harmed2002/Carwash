$(document).ready(function () {
    $("#serviceTypeTable").DataTable({
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
    }).buttons().container().appendTo('#serviceTypeTable_wrapper .col-md-6:eq(0)');

});


function createServiceType(idType = null, show = null) {
    if (idType == null && show == null) {
        openModal("Creación de Tipo de Servicio")
    }

    if (show == true) {
        openModal("Datos de Tipo de Servicio")
    }

    if (show == false) {
        openModal("Modificación de Tipo de Servicio");
    }

    url = idType = null ? 'formServiceType' : 'formServiceType/' + idType + '/' + show;

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

function saveServiceType(){
    let id= document.getElementById('id').value;

    url = id == 0 ? 'saveServiceType' : 'updateServiceType/' + id;
    var data = $('.form-send-serviceType').serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {

            hideModal();
            $('#tbody_serviceType').html('');
            $('#tbody_serviceType').append(data);

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

function deleteServiceType(id) {
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
                url: 'deleteServiceType/' + id,
                success: (data) => {
              
                    $('#tbody_serviceType').html('');
                    $('#tbody_serviceType').append(data);

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

function toggleCombo() {
    let lenNombre = document.getElementById('nombre').value;
    let divCombo = document.getElementById('detail');
    let checking = $('#esCombo').prop("checked");

    if (lenNombre != '') {
        if( checking ){
            divCombo.style.display = '';
        } else {
            divCombo.style.display = 'none';
        }
    } else {
        $('#esCombo').prop("checked", false);
        swal({
            title: 'ADVERTENCIA',
            text: "Debe digitar el nombre del servicio",
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            document.getElementById('nombre').focus();
        })
        return 0;
    }

    
}


var count = 0;

function addDetail() {    
    count = count + 1;
    let idServ = $('#idTipoServ').val()
    let cmbServ = document.getElementById("idTipoServ");
    let selServ = cmbServ.options[cmbServ.selectedIndex].text;
    let arrayServ = selServ.split(',');

    var data = {
        id: idServ,
        servicio: arrayServ[0],
        valor: arrayServ[1],
        count : count
    }
    
    $.ajax({
        type: 'GET',
        url: 'service',
        data: data,
        success: (data) => {
            $('#tbody_servicedet').append(data);

        },
        error: (data) => {
            console.log('error', data)
        }
    }).done(function (data) {
        //let cont_fila = ($('#tbody_servicedet').find('tr').length);
        let vlrServ = arrayServ[1];
        let vlrActual = $('#total').val();
        let total = parseFloat(vlrServ) + parseFloat(vlrActual);
        $('#total').val(total);


        //for (var i = 1; i < cont_fila + 1; i++) {
            //let nameField = '#details[' + i + '][valor]';
            //var subtotal = $('nameField').val();
            /*let nameField = 'details[' + i + '][valor]';
            var subtotal = document.getElementById(nameField).value;*/
            //console.log(subtotal);
        //     if (subtotal != undefined) {
        //         total_general = parseFloat(total_general) + parseFloat(subtotal);
        //     }
        //}
        // $('#totalRemission').val((total_general * 1).toFixed(2));
        // $("#summary").text((total_general * 1).toFixed(2));
    });

    return 0;
}


function deleteRow(r) {
    swal({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar!'
    }).then((result) => {
        if (result) {
            /*console.log(r.parentNode.parentNode.$('#details[r][valor]'));*/
            let i = r.parentNode.parentNode.rowIndex;
            document.getElementById('detailTable').deleteRow(i);
        }

    })
}

