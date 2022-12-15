<?php
RequirePage::requireModel('Crud');
RequirePage::requireModel('ModelPriviledge');

class ControllerPriviledge{

    public function index(){
        $priviledge = new ModelPriviledge;
        $select = $priviledge->select();
        twig::render("priviledge-index.php", ['priviledges' => $select, 
                                        'priviledge_list' => "Liste des priviledges"]);
    }

    public function create(){
       twig::render('priviledge-create.php');
    }

    public function store(){
        $priviledge = new ModelPriviledge;
        $insert = $priviledge->insert($_POST);
        requirePage::redirectPage('priviledge');
    }

    public function show($id){
        $priviledge = new ModelPriviledge;
        $select = $priviledge->selectId($id);
        twig::render('priviledge-show.php', ['priviledges' => $select,
                                            'priviledge_detail' => "Modifier"]);
    }

    public function edit($id){
        $priviledge = new ModelPriviledge;
        $select = $priviledge->selectId($id);
        twig::render('priviledge-edit.php', ['priviledge' => $select]);
    }
    // *** ?? A quoi servent $update et $delete ?
    public function update(){
        $priviledge = new ModelPriviledge;
        $update = $priviledge->update($_POST);
        RequirePage::redirectPage('priviledge');
    }
    public function delete(){
        $priviledge = new ModelPriviledge;
        $delete = $priviledge->delete($_POST['id']);
        RequirePage::redirectPage('priviledge');
    }
}
?>