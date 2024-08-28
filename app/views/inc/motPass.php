
<div id="motPass" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content" >

      <form action="#" id="formpass">
        <div class="modal-header">						
          <h4 class="modal-title">Changer le mot pass</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>

        <div class="modal-body">					
          <div class="form-group">
            <label id="labelinput1">Ancien mot de pass</label>
            <input type="password" class="form-control" name="dancien" required id="input1" <?php if(!empty($data["dancien_er"])){ echo "style='border:1px solid red;'";}  ?>  >
            <div style='color:red;textseze: 11px;' id="divinput1"></div>
          </div>

				
          <div class="form-group">
            <label id="labelinput2">Nouveau mot de pass</label>
            <input type="password" class="form-control" name="dnouveau" required id="input2">
            <div style='color:red;textseze: 11px;' id="divinput2"></div>
          </div>

         					
          <div class="form-group">
            <label id="labelinput3">Confirmation</label>
            <input type="password" class="form-control" name="dconfirmation" required id="input3">
            <div style='color:red;textseze: 11px;' id="divinput3"></div>
          </div>

          
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="button" class="btn btn-success" value="Save" id="savepass">
        </div>
      </form>
   
    </div>
  </div>
</div>













<div id="myModalr" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<i class="material-icons">&#xE876;</i>
				</div>				
				<h4 class="modal-title">Awesome!</h4>	
			</div>
			<div class="modal-body">
				<p class="text-center">Le mot de passe a été modifié. Voulez-vous décoonnecter ?.</p>
			</div>
			<div class="modal-footer">
          <a class="btn btn-success btn-block" href="<?php echo URLROOT;  ?>Users/logout">OK</a>
			</div>
		</div>
	</div>
</div>


















<div id="altdataj"></div>	
























<script>
$(document).ready(function(){
    $("#savepass").on("click",function(){
        var $dt=$("#formpass").serializeArray();
        console.log({dancien:$dt[0]["value"],dnouveau:$dt[1]["value"],dconfirmation:$dt[2]["value"]});

        var myData;
       

             $.ajax({
                 url:"<?php echo URLROOT;  ?>users/passedeitu",
                 method:"post",
                 data:{dancien:$dt[0]["value"],dnouveau:$dt[1]["value"],dconfirmation:$dt[2]["value"]},
                 success:function(data){
                  $("#altdataj").html(data);
                    
                 }
             });
    });
});
</script>
