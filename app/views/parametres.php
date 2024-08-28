



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>test</title>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
<link href="<?php echo URLROOT;  ?>js/jquery.flexdatalist.css" rel="stylesheet" type="text/css">
<style>
body { font-family:'Open Sans'; background-color:#fafafa;}
.container { margin:150px auto 30px auto;}
h2 { margin:20px auto;}
.button2 {
  background-color: #0497aa; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
 .button2:hover{
  background-color: #015a66; /* Green */

 } 
</style>
</head>


<body><div id="jquery-script-menu">
<div class="jquery-script-center">
<ul>
<li><a href="<?php echo URLROOT;  ?>users/listUtilisateurs">Liste des utilisateurs</a></li>
<li><a href="<?php echo URLROOT;  ?>files/index">Liste des fichier</a></li>
</ul>
<div class="jquery-script-ads">

</div>
<div class="jquery-script-clear"></div>
</div>
</div>
<div class="container">



<h2>Type de fichier</h2>
<input type='text' id="dtype" placeholder='type' class='flexdatalist form-control' data-min-length='1' data-searchContain='true' multiple='multiple' name='skill1' value="<?php echo $data["type"]; ?>">

<br><br>
<h2>Localisation</h2>
<input type='text' id="dlocalisation" placeholder='localisation' class='flexdatalist form-control' data-min-length='1' data-searchContain='true' multiple='multiple' name='skill2' value="<?php echo $data["localisationTags"]; ?>">


<br>

<button class="button2" id="sendData" style="display:none;">save</button>



<script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="<?php echo URLROOT;  ?>js/jquery.flexdatalist.js"></script>




<script>

$(document).ready(function(){

  $("#dtype").change(function(){
    $("#sendData").css("display","block");
  });

  $("#dlocalisation").change(function(){
    $("#sendData").css("display","block");
  });


  $("#sendData").on('click',function(event){
  
            var type=$("#dtype").val();
            var localisation=$("#dlocalisation").val();
             $.ajax({
                         url:"<?php echo URLROOT;  ?>files/editTags",
                         method:"post",
                         data:{dtype:type,dlocalisation:localisation},
                         success:function(data){
                            location.reload();
                         }
                     });
          })

});




</script>

</body>
</html>