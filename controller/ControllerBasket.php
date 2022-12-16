<?php
RequirePage::requireModel('Crud');
RequirePage::requireModel('ModelStamp');
RequirePage::requireModel('ModelClient');
RequirePage::requireModel('ModelBasket');
RequirePage::requireModel('ModelImage');

class ControllerBasket{

    public function index(){
        $basket = new ModelBasket;
        $select = $basket->select();
        twig::render("basket-index.php", ['baskets' => $select, 
                                        'basket_list' => "Liste des paniers"]);
    }

    public function create(){
       $stamp = new ModelStamp;
       $selectStamp = $stamp->selectStamp(); // pour chaque boucle, il faut l'associer
       twig::render('basket-create.php', [
                                        'stamps' => $selectStamp
                                        ]);
    }

   public function store(){
        $basket = new ModelBasket;
        $insert = $basket->insert($_POST);
        requirePage::redirectPage('basket');
    }

    public function show($id){
        $basket = new ModelBasket;
        $select = $basket->selectId($id);
        $client = new ModelClient;
        $selectClient = $client->select(); // pour chaque boucle, il faut l'associer
        $stamp = new ModelStamp;
        $selectStamp = $stamp->selectStamp();
        twig::render("basket-show.php", [
                                        'baskets' => $select,
                                        'clients' => $selectClient, 
                                        'stamps' => $selectStamp
                                        ]);
    }

    public function update(){
        $basket = new ModelBasket;
        $update = $basket ->update($_POST);
        RequirePage::redirectPage('basket');
    }
    public function delete(){
        $basket = new ModelBasket;
        $delete = $basket->delete($_POST['id']);
        RequirePage::redirectPage('basket');
    }
}
?>