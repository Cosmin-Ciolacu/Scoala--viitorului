<?php
if(isset($_FILES['fisier'])){
    $errors= array();
    $file_name = $_FILES['fisier']['name'];
    $file_size = $_FILES['fisier']['size'];
    $file_tmp = $_FILES['fisier']['tmp_name'];
    $file_type = $_FILES['fisier']['type'];
    $tmp = explode(".", $file_name);
    $file_ext = end($tmp);

    $expensions= array("jpeg","jpg","png","gif","mp4","avi","","swf","docx","doc","pptx","ppt","xls","xlsx","pdf","exe");

    if(in_array($file_ext,$expensions)=== false){
        $errors[]="Nu se poate incarca acest tip de fisier.";
    }

    if($file_size > 100097152) {
        $errors[]='Fisierul trebuie sa fie mai mic de 100 MB.';
    }

    if(empty($errors)==true) {
        move_uploaded_file($file_tmp,"fisiere/".$file_name);
    }else{
        print_r($errors);
    }
}
?>