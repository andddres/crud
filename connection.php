<?php
$con  = mysqli_connect('localhost:3306','root','','crud');
if(mysqli_connect_errno())
{
    echo 'Database Connection Error';
}
