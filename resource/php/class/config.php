<?php
class config{
    // local connection
    private $user = 'root';
    private $password = '';
    public $pdo = null;

    // hostinger connection
    // private $user = 'port7396_cave';
    // private $password = 'p@ssw0rdBSIT4A';
    // public $pdo = null;

    //private $user = 'root';
    //private $password = '';
    //public $pdo = null;
    
    //  private $user = 'ceumnlre_root';
    //  private $password = 'Eg5c272klko5';
    //  public $pdo = null;

    public function con(){
        try {
            // local connection
            $this->pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=ceumnlre_cave', $this->user, $this->password);

            //hostinger connection
            //  $this->pdo = new PDO('mysql:local=109.106.254.187;dbname=ceumnlre_cave', $this->user, $this->password);

            // $this->pdo = new PDO('mysql:host=127.0.0.1:3006;dbname=cave', $this->user, $this->password);

            } catch (PDOException $e) {
                die($e->getMessage());
        }
        return $this->pdo;
    }
}

 ?>
