var imgCont_edit = 0;
var id_pub = 0;
var precio_tot = 0;
var mod;
var vehiculo;
var imageContainer = [];
$(".box-header").remove();
$(".content-header").remove();

$(document).ready(function () {
  $('[data-toggle="select"]').select2();
  cargar_paginador(1, 8);
  cargar_slider();

  $('#cant_paginas').on('change', function () {
    cargar_paginador(1, this.value);
  });
});

function EjecutarBusqueda(e) {
  cargar_paginador(1, 8);
}


function cargar_slider() {

  $.post('controlador/controlador.php',
    {
      accion: 'slider'
    },
    function (data) {
      data = JSON.parse(data);

      var html_contenido_pag = "";
      var active;
      $("#total_pro").html("");

      if (!$.isEmptyObject(data)) {
        var salto = 5; // porque cada 4 items creo otro row
        for (var i = 1; i <= data.length; i++) {
          active = (i == 1) ? "active" : "";
          /// cierra el row
          if (salto == 0) {
            html_contenido_pag += "</div></div>";
          }
          // crear un row
          if (i == 1 || salto == 0) {
            html_contenido_pag += "<div class='carousel-item " + active + " '><div class='row'>";
            salto = 4;
          }
          // contenido del items              

          html_contenido_pag += '<div class="col-md-3 col-xl-3"><div class="card-box product-box"><div class="imagenes-carrusel"  disabled = " disabled " data-plugins="dropify" data-height="100" data-default-file="assets/images/slider/' + data[i - 1].imagen + '"/></div><p></p><div class="flex-container"></div></div></div>';

          salto = salto - 1;
        }

        // cierro el ultimo row

        $(".carousel-inner").html(html_contenido_pag);
        $('.imagenes-carrusel').dropify({
          tpl: {
            wrap: '<div class="dropify-wrapper"></div>',
            loader: '',
            message: '',
            preview: '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
            filename: '',
            clearButton: '',
            errorLine: '',
            errorsContainer: ''
          }
        });

      }
    }
  );
}

$(document).on("click", "#termino_modal", function () {
  $("#right-modal").modal("show");
});

