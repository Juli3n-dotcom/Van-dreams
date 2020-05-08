<?php

setcookie('accept_cookie', true, time()+365*24*3600, '/', null,false, true);

if(isset($_SERVER['http_REFERER'])AND !empty($_SERVER['http_REFERER'])){
    header('Location:'.$_SERVER['http_REFERER']);
}else{
    header('Location:http://vandreams.fr/');
}
?>