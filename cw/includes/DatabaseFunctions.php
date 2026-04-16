<?php

function query($pdo,$sql,$parameters=[]){
    $query=$pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function total($pdo,$table){
    $query=query($pdo,"SELECT COUNT(*) FROM $table");
    $row=$query->fetch();
    return $row[0];
}   