<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mencegah double submit form</title>
  <style>
    body{padding: 20px 40px}
    #btn-submit{padding: 10px 20px;background: #006faa;border: 0;color: #FFF;display:inline-block;cursor: pointer;}
    .validation-error {color:#FF0000;}
    .input-control{padding:10px;width:400px; border: 1px solid #999;}
    .input-group{margin-top:10px;}
    #submit-control{margin-top:15px;}
  </style>
</head>
<body>
<h2>Mencegah double submit form dengan jquery</h2>
<p>Baca tutorialnya di <a href="http://www.jurnalweb.com/mencegah-submit-form-dua-kali-dengan-jquery-dan-php">jurnalweb.com</a></p>
<form id="jw-frm" method="post">
  <div class="input-group">Judul <span class="judul-validation validation-error"></span></div>
  <div>
    <input type="text" name="judul" id="judul" class="input-control" />
  </div>

  <div class="input-group">Konten </div>
  <div>
    <textarea rows="5" name="konten" id="konten" class="input-control"></textarea>
  </div>

  <div id="submit-control">
    <input type="button" name="btn-submit" id="btn-submit" value="submit" onClick="ajaxSend();"/>
  </div>
</form>

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script>
function ajaxSend() { 
  var valid = true;
  valid = checkValid($("#judul"));
  if(valid) {
    var judul = $("#judul").val();
    var konten = $("#konten").val();
    $.ajax({
      url: "process-ajax.php",
      data:'judul='+judul+'&konten='+konten,
      type: "POST",
      beforeSend: function(){
        $('#submit-control').html("<img src='loading.gif' /> sedang dikirim...");
      },
      success: function(data){
        $('#submit-control').html("Berhasil, data sudah terkirim");
      }
    });
  }
}

function checkValid(obj) {
  var name = $(obj).attr("name");
  $("."+name+"-validation").html(""); 
  $(obj).css("border","");
  if($(obj).val() == "") {
    $(obj).css("border","red 1px solid");
    $("."+name+"-validation").html("Harus diisi");
    return false;
  } 
  return true;  
}
</script>
</body>
</html>