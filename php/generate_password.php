<?php
$pattern='A02aB1F/bG*3cH&4dI%e8J$f9K7g#5Lh@6Mi~jN`Ol3P^kQm2n-1CozD5EpR_Sy,.qT7-rUx8+Vs{W]Xt[uY}vZw';

$patternLen=strlen($pattern);
$password=[];

for($i=0;$i<8;$i++){
    $index=rand(0,$patternLen-1);
   $password[] = $pattern[$index];
}
echo implode($password);
?>