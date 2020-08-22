$(document).ready(function () {

    cargar_tabla();

    $("#btn_crear").click(function (e) {
        $("#modal_crear").modal("show");
        $("#form_guardar")[0].reset();
        $(".dropify-wrapper").show();
        $(".dropify-wrapper").remove();
        $(".principal").remove();
        $("#eli_img1").remove();
        $("#eli_img2").remove();
        $("#eli_img3").remove();
        $("#eli_img4").remove();
        $(".dropify-preview").css("display", "none");
        $(".gallery-body").remove();
        $(".gallerySlide").remove();
        cargar_input_img();
        $("#eli_img1").hide();
        $("#eli_img2").hide();
        $("#eli_img3").hide();
        $("#eli_img4").hide();
    });
})

function cargar_input_img() {
    var img_1 = '<input type="file" data-plugins="dropify" data-height="150" id="imagen1" name="imagen1" accept="image/*"/><p class="text-muted text-center mt-2 mb-0 principal"><b>Principal</b></p>';

    var img_2 = '<input type="file" data-plugins="dropify" data-height="150" id="imagen2" name="imagen2" accept="image/*"/>';

    var img_3 = '<input type="file" data-plugins="dropify" data-height="150" id="imagen3" name="imagen3" accept="image/*"/>';

    var img_4 = '<input type="file" data-plugins="dropify" data-height="150" id="imagen4" name="imagen4" accept="image/*"/>';

    $(img_1).insertBefore("#img_ini1");
    $(img_2).insertBefore("#img_ini2");
    $(img_3).insertBefore("#img_ini3");
    $(img_4).insertBefore("#img_ini4");

    $('#imagen1').dropify({
        messages: {
            'default': '',
            'replace': 'Click para remplazar',
            'remove':  'Eliminar',
            'error': 'Ooops, something wrong happended.'
        }
    });

    $('#imagen2').dropify({
        messages: {
            'default': '',
            'replace': 'Click para remplazar',
            'remove':  'Eliminar',
            'error': 'Ooops, something wrong happended.'
        }
    });

    $('#imagen3').dropify({
        messages: {
            'default': '',
            'replace': 'Click para remplazar',
            'remove':  'Eliminar',
            'error': 'Ooops, something wrong happended.'
        }
    });

    $('#imagen4').dropify({
        messages: {
            'default': '',
            'replace': 'Click para remplazar',
            'remove':  'Eliminar',
            'error': 'Ooops, something wrong happended.'
        }
    });
}