function cargar_paginador(pagina, tot_pag) {
  var items_por_pagina = tot_pag;
  var numero_pagina = pagina;
  var buscar = $("#txt_buscar").val().trim();
  $("#conte_pagina > div").remove();

  $.post('controlador/controlador.php',
    {
      accion: 'cargar_contenido',
      items_por_pagina: items_por_pagina,
      numero_pagina: numero_pagina,
      buscar: buscar
    },
    function (data) {
      var data = JSON.parse(data);
      var html_paginador = "";
      var html_contenido_pag = "";
      var active, titulo_publi, fecha_publi;

      if (!$.isEmptyObject(data)) {
        var anterior = pagina - 1;
        var siguiente = pagina + 1;

        if (pagina == 1) {
          var disable = "color: currentColor;cursor: not-allowed;opacity: 0.5;";
          var onclick = "";
        } else {
          var disable = "cursor:pointer;";
          var onclick = "onclick='cargar_paginador(" + anterior + "," + items_por_pagina + ")'";
        }

        html_paginador += "<a class='page-link' style='font-size:15px;" + disable + "' " + onclick + " tabindex='-1'>Anterior</a>";

        for (var i = 1; i <= parseInt(data[0].num_paginador); i++) {
          var active = (i == pagina) ? "active" : "";
          html_paginador += "<li class='page-item " + active + "'><a class='page-link' style='font-size:15px; cursor:pointer;' onclick='cargar_paginador(" + i + "," + items_por_pagina + ")' tabindex='-1'>" + i + "</a></li>";
        }
        if (pagina == data[0].num_paginador) {
          var disable_sig = "color: currentColor;cursor: not-allowed;opacity: 0.5;";
          var onclick_sig = "";
        } else {
          var disable_sig = "cursor:pointer;";
          var onclick_sig = "onclick='cargar_paginador(" + siguiente + "," + items_por_pagina + ")'";
        }

        html_paginador += "<a class='page-link' style='font-size:15px;" + disable_sig + "' " + onclick_sig + " tabindex='-1'>Siguiente</a>";

        $("#paginador").html(html_paginador);

        for (var i = 1; i <= data.length; i++) {
          /// cierra el row
          if (i == 5) {
            html_contenido_pag += "</div>";
          }
          // crear un row
          if (i == 1 || i == 5) {
            html_contenido_pag += "<div class='row animate__animated animate__zoomIn' style='padding: 10px;'>";
          }
          // contenido del items           
          titulo_publi = data[i - 1].titulo.substring(0, 20);

          html_contenido_pag += '<div class="col-md-3 col-xl-3"><div class="card-box product-box"><div class="product-action"><a class="btn btn-primary btn-xs waves-effect waves-light" title="Ver detalle" onclick="ver_detalle(' + data[i - 1].id + ');"><i class="fas fa-plus-circle" style="font-size:15px;color:#FFF;"></i></a></div><div class="imagenes-pub"  disabled = " disabled " data-plugins="dropify" data-height="150"   data-default-file="assets/images/publicaciones/' + data[i - 1].imagen + '"/></div><p></p><div class="flex-container"><div style="width: 100%;"><p style="color:black;font-size: 30px;margin-bottom: 0px;text-align:center;" title="' + titulo_publi + '">' + titulo_publi + '</p></div></div><div class="flex-container"><div style="width: 100%;"><p style="font-size: 21px;margin: 0 0 -20px;text-align:center;" class="font-16 mt-0 sp-line-1" ><strong>Modelo:</strong> ' + data[i - 1].modelo + '</p></div></div><div class="flex-container"><div style="width: 100%;margin-top: 25px;"><p style="font-size: 18px;margin-bottom: 2px;text-align: center;">$' + formato_numero(data[i - 1].valor, 0, ',', '.') + '</p></div></div></div></div>';

        }

        // cierro el ultimo row
        html_contenido_pag += "</div>";
        $("#conte_pagina").append(html_contenido_pag);
        $('.imagenes-pub').dropify({
          tpl: {
            wrap: '<div class="dropify-wrapper"></div>',
            loader: '',
            message: '',
            preview: '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
            filename: '',
            clearButton: '',
            errorLine: '',
            errorsContainer: ''
          }
        });
      } else {
        $("#paginador li").remove();
        $("#conte_pagina").append('<div class="text-center"><svg id="Layer_1" class="svg-computer" viewBox="0 0 424.2 424.2"><style>.st0{fill:none;stroke: #000;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}</style><g id="Layer_2"><path class="st0" d="M339.7 289h-323c-2.8 0-5-2.2-5-5V55.5c0-2.8 2.2-5 5-5h323c2.8 0 5 2.2 5 5V284c0 2.7-2.2 5-5 5z"/><path class="st0" d="M26.1 64.9h304.6v189.6H26.1zM137.9 288.5l-3.2 33.5h92.6l-4.4-33M56.1 332.6h244.5l24.3 41.1H34.5zM340.7 373.7s-.6-29.8 35.9-30.2c36.5-.4 35.9 30.2 35.9 30.2h-71.8z"/><path class="st0" d="M114.2 82.8v153.3h147V82.8zM261.2 91.1h-147"/><path class="st0" d="M124.5 105.7h61.8v38.7h-61.8zM196.6 170.2H249v51.7h-52.4zM196.6 105.7H249M196.6 118.6H249M196.6 131.5H249M196.6 144.4H249M124.5 157.3H249M124.5 170.2h62.2M124.5 183.2h62.2M124.5 196.1h62.2M124.5 209h62.2M124.5 221.9h62.2"/></g></svg><h3 class="mt-4 text">No se encontrarón resultados en la busqueda</h3></div> <!-- end row-->    </div> <!-- end /.text-center-->');
      }
    }
  );

}

function ver_detalle(id) {

  $("#modal_detalle").modal("show");
  $("#color2").val("#fffff");
  $("#txt_cantidades").val(1);
  $("#nombre_producto").html("");
  $("#precio_producto").html("0");
  $("#marca").html("");
  id_pub = id;

  $.post('controlador/controlador.php',
    {
      accion: 'obtener_datos',
      id: id
    },
    function (data) {
      data = JSON.parse(data);
      $("#imgLarge-edit img").remove();
      $("#imgLarge-modal img").remove();
      $("#id_update-modal").val(data.id);
      precio_tot = data.valor;
      vehiculo = data.titulo;
      mod = data.modelo;
      $("#nombre_producto").html(data.titulo);
      $("#precio_producto").html("$ " + formato_numero(data.valor, 0, ',', '.'));
      $("#marca").html("<h5 class='mb-3 product-brand'>Placa: <span class='strong-none'>" + data.placa + "</span></h5>");
      $("#atributos").html("<h5 class='mb-3 product-brand'>Modelo: <span class='strong-none'>" + data.modelo + "</span></h5>");
      $("#color2").val(data.color);
      cargar_imagenes(data.id);
    });

}

