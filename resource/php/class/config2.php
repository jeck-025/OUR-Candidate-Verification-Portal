<?php
 class config2 {
    private $user = 'root';
    private $password = '';
    public $pdo = null;

    // private $user = 'port7396_cave_daap';
    // private $password = 'p@ssw0rdBSIT4A';
    // public $pdo = null;
    //
      // private $user = 'ceumnlre_root';
      // private $password = 'Eg5c272klko5';
      // public $pdo = null;

    public function conn(){
        try {
            // local connection
            $this->pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=ceumnlre_cave', $this->user, $this->password);

            // hostinger connection
            // $this->pdo = new PDO('mysql:host=109.106.251.63;dbname=port7396_mapdb', $this->user, $this->password);

            //  $this->pdo = new PDO('mysql:local=109.106.254.187;dbname=ceumnlre_map', $this->user, $this->password);

            } catch (PDOException $e) {
                die($e->getMessage());
        }
        return $this->pdo;
    }
 }

?>
