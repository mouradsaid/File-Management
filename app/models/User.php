<?php


class User{
    public function __construct(){
        $this->db = new Database;
    }


    public function countUsers($searchby=null)
    {
        if(empty($searchby)){
        $this->db->query("select count(*) as t from userdoc where isadmin!='ok'");
        }else{
        $this->db->query("select count(*) as t from userdoc where isadmin!='ok' and (id LIKE '{$searchby}%' or prinom LIKE '{$searchby}%' or nom LIKE '{$searchby}%' or nameuser LIKE '{$searchby}%' or timeu LIKE '{$searchby}%');");
        }
        $rp = $this->db->fetch();
        if ($rp) return $rp;
        else return false;
    }

    public function getUsersById($vor,$parPage)
    {
        $this->db->query("select U.*,count(D.idusr) as totalFile from userdoc U left join document D on U.id=D.idusr where isadmin!='ok' group by U.id,D.idusr order by U.id desc limit $vor,$parPage;");
        $posts = $this->db->fetchAll();
        if ($posts) return $posts;
        else return false;
    }
    
    public function searcHgetUsersById($vor,$parPage,$searchby)
    { 
        $this->db->query("select U.*,count(D.idusr) as totalFile from userdoc U left join document D on U.id=D.idusr where isadmin!='ok' and (U.id LIKE '{$searchby}%' or U.prinom LIKE '{$searchby}%' or U.nom LIKE '{$searchby}%' or U.nameuser LIKE '{$searchby}%' or U.timeu LIKE '{$searchby}%') group by U.id,D.idusr order by U.id desc limit $vor,$parPage;");
        $posts = $this->db->fetchAll();
        if ($posts) return $posts;
        else return false;
    }


    public function getUser($nameuser){
        $this->db->query('SELECT * FROM userdoc WHERE nameuser=:nameuser');
        $this->db->bind(':nameuser',$nameuser);
        $this->db->execute();
        if($this->db->rowCount()) return true;
        else return false;
    }

    public function login($username,$password){
        $this->db->query('SELECT * FROM userdoc WHERE nameuser=:nameuser;');
        $this->db->bind(':nameuser',$username); 
        $row = $this->db->fetch();
        if(empty($row)){
            return false;
        }else{
        $hachedPassword= $row->passworduser;
        if (password_verify($password, $hachedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

        // $this->db->bind(':password',$password);
        // $row = $this->db->fetch();
        // if(!empty($row)) return $row;
        // else return false;


        // $this->db->query("SELECT * FROM users WHERE userEmail=:email");
        // $this->db->bind(":email", $email);
        // $row = $this->db->fetch();
        // $hashed_password = $row->userPassword;
        // if (password_verify($password, $hashed_password)) {
        //     return $row;
        // } else {
        //     return false;
        // }





    }
    public function insertUser($data)
    { 
        $this->db->query("insert into userdoc(nom,prinom,isadmin,nameuser,passworduser,passworduserPD,timeu) value (:nom,:prinom,'no',:nameuser,:passworduser,:passworduserPD,now()); ");
        $this->db->bind(":nom", $data['dnom'] );
        $this->db->bind(":prinom", $data['dprenom'] );
        $this->db->bind(":nameuser", $data['dusername'] );
        $this->db->bind(":passworduser", $data['passworduser'] );
        $this->db->bind(":passworduserPD", $data['passworduserPD'] );
        if ($this->db->execute()) return true;
        else return false;
    }

    public function passEdeituser($nvopass)
    { 
        $idu=$_SESSION['user_id'];
        $this->db->query("update userdoc set passworduser=:passworduser, statut='1' where id=:idus;"); //update userdoc set passworduser="", statut='1' where id="";
        $this->db->bind(":passworduser", $nvopass);
        $this->db->bind(":idus", $idu);
        if ($this->db->execute()) return true;
        else return false;
    }



    public function deleteUserm($id)
    {
        $this->db->query("delete from userdoc where id=:iddc;");
        $this->db->bind(":iddc", $id);
        if ($this->db->execute()) return true;
        else return false;
    }
    
    public function edituserr($id,$data2,$data3,$data4)
    {
        $this->db->query("update userdoc set nom=:nomr,prinom=:prinomr,nameuser=:nameuserr where id=:iddc;");
        $this->db->bind(":iddc", $id);
        $this->db->bind(":nomr", $data2);
        $this->db->bind(":prinomr", $data3);
        $this->db->bind(":nameuserr", $data4);
        if ($this->db->execute()) return true;
        else return false;
    }

    //deactivateUserm($id)

    public function deactivateUserm($id)
    {
        $this->db->query('SELECT passworduserPD FROM userdoc WHERE id=:iddc;');
        $this->db->bind(":iddc",$id); 
        $row = $this->db->fetch();
        if(empty($row)){return false;}else{
        $passHach=password_hash($row->passworduserPD, PASSWORD_DEFAULT);
     
        $this->db->query("update userdoc set passworduser=:passworduser,statut=null where id=:iddc");
        $this->db->bind(":iddc", $id);
        $this->db->bind(":passworduser", $passHach);
        if ($this->db->execute()) return true;
        else return false;
    }
    }
    


}