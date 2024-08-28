<?php


class File{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function tagsInput(){
        $this->db->query("select typeTags,localisationTags from tagsInput where id=1;");
        $posts = $this->db->fetch();
        return $posts;
    }

    public function insertInput($type,$localisation){
        $this->db->query("update tagsInput set typeTags=:newtypeTags , localisationTags=:newlocalisationTags where id=1;");
        $this->db->bind(":newtypeTags",$type);
        $this->db->bind(":newlocalisationTags",$localisation);

        if ($this->db->execute()) return true;
        else return false;
    }

    public function getFiles()
    {
        $this->db->query("select U.prinom,U.nom,D.titreDoc,D.typeDoc,D.localisationDoc,D.timeF,D.ref from userdoc U inner join document D on U.id=D.idusr;");
        $posts = $this->db->fetchAll();
        if ($posts) return $posts;
        else return false;
    }

    public function getFilesById($vor,$parPage)
    {
        $this->db->query("select D.nameDoc,D.id,U.prinom,U.nom,D.titreDoc,D.typeDoc,D.localisationDoc,D.timeF,D.ref from userdoc U inner join document D on U.id=D.idusr order by D.id desc limit $vor,$parPage;");
        $posts = $this->db->fetchAll();
        if ($posts) return $posts;
        else return false;
    }
    public function getFilesByIdar($vor,$parPage)
    {
        $this->db->query("select D.nameDoc,D.id,U.prinom,U.nom,D.titreDoc,D.typeDoc,D.localisationDoc,D.timeF,D.ref from userdoc U inner join archiveDocument D on U.id=D.idusr order by D.id desc limit $vor,$parPage;");
        $posts = $this->db->fetchAll();
        if ($posts) return $posts;
        else return false;
    }
    
    public function searcHgetFilesById($vor,$parPage,$searchby)
    {                     
        $this->db->query("select D.nameDoc,D.id,U.prinom,U.nom,D.titreDoc,D.typeDoc,D.localisationDoc,D.timeF,D.ref from userdoc U inner join document D on U.id=D.idusr where (D.id LIKE '{$searchby}%' or U.prinom LIKE '{$searchby}%' or U.nom LIKE '{$searchby}%' or D.titreDoc LIKE '{$searchby}%' or D.typeDoc LIKE '{$searchby}%' or D.localisationDoc LIKE '{$searchby}%' or D.ref LIKE '{$searchby}%') order by D.id desc limit $vor,$parPage;");
        $posts = $this->db->fetchAll();
        if ($posts) return $posts;
        else return false;
    }
    public function searcHgetFilesByIdar($vor,$parPage,$searchby)
    {                     
        $this->db->query("select D.nameDoc,D.id,U.prinom,U.nom,D.titreDoc,D.typeDoc,D.localisationDoc,D.timeF,D.ref from userdoc U inner join archiveDocument D on U.id=D.idusr where (D.id LIKE '{$searchby}%' or U.prinom LIKE '{$searchby}%' or U.nom LIKE '{$searchby}%' or D.titreDoc LIKE '{$searchby}%' or D.typeDoc LIKE '{$searchby}%' or D.localisationDoc LIKE '{$searchby}%' or D.ref LIKE '{$searchby}%') order by D.id desc limit $vor,$parPage;");
        $posts = $this->db->fetchAll();
        if ($posts) return $posts;
        else return false;
    }
    
    public function getFilesByIduser($vor,$parPage)
    {
        $iduser=(int)$_SESSION['user_id'];
        $this->db->query("select nameDoc,id,titreDoc,typeDoc,localisationDoc,timeF,ref from document where idusr=$iduser order by id desc limit $vor,$parPage;");
        $posts = $this->db->fetchAll();
        if ($posts) return $posts;
        else return false;
    }

    public function getFilesByIduserar($vor,$parPage)
    {
        $iduser=(int)$_SESSION['user_id'];
        $this->db->query("select nameDoc,id,titreDoc,typeDoc,localisationDoc,timeF,ref from archiveDocument where idusr=$iduser order by id desc limit $vor,$parPage;");
        $posts = $this->db->fetchAll();
        if ($posts) return $posts;
        else return false;
    }
    
    public function searcHgetFilesByIduser($vor,$parPage,$searchby)
    {
        $iduser=(int)$_SESSION['user_id'];
        $this->db->query("select nameDoc,id,titreDoc,typeDoc,localisationDoc,timeF,ref from document where idusr=$iduser and (id LIKE '{$searchby}%' or titreDoc LIKE '{$searchby}%' or typeDoc LIKE '{$searchby}%' or localisationDoc LIKE '{$searchby}%' or timeF LIKE '{$searchby}%' or ref LIKE '{$searchby}%') order by id  desc limit $vor,$parPage;");
        $posts = $this->db->fetchAll();
        if ($posts) return $posts;
        else return false;
    }

    public function searcHgetFilesByIduserar($vor,$parPage,$searchby)
    {
        $iduser=(int)$_SESSION['user_id'];
        $this->db->query("select nameDoc,id,titreDoc,typeDoc,localisationDoc,timeF,ref from archiveDocument where idusr=$iduser and (id LIKE '{$searchby}%' or titreDoc LIKE '{$searchby}%' or typeDoc LIKE '{$searchby}%' or localisationDoc LIKE '{$searchby}%' or timeF LIKE '{$searchby}%' or ref LIKE '{$searchby}%') order by id  desc limit $vor,$parPage;");
        $posts = $this->db->fetchAll();
        if ($posts) return $posts;
        else return false;
    }

