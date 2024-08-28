<?php

class Users extends Controller{
   public function __construct(){
    $this -> userModel = $this->model('User');
   }

   public function index()
   {
    echo '404';
    die();
   }




   public function listUtilisateurs($id=null){
    if(empty($_SESSION['user_id']) || empty($_SESSION['user_name']) || empty($_SESSION['user_dm']) || $_SESSION['user_dm'] !='ok' ){
        redirect('users/login');
    }else{
    $this->view('utilisateurs');   
    }
   }

   public function searcHlistUtilisateurs(){
    if(empty($_SESSION['user_id']) || empty($_SESSION['user_name']) || empty($_SESSION['user_dm']) || $_SESSION['user_dm'] !='ok' ){
        redirect('users/login');
    }else{
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if(!empty($_POST['input'])){$searchby=$_POST['input'];}else{$searchby=null;};
        if(empty($_POST['id'])){$id=1;}else{$id=(int)$_POST['id'];}

        $rsp=$this->userModel->countUsers($searchby)->t;
        $parPage=3;
        $page= ceil(($rsp)/$parPage);  
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
                    'data'=>$this->userModel->getUsersById($vor,$parPage),
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
                    'data'=>$this->userModel->searcHgetUsersById($vor,$parPage,$searchby),
                    'totalElmen'=>$parPage*$page,
                    'totalPage'=>$page,
                    'Page1'=> $id1,
                    'Page2'=>$id2,
                    'thisPage'=>$id,
                    'Page4'=>$id4,
                    'Page5'=>$id5,
                    '222'=>'55',
                ];
            }

     
            $this->view('search/sutilisateurs',$data);
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
            $this->view('search/sutilisateurs',$data);


        }
    }
   }



   public function register(){
    if(empty($_SESSION['user_id']) && empty($_SESSION['user_name']) && empty($_SESSION['user_dm']) && $_SESSION['user_dm'] !='ok' ){
        redirect('users/login');
    }else{

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $data = [
                'dnom' => $_POST['dnom'],
                'dprenom' => $_POST['dprenom'],
                'dusername'=> $_POST['dusername'],
                'dnom_err' => '',
                'dprenom_err' => '',
                'dusername_err' => '',
            ];

            if (empty($data['dnom'])) $data['dnom_err'] = 'Please fill';
            if (empty($data['dprenom'])) $data['dprenom_err'] = 'Please fill';
            if (empty($data['dusername'])) $data['dusername_err'] = 'Please fill';

            if(empty($data['dnom_err']) && empty($data['dprenom_err']) && empty($data['username_err'])){  
                //$data['nameuser']= $data['dnom'][0].$data['dprenom'][0].getRandomstr(2).getRandomNumber(4);
                $data['passworduserPD']=getRandomstr(6);
                $data['passworduser']= password_hash($data['passworduserPD'], PASSWORD_DEFAULT);

                // echo password_hash('123', PASSWORD_DEFAULT);
                // die();

                if ($this->userModel->insertUser($data)) {   
                    redirect('users/listUtilisateurs');
                } else {
                    die("something went wrong!!");
                }

            }else{
                echo '404';
                die();
            }

        } else {
            redirect('users/listUtilisateurs');
            die();
        }
    }}




   public function login(){

    if(!empty($_SESSION['user_id']) && !empty($_SESSION['user_name']) && !empty($_SESSION['user_dm']) ){
        redirect('files'); 
    }else{

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $data=[
        'username'=>$_POST['username'],
        'password'=>$_POST['password'],
        'username_er'=>'',
        'password_er'=>''
    ];

    if(empty($data['username'])) $data['username_er'] = 'Identifiant ou mot de pass incorrect';
    if(empty($data['password'])) $data['username_er'] = 'Identifiant ou mot de pass incorrect';


    if(empty($data['username_er']) && empty($data['username_er'])){
        $user= $this->userModel->login($data['username'],$data['password']);
        if($user){
            $_SESSION['user_id_nameuser']=$user->nameuser;
            $_SESSION['user_id']=$user->id;
            $_SESSION['user_name']=$user->prinom;
            $_SESSION['user_dm']=$user->isadmin;
            if($_SESSION['user_id']=='ok'){redirect('files');}else{redirect("files/fichier");}
        }else{
            $data['username_er'] = 'Identifiant ou mot de pass incorrect';
            $this->view('login',$data);
        }
    }else{
        $this->view('login',$data['username_er']);
    }
    }else{
        $this->view('login');
    }
   }
}

    public function logout()
    {
        $_SESSION['user_id']=null;
        $_SESSION['user_name']=null;
        $_SESSION['user_dm']=null;
        session_destroy();
        redirect('users/login');
    }

    public function passedeitu(){
        if(empty($_SESSION['user_id']) || empty($_SESSION['user_name']) || empty($_SESSION['user_dm']) ){
            echo "404";
            die();
        }else{ 

            if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['dancien']) && !empty($_POST['dnouveau'])&& !empty($_POST['dconfirmation'])){

             
                $data=[
                    'dancien'=>$_POST['dancien'],
                    'dnouveau'=>$_POST['dnouveau'],
                    'dconfirmation'=>$_POST['dconfirmation'],
                    'dancien_er'=>'',
                    'dnouveau_er'=>'',
                    'dconfirmation_er'=>'',
                    'st'=>''
                ];

                if(empty($data["dancien"])){$data["dancien_er"]="Le mot de pass est incorrect";}else{
                    $user=$_SESSION['user_id_nameuser'];
                    $user= $this->userModel->login($user,$data["dancien"]);
                    if($user==false){$data["dancien_er"]="Le mot de pass est incorrect";}
                }

                if(empty($data["dnouveau"])){$data["dnouveau_er"]="Entrer un nouveau mot de passe";}else{if(strlen($data["dnouveau"])<6){$data["dnouveau_er"]="Le mot de pass est trop court";}}

                if($data["dnouveau"]!=$data["dconfirmation"]){$data["dconfirmation_er"]="Le mot de pass ne correspond pas";}

                if(empty($data['dancien_er']) && empty($data['dnouveau_er']) && empty($data['dconfirmation_er'])){
                    $passHash=password_hash($data['dnouveau'], PASSWORD_DEFAULT);
                    $rp=$this->userModel->passEdeituser($passHash);
                    if($rp){
                        $data['st']=true;
             
                    }
                };

                $data['dancien']="";
                $data['dnouveau']="";
                $data['dconfirmation']="";
                $this->view('inc/dt',$data);


            }else{
                $data=[
                    'dancien'=>'',
                    'dnouveau'=>'',
                    'dconfirmation'=>'',
                    'dancien_er'=>'Remplissez tout les champs',
                    'dnouveau_er'=>'Remplissez tout les champs',
                    'dconfirmation_er'=>'Remplissez tout les champs',
                    'st'=>''
                ];
                $this->view('inc/dt',$data);
            }}}

    public function deleteUser($id)
    {
        $id=(int)$id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && is_int($id)) {
        
            if ($this->userModel->deleteUserm($id)) {
                redirect('users/listUtilisateurs');
            } else {
                die("something went wrong!!");
            }
                }else{
                    redirect('users/listUtilisateurs');
                    die();
                }
            }            


            public function edituser($id)
            {
        
                $id=(int)$id;
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && is_int($id)) {
                    $data = [
                        'dmon' => $_POST['dmon'],
                        'dprinom' => $_POST['dprinom'],
                        'dusername'=>$_POST['dusername'],
                        'dmon_err' => '',
                        'dprinom_err' => '',
                        'dusername_err' => '',
                    ];
                    if (empty($data['dmon'])) $data['dtitre_err'] = 'Please fill';
                    if (empty($data['dprinom'])) $data['dtype_err'] = 'Please fill';
                    if (empty($data['dusername'])) $data['dusername_err'] = 'Please fill';
                
        
        
                    if(empty($data['dmon_err']) && empty($data['dprinom_err']) && empty($data['dusername_err'])){
        
                  
                        $data2=$data['dmon'];
                        $data3=$data['dprinom'];
                        $data4=$data['dusername'];
                    
                        if ($this->userModel->edituserr($id,$data2,$data3,$data4)) {
                            redirect('users/listUtilisateurs');
                        } else {
                            die("something went wrong!!");
                        }
        
                    }else{
                        redirect('users/listUtilisateurs');
                        die();
                    }
        
        
        
                }else {
                    redirect('users/listUtilisateurs');
                    die();
                }
            }        


            

    public function deactivate($id)
    {
        $id=(int)$id;
        if (is_int($id) && $_SESSION['user_dm'] =='ok') {
            if ($this->userModel->deactivateUserm($id)) {
                redirect('users/listUtilisateurs');
            } else {
                die("something went wrong!!");
            }
                }else{
                    redirect('users/listUtilisateurs');
                    die();
                }
    }                




}