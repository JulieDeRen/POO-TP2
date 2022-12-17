<?php
RequirePage::requireModel('Crud');
RequirePage::requireModel('ModelStamp');
RequirePage::requireModel('ModelClient');
RequirePage::requireModel('ModelBasket');
RequirePage::requireModel('ModelImage');

class ControllerBasket{

    public function index(){
        $total=0; // initialiser total
        $basket = new ModelBasket;
        if(isset($_SESSION['idUser'])){
            $select = $basket->selectBasket($_SESSION['idUser']);
            // print_r($select);
            foreach($select as $key=>$value){
                if($key == 'price'){
                    $total += $value['price'];
                }
            }
            // print_r($total);

            // print_r($total);
            twig::render("basket-index.php", ['baskets' => $select, 
                                                'total' => $total,
                                                'basket_list' => "Liste des paniers"]);
        }
        else{ // renvoyer sur le catalogue
            $basket = new ModelStamp;
            $select = $basket->selectStamp(); // pour chaque boucle, il faut l'associer
            twig::render('basket-create.php', [
                                             'baskets' => $select,
                                             ]);
        }
    }

    public function create(){
       $basket = new ModelStamp;
       $select = $basket->selectStamp(); // pour chaque boucle, il faut l'associer
       twig::render('basket-create.php', [
                                        'baskets' => $select
                                        ]);
    }

   public function store(){
        $_POST['idClient'] = $_SESSION['idUser'];
        $_POST['idStamp'] = $_POST['id']; // id du timbre
        $_POST['datePutInBasket'] = $_SESSION['date'];
        unset($_POST['id']); // sert à rien
        $basket = new ModelBasket;
        $insert = $basket->insertBasket($_POST);
        if($insert == true){
            $_SESSION['basket'] = true;
            requirePage::redirectPage('basket/create');
        }
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
    public function delete(){
        // print_r($_POST['idStamp']);
        // print_r($_SESSION['idUser']);
        // die();
        $basket = new ModelBasket;
        $delete = $basket->deleteBasket($_POST['idStamp'], $_SESSION['idUser']);
        RequirePage::redirectPage('basket/create');
    }
}
?>