    public function countFiles($searchby=null)
    {
        if(empty($searchby)){
            $this->db->query("select count(*) as t from document");
        }else{
            $this->db->query("select count(*) as t from userdoc U inner join document D on U.id=D.idusr where (D.id LIKE '{$searchby}%' or U.prinom LIKE '{$searchby}%' or U.nom LIKE '{$searchby}%' or D.titreDoc LIKE '{$searchby}%' or D.typeDoc LIKE '{$searchby}%' or D.localisationDoc LIKE '{$searchby}%' or D.ref LIKE '{$searchby}%');");
        }
        $posts = $this->db->fetch();
        if ($posts) return $posts;
        else return false;
    }
    public function countFiles2($searchby=null)
    {
        $iduser=(int)$_SESSION['user_id'];
        if(empty($searchby)){
            $this->db->query("select count(*) as t from document where idusr=$iduser;");
        }else{ 
            $this->db->query("select count(*) as t from document where idusr=$iduser and (id LIKE '{$searchby}%' or titreDoc LIKE '{$searchby}%' or typeDoc LIKE '{$searchby}%' or localisationDoc LIKE '{$searchby}%' or timeF LIKE '{$searchby}%' or ref LIKE '{$searchby}%');");
        }
        $posts = $this->db->fetch();
        if ($posts) return $posts;
        else return false;
    }

    public function countFiles3($searchby=null)
    {
        $iduser=(int)$_SESSION['user_id'];
        if(empty($searchby)){
            $this->db->query("select count(*) as t from archiveDocument where idusr=$iduser;");
        }else{ 
            $this->db->query("select count(*) as t from archiveDocument where idusr=$iduser and (id LIKE '{$searchby}%' or titreDoc LIKE '{$searchby}%' or typeDoc LIKE '{$searchby}%' or localisationDoc LIKE '{$searchby}%' or timeF LIKE '{$searchby}%' or ref LIKE '{$searchby}%');");
        }
        $posts = $this->db->fetch();
        if ($posts) return $posts;
        else return false;
    }




    public function insertFiles($data1,$data2,$data3,$data4)
    { 
        $this->db->query("INSERT INTO document(nameDoc,idusr,titreDoc,typeDoc,localisationDoc,timeF) VALUES (:nameDoc,:idusr,:titreDoc,:typeDoc,:localisationDoc,now());");
        $this->db->bind(":nameDoc", $data1 );
        $this->db->bind(":idusr", $_SESSION['user_id']);
        $this->db->bind(":titreDoc", $data2);
        $this->db->bind(":typeDoc", $data3);
        $this->db->bind(":localisationDoc", $data4);

        if ($this->db->execute()) return true;
        else return false;
    }
    

    public function editFiles($id,$data2,$data3,$data4)
    {
    
   
        $this->db->query("update document set titreDoc=:titreDoc,typeDoc=:typeDoc,localisationDoc=:localisationDoc where id=:iddc;");
        $this->db->bind(":iddc", $id);
        $this->db->bind(":titreDoc", $data2);
        $this->db->bind(":typeDoc", $data3);
        $this->db->bind(":localisationDoc", $data4);

        if ($this->db->execute()) return true;
        else return false;
    }

    public function editFilesar($id,$data2,$data3,$data4)
    {
    
   
        $this->db->query("update archiveDocument set titreDoc=:titreDoc,typeDoc=:typeDoc,localisationDoc=:localisationDoc where id=:iddc;");
        $this->db->bind(":iddc", $id);
        $this->db->bind(":titreDoc", $data2);
        $this->db->bind(":typeDoc", $data3);
        $this->db->bind(":localisationDoc", $data4);

        if ($this->db->execute()) return true;
        else return false;
    }
    
    public function unarchive($id)
    {
        $this->db->query("call ps_unarchiveDC(:iddc);");
        $this->db->bind(":iddc", $id);
        if ($this->db->execute()) return true;
        else return false;
    }
    
    public function archivebyid($id)
    {
        $this->db->query("call ps_archiveDC(:iddc);");
        $this->db->bind(":iddc", $id);
        if ($this->db->execute()) return true;
        else return false;
    }

    public function deleteFiles($id)
    {
        $this->db->query("select nameDoc from document where id=:iddc;");
        $this->db->bind(":iddc", $id);
        $row = $this->db->fetch();
        if(empty($row)){
            return false;
        }else{
            $this->db->query("delete from document where id=:iddc;");
            $this->db->bind(":iddc", $id);
            $this->db->execute();
            return $row;

        }
    }

    public function deleteFilesar($id)
    {
        $this->db->query("select nameDoc from archiveDocument where id=:iddc;");
        $this->db->bind(":iddc", $id);
        $row = $this->db->fetch();
        if(empty($row)){
            return false;
        }else{
            $this->db->query("delete from archiveDocument where id=:iddc;");
            $this->db->bind(":iddc", $id);
            $this->db->execute();
            return $row;

        }
    }

    public function downlodFiles($id,$namedoc)
    {
        $this->db->query("select titreDoc,nameDoc,ref from document where idusr=:iddc and nameDoc=:namedoc limit 1;");
        $this->db->bind(":namedoc", $namedoc);
        $this->db->bind(":iddc", $id);
        $row = $this->db->fetch();
        if(empty($row)){
            return false;
        }else{
            return $row;
        }
    }

    public function downlodFilesar($id,$namedoc)
    {
        $this->db->query("select titreDoc,nameDoc,ref from archiveDocument where idusr=:iddc and nameDoc=:namedoc limit 1;");
        $this->db->bind(":namedoc", $namedoc);
        $this->db->bind(":iddc", $id);
        $row = $this->db->fetch();
        if(empty($row)){
            return false;
        }else{
            return $row;
        }
    }

}