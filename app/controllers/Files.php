<?php

class Files extends Controller{

    public function __construct(){
        $this->fileModel=$this->model('File');
    }

    public function parametres()
    {
        $rs=$this->fileModel->tagsInput();
        $data=[
            'type'=>$rs->typeTags,
            'localisationTags'=>$rs->localisationTags,
        ];
        $this->view('parametres',$data);
    }


    public function editTags()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            echo $_POST["dtype"]." ".$_POST["dlocalisation"];
            $type=$_POST["dtype"];
            $localisation=$_POST["dlocalisation"];
            if(!empty($type) && !empty($localisation)){
                $this->fileModel->insertInput($type,$localisation);
            }

        }else{
            redirect('files/parametres');
        }
    }



    public function index($id=null)
    {
        if(empty($_SESSION['user_id']) || empty($_SESSION['user_name']) || empty($_SESSION['user_dm']) || $_SESSION['user_dm']=='no'){
            redirect('users/login');
        }else{
            $this->view('panal');
         }    
    }
    

    public function indexSreach()
    {
        if(empty($_SESSION['user_id']) || empty($_SESSION['user_name']) || empty($_SESSION['user_dm']) || $_SESSION['user_dm']=='no'){
            redirect('users/login');
        }else{
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if(!empty($_POST['input'])){$searchby=$_POST['input'];}else{$searchby=null;};
            if(empty($_POST['id'])){$id=1;}else{$id=(int)$_POST['id'];}

            $rsp=$this->fileModel->countFiles($searchby)->t;
            $parPage=3;
            $page= ceil($rsp/$parPage);  
            $id=(int) $id;
            if(empty($id) || !is_int($id) ){$id=1;}
            if($rsp>0){ 
            if($page>=$id && $id>=1){
                $vor=($id-1)*$parPage;
                $id1=$id-2;
                $id2=$id-1;
                $id4=$id+1;
                $id5=$id+2;
                if($id-2<0)$id1=0;
                if($id-1<0)$id2=0;
                if($id+1>$page)$id4=0;
                if($id+2>$page)$id5=0;


                if(empty($searchby)){
                    $data= [
                        'data'=>$this->fileModel->getFilesById($vor,$parPage),
                        'totalElmen'=>$parPage*$page,
                        'totalPage'=>$page,
                        'Page1'=> $id1,
                        'Page2'=>$id2,
                        'thisPage'=>$id,
                        'Page4'=>$id4,
                        'Page5'=>$id5,
                    ];

                }else{
                $data= [
                    'data'=>$this->fileModel->searcHgetFilesById($vor,$parPage,$searchby),
                    'totalElmen'=>$parPage*$page,
                    'totalPage'=>$page,
                    'Page1'=> $id1,
                    'Page2'=>$id2,
                    'thisPage'=>$id,
                    'Page4'=>$id4,
                    'Page5'=>$id5,
                ];
            }



                $this->view('search/spanal',$data);
            }else{
                echo '404';
                die();
            } }else{

                $data= [
                    'data'=>'',
                    'totalElmen'=>0,
                    'totalPage'=>0,
                    'Page1'=> 0,
                    'Page2'=>0,
                    'thisPage'=>0,
                    'Page4'=>0,
                    'Page5'=>0,
                ];
                $this->view('search/spanal',$data);
            }}
    }






    public function registerFile(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $fileN=$_FILES['ddocument']['name'];
            if(!empty($fileN)){

          
            $rext=['jpg','png','xlsx','xls','doc','docx','ppt','pptx','txt','pdf','zip','rar', 'jpeg','bmp','webp'];
            $filetype=$_FILES['ddocument']['type'];
            $filesize=$_FILES['ddocument']['size'];
            $fileN=$_FILES['ddocument']['name'];
            $size=100*1024*1024;
            $extension=pathinfo($fileN,PATHINFO_EXTENSION);
            $newname=uniqid().time().'.'.$extension;


            $data = [
                'dtitre' => $_POST['dtitre'],
                'dtype' => $_POST['dtype'],
                'dlocalisation' => $_POST['dlocalisation'],
                'namefile'=>$newname,
                'dtitre_err' => '',
                'dtype_err' => '',
                'dlocalisation_err' => '',
            ];

            if (empty($data['dtitre'])) $data['dtitre_err'] = 'Please fill';
            if (empty($data['dtype'])) $data['dtype_err'] = 'Please fill';
            if (empty($data['dlocalisation'])) $data['dlocalisation_err'] = 'Please fill';



            if(in_array($extension,$rext) && ($size>=$filesize) && empty($data['dtitre_err']) && empty($data['dtype_err']) && empty($data['dlocalisation_err'])){

                $data1=$data['namefile'];
                $data2=$data['dtitre'];
                $data3=$data['dtype'];
                $data4=$data['dlocalisation'];
                if ($this->fileModel->insertFiles($data1,$data2,$data3,$data4)) {
                    $dirpath=realpath(dirname(getcwd()));
                    move_uploaded_file($_FILES['ddocument']['tmp_name'],$dirpath."/public/upload/".$newname);  
                    redirect('files/fichier');
                } else {
                    die("something went wrong!!");
                }

            }else{
                redirect('files/fichier');
                die();
            }
        }else{
            redirect('files/fichier');
            die();
        }
        } else {
            redirect('files/fichier');
            die();
        }
    }
    public function editFile($id)
    {

        $id=(int)$id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && is_int($id)) {
            $data = [
                'dtitre' => $_POST['dtitre'],
                'dtype' => $_POST['dtype'],
                'dlocalisation' => $_POST['dlocalisation'],
                'dtitre_err' => '',
                'dtype_err' => '',
                'dlocalisation_err' => '',
            ];
            if (empty($data['dtitre'])) $data['dtitre_err'] = 'Please fill';
            if (empty($data['dtype'])) $data['dtype_err'] = 'Please fill';
            if (empty($data['dlocalisation'])) $data['dlocalisation_err'] = 'Please fill';


            if(empty($data['dtitre_err']) && empty($data['dtype_err']) && empty($data['dlocalisation_err'])){

          
                $data2=$data['dtitre'];
                $data3=$data['dtype'];
                $data4=$data['dlocalisation'];
                if ($this->fileModel->editFiles($id,$data2,$data3,$data4)) {
                    redirect('files');
                } else {
                    die("something went wrong!!");
                }

            }else{
                redirect('files');
                die();
            }



        }else {
            redirect('files');
            die();
        }
    }

    

    public function deleteFile($id)
    {
        $id=(int)$id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && is_int($id)) {

            $st=$this->fileModel->deleteFiles($id);

            if ($st==false) {
                redirect('files');
            } else {
                $newname=$st->nameDoc;
                $dirpath=realpath(dirname(getcwd()));
                unlink($dirpath."/public/upload/".$newname); 
                redirect('files');
            }
        }else{
            redirect('files');
          
        }
    }


    public function fichier()
    {
        if(empty($_SESSION['user_id']) || empty($_SESSION['user_name']) || empty($_SESSION['user_dm'])){
            redirect('users/login');
        }else{
                $this->view('fichier'); 
        }
    }

    public function searchFicher()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(empty($_SESSION['user_id']) || empty($_SESSION['user_name']) || empty($_SESSION['user_dm'])){
            echo "404";
            die();
        }else{
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if(!empty($_POST['input'])){$searchby=$_POST['input'];}else{$searchby=null;}
            if(empty($_POST['id'])){$id=1;}else{$id=(int)$_POST['id'];}
            $rsp=$this->fileModel->countFiles2($searchby)->t;
            $rs=$this->fileModel->tagsInput();
            $parPage=3; //ajout number element par page
            $page= ceil($rsp/$parPage);  
            if(empty($id) || !is_int($id) ){$id=1;}
            if($rsp>0){ 
            if($page>=$id && $id>=1){
                $vor=($id-1)*$parPage;
                $id1=$id-2;
                $id2=$id-1;
                $id4=$id+1;
                $id5=$id+2;
                if($id-2<0)$id1=0;
                if($id-1<0)$id2=0;
                if($id+1>$page)$id4=0;
                if($id+2>$page)$id5=0;

                if(empty($searchby)){
                    
                    $data= [
                        'data'=>$this->fileModel->getFilesByIduser($vor,$parPage),
                        'totalElmen'=>$parPage*$page,
                        'totalPage'=>$page,
                        'Page1'=> $id1,
                        'Page2'=>$id2,
                        'thisPage'=>$id,
                        'Page4'=>$id4,
                        'Page5'=>$id5,
                        'type'=>explode(",",$rs->typeTags),
                        'localisationTags'=>explode(",",$rs->localisationTags),               
                    ];
                }else{
                $data= [
                    'data'=>$this->fileModel->searcHgetFilesByIduser($vor,$parPage,$searchby),
                    'totalElmen'=>$parPage*$page,
                    'totalPage'=>$page,
                    'Page1'=> $id1,
                    'Page2'=>$id2,
                    'thisPage'=>$id,
                    'Page4'=>$id4,
                    'Page5'=>$id5,
                    'type'=>explode(",",$rs->typeTags),
                    'localisationTags'=>explode(",",$rs->localisationTags),     
                ];}
                $this->view('search/sfichier',$data);
            }else{
                echo '404';
                die();
            } }else{
                $data= [
                    'data'=>'',
                    'totalElmen'=>0,
                    'totalPage'=>0,
                    'Page1'=> 0,
                    'Page2'=>0,
                    'thisPage'=>0,
                    'Page4'=>0,
                    'Page5'=>0,
                    'type'=>explode(",",$rs->typeTags),
                    'localisationTags'=>explode(",",$rs->localisationTags),     
                ];
                $this->view('search/sfichier',$data);
            }
        }
    }
    }


    public function pg404(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        echo $_POST['test'];
    }


    public function downlod($nameFile){
        if(empty($nameFile)){
            echo 'File does not exist.';
            die();
        }else{
            $idu=$_SESSION["user_id"];
            $row=$this->fileModel->downlodFiles($idu,$nameFile);
            if($row){
                $dirpath=realpath(dirname(getcwd()));
                $filePath= $dirpath.'/public/upload/'.$row->nameDoc;
                $titel = $row->ref."_".$row->titreDoc.".".pathinfo($row->nameDoc,PATHINFO_EXTENSION);
                if (file_exists($filePath)) {
                    $mimeTypes = [
                        'jpg'  => 'image/jpeg',
                        'jpeg' => 'image/jpeg',
                        'png'  => 'image/png',
                        'bmp'  => 'image/bmp',
                        'webp' => 'image/webp',
                        'xls'  => 'application/vnd.ms-excel',
                        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'doc'  => 'application/msword',
                        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'ppt'  => 'application/vnd.ms-powerpoint',
                        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                        'txt'  => 'text/plain',
                        'pdf'  => 'application/pdf',
                        'zip'  => 'application/zip',
                        'rar'  => 'application/x-rar-compressed'
                    ];
                    header('Content-Description: File Transfer');
                    header('Content-Type: ' . $mimeType);
                    header('Content-Disposition: attachment; filename="' . $titel . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($filePath));
                    ob_clean();
                    flush();
                    readfile($filePath);
                    exit;
                } else {
                    echo 'File does not exist.';
                    die();
                }

            }else{
                echo 'File does not exist.';
                die();
            }
        }
    }

    public function archivepyid($id)
    {
        $id=(int)$id;
        if (is_int($id)) {
            $st=$this->fileModel->archivebyid($id);
            redirect('files/fichier');
        }else{
            redirect('files/fichier');
        }
    }









































    public function archive()
    {
        if(empty($_SESSION['user_id']) || empty($_SESSION['user_name']) || empty($_SESSION['user_dm'])){
            redirect('users/login');
        }else{
            $this->view('monar');
        }
    }

    public function searcharchive()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(empty($_SESSION['user_id']) || empty($_SESSION['user_name']) || empty($_SESSION['user_dm'])){
            echo "404";
            die();
        }else{
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if(!empty($_POST['input'])){$searchby=$_POST['input'];}else{$searchby=null;}
            if(empty($_POST['id'])){$id=1;}else{$id=(int)$_POST['id'];}
            $rsp=$this->fileModel->countFiles3($searchby)->t;
            $rs=$this->fileModel->tagsInput();
            $parPage=3; //ajout number element par page
            $page= ceil($rsp/$parPage);  
            if(empty($id) || !is_int($id) ){$id=1;}
            if($rsp>0){ 
            if($page>=$id && $id>=1){
                $vor=($id-1)*$parPage;
                $id1=$id-2;
                $id2=$id-1;
                $id4=$id+1;
                $id5=$id+2;
                if($id-2<0)$id1=0;
                if($id-1<0)$id2=0;
                if($id+1>$page)$id4=0;
                if($id+2>$page)$id5=0;

                if(empty($searchby)){
                    
                    $data= [
                        'data'=>$this->fileModel->getFilesByIduserar($vor,$parPage),
                        'totalElmen'=>$parPage*$page,
                        'totalPage'=>$page,
                        'Page1'=> $id1,
                        'Page2'=>$id2,
                        'thisPage'=>$id,
                        'Page4'=>$id4,
                        'Page5'=>$id5, 
                        'type'=>explode(",",$rs->typeTags),
                        'localisationTags'=>explode(",",$rs->localisationTags),              
                    ];
                }else{
                $data= [
                    'data'=>$this->fileModel->searcHgetFilesByIduserar($vor,$parPage,$searchby),
                    'totalElmen'=>$parPage*$page,
                    'totalPage'=>$page,
                    'Page1'=> $id1,
                    'Page2'=>$id2,
                    'thisPage'=>$id,
                    'Page4'=>$id4,
                    'Page5'=>$id5,
                    'type'=>explode(",",$rs->typeTags),
                    'localisationTags'=>explode(",",$rs->localisationTags),   
                ];}
                $this->view('search/smonar',$data);
            }else{
                echo '404';
                die();
            } }else{
                $data= [
                    'data'=>'',
                    'totalElmen'=>0,
                    'totalPage'=>0,
                    'Page1'=> 0,
                    'Page2'=>0,
                    'thisPage'=>0,
                    'Page4'=>0,
                    'Page5'=>0,
                    'type'=>explode(",",$rs->typeTags),
                    'localisationTags'=>explode(",",$rs->localisationTags),   
                ];
                $this->view('search/smonar',$data);
            }
        }
    }
    }

    
    public function editarchive($id)
    {

        $id=(int)$id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && is_int($id)) {
            $data = [
                'dtitre' => $_POST['dtitre'],
                'dtype' => $_POST['dtype'],
                'dlocalisation' => $_POST['dlocalisation'],
                'dtitre_err' => '',
                'dtype_err' => '',
                'dlocalisation_err' => '',
            ];
            if (empty($data['dtitre'])) $data['dtitre_err'] = 'Please fill';
            if (empty($data['dtype'])) $data['dtype_err'] = 'Please fill';
            if (empty($data['dlocalisation'])) $data['dlocalisation_err'] = 'Please fill';


            if(empty($data['dtitre_err']) && empty($data['dtype_err']) && empty($data['dlocalisation_err'])){

          
                $data2=$data['dtitre'];
                $data3=$data['dtype'];
                $data4=$data['dlocalisation'];
                if ($this->fileModel->editFilesar($id,$data2,$data3,$data4)) {
                    redirect('files/archive');
                } else {
                    die("something went wrong!!");
                }

            }else{
                redirect('files/archive');
                die();
            }



        }else {
            redirect('files/archive');
            die();
        }
    }

    public function deleteFilear($id)
    {
        $id=(int)$id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && is_int($id)) {

            $st=$this->fileModel->deleteFilesar($id);

            if ($st==false) {
                redirect('files');
            } else {
                $newname=$st->nameDoc;
                $dirpath=realpath(dirname(getcwd()));
                unlink($dirpath."/public/upload/".$newname); 
                redirect('files/archive');
            }
        }else{
            redirect('files/archive');
          
        }
    }


    public function unarchive($id)
    {
        $id=(int)$id;
        if (is_int($id)) {
            $st=$this->fileModel->unarchive($id);
            redirect('files/archive');
        }else{
            redirect('files/archive');
        }
    }



    public function downlodar($nameFile){
        if(empty($nameFile)){
            echo 'File does not exist.';
            die();
        }else{
            $idu=$_SESSION["user_id"];
            $row=$this->fileModel->downlodFilesar($idu,$nameFile);
            if($row){
                $dirpath=realpath(dirname(getcwd()));
                $filePath= $dirpath.'/public/upload/'.$row->nameDoc;
                $titel = $row->ref."_".$row->titreDoc.".".pathinfo($row->nameDoc,PATHINFO_EXTENSION);
                if (file_exists($filePath)) {
                    $mimeTypes = [
                        'jpg'  => 'image/jpeg',
                        'jpeg' => 'image/jpeg',
                        'png'  => 'image/png',
                        'bmp'  => 'image/bmp',
                        'webp' => 'image/webp',
                        'xls'  => 'application/vnd.ms-excel',
                        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'doc'  => 'application/msword',
                        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'ppt'  => 'application/vnd.ms-powerpoint',
                        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                        'txt'  => 'text/plain',
                        'pdf'  => 'application/pdf',
                        'zip'  => 'application/zip',
                        'rar'  => 'application/x-rar-compressed'
                    ];
                    header('Content-Description: File Transfer');
                    header('Content-Type: ' . $mimeType);
                    header('Content-Disposition: attachment; filename="' . $titel . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($filePath));
                    ob_clean();
                    flush();
                    readfile($filePath);
                    exit;
                } else {
                    echo 'File does not exist.';
                    die();
                }

            }else{
                echo 'File does not exist.';
                die();
            }
        }
    }

