<?php
RequirePage::requireModel('Crud');
RequirePage::requireModel('ModelClient');
RequirePage::requireModel('ModelCountry');
RequirePage::requireModel('ModelUser');
RequirePage::requireModel('ModelBasket');
RequirePage::requireModel('ModelPriviledge');

class ControllerClient{

    public function index(){
        $client = new ModelClient;
        $select = $client->selectClient();
        twig::render("client-index.php", ['clients' => $select, 
                                        'client_list' => "Liste de Client"]);
    }

    public function create(){

       $country = new ModelCountry;
       $select = $country->select('countryName'); // passer la variable en param
       $priviledge = new ModelPriviledge;
       $selectPriviledge = $priviledge->select('type'); // passer la variable en param
       twig::render('client-create.php', ['countries' => $select, 
                    'priviledges' => $selectPriviledge,
                    'country_list' => "Liste des pays"]);
    }

    public function store(){
        // Vérifier le numéro d'employé, s'il y a lieu
        if(isset($_POST['idEmployee']) && isset($_SESSION['idUser'])){
            if($_POST['idEmployee'] == $_SESSION['idUser']){
                $_POST['idPriviledge']= $_SESSION['idPriviledge'];
            }
        }
        else {
            $_POST['idPriviledge'] = 3; // statue de client
        }
        $validation = new Validation;
        extract($_POST);
        $validation->name('prénom')->value($firstName)->pattern('alpha')->required()->max(45);
        $validation->name('nom de famille')->value($lastName)->pattern('alpha')->required()->max(60);
        // pas requis dans le modèle pour client au check out ;) $validation->name('addresse')->value($addresse)->pattern('address')->required();
        $validation->name('mot de passe')->value($password)->max(20)->min(6);
        // automatique puisque client - $validation->name('privilege')->value($idPriviledge)->pattern('int')->required();

        if($validation->isSuccess()){
            $user = new ModelUser;
            $options = [
                'cost' => 10,
            ];
            // print_r($_POST);
            // die();
            $_POST['password']= password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
            $userInsert = $user->insert($_POST);
            // print_r($_POST);
            $client = new ModelClient;
            // passer post et id en paramêtre puisque id client est le id du user
            $clientInsert = $client ->insertClient($_POST, $userInsert); 
            requirePage::redirectPage('basket/create');
        }else{
            $errors = $validation->displayErrors();
            $country = new ModelCountry;
            $select = $country->select('countryName');
            $priviledge = new ModelPriviledge;
            $selectPriviledge = $priviledge->select('type');
            twig::render('client-create.php', ['errors'=>$errors, 
                        'data'=>$_POST, 
                        'countries' => $select, 
                        'priviledges' => $selectPriviledge, 
                        'country_list' => "Liste des pays"]);
        }
    }



    public function show($id){
        // CheckSession::sessionAuth();
        // $user = new ModelUser;
        // $select = $user->selectUserId($id);
        $client = new ModelClient;
        $selectClient = $client -> selectId($id);
        $user = new ModelUser;
        $selectUser = $user -> selectId($id);
        // print_r($selectUser);
        // die();
        $priviledge = new ModelPriviledge;
        $selectPriviledge = $priviledge->select();
        $country = new ModelCountry;
        $selectCountry = $country->select('countryName'); // pour chaque boucle, il faut l'associer
        twig::render("client-show.php", [ /* 'users' => $select, */
                                        'clients' => $selectClient, 
                                        'users' => $selectUser, 
                                        'priviledges' => $selectPriviledge,
                                        'countries'=> $selectCountry,
                                        'client_list' => "Liste de Client"]);
    }

    public function edit($id){
        $client = new ModelClient;
        $select = $client->selectId($id);
        twig::render('client-edit.php');
    }
    public function update(){
        $user = new ModelUser;
        $update = $user ->update($_POST);
        // die();
        $client = new ModelClient;
        $update = $client ->update($_POST);
        RequirePage::redirectPage('client');
    }
    public function delete(){
        $client = new ModelClient;
        $delete = $client->delete($_POST['id']);
        $user = new ModelUser;
        $delete = $user ->delete($_POST['id']);

        RequirePage::redirectPage('client');
    }
}
?>