$(document).ready(function () {

    initSelectTwoModal();
    initSelect();
})

function openModal(title) {
    $('.alert-dismissible').remove();
    $("#adminModal").modal("show");
    $("#modalTitle").html(title);
    resetform()
}

function hideModal() {
    // $('.listMessageErrors').hide();
    $("#adminModal").modal("hide");
    $('.modal-body').empty();
    $('.messages').empty();
    $('.messages').html('');
    // resetform()
}
//---------------------------------------------------------------------------------------------------//
// Función de envio de datos
function sendDate(type, url, data) {
    return submit(type, url, data);
}

function deleteData(url) {
    return submit('GET', url);
}

function getDate(url) {
    return submit('GET', url);
}

function submit(type, url, data = null) {
    $.ajax({
        method: type,
        url: url,
        data: data
    }).done(function (msg) {
        alert("Data Saved: " + msg);
    }).fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function resetform() {
    $("form select").each(function () {
        this.selectedIndex = 0
    });
    $("form input[type=text] , form textarea").each(function () {
        this.value = ''
    });
}

function initSelectTwoModal() {
    $('.select2').select2(
        {
            dropdownParent: $('#adminModalBody'),
            width: '100%'
        }
    );
    $('#typeProduction').select2({ placeholder: "Digita un tipo de movimiento, selecciona" });
    $('#permissions').select2({ placeholder: "Digita los nombres de los permisos a asociar, selecciona" });
    $('#roles').select2({ placeholder: "Digita los nombres de los roles a asociar, selecciona" });
}

function initSelect() {
    $('.select3').select2(
        {
            width: '100%',
        }
    );
}

function alertSuccess() {
    swal({
        title: "Buen trabajo!",
        text: "Se ha guardado con éxito!",
        icon: "success",
    });
}

function alertDanger(message = null) {
    swal({
        title: "Advertencia!",
        icon: "info",
        text: message == null ? "Algo salio mal, vuelve a intentar!" : message,

    });
}

function onFail(errors) {
    message = "";
    Object.entries(errors).forEach(([key, value]) => {
        message += '<li>' + value[0] + '</li>';
    });

    $('.messages').html('<div class="alert alert-danger alert-dismissible fade show pl-5 pr-5 mt-2"><h5><i class="icon fas fa-ban"></i> Alerta!</h5><ul">' + message + '</ul><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');

}

function onFailArray(errors) {
    message = "";
    errors.forEach(function(text, index) {
        message += '<li>' + text + '</li>';
    });

    $('.messages').html('<div class="alert alert-danger alert-dismissible fade show pl-5 pr-5 mt-2"><h5><i class="icon fas fa-ban"></i> Alerta!</h5><ul">' + message + '</ul><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');

}


function onSuccess(message) {

    $('.messageSuccess').html('<div class="alert alert-success alert-dismissible fade show pt-2 pb-2 pb-0"><b>' + message + '</b><button type="button" class="btn-close pb-2" data-bs-dismiss="alert" aria-label="Close"></button></div>');

}

function onDanger(message, modal = false) {
    if (modal) {
        $('.listMessageErrors').html('<div class="messageErrors mt-2"><div class="alert alert-danger alert-dismissible fade show pt-2 pb-2 pb-0"><b>' + message + '</b><button type="button" class="btn-close pb-2" data-bs-dismiss="alert" aria-label="Close"></button></div></div>');

    } else {
        $('.messageError').html('<div class="alert alert-danger alert-dismissible fade show pt-2 pb-2 pb-0 mt-2"><b>' + message + '</b><button type="button" class="btn-close pb-2" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}

function onDangerUniqueMessage(message) {
    $('.listMessageErrors').show();
    $('.listMessageErrors').html('<div class="alert alert-danger alert-dismissible fade show pl-5 pr-5 mt-2"><h5><i class="icon fas fa-ban"></i> Alerta!</h5><ul">' + message + '</ul><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
    setTimeout(function () {
        $('.listMessageErrors').hide();
    }, 8000);
}


function getNameClient() {
    let idCliente = $('#idCliente').val(); // Obtengo la id del cliente

    if (idCliente) {
        $.ajax({
            url: 'showClient/' + idCliente,
            type: 'GET',
            dataType: 'json',
            success: function (dataJson) {

                if (dataJson != null) {
                    if (dataJson.pers_razonsocial == null) {

                        var segnombre = '';
                        var primernombre = '';
                        var primerapell = '';
                        var pers_segapell = '';

                        if (dataJson.pers_segnombre != null) { segnombre = dataJson.pers_segnombre;  }
                        if (dataJson.pers_primernombre != null) { primernombre = dataJson.pers_primernombre }
                        if (dataJson.pers_primerapell != null) { primerapell = dataJson.pers_primerapell }
                        if (dataJson.pers_segapell != null) { pers_segapell = dataJson.pers_segapell }

                        var nombreapellidos = primernombre + ' ' + segnombre + ' ' + primerapell + ' ' + pers_segapell;
                        $('#rSocial').val(nombreapellidos);

                    } else {
                        $('#rSocial').val(dataJson.pers_razonsocial);
                    }


                } else {
                    $('#rSocial').val('');
                    onDangerUniqueMessage('Esta identificación no existe en la base de datos')
                }
            },
            error: (error) => {
                console.log("error", error);
            }
        });
    }
}

function inactivateFields() {
    //var tipoId = $('.TipoId').val();

    let tipoId = $('#TipoId').val();

    if (tipoId == "CC") {
        $('#rSocial').prop("disabled", true);
        $('#Apell1').prop("disabled", false);
        $('#Apell2').prop("disabled", false);
        $('#Nom1').prop("disabled", false);
        $('#Nom2').prop("disabled", false);
    } else {
        $('#rSocial').prop("disabled", false);
        $('#Apell1').prop("disabled", true);
        $('#Apell2').prop("disabled", true);
        $('#Nom1').prop("disabled", true);
        $('#Nom2').prop("disabled", true);
    }
}

function typeDocument(type) {
    if (type != null) {
        if (type === "NIT") {
            $("#Apell1").prop("disabled", true);
            $("#Apell2").prop("disabled", true);
            $("#Nom1").prop("disabled", true);
            $("#Nom2").prop("disabled", true);
            $("#rSocial").prop("disabled", false);

        } else {

            $("#rSocial").prop("disabled", true);
            $("#Apell1").prop("disabled", false);
            $("#Apell2").prop("disabled", false);
            $("#Nom1").prop("disabled", false);
            $("#Nom2").prop("disabled", false);
        }
    }

}

function companyNameCc() {
    $('.form-control').val().toUpperCase();
    var razonSocial =
        $(".Nom1").val().toUpperCase() + ' ' +
        $(".Nom2").val().toUpperCase() + ' ' + $(".Apell1").val().toUpperCase() + ' ' + $(".Apell2").val().toUpperCase();

        $("#Nom1").val($(".Nom1").val())
        $("#Nom2").val($(".Nom2").val())
        $("#Apell1").val($(".Apell1").val())
        $("#Apell2").val($(".Apell2").val())
        $('#pers_razonsocial').val(razonSocial)
       
    $('.rSocial').val(razonSocial);
}

var num=  random(1,9000000000);

function random(min,max){
    return Math.floor(Math.random()*(max-min+1)+min)

}

/*function razonsocial(){
    $('#pers_razonsocial').val($('.rSocial').val())
}*/

function imagePreview() {
    const $getPhoto = document.querySelector("#photo"), $imgPreview = document.querySelector("#photoPers");
    const archivos = $getPhoto.files;
    
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!archivos || !archivos.length) {
        $imgPreview.src = "img/Employees/User.png";
        return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const firstImage = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(firstImage);
    // Y a la fuente de la imagen le ponemos el objectURL
    $imgPreview.src = objectURL;
}

