<?php
RequirePage::requireModel('Crud');
RequirePage::requireModel('ModelSession');

class ControllerSession{
    // Code édité*
    // Source* : https://www.javatpoint.com/how-to-get-the-ip-address-in-php#:~:text=The%20simplest%20way%20to%20collect,is%20currently%20viewing%20the%20webpage.
    public function getIPAddress() {  
        //whether ip is from the share internet  
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }  
        //whether ip is from the remote address  
        else{  
            $ip = $_SERVER['REMOTE_ADDR'];  
        }  
        return $ip;  
    }  

    // Code édité**
    // Source** : https://www.javatpoint.com/how-to-get-current-page-url-in-php#:~:text=To%20get%20the%20current%20page,always%20available%20in%20all%20scope.
    public function getURL(){
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
        else  
            $url = "http://";   
        // Append the host(domain name, ip) to the URL.   
        $url.= $_SERVER['HTTP_HOST'];   
        
        // Append the requested resource location to the URL   
        $url.= $_SERVER['REQUEST_URI'];    
        
        return $url;
    }

    public function index(){
        $session = new ModelSession;
        $select = $session->selectSession();
        //print_r($select);
        //die();
        twig::render("session-index.php", ['sessions' => $select, 
                                        'session_list' => "Liste des sessions"]);
    }

    public function store(){
        $session = new ModelSession;
        $insert = $session->insertSession($_SESSION);
        // requirePage::redirectPage('session');
    }
    // peut-être le garder si admin veut effacer une session (?)
    public function delete(){
        $format = new ModelFormat;
        $delete = $format->delete($_SESSION['id']);
        RequirePage::redirectPage('format');
    }
}
?>