function cargar_tabla() {
    var contador = 0;

    if (!$.fn.DataTable.isDataTable("#tbl_producto")) {
        dtable = $("#tbl_producto").DataTable({
            "responsive": true,
            "deferRender": false,
            "bFilter": true,
            "ajax": {
                "type": "POST",
                "url": "../controlador/controlador.php",
                "data": {
                    accion: 'cargar_tabla'
                },
            },
            "columns": [
                { data: 'id' },
                { data: 'id' },
                { data: 'titulo' },
                { data: 'modelo', className: "text-center" },
                { data: 'placa', className: "text-center" },
                { data: 'anio' },
                { data: 'valor' },
                { data: 'disponibilidad' },
            ],
            "columnDefs": [
                {
                    "targets": 0,
                    "className": "text-center",
                    "data": "",
                    render: function (data, type, row) {
                        contador += 1;
                        return contador;
                    }
                },
                {
                    "targets": [1],
                    "data": "imagen",
                    "render": function (data, type, row) {
                        return '<img src="../assets/images/publicaciones/' + row.imagen + '"  class="img-thumbnail" width="107" height="89"  style="width:107px; height:89px;"/>';
                    }
                },
                {
                    "targets": [7],
                    "data": { disponibilidad: 'disponibilidad', id: 'id' },
                    "render": function (data, type, row) {
                        if (row.disponibilidad == "0") {
                            return "<div style='background: #f1556c; color:#FFF; border-radius: 10px; text-align: center;width: 100px;'>Inactiva</div>";
                        } else {
                            return "<div style='background: #1ABC9C;color:#FFF;border-radius: 10px; text-align: center;width: 100px;'>Activa</div>";
                        }
                    }
                },

                {
                    "targets": [8],
                    "data": "id",
                    "className": "td_defecto",
                    "render": function (data, type, row) {
                        if (row.disponibilidad == 0) {
                            return '<div class="btn-group dropdown"><a href="javascript: void(0);" class="table-action-btn arrow-none btn btn-light btn-sm bg-dark" data-toggle="dropdown" aria-expanded="false" style="color:#FFF;"><i class="mdi mdi-dots-horizontal"></i></a><div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#" onclick="obtener_datos(' + row.id + ')"><i class="far fa-edit mr-2 text-muted font-18 vertical-middle"></i>Editar</a><a class="dropdown-item" href="#" onclick="cambiar_estado(' + row.id + ', ' + row.disponibilidad + ', this);"><i class="fas fa-check-circle desDeta mr-2 text-muted font-18 vertical-middle"></i>Activar</a><a class="dropdown-item" href="#" onclick="eliminar(' + row.id + ')"><i class=" fas fa-trash-alt mr-2 text-muted font-18 vertical-middle"></i>Eliminar</a></div></div>';
                        } else {
                            return '<div class="btn-group dropdown"><a href="javascript: void(0);" class="table-action-btn arrow-none btn btn-light btn-sm bg-dark" data-toggle="dropdown" aria-expanded="false" style="color:#FFF;"><i class="mdi mdi-dots-horizontal"></i></a><div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#" onclick="obtener_datos(' + row.id + ')"><i class="far fa-edit mr-2 text-muted font-18 vertical-middle"></i>Editar</a><a class="dropdown-item" href="#" onclick="cambiar_estado(' + row.id + ', ' + row.disponibilidad + ', this);"><i class="fas fa-minus-circle desDeta mr-2 text-muted font-18 vertical-middle"></i>Inactivar</a><a class="dropdown-item" href="#" onclick="eliminar(' + row.id + ')"><i class=" fas fa-trash-alt mr-2 text-muted font-18 vertical-middle"></i>Eliminar</a></div></div>';
                        }
                    }
                }]
        });
    } else {
        dtable.destroy();
        cargar_tabla();
    }
    $("#consulta").show();
}

function cambiar_estado(id, estado, elemento) {

    bsd.confirm('¿Esta seguro que desea cambiar el estado?', function (confirmed) {
        if (confirmed) {
            estado = (estado == "1") ? "0" : "1";

            $.post("../controlador/controlador.php", {
                accion: "cambiar_estado",
                id: id,
                estado: estado
            }, function (data, textStatus) {
                if (data == 1) {
                    toastr.error("Ha ocurrido un error al modificar el estado", "Error", {
                        progressBar: true,
                        closeButton: true,
                        newestOnTop: true,
                        preventDuplicates: true
                    });
                } else {
                    toastr.success("El estado se ha modificado correctamente", "Éxito", {
                        progressBar: true,
                        closeButton: true,
                        newestOnTop: true,
                        preventDuplicates: true
                    });
                    $(elemento).attr("onclick", "cambiar_estado(" + id + ", " + estado + ", this);");
                    cargar_tabla();
                    if (estado == "1") {
                        $(elemento).attr("css", "style='background: #69E4A6;border-radius: 13px; padding: 3px;text-align: center;width: 100px;cursor:pointer;")
                    } else {
                        $(elemento).attr("css", "style='background: #FF7285;border-radius: 13px; padding: 3px;text-align: center;width: 100px;cursor:pointer;")
                    }
                }
            });
        }
    });
}

function eliminar(id) {

    bsd.confirm('¿Esta seguro que desea eliminar el vehiculo publicado?', function (confirmed) {
        if (confirmed) {

            $.post("../controlador/controlador.php", {
                accion: "eliminar",
                id: id
            }, function (data, textStatus) {
                if (data == 1) {
                    toastr.error("Ha ocurrido un error al eliminar el vehiculo", "Error", {
                        progressBar: true,
                        closeButton: true,
                        newestOnTop: true,
                        preventDuplicates: true
                    });
                } else {
                    toastr.success("El estado se ha eliminado correctamente", "Éxito", {
                        progressBar: true,
                        closeButton: true,
                        newestOnTop: true,
                        preventDuplicates: true
                    });
                    cargar_tabla();
                }
            });
        }
    });
}

