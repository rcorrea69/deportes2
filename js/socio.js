$(document).ready(function () {
    foco();
 
});

function foco(){
    $('#dni').val('');
    $('#dni').focus();

}

$('#btn_enviar').click(function (e) { 
       
    e.preventDefault();
    var dni=$('#dni').val();
        if( dni == null || dni.length == 0 || /^\s+$/.test(dni) ) {
            //alert('El dni esta vacio desde aca');
            $('#dni').focus();
            Swal.fire({
            icon: 'warning',
            title: 'Atención...',
            text: 'El Nro de DNI esta vacio',
            //footer: '<a href>Why do I have this issue?</a>'
            });
            return false;
        }
        $.ajax({
            type: "POST",
            url: "ajax/existe_sociook.php",
            data: {dni:dni},
            success: function (response) {
                var repuesta=response;
               
                if (repuesta==0) {
                    foco();
                    Swal.fire({
                        icon: 'error',
                        title: 'Atención...',
                        text: 'El Nro de Socio (Dni) ' +dni+' No esta ingresado',
                       
                        });
                       
                } else {
                   
                    location.href="op.php?dni="+dni;
                   
                }  
               

            }
        });

    
});