function cargar_imagenes(id) {

  $(".gallery-body-modal").remove();
  $(".gallerySlide-modal").remove();
  imgCont_edit = 0;

  $.post('controlador/controlador.php',
    {
      accion: 'cargar_imagenes',
      id: id
    },
    function (data) {
      data = JSON.parse(data);
      $.each(data, function (index, row) {
        imgCont_edit++;
        var imgSmall = $('<div class="gallery-body-modal">  <img src="assets/images/publicaciones/' + row.imagen + '" class="img-fluid  avatar-md rounded  selectImg-modal selectImg-opacityx selectImg-hover-opacity-off" onclick="currentDiv_modal(' + imgCont_edit + ')" style="width:100%;height:100%;border: 2px solid #000;border-radius: 10px; cursor:pointer;"></div>');

        if (imgCont_edit == 1) {
          var imgLarge = $('<div class="image-preview-edit gallerySlide-modal" style="display: block;background: none;"><img src="assets/images/publicaciones/' + row.imagen + '" id="foto_producto"> <div class="imagenes-cargadas" disabled = " disabled " data-plugins="dropify" data-height="350" data-default-file="assets/images/publicaciones/' + row.imagen + '" /></div></div>');
          $("#not_img_edit").hide();
        } else {
          var imgLarge = $('<div class="image-preview-edit gallerySlide-modal" style="display: none;background: none;"><div class="imagenes-cargadas"  disabled = " disabled " data-plugins="dropify" data-height="350" data-default-file="assets/images/publicaciones/' + row.imagen + '" /></div>');
          $("#not_img_edit").hide();
        }

        $(imgSmall).insertBefore("#add-photo-container-modal");
        $(imgLarge).insertBefore("#imgLarge-modal");
        $("#foto_producto").hide();
        $('.imagenes-cargadas').dropify({
          tpl: {
            wrap: '<div class="dropify-wrapper"></div>',
            loader: '',
            message: '',
            preview: '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
            filename: '',
            clearButton: '',
            errorLine: '',
            errorsContainer: ''
          }
        });
        $("#not_img_edit").hide();
      });
    });
}

function currentDiv_modal(n) {
  showDivs_modal(slideIndex = n);
}

function showDivs_modal(n) {
  var i;
  var x = document.getElementsByClassName("gallerySlide-modal");
  var dots = document.getElementsByClassName("selectImg-modal");
  if (n > x.length) { slideIndex = 1 }
  if (n < 1) { slideIndex = x.length }
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" selectImg-opacity-off", "");
  }
  x[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " selectImg-opacity-off";
}

function form_car() {
  $("#form_guardar")[0].reset();
  $("#modal_form").modal("show");
  $("#t_doc").val("").trigger('change');
  $("#t_pago").val("").trigger('change');
  $("#vehiculo").val(vehiculo);
  $("#mod").val(mod);
  $("#id_item").html(id_pub);

  $(".fecha_prod").datepicker({
    firstDay: 1,
    defaultDate: "+2m",
    format: "yyyy-mm-dd",
    language: 'es',
    todayBtn: true,
    autoclose: true,
    startDate: '-0d',
  }).datepicker("setDate", null);

  $("#f_fin_prod").change(function () {

    var f_ini = $("#f_ini_prod").val();
    var f_fin = $("#f_fin_prod").val();

    fechaini = new Date(f_ini);
    fechafin = new Date(f_fin);
    dias = fechafin.getTime() - fechaini.getTime();
    diasDif = Math.round(dias / (1000 * 60 * 60 * 24));
    valor_f = precio_tot * diasDif;

    if (diasDif == 0) {
      $("#precio_tot").val(formato_numero(precio_tot, 0, ',', '.'));
    } else if (diasDif < 0) {
      $("#precio_tot").val(0);
      toastr.warning("La fecha de inicio no puede ser mayor a la fecha final", "Advertencia", {
        progressBar: true,
        closeButton: true,
        newestOnTop: true,
        preventDuplicates: true
      });
    } else {
      $("#precio_tot").val(formato_numero(valor_f, 0, ',', '.'));
    }
  });
}