function guardar_datos() {

    var imagen1 = $('#imagen1')[0].files;
    var imagen2 = $('#imagen2')[0].files;
    var imagen3 = $('#imagen3')[0].files;
    var imagen4 = $('#imagen4')[0].files;
    var titulo = $("#titulo").val();
    var placa = $("#placa").val();
    var modelo = $("#modelo").val();
    var valor = $("#valor").val().replace(/\D/g, '');
    var anio = $("#anio").val();
    var color = $("#color").val();
    var accion = "guardar_datos";
    var data = new FormData();

    if (imagen1.length > 0) {
        data.append('imagen1', imagen1[0]);
    } else {
        toastr.warning("La imagen principal es obligatoria", "Advertencia", {
            progressBar: true,
            closeButton: true,
            newestOnTop: true,
            preventDuplicates: true
        });
        return false;
    }

    if (imagen2.length > 0) {
        data.append('imagen2', imagen2[0]);
    } if (imagen3.length > 0) {
        data.append('imagen3', imagen3[0]);
    } if (imagen4.length > 0) {
        data.append('imagen4', imagen4[0]);
    }

    if (titulo == "") {
        toastr.warning("El titulo es obligatorio", "Advertencia", {
            progressBar: true,
            closeButton: true,
            newestOnTop: true,
            preventDuplicates: true
        });
        return false;
    }
    if (placa == "") {
        toastr.warning("La placa es obligatoria", "Advertencia", {
            progressBar: true,
            closeButton: true,
            newestOnTop: true,
            preventDuplicates: true
        });
        return false;
    }
    if (modelo == "") {
        toastr.warning("El modelo es obligatorio", "Advertencia", {
            progressBar: true,
            closeButton: true,
            newestOnTop: true,
            preventDuplicates: true
        });
        return false;
    }
    if (valor == "") {
        toastr.warning("El valor es obligatorio", "Advertencia", {
            progressBar: true,
            closeButton: true,
            newestOnTop: true,
            preventDuplicates: true
        });
        return false;
    }
    if (anio == "") {
        toastr.warning("El año es obligatorio", "Advertencia", {
            progressBar: true,
            closeButton: true,
            newestOnTop: true,
            preventDuplicates: true
        });
        return false;
    }
    data.append('titulo', titulo);
    data.append('placa', placa);
    data.append('modelo', modelo);
    data.append('valor', valor);
    data.append('anio', anio);
    data.append('color', color);
    data.append('accion', accion);

    $.ajax({
        url: "../controlador/controlador.php",
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        statusCode: {
            200: function (resp) {
                if (resp == "0") {
                    $("#btn_guardar").prop("disabled", false);
                    toastr.success("Se ha creado la publicación correctamente", "Éxito", {
                        progressBar: true,
                        closeButton: true,
                        newestOnTop: true,
                        preventDuplicates: true
                    });
                    cargar_tabla();
                    $("#modal_crear").modal("hide");
                } else {
                    $("#btn_guardar").prop("disabled", false);
                    toastr.error("Ha ocurrido un error al crear la publicación", "Error", {
                        progressBar: true,
                        closeButton: true,
                        newestOnTop: true,
                        preventDuplicates: true
                    });
                    return false;
                }
            },
        }
    });

}

function obtener_datos(id) {
    $("#modal_editar").modal("show");
    $.post('../controlador/controlador.php',
        {
            accion: 'obtener_datos',
            id: id
        },
        function (data) {
            data = JSON.parse(data);
            $("#id_update").val(data.id);
            $("#titulo_edit").val(data.titulo);
            $("#placa_edit").val(data.placa);
            $("#modelo_edit").val(data.modelo);
            $("#valor_edit").val(formato_numero(data.valor, 0, ',', '.'));
            $("#anio_edit").val(data.anio);
            $("#color_edit").val(data.color);
            cargar_imagenes(id)
        });
}

