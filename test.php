<?php
$check=mail("shaktidd375@gmail.com","Testing Purpose","This is a testing email from xamp server","From: githubapp3709@gmail.com");
if($check==true){
echo "email sent successfully";
}
else{
    echo "email not sent";
}
?>