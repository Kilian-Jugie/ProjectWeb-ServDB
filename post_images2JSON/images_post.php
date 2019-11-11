<?php
    if(isset($_POST['submitform'])){
        // <-- include DB
        $targetDir = "uploads/";
        $allowtypes = array('jpg', 'png', 'jpeg', 'gif');
        $nbImages = 0;
        $jsonArray = [];

        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
        if(!empty(array_filter($_FILES['files']['name']))){
            foreach($_FILES['files']['name'] as $key=>$value){
                $filename = basename($_FILES['files']['name'][$key]);
                $filepath = $targetDir.$filename;

                $filetype = pathinfo($filepath, PATHINFO_EXTENSION);
                $arraylength = count($_FILES['files']['name']);
                if(in_array($filetype, $allowtypes)){
                    if(move_uploaded_file($_FILES['files']['tmp_name'][$key], $filepath)){
                        $jsonArray[$nbImages] = array("path:" => $filepath, "format" => $filetype);
                        $nbImages++;
                    }else{
                        $errorUpload .= $_FILES['files']['name'][$key].', ';
                    }
                }else{
                    $errorUploadType .= $_FILES['files']['name'][$key].', ';
                }
                
                
            }
            if(!empty($jsonArray)){
                // $insertValuesSQL = trim($insertValuesSQL, ',');
                $json = '"nb_image": "'.$arraylength.'", "image": '.json_encode($jsonArray);
                 $json = json_encode($json);
                echo $json;
                // echo "Json : ".$json;
            }      
        }

    }
?>