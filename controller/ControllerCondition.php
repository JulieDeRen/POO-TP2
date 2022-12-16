<?php
RequirePage::requireModel('Crud');
RequirePage::requireModel('ModelCondition');

class ControllerCondition{

    public function index(){
        $condition = new ModelCondition;
        $select = $condition->select();
        twig::render("condition-index.php", ['conditions' => $select, 
                                        'condition_list' => "Liste des conditions"]);
    }

    public function create(){
       twig::render('condition-create.php');
    }

    public function store(){
        $condition = new ModelCondition;
        $insert = $condition->insert($_POST);
        requirePage::redirectPage('condition');
    }

    public function show($id){
        $condition = new ModelCondition;
        $select = $condition->selectId($id);
        twig::render('condition-show.php', ['conditions' => $select,
                                            'condition_detail' => "Modifier"]);
    }

    public function edit($id){
        $condition = new ModelCondition;
        $select = $condition->selectId($id);
        twig::render('condition-edit.php', ['condition' => $select]);
    }
    // *** ?? A quoi servent $update et $delete ?
    public function update(){
        $condition = new ModelCondition;
        $update = $condition->updateCondition($_POST);
        RequirePage::redirectPage('condition');
    }
    public function delete(){
        $condition = new ModelCondition;
        $delete = $condition->delete($_POST['id']);
        RequirePage::redirectPage('condition');
    }
}
?>