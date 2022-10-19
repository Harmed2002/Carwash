$(document).ready(function () {
    $("#employeeTable").DataTable({
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
    }).buttons().container().appendTo('#employeeTable_wrapper .col-md-6:eq(0)');
});

function createEmployee(id = null, show = null){
    //, type = null
    if (show == true) {
        openModal("Datos de Empleado")
    }

    if (id == null && show == null) {
        openModal("Creación de Empleado")
    }

    if (show == false) {
        openModal("Modificación de Empleado")
    }

    url = id == null ? 'formEmployee' : 'formEmployee/' + id + '/' + show;

    $.ajax({
        type: 'GET',
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

// Metodo para guardar empleado
function saveEmployee(){
    let idPers = document.getElementById('idPerson').value;
    let idEmpl = document.getElementById('idEmployee').value;
    
    //var data = $('.form-send-employee').serialize();
    //var data = new FormData($('.form-send-employee')[0]);

    url = idPers == 0 ? 'saveEmployee' : 'updateEmployee/' + idEmpl;

    $.ajax({
        type: 'POST',
        url: url, 
        data: new FormData($('.form-send-employee')[0]),
        //dataType: 'json',
        contentType: false,
        processData: false,
        //headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        success: (data) => {
            hideModal();
            $('#tbody_employee').html('');
            $('#tbody_employee').html(data);
    
            alertSuccess()
        },
        error: (data) => {
            //console.log('Error:', data);
            alertDanger();
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
function deleteEmployee(id){
    swal({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Anular!'
      }).then((result) => {
            //console.log(result);
        if (result) {
            $.ajax({
                type: 'get',
                url: 'deleteEmployee/' + id,
                success: (data) => {
         
                    $('#tbody_employee').html('');
                    $('#tbody_employee').html(data);

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

function letFormat(type) { 
    let vlrSalario = document.getElementById('salario').value;
    
    // Gana el foco
    if(type == '1') {
        document.getElementById('salario').value = vlrSalario.replace(/,/gi, '');
        //alert(number_format(vlrSalario, 0, '', ''));
    }
    
    // Pierde el foco
    if(type == '2') {
        document.getElementById('salario').value = new Intl.NumberFormat('es-MX').format(vlrSalario);
        //new Intl.NumberFormat('es-MX').format(vlrSalario)
    }
}

function validExistPerson() {
    let idEmployee = document.getElementById('idEmployee').value;
    let idPerson = document.getElementById('idPerson').value;
    
    if (idEmployee && !idPerson) {
        $.ajax({
            url: 'showEmpl/' + idEmployee,
            type: 'GET',
            dataType: 'json',
            success: function (dataJson) {
                if (dataJson.data.length) {
                    onDangerUniqueMessage('Esta identificación ya existe en la base de datos')
                    $('#idEmployee').val('')
                }
            },
            error: (error) => {
                //console.log(dataJson);
                console.log("error", error);
            }
        });
    }
}
