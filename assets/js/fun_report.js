$(document).ready(function () {

    $("#eli_filtros").hide();
    $("#filtros").click(function () {
        $("#modal_filtros").modal("show");
        $(".fecha").datepicker({
            firstDay: 1,            
            format: "yyyy-mm-dd",
            language: 'es',
            todayBtn: true,
            autoclose: true,            
        }).datepicker("setDate", null);
    });
    consultar(0);
})

function consultar(elemt) {
  
    fecha_inicio = $("#fecha_inicio").val();
    fecha_fin = $("#fecha_fin").val();
    var cont = 0;

    if (elemt == 1) {
        if (fecha_inicio <= fecha_fin) {
                $("#eli_filtros").show();
                $("#filtros").hide();
                $("#modal_filtros").modal("hide");
        }else{            
            Notificacion("La fecha inicial no debe ser mayor a la fecha final", "warning");
            return false;
        }
    }
    if (!$.fn.DataTable.isDataTable('#t_reporte')) {

        dtable = $("#t_reporte").DataTable({
            "ajax": {
                "url": "../controlador/controlador.php",
                "type": "POST",                                
                "data": {
                    accion: 'consultar',
                    fecha_inicio: fecha_inicio,
                    fecha_fin: fecha_fin
                }
            },
            "deferRender": false,
            "bFilter": true,
            "responsive": true,
            "columns": [
                { "data": "id" },
                { "data": "nombre"},
                { "data": "email" },
               // { "data": "tipo_doc",},
                //{ "data": "documento"}, 
                { "data": "titulo"}, 
                { "data": "placa"}, 
                { "data": "modelo"},                
                { "data": "fecha_ini"},
                { "data": "fecha_fin" }
            ],
            "columnDefs": [
                {
                    "targets": 0,
                    "className": "text-center",
                    "data": "",
                    render: function (data, type, row) {
                        cont += 1;
                        return cont;
                    }
                },
            ],            
        });
    }
    else {
        dtable.destroy();
        consultar(elemt);
    }
    $("#consulta").show();
}

function eli_filtro() {
    $("#fecha_inicio").val("");
    $("#fecha_fin").val("");
    $("#estado").val("");
    $("#eli_filtros").hide();
    $("#filtros").show();
    consultar(0);
}

$("#CSV").click(function () {

    fecha_inicio = $("#fecha_inicio").val();
    fecha_fin = $("#fecha_fin").val();    

    var datosTabla = $("#t_reporte tbody tr:first").find("td").html();

    if (datosTabla == "No hay datos disponibles") {
        Notificacion("No se encontro información para exportar CSV", "warning");
        return false;
    }

    window.open("../modelo/reporte_csv.php?fecha_inicio=" + fecha_inicio + "&fecha_fin=" + fecha_fin);
    
});