function guardar_form() {
  var nombre = $("#nombre").val();
  var apellido = $("#apellido").val();
  var email = $("#email").val();
  var t_doc = $("#t_doc").val();
  var documento = $("#documento").val();
  var t_pago = $("#t_pago").val();
  var f_ini_prod = $("#f_ini_prod").val();
  var f_fin_prod = $("#f_fin_prod").val();
  var accion = "guardar_form";

  if (nombre == "") {
    toastr.warning("El nombre es obligatorio", "Advertencia", {
      progressBar: true,
      closeButton: true,
      newestOnTop: true,
      preventDuplicates: true
    });
    return false;
  }
  if (apellido == "") {
    toastr.warning("El apellido es obligatorio", "Advertencia", {
      progressBar: true,
      closeButton: true,
      newestOnTop: true,
      preventDuplicates: true
    });
    return false;
  }

  if (email == "") {
    toastr.warning("El  correo electrónico es obligatorio", "Advertencia", {
      progressBar: true,
      closeButton: true,
      newestOnTop: true,
      preventDuplicates: true
    });
    return false;
  }
  if (!isValidEmailAddress(email)) {
    toastr.warning("El correo electrónico no es validoo", "Advertencia", {
      progressBar: true,
      closeButton: true,
      newestOnTop: true,
      preventDuplicates: true
    });
    return false;
  }
  if (t_doc == "") {
    toastr.warning("El tipo de documento es obligatorio", "Advertencia", {
      progressBar: true,
      closeButton: true,
      newestOnTop: true,
      preventDuplicates: true
    });
    return false;
  }
  if (documento == "") {
    toastr.warning("El N° de documento es obligatorio", "Advertencia", {
      progressBar: true,
      closeButton: true,
      newestOnTop: true,
      preventDuplicates: true
    });
    return false;
  }
  if (t_pago == "") {
    toastr.warning("El tipo de pago es obligatorio", "Advertencia", {
      progressBar: true,
      closeButton: true,
      newestOnTop: true,
      preventDuplicates: true
    });
    return false;
  }
  if (f_ini_prod == "") {
    toastr.warning("La fecha de inicio es obligatoria", "Advertencia", {
      progressBar: true,
      closeButton: true,
      newestOnTop: true,
      preventDuplicates: true
    });
    return false;
  }
  if (f_fin_prod == "") {
    toastr.warning("La fecha final es obligatoria", "Advertencia", {
      progressBar: true,
      closeButton: true,
      newestOnTop: true,
      preventDuplicates: true
    });
    return false;
  }
  if (f_ini_prod > f_fin_prod) {
    toastr.warning("La fecha de inicio no puede ser mayor a la fecha final", "Advertencia", {
      progressBar: true,
      closeButton: true,
      newestOnTop: true,
      preventDuplicates: true
    });
    return false;
  }

  $.ajax({
    type: "POST",
    url: 'controlador/controlador.php',
    data: ('id_pub=' + id_pub +
      '&nombre=' + nombre +
      '&apellido=' + apellido +
      '&email=' + email +
      '&t_doc=' + t_doc +
      '&documento=' + documento +
      '&t_pago=' + t_pago +
      '&f_ini_prod=' + f_ini_prod +
      '&f_fin_prod=' + f_fin_prod +
      '&accion=' + accion + ' '),
    cache: false,
    success: function (resp) {
      if (resp == "0") {
        $("#btn_save").prop("disabled", false);
        toastr.success("Se ha enviado la solicitud correctamente", "Éxito", {
          progressBar: true,
          closeButton: true,
          newestOnTop: true,
          preventDuplicates: true
        });
        $("#modal_form").modal("hide");
        $("#modal_detalle").modal("hide");
        return false;
      } else {
        toastr.error("Ha ocurrido un error al enviar la solicitud", "Error", {
          progressBar: true,
          closeButton: true,
          newestOnTop: true,
          preventDuplicates: true
        });
        return false;
      }
    }
  });
}

function login() {
  var user = $("#user").val();
  var password = $("#password").val();
  var accion = "login";

  $.ajax({
    type: "POST",
    url: 'controlador/controlador.php',
    data: ('user=' + user +
      '&password=' + password +
      '&accion=' + accion + ' '),
    cache: false,
    success: function (resp) {
      if (resp == "0") {
        location.href = "vista/cpanel.php";
        $("#modal_login").modal("hide");
        return false;
      } else {
        toastr.error("Ha ocurrido un error al iniciar sesión", "Error", {
          progressBar: true,
          closeButton: true,
          newestOnTop: true,
          preventDuplicates: true
        });
        return false;
      }
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

function soloNum(input) {

  var num = input.value.replace(/\./g, '');
  if (!isNaN(num)) {
    num = num.split('').join('').replace(/^[\.]/, '');
    input.value = num;
  } else {
    input.value = input.value.replace(/[^\d\.]*/g, '');
  }
}

function soloLetras(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toLowerCase();
  letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
  especiales = [8, 37, 39, 46];

  tecla_especial = false
  for (var i in especiales) {
    if (key == especiales[i]) {
      tecla_especial = true;
      break;
    }
  }

  if (letras.indexOf(tecla) == -1 && !tecla_especial)
    return false;
}

function isValidEmailAddress(emailAddress) {
  var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
  return pattern.test(emailAddress);
}