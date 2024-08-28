

<table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Référence</th>
            <th>Utilisateur</th>
            <th>Titre</th>
            <th>Type</th>
            <th>Localisation</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>



        <?php if(!empty($data['data']) ){foreach ($data['data'] as $file) : ?>
          <tr>

            <td>AUDOC0<?php echo  $file->id ; ?></td>
            <td><?php echo  $file->prinom.' '.$file->nom ; ?></td>
            <td><?php echo  $file->titreDoc ; ?></td>
            <td><?php echo  $file->typeDoc ; ?></td>
            <td><?php echo  $file->localisationDoc ; ?></td> 
            <td><?php echo  $file->timeF ; ?></td>
            <td>
            <a href="#editEmployeeModal<?php echo  $file->id ; ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
              <a href="#deleteEmployeeModal<?php echo  $file->id ; ?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
              <a href="<?php echo URLROOT.'files/downlod/'.$file->nameDoc ; ?>" class="deletem" ><span class="material-icons">download</span></a>&nbsp;
              <a href="<?php echo URLROOT.'files/archivepyid/'.$file->id ; ?>" class="deletem1" ><span class="material-icons">archive</span></a>&nbsp;
              <?php 
              $rext=["txt","jpj","jpeg","png","bmp","webp","pdf"];
              $extension=pathinfo($file->nameDoc,PATHINFO_EXTENSION);
              if(in_array($extension,$rext)){
               ?>
              <a href="<?php echo URLROOT.'public/upload/'.$file->nameDoc ; ?>" class="deletem2" target="_blank"><span class="material-icons">remove_red_eye</span></a>
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






    <?php if(!empty($data['data']) ){foreach ($data['data'] as $file) : ?>
<div id="editEmployeeModal<?php echo  $file->id ; ?>" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo URLROOT;  ?>files/editFile/<?php echo  $file->id ; ?>" method="post">
        <div class="modal-header">						
          <h4 class="modal-title">Edit Document <?php echo  $file->id ; ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Titre</label>
            <input type="text" class="form-control" name="dtitre" required value="<?php echo  $file->titreDoc ; ?>">
          </div>
          <div class="form-group">
            <label>Type</label>
            <select name="dtype" id="" class="form-control" >
              <option value="PRO_adminitration">PRO_adminitration</option>
              <option value="santé">santé</option>
              <option value="banque">banque</option>
              <option value="job_candidature">job_candidature</option>
              <option value="job">job</option>
              <option value="pro">pro</option>
            </select>
          </div>
          <div class="form-group">
            <label>Localisation</label>
            <select name="dlocalisation" id="" class="form-control" >
              <option value="MA">MA</option>
              <option value="FR">FR</option>
            </select>
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
<?php if(!empty($data['data']) ){foreach ($data['data'] as $file) : ?>
<div id="deleteEmployeeModal<?php echo  $file->id ; ?>" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form  action="<?php echo URLROOT;  ?>files/deleteFile/<?php echo  $file->id ; ?>" method="post" >
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






<script>
$(".pageSearch").on('click',function(event){
            event.stopPropagation();
            event.stopImmediatePropagation();
            var id=$(this).attr("dataid");
            var input=$("#idinput").val();
             $.ajax({
                         url:"<?php echo URLROOT;  ?>files/indexSreach",
                         method:"post",
                         data:{input:input,id:id},
                         success:function(data){
                             $("#altdata").html(data);
                         }
                     });
          })
    </script>





