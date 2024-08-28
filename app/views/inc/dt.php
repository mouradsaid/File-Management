

<script>
$(document).ready(function(){
<?php
if(!empty($data["dancien_er"])){echo '$("#input1").css("border","1px solid red");$("#labelinput1").css("color","red");$("#divinput1").html("'.$data["dancien_er"].'");';}
if(!empty($data["dnouveau_er"])){echo '$("#input2").css("border","1px solid red");$("#labelinput2").css("color","red");$("#divinput2").html("'.$data["dnouveau_er"].'");';}
if(!empty($data["dconfirmation_er"])){echo '$("#input3").css("border","1px solid red");$("#labelinput3").css("color","red");$("#divinput3").html("'.$data["dconfirmation_er"].'");';}
?>
})


$(document).ready(function(){
  //$("#contentmodal").css("display","none");
  <?php if(!empty($data["st"])){if($data["st"]==true){echo "$('#myModalr').modal('show');$('#motPass').modal('hide');";}}  ?>
  //$('#myModalr').modal('show');$('#motPass').modal('hide');


});




</script>





