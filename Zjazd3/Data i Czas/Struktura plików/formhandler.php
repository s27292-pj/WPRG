<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $form_path = isset($_GET["dir_path"]) ? $_GET["dir_path"] : null;
    $dir_name = isset($_GET["directory"]) ? $_GET["directory"] : null;
    $operation_type = isset($_GET["operation"]) ? $_GET["operation"] : null;

    if ($form_path !== null && $dir_name !== null && $operation_type !== null) {
        filehandler($form_path, $dir_name, $operation_type);
    } else {
        echo "Please fill in all fields.";
    }

}
function filehandler($path,$catalogue,$operation = "read"){
    try {
        $path = "./" . $path;
        if (!(substr($path, -1) == "/")) {
            $path = $path . "/";
        }

        if(($opened = opendir($path))){
            switch ($operation) {
                case "read":
                    read($path . $catalogue);
                    break;
                case "delete":
                    delete($path,$catalogue);
                    break;
                case "create":
                    create($path,$catalogue);
                    break;
            }
            closedir($opened);
        } else {
            throw new Exception("Couldn't open " . $path);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function read($r_path){
    $c = scandir($r_path);
    foreach ($c as $file) {
        echo $file . "<br>";
    }
}

function delete($d_path,$d_name){;
    if (!file_exists($d_path . $d_name)){
        throw new ErrorException("Directory doesn't Exist");
    }
    if(count(glob($d_path.$d_name."/*"))===0){
        if (rmdir($d_path.$d_name)){
            echo "Directory Deleted";
            read($d_path);
        } else {
            throw new ErrorException("Cannot delete directory");
        }
    } else {
        throw new ErrorException("The directory is not empty! Please delete all of the files inside of it first.");
    }
}

function create($c_path,$c_name){
    if (file_exists($c_path . $c_name)){
        throw new ErrorException("Directory already exists");
    } else {
        if (mkdir($c_path . $c_name, 0777, true)) {
            echo "Catalogue ". $c_name  ." created";
            read($c_path . $c_name);
        } else {
            throw new ErrorException("Couldn't create " . $c_path . $c_name);
        }
    }
}


