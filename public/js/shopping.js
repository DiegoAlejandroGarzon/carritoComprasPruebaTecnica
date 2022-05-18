$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.card-buttonProduct').on('click', function(){
        
        $.ajax({
            "dataSrc":"data",
            type:'POST',
            url:"/addShoppingCar/"+$(this).attr("id"),
            processData:false,
            contentType:false,
            success:function(data){
                if(data.error == 'on'){
                    Swal.fire({
                        icon: 'error',
                        title: data.mensaje,
                        showConfirmButton: true,
                        // timer: 2500
                    })
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: data.mensaje,
                        showConfirmButton: false,
                        timer: 2500
                    })
                }
            },error:function(msj){
                mensajeDeErrores = "";
                var errores = msj.responseJSON.errors;
                for(var error in errores){
                    mensajeDeErrores = mensajeDeErrores+errores[error]+"<br>"
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Revisa el formulario nuevamente',
                    showConfirmButton: true,
                    html: mensajeDeErrores,
                    // timer: 1500
                })
            }
        })
    });
});