<?php
RequirePage::requireModel('Crud');
RequirePage::requireModel('ModelStamp');
RequirePage::requireModel('ModelClient');
RequirePage::requireModel('ModelCountry');
RequirePage::requireModel('ModelCondition');
RequirePage::requireModel('ModelFormat');
RequirePage::requireModel('ModelImage');
RequirePage::requireModel('ModelBasket');

class ControllerStamp{

    public function index(){
        $stamp = new ModelStamp;
        $select = $stamp->selectStamp();
        twig::render("stamp-index.php", ['stamps' => $select, 
                                        'stamp_list' => "Liste de timbres"]);
    }

    public function create(){
       $country = new ModelCountry;
       $selectCountry = $country->select('countryName'); // pour chaque boucle, il faut l'associer
       $condition = new ModelCondition;
       $selectCondition = $condition->select();
       $format = new ModelFormat;
       $selectFormat = $format->select();
       twig::render('stamp-create.php', [
                                        'countries' => $selectCountry, 
                                        'conditions' => $selectCondition,
                                        'formats' => $selectFormat
                                        ]);
    }

   public function store(){
        // Source : https://www.w3schools.com/php/php_file_upload.as
        // code édité
        $target_dir = "./uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "Image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Ce fichier n'est pas une image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Ce fichier existe déjà";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Votre fichier est trop large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Désolé, seulement les formats JPG, JPEG, PNG & GIF sont acceptés.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Désolé, votre fichier n'a pas été téléversé.";
        // if everything is ok, try to upload file
        } 
        else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Le fichier ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " a été uploadé.";
            } 
            else {
                echo "Désolé, il y a eu une erreur en uploadant votre fichier.";
            }
        }

        ///////////////////

        $stamp = new ModelStamp;
        $insert = $stamp->insert($_POST);
        $img = new ModelImage;
        $_POST['idStamp'] = $insert;
        $imgPath = substr($target_file, 2);
        $_POST['imgPath'] = $imgPath;
        $insertImg = $img->insert($_POST);
        requirePage::redirectPage('stamp');
    }

    public function show($id){
        $stamp = new ModelStamp;
        $select = $stamp->selectId($id);
        $country = new ModelCountry;
        $selectCountry = $country->select('countryName'); // pour chaque boucle, il faut l'associer
        $condition = new ModelCondition;
        $selectCondition = $condition->select();
        $format = new ModelFormat;
        $selectFormat = $format->select();
        $img = new ModelImage;
        $selectImg = $img->select();
        twig::render("stamp-show.php", [
                                        'stamps' => $select,
                                        'countries' => $selectCountry, 
                                        'conditions' => $selectCondition,
                                        'formats' => $selectFormat,
                                        'images' => $selectImg
                                        ]);
    }

    public function update(){
        $stamp = new ModelStamp;
        $update = $stamp ->update($_POST);
        RequirePage::redirectPage('stamp');
    }
    public function delete(){
        $stamp = new ModelStamp;
        $delete = $stamp->delete($_POST['id']);
        RequirePage::redirectPage('stamp');
    }
}
?>