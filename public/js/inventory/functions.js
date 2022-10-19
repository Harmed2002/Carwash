function downloadPdf() {
    var configuracion_ventana = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
    var route = 'reportDocument?'+$('.form-report').serialize();
    
     window.open([route],['Reportes'],[configuracion_ventana]);

    return 0;
}

$(document).ready(function () {


    $("#table-inventory").DataTable({
        "language": {
            "url": "js/plugins/datatables/es.json"
        },
        // "dom": 'Bfrtip',
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "bSort" : false
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });
// }.buttons().container().appendTo('#table-inventory_wrapper .col-md-6:eq(0)');

    $("#table-report-tanking").DataTable({
        "language": {
            "url": "js/plugins/datatables/es.json"
        },
        // "dom": 'Bfrtip',
        "responsive": true,
        "lengthChange": false,
        "autoWidth": true,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "iDisplayLength": 9,
        "bSort" : false
    });

    $("#table-inventory-control").DataTable({
        "language": {
            "url": "js/plugins/datatables/es.json"
        },
        // "dom": 'Bfrtip',
        "responsive": true,
        "lengthChange": false,
        "autoWidth": true,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "iDisplayLength": 9,
        "bSort" : false
    });
    

});
