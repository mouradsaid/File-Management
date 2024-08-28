<?php include_once 'inc/header.php';?>
<?php include_once 'inc/nav.php';?>


<br><br>



<div class="container">

<div class="row">
<div class="col-xs-3"> 
<input type="text" class="form-control" placeholder='Search' id="idinput">
</div>
</div>

  <div class="table-responsive">
    <div class="table-wrapper">
      <div class="table-title">
        <div class="row">
          <div class="col-xs-6">  
            
            
          </div>
          <div class="col-xs-6">
            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter Utilisateur</span></a>
          </div>
        </div>
      </div>
 


      <div id="altdata">
    </div>






  </div>        
  </div>


  <script>

$(document).ready(function(){
  $.ajax({
                 url:"<?php echo URLROOT;  ?>users/searcHlistUtilisateurs",
                 method:"post",
                 data:{input:""},
                 success:function(data){
                     $("#altdata").html(data);
                 }
             });
    $("#idinput").keyup(function(){
        var input=$(this).val();
        if(input !=""){

             $.ajax({
                 url:"<?php echo URLROOT;  ?>users/searcHlistUtilisateurs",
                 method:"post",
                 data:{input:input},
                 success:function(data){
                     $("#altdata").html(data);
                 }
             });

        }else{
          $.ajax({
                 url:"<?php echo URLROOT;  ?>users/searcHlistUtilisateurs",
                 method:"post",
                 data:{input:""},
                 success:function(data){
                     $("#altdata").html(data);
                 }
             });
        }
    });
});
</script>





<?php include_once 'inc/motPass.php';?>
<?php include_once 'inc/footer.php';?>
