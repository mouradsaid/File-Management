<?php


class Database{
    private $host=DB_HOST;
    private $user=DB_USER;
    private $password=DB_PASSWORD;
    private $db_name=DB_NAME;
    private $pdo;
    private $stmt;
    
    public function __construct(){
        $dsn='mysql:host=' . $this->host . "; dbname=" . $this->db_name;
        try{
            $this->pdo = new PDO($dsn,$this->user,$this->password);
        }catch(PDOException $e){
            die("Exception database :".$e->getMessage());
        }
    }


    
    public function __destruct()
    {
        if ($this->stmt !== null) {
            $this->stmt = null;
        }
        if ($this->pdo !== null) {
            $this->pdo = null;
        }
    }

    public function query($sql)
    {
        $this->stmt = $this->pdo->prepare($sql);
    }

    public function bind($param, $value, $type = null)
    {

        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = pdo::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = pdo::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = pdo::PARAM_NULL;
                    break;
                default:
                    $type = pdo::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    //fetch data

    public function fetchAll()
    {
        $this->stmt->execute();
        $results = $this->stmt->fetchAll(PDO::FETCH_OBJ);

        return $results;
    }

    public function fetch()
    {
        $this->stmt->execute();
        $result = $this->stmt->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    //row Count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

//     public function __destruct(){
//         if($this->stmt !== null){
//             $this->stmt=null;
//         }
//         if($this->pdo !== null){
//             $this->pdo=null;
//         }
//     }

//     public function query($sql){
//         $this->stmt=$this->pdo->prepare($sql);
//     }


//     public function bind($param,$value,$type=null){
//         if(is_null($type)){
//             switch(true){
//                 case is_int($value):
//                     $type=pdo::PARAM_INT;
//                     break;
//                 case is_bool($value):
//                     $type=pdo::PARAM_BOOL;
//                     break;    
//                 case is_null($value):
//                     $type=pdo::PARAM_NULL;
//                     break;
//                 default:
//                     $type=pdo::PARAM_STR;
//             }
//         }
//         $this->stmt->bindValue($param,$value,$type);
//     }
    
    
//     public function execute(){
//        return $this->stmt->execute();
//     }

//    //fetch date
//     public function fetchAll(){
//         $this->stmt->execute();
//         $results=$this->stmt->fetchAll(PDO::FETCH_OBJ);
//         return $results;
//     }   

//     public function fetch(){
//         $this->stmt->execute();
//         $results=$this->stmt->fetch(PDO::FETCH_OBJ);
//         return $results;
//     }   

//     public function rowCount(){
//         $results=$this->stmt->rowCount();
//         return $results;
//     }   

}