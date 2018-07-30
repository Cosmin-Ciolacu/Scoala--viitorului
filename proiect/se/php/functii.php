<?php
function getnume($a,$b) {
    $rez = mysqli_query($a,"SELECT * FROM login WHERE id_utilizator='$b' LIMIT 1");
    while($row = mysqli_fetch_array($rez)) {
        $username = $row[1];
    }
    return $username;
}

function get_image($a,$b) {
    $rez = mysqli_query($a,"SELECT * FROM login WHERE username='$b' LIMIT 1");
    while($row = mysqli_fetch_array($rez)) {
        $image = $row[4];
    }
    return $image;
}


function inteles($con,$id1,$id2) {
    $sql = "SELECT * FROM inteles WHERE id_utilizator='$id1' AND id_lectie='$id2'";
    $rez = mysqli_query($con,$sql);
    $nr = mysqli_num_rows($rez);
    if($nr > 0) {
        return 1;
    } else {
        return 0;
    }
}

function con_to_link ($str) {
    $link = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($str)));
    return $link;
}

function exista_cont($con, $username) {
    $rez = mysqli_query($con, "SELECT * FROM login where username='$username'");
    $nr = mysqli_num_rows($rez);
    if($nr == 0) {
        return false;
    } else {
        return true;
    }
}

function nr_elevi($con, $clasa){
    $sql = "select * from login where clasa='$clasa'";
    $rez = mysqli_query($con, $sql);
    return mysqli_num_rows($rez);
}
?>