//_____________________________________________________________________________________

public function indexar($id=null)
{
    if(empty($_SESSION['user_id']) || empty($_SESSION['user_name']) || empty($_SESSION['user_dm']) || $_SESSION['user_dm']=='no'){
        redirect('users/login');
    }else{
        $this->view('panalar');
     }    
}


public function indexSreachar()
{
    if(empty($_SESSION['user_id']) || empty($_SESSION['user_name']) || empty($_SESSION['user_dm']) || $_SESSION['user_dm']=='no'){
        redirect('users/login');
    }else{
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(!empty($_POST['input'])){$searchby=$_POST['input'];}else{$searchby=null;};
        if(empty($_POST['id'])){$id=1;}else{$id=(int)$_POST['id'];}

        $rsp=$this->fileModel->countFiles3($searchby)->t;
        $parPage=3;
        $page= ceil($rsp/$parPage);  
        $id=(int) $id;
        if(empty($id) || !is_int($id) ){$id=1;}
        if($rsp>0){ 
        if($page>=$id && $id>=1){
            $vor=($id-1)*$parPage;
            $id1=$id-2;
            $id2=$id-1;
            $id4=$id+1;
            $id5=$id+2;
            if($id-2<0)$id1=0;
            if($id-1<0)$id2=0;
            if($id+1>$page)$id4=0;
            if($id+2>$page)$id5=0;


            if(empty($searchby)){
                $data= [
                    'data'=>$this->fileModel->getFilesByIdar($vor,$parPage),
                    'totalElmen'=>$parPage*$page,
                    'totalPage'=>$page,
                    'Page1'=> $id1,
                    'Page2'=>$id2,
                    'thisPage'=>$id,
                    'Page4'=>$id4,
                    'Page5'=>$id5,
                ];

            }else{
            $data= [
                'data'=>$this->fileModel->searcHgetFilesByIdar($vor,$parPage,$searchby),
                'totalElmen'=>$parPage*$page,
                'totalPage'=>$page,
                'Page1'=> $id1,
                'Page2'=>$id2,
                'thisPage'=>$id,
                'Page4'=>$id4,
                'Page5'=>$id5,
            ];
        }



            $this->view('search/spanalar',$data);
        }else{
            echo '404';
            die();
        } }else{

            $data= [
                'data'=>'',
                'totalElmen'=>0,
                'totalPage'=>0,
                'Page1'=> 0,
                'Page2'=>0,
                'thisPage'=>0,
                'Page4'=>0,
                'Page5'=>0,
            ];
            $this->view('search/spanalar',$data);
        }}
}


    































}