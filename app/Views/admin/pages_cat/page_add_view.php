<?php
use Core\Language;
?>
<script>



//mmantık şu ajaxdan datayı gonder
//get parametresi ile tr ve en gitsin
//db deki yer bu parametreye gore ek yaparak kayıt yapsın


	function TurkceInput(okunan_alan,ara_karakter,lang) {
	    var charMap = {Ç:'c',Ö:'o',Ş:'s',İ:'i',I:'i',Ü:'u',Ğ:'g',ç:'c',ö:'o',ş:'s',ı:'i',ü:'u',ğ:'g', ".":'_'};
	    var str = $('#'+okunan_alan).val();
	    str_array = str.split('');
	    for(var i=0, len = str_array.length; i < len; i++) {
	        str_array[i] = charMap[ str_array[i] ] || str_array[i];
	    }
	    str = str_array.join('');
	     var clearStr = str.replace( / /gi,ara_karakter).replace(/--/gi,ara_karakter).replace(/[^a-z0-9-.çöşüğı]/gi,ara_karakter).replace("--","-").toLowerCase();
	   $("#slug_"+lang).val(clearStr);
	   //  $('#'+okunan_alan).parent().next().children("input").val(clearStr);
	}


$(function() {



               <?php  foreach ($languages as $value) {      ?>
				$("#title_<?php echo $value['slug']; ?>").keyup(function() {
					TurkceInput($(this).attr('id'),"_",'<?php echo $value['slug']; ?>');
				});
				<?php } ?>




	
    $(".textarea").wysihtml5();
//https://ideal.com.tr/public/js/adresler.js
//https://test.ideal.com.tr/public/script.js
/*    	adet=$(".content form").length;
    	console.log(adet);
    	$.each($('.content form'), function(index, value) {
    	console.log($(this).attr("id"));
    	var id=$(this).attr("id");
    	console.log($('.content #'+id).serialize());  	});*/
 // adres
 
    $("#save_button").on("click", function() {
    	  var form = $('.content #page');
    	  $.ajax({
    	      type: form.attr('method'),
              url: form.attr('action'),
              data: form.serialize(),

              success: function(result) {
            	   json = JSON.parse(result);
            	   if (json.sonuc == 'ok') {
            		 var id= json.id ;
                     window.open('/admin/page_edit_cat/'+id, '_self');
            	   }
              }
          });

    });
});
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Haber Ekleme <small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Forms</a></li>
			<li class="active">General Elements</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<div class="nav-tabs-custom">
					<!-- Tabs within a box -->
					<ul class="nav nav-tabs pull-right">
					 <?php
    
    $a = 0;
    foreach ($languages as $value) {
        $a ++;
        if ($a == 1) {
            $class = "active";
        } else {
            $class = "";
        }
        ?>
						<li class="<?php echo $class?>"><a
							href="#<?php
        
echo $value['slug'];
        ?>" data-toggle="tab"><?php echo strtoupper( $value['slug']);?></a></li>
						
					<?php } ?>
						<li class="pull-left header"><i class="fa fa-inbox"></i> Sayfa
							Ekleme</li>
					</ul>
					<form role="form" method="post" action="/admin/page_add_cat"
						id="page">
						<div class="tab-content no-padding">
	<?php
    $y = 0;
    foreach ($languages as $value) {
        $y ++;
        if ($y == 1) {
            $class = "active";
        } else {
            $class = "";
        }
        
        $language = $value['slug'];
        ?>
	   <div class=" tab-pane <?php echo $class?>"	id="<?php echo $language?>"	style="position: relative; height: 600px;">
                <?php
        include 'include_add.php';
        ?>
                </div>

				
              <?php } ?>
				</div>
						<div class="box-footer clearfix">
							<button class="pull-right btn btn-default"
								style="margin-top: 44px;" type="button" id="save_button">
								Save <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</form>
				</div>
				<!-- /.nav-tabs-custom -->


			</div>
			<!--/.col md12  -->
		</div>


	</section>

</div>
<!-- ./wrapper -->

<!-- /.content-wrapper -->