<?php

class ModelCondition extends Crud {

    protected $table = 'condition';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'name', 'description'];

    // condition est un mot réservé sql.  Le script sql est propre à cette classe
    public function updateCondition($data){
        // traiter les données non obligatoires qui posent problème si elle ne sont pas saisie dans la requête
        foreach($data as $key => $value){
            if(isset($data[$key]) && ($value=="" || $value=="-1")){
                unset($data[$key]);
            }
        }
        $champRequete = null;
        $data_keys = array_fill_keys($this->fillable, '');
        $data_map = array_intersect_key($data, $data_keys);
        foreach($data_map as $key=>$value){
            $champRequete .= "$key = :$key, ";
        }
        $champRequete = rtrim($champRequete, ", ");

        $sql = "UPDATE `condition` SET $champRequete WHERE $this->primaryKey = :$this->primaryKey";

        $stmt = $this->prepare($sql);
        foreach($data_map as $key=>$value){
            $stmt->bindValue(":$key", $value);
        } 
        if(!$stmt->execute()){
            print_r($stmt->errorInfo());
        }else{
           // header('Location: ' . $_SERVER['HTTP_REFERER']);
           return true;
        }
    }

}

?>