<?php

if(!isset($_SESSION))
{
session_start();
include('connect.php');
}
if(!isset($_SESSION['cmuitaccount_name'])){
    header('location:index.php');
}

if(isset($_SESSION['cmuitaccount_name']) && $_SESSION['organization_code'] != '06' && $_SESSION['organization_code'] != '00' ){
    header('location:403.php');
}

if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //have we expired?
    echo '<script src="plugins/sitejs/session_check.js" type="text/javascript"></script>';
} 
else{ //if we haven't expired:
    $_SESSION['last_activity'] = time(); //this was the moment of last activity.
    echo "<script>
    document.addEventListener('click', myFunction);
    document.addEventListener('onkeypress', myFunction);
    document.addEventListener('ontouchstart', myFunction);
    document.addEventListener('onmousedown', myFunction);
    document.addEventListener('onmousemove', myFunction);

    function myFunction() {
        $.ajax({
            type: 'POST',
            url: 'include/setSession.php',
            data: {
                statement: 'check'
            },
            dataType: 'json',
            success: function(data){
                if(data.exptime == 'expired')
                {
                    setTimeout(function() {
                        let timerInterval
                        Swal.fire({
                            icon: 'warning',
                            title: 'Session Timeout',
                            html: 'Your session has expired due to inactivity. You will be signed out in <b></b> seconds.',
                            timer: 10000,
                            confirmButtonText: 'Sign out',
                            confirmButtonColor: '#d33',
                            showDenyButton: true,
                            denyButtonColor: '#3085d6',
                            denyButtonText: 'Continue Session',
                            timerProgressBar: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                timerInterval = setInterval(() => {
                                    const content = Swal.getContent()
                                    if (content) {
                                        const b = content.querySelector('b')
                                        if (b) {
                                            b.textContent = Math.ceil(Swal.getTimerLeft() / 1000)
                                        }
                                    }
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location = 'login.php?logout';
                            } else if (result.isDenied) {
                                $.ajax({
                                    type: 'POST',
                                    url: 'include/setSession.php',
                                    data: {
                                        statement: 'continue'
                                      },
                                    dataType: 'json',
                               });
                            } else if (result.isConfirmed) {
                                window.location = 'login.php?logout';
                            }
                        })
                    }, 1);
                }
                else
                {
                    $.ajax({
                        type: 'POST',
                        url: 'include/setSession.php',
                        data: {
                            statement: 'continue'
                          },
                        dataType: 'json',
                   });
                }
                
            }
       });
    }
    </script>";
}
?>