<?php require 'include/validar_session.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>

    <?php include 'include/header.php' ?>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <?php include 'include/menu.php' ?>

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="panel_socios.php">Principal</a>
                </li>
                <li class="breadcrumb-item active">Reimprimir Orden de Pago</li>
            </ol>
            <div class="row">
                <div class="col-12">
                    <h3>Reimprimir Boleta de Orden de Pago....</h3>    
                    <br>

                    <form class="form-inline" id="frm-reimprimirOp" name="frm-reimprimirOp" autocomplete="off">
                        <div class="form-group mb-2">
                            <label for="op" class="sr-only">Orden de Pago Nro: </label>
                            <input type="text" readonly class="form-control-plaintext" value="Orden de Pago Nro:">
                        </div>


                        <div class="input-group">
                            <input type="text" class="form-control" id="reimprimirOp" name="reimprimirOp" placeholder="OP" style="text-align: center;">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </span>
                        </div><!-- /input-group -->

                    </form>

                    <div class="row">

                        <div id="resultados_ajax" class="col-12">

                        </div>
                    </div>
                    <div id="loader"></div>

                </div><!-- /.col-12-->
            </div><!-- /.row-->
        </div> <!-- /.container-fluid-->


        <footer class="sticky-footer">
            <div class="container">
                <div class="text-center">
                    <small>Ruben Correa Website 2019</small>
                </div>
            </div>
        </footer>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fa fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <?php include 'modal/cerrar_sesion.php' ?>
        <!-- Bootstrap core JavaScript-->
        <!-- Core plugin JavaScript-->
        <!-- Custom scripts for all pages-->
        <?php include 'include/librerias_js.php' ?>
        <!-- <script type="text/javascript" src="js/pagos.js"></script> -->
        <script type="text/javascript">
            $(document).ready(function(){
                foco();
            });

            function foco(){
                $('#reimprimirOp').focus();
            }

            $('#frm-reimprimirOp').submit(function(e){
            
                var op=$('#reimprimirOp').val();

                if (op==""){
                foco();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No ingreso el Nro. de Orden de Pagos!'
                    
                })
                return false;
                }

                $.ajax({
                    type: "POST",
                    url: "ajax/existe_op.php",
                    data: "op="+op,
                
                    success: function (response) {
                        var res=parseInt(response);
                        if(res==1){
                            window.open("./reportes/orden_de_pago.php?op="+ op, '_blank');    
                        }else{
                            foco();
                            Swal.fire({
                                icon: 'error',
                                title: 'OP no Existe...',
                                text: 'El Nro. de Orden de Pagos no Existe!'
                                
                            })
                        }
                    }
                });
                e.preventDefault();
            });
        
        </script>
    </div><!-- /.content-wrapper-->
</body>

</html>