function cargar_imagenes(id) {
    $(".gallery-body-edit").remove();
    $(".gallerySlide-edit").remove();
    $(".dropify-wrapper").remove();
    $(".eli_img1").remove();
    $(".principal").remove();

    id_pub = id;
    imgCont_edit = 0;
    $.post('../controlador/controlador.php',
        {
            accion: 'cargar_imagenes',
            id: id
        },
        function (data) {
            data = JSON.parse(data);
            if (data.length == 1) {
                var img1 = '<input type="file" data-plugins="dropify" data-show-remove="false" data-height="150" id="imagen1_edit" data-default-file="../assets/images/publicaciones/' + data[0].imagen + '" name="imagen1_edit" accept="image/*"/><p class="text-muted text-center mt-2 mb-0 principal"><b>Principal</b></p>';

                var img2 = '<input type="file" data-plugins="dropify" data-show-remove="false" class="subir_img" data-height="150" id="imagen2_edit" name="imagen2_edit" accept="image/*"/>';

                var img3 = '<input type="file" data-plugins="dropify" data-show-remove="false" class="subir_img" data-height="150" id="imagen3_edit" name="imagen3_edit" accept="image/*"/>';

                var img4 = '<input type="file" data-plugins="dropify" data-show-remove="false" class="subir_img" data-height="150" id="imagen4_edit" name="imagen4_edit" accept="image/*"/>';
            }


            if (data.length == 2) {
                var img1 = '<input type="file" data-plugins="dropify" data-show-remove="false" data-height="150" id="imagen1_edit" data-default-file="../assets/images/publicaciones/' + data[0].imagen + '" name="imagen1_edit"  accept="image/*"/><p class="text-muted text-center mt-2 mb-0 principal"><b>Principal</b>';

                var img2 = '<input type="file" data-plugins="dropify" data-show-remove="false" data-height="150" id="imagen2_edit" data-default-file="../assets/images/publicaciones/' + data[1].imagen + '" name="imagen2_edit"  disabled = " disabled " accept="image/*"/><figcaption style="text-align:right;" class="eli_img1" onclick="eliminar_img(' + data[1].id + ',' + id + ',0,0,0)"> <i class="fas fa-times"  style="cursor:pointer;font-size: 20px;position: absolute;margin-top: -160px;z-index: 999;margin-left: -23px;border: 2px solid;padding: 2px;border-radius: 5px;  opacity: 0.5;" title="Eliminar imagen"></i> </figcaption>';

                var img3 = '<input type="file" data-plugins="dropify" data-show-remove="false" class="subir_img" data-height="150" id="imagen3_edit" name="imagen3_edit" accept="image/*"/>';

                var img4 = '<input type="file" data-plugins="dropify" data-show-remove="false" class="subir_img" data-height="150" id="imagen4_edit" name="imagen4_edit" accept="image/*"/>';
            }

            if (data.length == 3) {
                var img1 = '<input type="file" data-plugins="dropify" data-show-remove="false" data-height="150" id="imagen1_edit" data-default-file="../assets/images/publicaciones/' + data[0].imagen + '" name="imagen1_edit" accept="image/*"/><p class="text-muted text-center mt-2 mb-0 principal" ><b>Principal</b></p>';

                var img2 = '<input type="file" data-plugins="dropify" data-show-remove="false" data-height="150" id="imagen2_edit" data-default-file="../assets/images/publicaciones/' + data[1].imagen + '" name="imagen2_edit"  disabled = " disabled " accept="image/*"/><figcaption style="text-align:right;" class="eli_img1" onclick="eliminar_img(' + data[1].id + ',' + id + ',' + data[2].id + ',1,0)"> <i class="fas fa-times"  style="cursor:pointer;font-size: 20px;position: absolute;margin-top: -160px;z-index: 999;margin-left: -23px;border: 2px solid;padding: 2px;border-radius: 5px;  opacity: 0.5;" title="Eliminar imagen"></i> </figcaption>';

                var img3 = '<input type="file" data-plugins="dropify" data-show-remove="false" data-height="150" id="imagen3_edit" data-default-file="../assets/images/publicaciones/' + data[2].imagen + '" name="imagen3_edit"  disabled = " disabled " accept="image/*"/><figcaption style="text-align:right;" class="eli_img1" onclick="eliminar_img(' + data[2].id + ',' + id + ',0,0,0)"> <i class="fas fa-times"  style="cursor:pointer;font-size: 20px;position: absolute;margin-top: -160px;z-index: 999;margin-left: -23px;border: 2px solid;padding: 2px;border-radius: 5px;  opacity: 0.5;" title="Eliminar imagen"></i> </figcaption>';

                var img4 = '<input type="file" data-plugins="dropify" data-show-remove="false" class="subir_img" data-height="150" id="imagen4_edit" name="imagen4_edit" accept="image/*"/>';
            }

            if (data.length == 4) {
                var img1 = '<input type="file" data-plugins="dropify" data-show-remove="false" data-height="150" id="imagen1_edit" data-default-file="../assets/images/publicaciones/' + data[0].imagen + '" name="imagen1_edit"  accept="image/*"/><p class="text-muted text-center mt-2 mb-0 principal"><b>Principal</b></p>';

                var img2 = '<input type="file" data-plugins="dropify" data-show-remove="false" data-height="150" id="imagen2_edit" data-default-file="../assets/images/publicaciones/' + data[1].imagen + '" name="imagen2_edit"  disabled = " disabled " accept="image/*"/><figcaption style="text-align:right;" class="eli_img1" onclick="eliminar_img(' + data[1].id + ',' + id + ',' + data[2].id + ',2,' + data[3].id + ')"> <i class="fas fa-times"  style="cursor:pointer;font-size: 20px;position: absolute;margin-top: -160px;z-index: 999;margin-left: -23px;border: 2px solid;padding: 2px;border-radius: 5px;  opacity: 0.5;" title="Eliminar imagen"></i> </figcaption>';

                var img3 = '<input type="file" data-plugins="dropify" data-show-remove="false" data-height="150" id="imagen3_edit" data-default-file="../assets/images/publicaciones/' + data[2].imagen + '" name="imagen3_edit"  disabled = " disabled " accept="image/*"/><figcaption style="text-align:right;" class="eli_img1" onclick="eliminar_img(' + data[2].id + ',' + id + ',' + data[3].id + ',3,0)"> <i class="fas fa-times"  style="cursor:pointer;font-size: 20px;position: absolute;margin-top: -160px;z-index: 999;margin-left: -23px;border: 2px solid;padding: 2px;border-radius: 5px;  opacity: 0.5;" title="Eliminar imagen"></i> </figcaption>';

                var img4 = '<input type="file" data-plugins="dropify" data-show-remove="false" data-height="150" id="imagen4_edit" data-default-file="../assets/images/publicaciones/' + data[3].imagen + '" name="imagen4_edit"  disabled = " disabled " accept="image/*"/><figcaption style="text-align:right;" class="eli_img1" onclick="eliminar_img(' + data[3].id + ',' + id + ',0,0,0)"> <i class="fas fa-times"  style="cursor:pointer;font-size: 20px;position: absolute;margin-top: -160px;z-index: 999;margin-left: -23px;border: 2px solid;padding: 2px;border-radius: 5px;  opacity: 0.5;" title="Eliminar imagen"></i> </figcaption>';
            }

            $(img1).insertBefore("#img_edit1");
            $(img2).insertBefore("#img_edit2");
            $(img3).insertBefore("#img_edit3");
            $(img4).insertBefore("#img_edit4");
            $('#imagen1_edit').dropify({
                messages: {
                    'default': '',
                    'replace': 'Click para remplazar',
                    'error': 'Ooops, something wrong happended.'
                }
            });
            $('#imagen2_edit').dropify({
                messages: {
                    'default': '',
                    'remove': 'Eliminar',
                    'replace': 'Click para remplazar',
                    'error': 'Ooops, something wrong happended.'
                }
            });
            $('#imagen3_edit').dropify({
                messages: {
                    'default': '',
                    'replace': 'Click para remplazar',
                    'remove': 'Eliminar',
                    'error': 'Ooops, something wrong happended.'
                }
            });
            $('#imagen4_edit').dropify({
                messages: {
                    'default': '',
                    'replace': 'Click para remplazar',
                    'remove': 'Eliminar',
                    'error': 'Ooops, something wrong happended.'
                }
            });
        });
}

