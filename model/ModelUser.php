<?php

class ModelUser extends Crud {

    protected $table = 'user';
    protected $primaryKey = 'id';
    // ajouts de valeurs dans le tableau pour la table étrangère
    protected $fillable = ['id', 'firstName', 'lastName', 'birthday', 'password', 'email', 'idPriviledge'];


    // jointure pour montrer tous les clients incluants ceux qui ont ou pas de pays inscrit
    public function selectUser($champ='id', $order='ASC' ){
        // La requête sql ne fonctionne pas pour la table condition s'il n'y a pas l'échappé
        $sql = "SELECT `user`.id, `user`.lastName, `user`.firstName,  `client`.addresse, `user`.birthday, `user`.email, `priviledge`.type, `user`.idPriviledge, `country`.countryName FROM `user` INNER JOIN `client` ON `user`.id = `client`.id LEFT JOIN `priviledge` ON `user`.idPriviledge = `priviledge`.id LEFT JOIN `country` ON `country`.idCountry = `client`.idCountry  ORDER BY $champ $order";

        // "SELECT `user`.id, `user`.lastName, `user`.firstName,  `client`.addresse, `user`.birthday, `user`.email, `priviledge`.type AS `priviledge`, `user`.idPriviledge FROM `user` LEFT JOIN `client` ON `user`.id = `client`.id LEFT JOIN `priviledge` ON `user`.idPriviledge = `priviledge`.id ORDER BY $champ $order";

        $stmt  = $this->query($sql);
        return  $stmt->fetchAll();
    }

    public function selectUserId($value){
        $sql ="SELECT `user`.id, `user`.lastName, `user`.firstName,  `client`.addresse, `user`.birthday, `user`.email, `priviledge`.type, `user`.idPriviledge FROM `user` LEFT JOIN `client` ON `user`.id = `client`.id LEFT JOIN `priviledge` ON `user`.idPriviledge = `priviledge`.id WHERE `user`.id = $value";

        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        // si le id correspond à une donnée saisie alors retourner tout ce qui correspond à cette id sinon, générer message d'erreur
        if($count == 1 ){
            return $stmt->fetchAll(); // Modification ici fonction fetchAll()**
        }else{
            // print_r($sql);
            // die();
            header("location: ../../home/error");
        }
    }

    public function checkUser($data){
        extract($data);
        $sql = "SELECT * FROM $this->table WHERE email = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($email));
        $count = $stmt->rowCount();
        if($count == 1){
            $user_info = $stmt->fetch();
            if(password_verify($password, $user_info['password'])){
                    
                session_regenerate_id();
                $_SESSION['idUser'] = $user_info['id'];
                $_SESSION['idPrivilege'] = $user_info['idPrivilege']; // ** Modifié variable $_SESSION
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
                
                requirePage::redirectPage('user');
                
            }else{
               return "<ul><li>Verifier le mot de passe</li></ul>";  
            }
        }else{
            return "<ul><li>Le non d'utilisateur n'exist pas</li></ul>";
        }
    } 
        
    public function updateUser($data){
        // traiter les données non obligatoires qui posent problème si elle ne sont pas saisie dans la requête
        foreach($data as $key => $value){
            if(isset($data[$key]) && ($value=="" || $value=="-1") || $key == "addresse" || $key == "idCountry"){
                unset($data[$key]);
            }
        }
        // print_r($data);
        // die();
        $champRequete = null;
        foreach($data as $key=>$value){
            $champRequete .= "$key = :$key, ";
        }
        $champRequete = rtrim($champRequete, ", ");

        $sql = "UPDATE `$this->table` SET $champRequete WHERE $this->primaryKey = :$this->primaryKey";

        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        } 
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }else{
           // header('Location: ' . $_SERVER['HTTP_REFERER']);
           return $this->lastInsertId(); // no id
        }
    }



}

?>