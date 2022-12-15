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
        $stamp = new ModelStamp;
        $insert = $stamp->insert($_POST);
        $img = new ModelImage;
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