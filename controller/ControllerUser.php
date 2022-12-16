<?php
RequirePage::requireModel('Crud');
RequirePage::requireModel('ModelClient');
RequirePage::requireModel('ModelCountry');
RequirePage::requireModel('ModelUser');
RequirePage::requireModel('ModelBasket');
RequirePage::requireModel('ModelPriviledge');

class ControllerUser{

    public function index(){
        $user = new ModelUser;
        $select = $user->selectUser();
        $country = new ModelCountry;
        $selectCountry = $country->select('countryName'); // passer la variable en param
        $priviledge = new ModelPriviledge;
        $selectPriviledge = $priviledge->select('type'); // passer la variable en param
        // print_r($select);
        // die();
        twig::render("user-index.php", ['users' => $select, 
                                        'priviledges'=> $selectPriviledge,
                                        'countries' => $selectCountry,
                                        'user_list' => "Liste des utilisateurs"]);

    }

    public function create(){
        $country = new ModelCountry;
        $selectCountry = $country->select('countryName'); // passer la variable en param
        $priviledge = new ModelPriviledge;
        $selectPriviledge = $priviledge->select('type'); // passer la variable en param
        // print_r($select);
        // die();
        twig::render("user-create.php", ['priviledges'=> $selectPriviledge,
                                        'countries' => $selectCountry,
                                        'user_list' => "Liste des utilisateurs"]);

    }
    public function store(){
        $validation = new Validation;
        extract($_POST);
        $validation->name('nom')->value($firstName)->pattern('alpha')->required()->max(45);
        // $validation->name('courriel')->value($email)->pattern('email')->required();
        $validation->name('mot de passe')->value($password)->max(20)->min(6);
        $validation->name('privilege')->value($idPriviledge)->pattern('int')->required();

        if($validation->isSuccess()){
            $user = new ModelUser;
            $options = [
                'cost' => 10,
            ];
            $_POST['password']= password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
            $userInsert = $user->insert($_POST);
            // print_r($_POST);
            $client = new ModelClient;
            // passer post et id en paramêtre puisque id client est le id du user
            $clientInsert = $client ->insertClient($_POST, $userInsert); 
            requirePage::redirectPage('user');
        }else{
            $errors = $validation->displayErrors();
            $privilege = new ModelPriviledge;
            $selectPriviledge = $privilege->select();
            twig::render('user-create.php', ['errors' => $errors,
            'privileges' => $selectPriviledge, 'user' => $_POST]);
        }
    }

    public function show($id){
        // CheckSession::sessionAuth();
        $user = new ModelUser;
        $select = $user->selectUserId($id);
        // $client = new ModelClient;
        // $selectClient = $client -> selectClientId($id);
        $priviledge = new ModelPriviledge;
        $selectPriviledge = $priviledge->select();
        $country = new ModelCountry;
        $selectCountry = $country->select('countryName'); // pour chaque boucle, il faut l'associer
        twig::render("user-show.php", [ 'users' => $select,
                                        /* 'clients' => $selectClient, */
                                        'priviledges' => $selectPriviledge,
                                        'countries'=> $selectCountry,
                                        'client_list' => "Liste de Client"]);
    }

    public function login(){
        twig::render('user-login.php');
    }

    public function auth(){
        $validation = new Validation;
        extract($_POST);
        $validation->name('courriel')->value($email)->pattern('email')->required();
        $validation->name('password')->value($password)->required();

        if($validation->isSuccess()){
            $user = new ModelUser;
            $checkUser = $user->checkUser($_POST);
            if($checkUser===true){
                $pageVisited = new ModelSession;
                $pageVisited -> updateSession($_SESSION);
                if($pageVisited){
                    requirePage::redirectPage('user');
                }
            }
            else{
                // message d'erreur
                return "<ul><li>Verifier le mot de passe</li></ul>";  
            }
        }
            
        else{
            $errors = $validation->displayErrors();
            twig::render('user-login.php', ['errors' => $errors, 'user' => $_POST]);
        }
    }

    public function logout(){
        session_destroy();
        requirePage::redirectPage('user/login');
    }

    public function edit($id){
        $user = new ModelUser;
        $select = $user->selectId($id);
        twig::render('user-edit.php');
    }
    
    public function update(){
        $user = new ModelUser;
        $update = $user ->update($_POST);
        // die();
        $client = new ModelClient;
        $update = $client ->update($_POST);
        RequirePage::redirectPage('client');

        // print_r($_POST);
        // die();
        RequirePage::redirectPage('user');
    }
    public function delete(){
        $user = new ModelUser;
        $delete = $user->delete($_POST['id']);
        $client = new ModelClient;
        $delete = $client->delete($_POST['id'], $delete);
        RequirePage::redirectPage('user');
    }


}

?>