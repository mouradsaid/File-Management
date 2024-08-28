  
  <nav class="navbar navbar-default navbar-expand-lg navbar-light">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Gestion<b>Document</b></a>  		
      <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
        <span class="navbar-toggler-icon"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">

        <li><a href="<?php echo URLROOT;  ?>Users/logout">Déconnecter</a></li>
        <li><a href="#motPass" id="a1" data-toggle="modal">Changer le mot pass</a></li>  
        <li><a href="<?php echo URLROOT;  ?>files/fichier">Mon fichier</a></li>
        <li><a href="<?php echo URLROOT;  ?>files/archive">Mon archive</a></li>
        <?php   //if($_SESSION['user_dm']=='ok'){ ?>
        <!-- <li><a href="<?php //echo URLROOT;  ?>users/listUtilisateurs">Liste des utilisateurs</a></li>	
        <li><a href="<?php //echo URLROOT;  ?>files/index">Liste des fichier</a></li>
        <li><a href="<?php //echo URLROOT;  ?>files/fichier">Mon fichier</a></li> -->
        <?php //} ?>	
        <?php   if($_SESSION['user_dm']=='ok'){ ?>
      <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">Services <b class="caret"></b></a>
          <ul class="dropdown-menu">

            
            <li><a href="<?php echo URLROOT;  ?>files/parametres" id="a1" data-toggle="modal">Paramètres</a></li>
            <li><a href="<?php echo URLROOT;  ?>users/listUtilisateurs">Liste des utilisateurs</a></li>	
            <li><a href="<?php echo URLROOT;  ?>files/index">Liste des fichier</a></li>
            <li><a href="<?php echo URLROOT;  ?>files/indexar">archive</a></li>
            

          </ul>
      </li> 
      <?php } ?>	


      </ul>
    </div>
  </nav>


  