function eliminar_img(id, id_publicacion, id_img, eli_img, id_img2) {
    $.post('../controlador/controlador.php',
        {
            accion: 'eliminar_img',
            id: id,
            eli_img: eli_img,
            id_img: id_img,
            id_img2: id_img2
        }, function (data, textStatus) {
            if (data == 1) {
                toastr.error("La imagen no se ha podido eliminar", "Error", {
                    progressBar: true,
                    closeButton: true,
                    newestOnTop: true,
                    preventDuplicates: true
                });
            } else {
                toastr.success("La imagen se elimino correctamente", "Éxito", {
                    progressBar: true,
                    closeButton: true,
                    newestOnTop: true,
                    preventDuplicates: true
                });
                cargar_imagenes(id_publicacion);
            }
        });
}

$(document).on("change", ".subir_img", function () {

    var imagen2_edit = $("#imagen2_edit")[0].files;
    var imagen3_edit = $("#imagen3_edit")[0].files;
    var imagen4_edit = $("#imagen4_edit")[0].files;
    var accion = "subir_img";
    var data = new FormData();

    if (imagen2_edit.length > 0) {
        data.append('imagen2_edit', imagen2_edit[0]);
    } if (imagen3_edit.length > 0) {
        data.append('imagen3_edit', imagen3_edit[0]);
    } if (imagen4_edit.length > 0) {
        data.append('imagen4_edit', imagen4_edit[0]);
    }
    data.append('id_pub', id_pub);
    data.append('accion', accion);

    $.ajax({
        url: "../controlador/controlador.php",
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
        },
        statusCode: {
            200: function (resp) {
                if (resp == "0") {
                    cargar_imagenes(id_pub);
                }
            },
        }
    });
});

