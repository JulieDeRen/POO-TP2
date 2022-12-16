<?php

class ModelClient extends Crud {
    // *** IMPORTANT bons noms de variables ***
    protected $table = 'client';
    protected $primaryKey = 'id';
    // ajouts de valeurs dans le tableau pour la table étrangère
    protected $fillable = ['id', 'addresse', 'idCountry'];

    public function insertClient($data, $id){
        // print_r($data);
        // die();
        // traiter les données non obligatoires qui posent problème (date, birthday, country) si elle ne sont pas saisie dans la requête
        foreach($data as $key => $value){
            if(isset($data[$key]) && ($value=="" || $value=="-1")){
                unset($data[$key]);
            }
        }
        $data_keys = array_fill_keys($this->fillable, '');
        $data_map = array_intersect_key($data, $data_keys);
        $nomChamp = implode(", ",array_keys($data_map));
        $valeurChamp = ":".implode(", :", array_keys($data_map));
        $sql = "INSERT INTO `client` (id, addresse, idCountry) VALUES ($id, :addresse, :idCountry)";

        $stmt = $this->prepare($sql);
        foreach($data_map as $key=>$value){
            $stmt->bindValue(":$key", $value);
        } 
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }else{
            return $this->lastInsertId();
        }
    }

    
    // jointure pour montrer tous les clients incluants ceux qui ont ou pas de pays inscrit
    public function selectClient($champ='id', $order='ASC' ){
        // La requête sql ne fonctionne pas pour la table condition s'il n'y a pas l'échappé
        $sql = "SELECT `client`.id, `user`.lastName, `user`.firstName,  `client`.addresse, `user`.birthday, `user`.email, `country`.countryName,`user`.idPriviledge, `priviledge`.type FROM `client` RIGHT JOIN `user` ON `client`.id = `user`.id LEFT JOIN `country` ON `client`.idCountry = `country`.idCountry INNER JOIN `priviledge` WHERE `user`.idPriviledge = 3 ORDER BY $champ $order"; 

        $stmt  = $this->query($sql);
        return  $stmt->fetchAll();
    }

    public function selectClientId($value){
        //print_r($value);
        //die();
        $sql ="SELECT `client`.id as `id`, `user`.id, `user`.lastName, `user`.firstName,  `client`.addresse, `user`.birthday, `user`.lastName,  `user`.email, `country`.countryName,`user`.idPriviledge, `priviledge`.id  FROM `client` INNER JOIN `user` ON `client`.id = `user`.id LEFT JOIN `country` ON `client`.idCountry = `country`.idCountry INNER JOIN `priviledge` ON `user`.idPriviledge = `priviledge`.id WHERE `client`.$this->primaryKey = $value";

        //$sql ="SELECT * FROM `client` INNER JOIN `user` ON `client`.id = `user`.id LEFT JOIN `country` ON `client`.idCountry = `country`.idCountry INNER JOIN `priviledge` ON `user`.idPriviledge = `priviledge`.id WHERE `client`.$this->primaryKey = $value";

        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        // si le id correspond à une donnée saisie alors retourner tout ce qui correspond à cette id sinon, générer message d'erreur
        if($count == 1 ){
            return $stmt->fetchAll(); // Modification ici fonction fetchAll()**
        }else{
            header("location: ../../home/error");
        }
    }

    public function updateClient($data){
        // traiter les données non obligatoires qui posent problème si elle ne sont pas saisie dans la requête
        foreach($data as $key => $value){
            if(isset($data[$key]) && ($value=="" || $value=="-1")){
                unset($data[$key]);
            }
        }
        print_r($data);
        die();
        $champRequete = null;
        foreach($data as $key=>$value){
            $champRequete .= "$key = :$key, ";
        }
        $champRequete = rtrim($champRequete, ", ");

        $sql = "UPDATE `$this->table` SET `addresse` = " . $data['addresse'] .", `idCountry` = " . $data['idCountry'] . " WHERE $this->primaryKey = :$this->primaryKey";

        print_r($sql);
        die();
        
        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        } 
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }else{
            print_r($sql);
            die();
           // header('Location: ' . $_SERVER['HTTP_REFERER']);
           return $this->lastInsertId(); // no id
        }
    }

    public function deleteClient($id){

        $sql = "DELETE * FROM `user` INNER JOIN `client` ON `client`.id = `user`.id WHERE `user`.id = $id";

        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $id);
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }else{
            return true; // no id
        }
    }

    
}

?>