<table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Nom et prénom</th>
            <th>Nom d'utilisateur</th>
            <th>Date de l'inscription</th>
            <th>Mot de pass par défaut</th>
            <th>Nombre de fichiers</th>
            <th>Statut du compte</th>   <!--actif inactif -->
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>

        <?php if(!empty($data['data']) ){foreach ($data['data'] as $usr) : ?>
          <tr>
            <td><?php echo  $usr->id ; ?></td>
            <td><?php echo  $usr->prinom.' '.$usr->nom ; ?></td>
            <td><?php echo  $usr->nameuser ; ?></td>
            <td><?php echo  $usr->timeu ; ?></td>
            <td><?php echo  $usr->passworduserPD ; ?></td>
            <td><?php echo  $usr->totalFile ; ?></td>
            <td><?php if(empty($usr->statut)){echo "<div id='status-dotuf'></div> Inactive";}else{echo "<div id='status-dotun'></div> Active";}?></td>
            <td>
              <a href="#editEmployeeModal<?php echo  $usr->id ; ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
              <a href="#deleteEmployeeModal<?php echo  $usr->id ; ?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
              <?php if(!empty($usr->statut)){  ?>
              <a href="#rf<?php echo  $usr->id ; ?>" class="deletem" data-toggle="modal"><i class="material-icons">cached</i></a>
              <?php }  ?>
            </td>
          </tr>
        <?php endforeach;}; ?>
        </tbody>
      </table>
      <div class="clearfix">


        <div class="hint-text">Showing <b><?php if(!empty($data['data'])){echo count($data['data']);};  ?></b> out of <b><?php if(!empty($data['data'])){echo $data['totalElmen'];};   ?></b> entries</div>
        <ul class="pagination">
        <?php if($data['Page2']>0){echo '<li class="pageSearch page-item" id="" dataid="'.$data['Page2'].'"><a href="#">Previous</a></li>';}else{echo '<li class="page-item disabled"><a href="#">Previous</a></li>';} ?>
          <?php if($data['Page1']>0)echo '<li class="pageSearch page-item" dataid="'.$data['Page1'].'"><a href="#" class="page-link">'.$data['Page1'].'</a></li>'; ?>
          <?php if($data['Page2']>0)echo '<li class="pageSearch page-item" dataid="'.$data['Page2'].'"><a href="#" class="page-link">'.$data['Page2'].'</a></li>'; ?>
          <?php echo '<li class="pageSearch page-item active"  dataid="'.$data['thisPage'].'"><a href="" class="page-link">'.$data['thisPage'].'</a></li>'  ?>
          <?php if($data['Page4']>0)echo '<li class="pageSearch page-item" dataid="'.$data['Page4'].'"><a href="#" class="page-link">'.$data['Page4'].'</a></li>'; ?>
          <?php if($data['Page5']>0)echo '<li class="pageSearch page-item" dataid="'.$data['Page5'].'"><a href="#" class="page-link">'.$data['Page5'].'</a></li>'; ?>

          <?php if($data['Page4']>0){echo '<li class="pageSearch page-item"  dataid="'.$data['Page4'].'"><a href="#" class="page-link">Next</a></li>';}else{echo '<li class="page-item disabled" ><a href="#" class="page-link">Next</a></li>';} ?>
       
    </ul>
      </div>
    </div>





















    
<!-- add Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="<?php echo URLROOT;  ?>users/register" method="post">
        <div class="modal-header">	
          <h4 class="modal-title">Add Utilisateur</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nom</label>
            <input type="text" class="form-control" name="dnom" required>
          </div>
          <div class="form-group">
            <label>Prénom</label>
            <input type="text" class="form-control" name="dprenom" required>
          </div>		
          <div class="form-group">
            <label>username</label>
            <input type="text" class="form-control" name="dusername" required>
          </div>		
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-success" value="Add">
        </div>
      </form>
    </div>
  </div>
</div>


<?php if(!empty($data['data']) ){foreach ($data['data'] as $user) : ?>
<div id="editEmployeeModal<?php echo  $user->id ; ?>" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo URLROOT;  ?>users/edituser/<?php echo  $user->id ; ?>" method="post">
        <div class="modal-header">						
          <h4 class="modal-title">Edit user</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label>Nom</label>
            <input type="text" class="form-control" name="dmon" required value="<?php echo  $user->nom ; ?>">
          </div>

          <div class="form-group">
            <label>Prinom</label>
            <input type="text" class="form-control" name="dprinom" required value="<?php echo  $user->prinom ; ?>">
          </div>

          <div class="form-group">
            <label>username</label>
            <input type="text" class="form-control" name="dusername" required value="<?php echo  $user->nameuser ; ?>">
          </div>

        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-info" value="Save">
        </div>
      </form>

    </div>
  </div>
</div>
<?php endforeach;}; ?>


<!-- Delete Modal HTML -->
<?php if(!empty($data['data']) ){foreach ($data['data'] as $user) : ?>
<div id="deleteEmployeeModal<?php echo  $user->id ; ?>" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form  action="<?php echo URLROOT;  ?>users/deleteUser/<?php echo  $user->id ; ?>" method="post" >
        <div class="modal-header">	
          <h4 class="modal-title">Delete Document</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">					
          <p>Are you sure you want to delete these Records?</p>
          <p class="text-warning"><small>This action cannot be undone.</small></p>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-danger" value="Delete">
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach;}; ?>





<?php if(!empty($data['data']) ){foreach ($data['data'] as $user) : ?>
<div id="rf<?php echo  $user->id ; ?>" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form  action="<?php echo URLROOT;  ?>users/deactivate/<?php echo  $user->id ; ?>" method="post" >
        <div class="modal-header">	
          <h4 class="modal-title">Reset password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">					
          <p>Are you sure you want to Reset password?</p>
          <p class="text-warning"><small>This action cannot be undone.</small></p>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-danger" value="Reset password" style="background-color:green;">
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach;}; ?>





<script>
$(".pageSearch").on('click',function(event){
            event.stopPropagation();
            event.stopImmediatePropagation();
            var id=$(this).attr("dataid");
            var input=$("#idinput").val();
             $.ajax({
                         url:"<?php echo URLROOT;  ?>users/searcHlistUtilisateurs",
                         method:"post",
                         data:{input:input,id:id},
                         success:function(data){
                             $("#altdata").html(data);
                         }
                     });
          })
    </script>
