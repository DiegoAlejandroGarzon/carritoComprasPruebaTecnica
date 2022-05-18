$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('span').on('click', function(){
        Swal.fire({
            title: 'Eliminando...',
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
            }
        })
        $.ajax({
            type:'POST',
            url:"/deleteProductShoppingCar/"+$(this).attr("id"),
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
                    window.location.reload();
                }
            },error:function(msj){
                Swal.fire({
                    icon: 'error',
                    title: 'Error al eliminar',
                    showConfirmButton: true,
                    // timer: 1500
                })
            }
        })
    })
    
    $('#saveShopping').on('click', function(){
        Swal.fire({
            title: 'Cargando Datos...',
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
            }
        })
        var products = [];
        $(".productShoppingCar").each(function(){
            products.push($(this).attr("name"));
        });
        $.ajax({
            type:'POST',
            url:"/saveShopping",
            data:{"products": products},
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
                    window.location.reload();
                }
            },error:function(msj){
                Swal.fire({
                    icon: 'error',
                    title: 'Error al guardar la compra, Quizás no tiene productos en el carrito',
                    showConfirmButton: true,
                    // timer: 1500
                })
            }
        })
    })
});