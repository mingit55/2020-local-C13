<?php

function user(){
    return isset($_SESSION['user']) ? $_SESSION['user'] : false;
}

function go($url, $message){
    echo "<script>";
    echo "alert('$message');";
    echo "location.href='$url';";
    echo "</script>";
    exit;
}

function back($message){
    echo "<script>";
    echo "alert('$message');";
    echo "history.back();";
    echo "</script>";
    exit;
}

function json_response($data){
    header("Content-type: application/json");
    echo json_encode($data);
    exit;
}

function view($viewName, $data = []){
    extract($data);
    $filePath = _VIEW."/$viewName.php";
    $currentURL = explode("?", $_SERVER['REQUEST_URI'])[0];
    
    if(is_file($filePath)){
        require _VIEW."/layouts/header.php";
        require $filePath;
        require _VIEW."/layouts/footer.php";
    }
}

function checkInput(){
    foreach($_POST as $input){
        if(trim($input) === "") back("모든 정보를 입력해 주세요!");
    }
    foreach($_FILES as $file){
        if(!is_file($file)) back("모든 파일을 입력해 주세요!");
    }
}

function extname($file){
    return substr($file['name'], strrpos($file['name'], "."));
}