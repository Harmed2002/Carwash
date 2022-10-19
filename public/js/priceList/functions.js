
$(document).ready(function () {
    $("#priceListTable").DataTable({
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
    }).buttons().container().appendTo('#priceListTable_wrapper .col-md-6:eq(0)');
});



//Crear, editar , ver lista de precioss
function createPriceList(id_priceList = null, show = null) {

    if (id_priceList == null && show == null) {
        openModal("Crear de lista de precios.")
    }
    if (show == true) {

        openModal("Ver de lista de precios.")
    }
    if (show == false) {

        openModal("Editar de lista de precios.")
    }
    url = id_priceList == null ? 'formPriceList' : 'formPriceList/' + id_priceList + '/' + show;

    $.ajax({
        type: 'get',
        url: url,
        success: (data) => {

            $('#adminModalBody').html('');
            $('#adminModalBody').html(data);
            if (show) {

                $("#sendRolePermissionButton").remove();
            } else {
                initSelectTwoModal()
            }
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


// Metodo para guardar lista de precios
function savePriceList() {

    var data = $('.form-send-price-lists').serialize();

    url =  'savePriceList';

    $.ajax({
        type: 'post',
        url: url,
        data: data,
        headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
        success: (data) => {
            hideModal();
            // Lllega aca y la pego
            $('#tbody_priceList').html('');
            $('#tbody_priceList').html(data);

            alertSuccess()
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


//Metodo de eliminar
function deletePriceList(id_priceList) {
    swal({
        title: '¿Estás seguro',
        text: "¡No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Desea eliminarlo'
    }).then((result) => {
        console.log(result);
        if (result) {

            $.ajax({
                type: 'get',
                url: 'deletePriceList/' + id_priceList,
                success: (data) => {

                    $('#tbody_priceList').html('');
                    $('#tbody_priceList').html(data);
        
                    swal({

                        title: '¡Cambiado!',
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


var countMaterial = 0;
function materialPriceList() {

    var id_material =$('#id_material').val();
    
    $.ajax({
        type: 'get',
        data:{
            count: countMaterial++,
        },
        url: 'searchMaterial/' + id_material,
        success: (data) => {

            // $('#tbody_material_listPrice').html('');
            $('#tbody_material_listPrice').append(data);
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
    $countMaterial = countMaterial + 1;
    return 0;
}
function deletePriceListTable(_div){
    $('#'+_div).remove();
}