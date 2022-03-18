<?php
if(!isset($_SESSION))
{
session_start();
}
if($_POST['statement'] == 'continue')
{
    $_SESSION['last_activity'] = time();
}
if($_POST['statement'] == 'check')
{
    //$_SESSION['last_activity'] = time();
    if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] )
    {
        $exp = 'expired';
    }
    else
    {
        $exp = 'notexpired';
    }
    
    $data = array(
        'exptime'=>$exp ,
    );
    echo json_encode($data);
}

?>