<?php $data = file_get_contents("../../handoutmath/2021_07_15/aaaaa.jpg");
header('Content-type: image/jpeg');
echo $data; ?>