function editar_datos() {

    var id_update = $("#id_update").val();
    var imagen1_edit = $("#imagen1_edit")[0].files;
    var titulo = $("#titulo_edit").val();
    var placa = $("#placa_edit").val();
    var modelo = $("#modelo_edit").val();
    var valor = $("#valor_edit").val().replace(/\D/g, '');
    var anio = $("#anio_edit").val();
    var color = $("#color_edit").val();
    var accion = "editar_datos";
    var data = new FormData();

    if (titulo == "") {
        toastr.warning("El titulo es obligatorio", "Advertencia", {
            progressBar: true,
            closeButton: true,
            newestOnTop: true,
            preventDuplicates: true
        });
        return false;
    }
    if (placa == "") {
        toastr.warning("La placa es obligatoria", "Advertencia", {
            progressBar: true,
            closeButton: true,
            newestOnTop: true,
            preventDuplicates: true
        });
        return false;
    }
    if (modelo == "") {
        toastr.warning("El modelo es obligatorio", "Advertencia", {
            progressBar: true,
            closeButton: true,
            newestOnTop: true,
            preventDuplicates: true
        });
        return false;
    }
    if (valor == "") {
        toastr.warning("El valor es obligatorio", "Advertencia", {
            progressBar: true,
            closeButton: true,
            newestOnTop: true,
            preventDuplicates: true
        });
        return false;
    }
    if (anio == "") {
        toastr.warning("El año es obligatorio", "Advertencia", {
            progressBar: true,
            closeButton: true,
            newestOnTop: true,
            preventDuplicates: true
        });
        return false;
    }
    if (imagen1_edit.length > 0) {
        data.append('imagen1_edit', imagen1_edit[0]);
    }
    data.append('id_update', id_update);
    data.append('titulo', titulo);
    data.append('placa', placa);
    data.append('modelo', modelo);
    data.append('valor', valor);
    data.append('anio', anio);
    data.append('color', color);
    data.append('accion', accion);

    $.ajax({
        url: "../controlador/controlador.php",
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        statusCode: {
            200: function (resp) {
                if (resp == "0") {
                    $("#btn_editar").prop("disabled", false);
                    toastr.success("Se ha editado la publicación correctamente", "Éxito", {
                        progressBar: true,
                        closeButton: true,
                        newestOnTop: true,
                        preventDuplicates: true
                    });
                    cargar_tabla();
                    $("#modal_editar").modal("hide");
                } else {
                    $("#btn_editar").prop("disabled", false);
                    toastr.error("Ha ocurrido un error al editar la publicación", "Error", {
                        progressBar: true,
                        closeButton: true,
                        newestOnTop: true,
                        preventDuplicates: true
                    });
                    return false;
                }
            },
        }
    });

}

function formato_numero(numero, decimales, separador_decimal, separador_miles) {

    numero = parseFloat(numero);
    if (isNaN(numero)) {
        return '';
    }
    if (decimales !== undefined) {
        numero = numero.toFixed(decimales);
    }
    numero = numero.toString().replace('.', separador_decimal !== undefined ? separador_decimal : ',');
    if (separador_miles) {
        var miles = new RegExp('(-?[0-9]+)([0-9]{3})');
        while (miles.test(numero)) {
            numero = numero.replace(miles, '$1' + separador_miles + '$2');
        }
    }
    return numero;

}

function formato(input) {

    var num = input.value.replace(/\./g, '');
    if (!isNaN(num)) {
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/, '');
        input.value = num;
    } else {
        input.value = input.value.replace(/[^\d\.]*/g, '');
    }
}


function soloNum(input) {

    var num = input.value.replace(/\./g, '');
    if (!isNaN(num)) {
        num = num.split('').join('').replace(/^[\.]/, '');
        input.value = num;
    } else {
        input.value = input.value.replace(/[^\d\.]*/g, '');
    }
}