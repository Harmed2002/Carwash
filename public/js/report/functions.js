function downloadRemissionPdf() {
    var configuracion_ventana = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route = 'pdfReportRemissions?'+$('.idRemissionReport').serialize();
    
     window.open([route],['ReportRemissions'],[configuracion_ventana]);

    return 0;
}

$(document).ready(function () {


    $("#table-report").DataTable({
        "language": {
            "url": "js/plugins/datatables/es.json"
        },
        // "dom": 'Bfrtip',
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "iDisplayLength": 9,
        "bSort" : false
    });
    // .buttons().container().appendTo('#table-report_wrapper .col-md-6:eq(0)');


});


function detailRemission(idRemission){

        openModal("Detalle remisión.");
        $.ajax({
            type: 'get',
            url: ' detailRemission/'+idRemission,
            success: (data) => {
    
                $('#adminModalBody').html('');
                $('#adminModalBody').html(data);
    
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