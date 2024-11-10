<?php

try{
echo $hello;
}catch(Exception $e){
    echo 'Message: ' .$e->getMessage();
}
echo "Jacob";