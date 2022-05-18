$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#saveUser').on('click', function(){
        Swal.fire({
            title: 'Cargando datos...',
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
            }
        })
        datas = new FormData();
        datas.append("name",$("input[name=name]").val());
        datas.append("email",$("input[name=email]").val());
        datas.append("password",$("input[name=password]").val());
        datas.append("role",$("select[name=role]").val());
        $.ajax({
            "dataSrc":"data",
            type:'POST',
            url:"/createUser",
            data:datas,
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
                    tablaUsuarios.ajax.reload();
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
    })

    var tablaUsuarios = $('#tablaUsuarios').DataTable({
        responsive: false,        
        "ajax":"/usersList",
        "columns":[
            {'defaultContent':''},
            {data:'name'},
            {data:'role'},
            {data:'email'},
            {'defaultContent' :'<center><button type="button" class="edit btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit"><i class="fas fa-edit"></i></button><button type="button" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></center>'},
        ],
    });
    tablaUsuarios.on('order.dt search.dt', function () {
        tablaUsuarios.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            tablaUsuarios.cell(cell).invalidate('dom');
        });
    }).draw();

    $('#tablaUsuarios tbody').on('click','button.edit', function(e){
        //var usuarionEditar = tablaUsuario.row($(this)).data().id;
        var registro = tablaUsuarios.row(($(this)).parents("tr")).data();
        console.log(registro);
        $('#idUser').val(registro.id);
        $('#nameEdit').val(registro.name);
        $('#emailEdit').val(registro.email);
        $('#roleEdit').val(registro.role);
        $('#roleActualEdit').val(registro.role);
    })
    
    $('#saveEditUser').on('click', function(){
        Swal.fire({
            title: 'Cargando datos...',
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
            }
        })
        datas = new FormData();
        datas.append("idUser",$("input[name=idUser]").val());
        datas.append("name",$("input[name=nameEdit]").val());
        datas.append("email",$("input[name=emailEdit]").val());
        datas.append("role",$("select[name=roleEdit]").val());
        datas.append("roleActual",$("select[name=roleActualEdit]").val());
        $.ajax({
            "dataSrc":"data",
            type:'POST',
            url:"/updateUser",
            data:datas,
            processData:false,
            contentType:false,
            success:function(data){
                console.log(data);
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
                    tablaUsuarios.ajax.reload();
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
    })
    
    //ELIMINAR REGISTRO
    $('#tablaUsuarios tbody').on('click','button.delete', function(e){
            Swal.fire({
                title: 'Confirmar eliminación de Registro',
                showDenyButton: true,
                // showCancelButton: true,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    var registro = tablaUsuarios.row(($(this)).parents("tr")).data();
                    $.ajax({
                        "dataSrc":"data",
                        type:'POST',
                        url:"/deleteUser/"+registro.id,
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
                                tablaUsuarios.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: data.mensaje,
                                    showConfirmButton: false,
                                    timer: 2500
                                })
                                //window.location.reload();
                            }
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('Eliminación Cancelada', '', 'info')
                }
            })
        //var usuarionEditar = tablaUsuario.row($(this)).data().id;
        
    });

});