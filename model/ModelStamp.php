<?php

class ModelStamp extends Crud {
    // *** IMPORTANT bons noms de variables ***
    protected $table = 'stamp';
    protected $primaryKey = 'id';
    protected $foreignKeyCountry = 'idCountry';
    protected $foreignKeyFormat = 'idFormat';
    protected $foreignKeyCondition = 'idCondition';

    protected $fillable = ['id', 'name', 'price', 'priceEstimation', 'date', 'description', 'idCountry', 'idFormat', 'idCondition'];

    // problème pour moi avec les 
    public function selectStamp($champ='id', $order='ASC' ){
        // La requête sql ne fonctionne pas pour la table condition s'il n'y a pas l'échappé
        $sql = "SELECT `stamp`.id, `stamp`.name as `stampName`, `stamp`.price, `stamp`.priceEstimation, `stamp`.date, `stamp`.description, `stamp`.idCountry, `stamp`.idFormat, `stamp`.idCondition, `country`.countryName, `format`.name as `formatName`, `condition`.name as `conditionName`, `image`.imgPath FROM `stamp` LEFT JOIN `country` on stamp.idCountry = country.idCountry LEFT JOIN `format`on stamp.idFormat = format.id LEFT JOIN `condition` on stamp.idCondition = `condition`.id LEFT JOIN `image` ON `stamp`.id = `image`.idStamp ORDER BY $champ $order"; 
        $stmt  = $this->query($sql);
        return  $stmt->fetchAll();
    }
    
}

?>