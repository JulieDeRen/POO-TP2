<?php

class ModelBasket extends Crud {
    // *** IMPORTANT bons noms de variables ***
    protected $table = 'basket';
    // primaryKey pour le client pcq c'est principalement ce qu'on veut voir 
    protected $primaryKey = 'idClient';
    protected $primaryKeyStamp = 'idStamp';

    protected $fillable = ['idClient', 'idStamp', 'price', 'dateTransaction', 'datePutInBasket'];
    
    public function selectBasket($champ='id', $order='ASC' ){
        // La requête sql ne fonctionne pas pour la table condition s'il n'y a pas l'échappé
        $sql = "SELECT `basket`.idStamp, `basket`.idClient, `basket`.price, `stamp`.id, `stamp`.name as `title`, `stamp`.price, `stamp`.date, `stamp`.description, `stamp`.idCountry, `stamp`.idFormat, `stamp`.idCondition, `country`.countryName, `format`.name as `formatName`, `condition`.name as `conditionName` FROM `basket` INNER JOIN `stamp` ON `basket`.idStamp = `stamp`.id LEFT JOIN `country` ON stamp.idCountry = country.idCountry LEFT JOIN `format` ON stamp.idFormat = `format`.id LEFT JOIN `condition` ON stamp.idCondition = `condition`.id WHERE `basket`.idClient = $champ";
        $stmt  = $this->query($sql);
        return  $stmt->fetchAll();
    }
    public function insertBasket($data){

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
        $sql = "INSERT INTO `$this->table` ($nomChamp) VALUES ($valeurChamp)";
        $stmt = $this->prepare($sql);
        foreach($data_map as $key=>$value){
            $stmt->bindValue(":$key", $value);
        } 
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }else{
            // print_r($this->lastInsertId());
            // die();
            return true;//$this->lastInsertId(); // no id
        }
       
    }
    public function deleteBasket($idStamp, $idClient){

        $sql = "DELETE FROM `basket` WHERE `basket`.`idStamp` = $idStamp AND `basket`.`idClient` = $idClient";
        //print_r($sql);
        //die();

        $stmt = $this->prepare($sql);
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }else{
            return true; 
        }
    }
}

?>