<!DOCTYPE html>
<?php if(empty($_SESSION['ID'])){ header("location:login");   } ?>
<html lang="en">

 <?php	include($css_path); ?>


	
<style>
	.error {
    color: red;
}
	
	</style>
</head>
<body class="skin-default fixed-layout">
  
    <div id="main-wrapper">

    	<?php	include($menu_path); ?> 
     
        <div class="page-wrapper">
           
            <div class="container-fluid">
            
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor"> Product Detail</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                            
                                <li class="breadcrumb-item"><a href="product">Product List</a></li>
                                <li class="breadcrumb-item active"> Product Detail</li>
                            </ol>
                        </div>
                    </div>
                </div>
               

                <div class="row">
				<?php 
                $id=$_GET['id']; 
                $sql="select  p.*,t.title as ttile
                from product p LEFT JOIN type t On t.id=p.type_id
                where p.status =1 AND  p.id=:id" ;
                $result= $db->prepare($sql)->getResult(array(':id'=>$id));?>
				 
                    <div class="col-12 products-desc-edits-infor-wrappers">
					
                        <div class="card">
						 <div class="card-body py-4" style="padding-top:0px;">
						 <form class="" method="post" name="add_product" id="add_product"  enctype="multipart/form-data" >
                         <div class="form-row">
                         <div class="col-md-3">
                         <div class="form-group">
                         <label> Name</label>
                       <input readonly type="text" class="form-control" id="title" name="title"  value="<?php echo $result['title']; ?>" >
                        </div>
                        </div>
                        <div class="col-md-3">
                         <div class="form-group">
                         <label>Price</label>
                       <input type="text" class="form-control" id="price" name="price" readonly value="<?php echo $result['price']; ?>" >
                        </div>
                        </div>
                        <div class="col-md-3">
                         <div class="form-group">
                         <label>Rating</label>
                       <input type="text" class="form-control" readonly value="<?php echo $result['rating']; ?>" >
                        </div>
                        </div>
                        
                                        <div class="col-md-3">
                                          <div class="form-group">
                                          <label>Type</label>
                                             <select class="form-control select2 m-b-10 select2-multiple" data-placeholder="city" tabindex="1" name="type_id" id="type_id"  disabled>
                                                <option value="<?php echo $result['type_id']; ?>" selected><?php echo $result['ttile']; ?></option>
                                             </select>
                                          </div>
                                          </div>
                                        </div>
                         
               
                     <div class="form-row" >
                                
                                 
             <div class="col-md-6" id="desc">
                                        <label for="pdes" class="col-form-label">Description</label>
                                         <textarea class="textarea_editor1 form-control" rows="5" readonly name="description" id="description" placeholder="Enter text ...">
										 <?php echo $result['description']; ?></textarea>
                  
                                       
                                    </div>
                  <div class="col-md-6 ">
                                    <label > Image</label>
                                    <div class="card image">
                                       <div class="card-body dropi">
                                         
  <img src="<?php echo $result['cover']; ?>" height="100" width="100" >	   
                                       </div>
                                    </div>
                                 </div>
                                 </div>                      
                                     
                                         
			   
     	<div class="form-actions"  >
									   <input type='hidden' value="addVariation" name="action" id="action">
                                    <button hidden type="submit" name="submit" id="submit" class="btn waves-effect waves-light btn btn-info">Update</button>
                                    
									<a href="product"><button type="button" class="btn waves-effect waves-light btn-dark"><i class="icon-arrow-left-circle"></i>&nbsp;Back To List</button></a>
				</div>	
               </div>
			   
			
                                </form>
                            
                            </div>
                        </div>
                    </div>

                </div>
               

              
            </div>
           
            
        </div>
       
	  <?php	include($footer_path); ?>
    </div>
 
 <?php 
	include($js_path);
	?>
<script>
	$("#loader").hide();
	</script>
	<script src="assets/dist/js/jquery.validate.min.js"></script>
	<script>

$.validator.addMethod("regex", function(value, element, regexpr) {          
return regexpr.test(value);
}, "Letters only");

(function($,W,D)
{

    var JQUERY4U = {};
 
    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            
            //form validation rules
            $("#add_product").validate({
               
                rules: {
                      
					  title: {
                          required:true
                      }
					   
                 },
               
                messages: {
                     
					title: {
                          required:"<font color='red'>This field is required</font>"
                    }
					  
                },
                submitHandler: function(form) {
				 
functionsumitform(form);
  
							function functionsumitform(form) 
{                                   
  
                     	var formData = new FormData(form);
                   	var form = $(add_product);
					var url = 'MODULE_Product';
					$("#loader").show();
                    $("#submit").hide();
					var a='services';
					$.ajax({
					type: "POST",
					url: url,
					data: formData, // serializes the form's elements.
					cache:false,
            contentType: false,
            processData: false,
					success: function(data)
                   {
			
					   			    
												document.getElementById("submit").style.display="";
					   
					   $("#loader").hide();   
					$("#submit").show();
					  
                     
                if(data){
					 
                      Swal.fire({
                 title: 'Product Added successfully',
                type: 'success',
                showConfirmButton: false,
                timer: 2500
            }).then((result) => {
               
                    //setTimeout(function(){  window.location.href = 'add_product';}, 1000); 
                
            });
           
				  }
				  else{
                Swal.fire({
                 title:"Failed",
                type: 'error',
				showConfirmButton: false,
                timer: 2500
        }).then((result) => {});
				  }
			
                   }
                 });
                }
			/* 	} */
				}
            });
        }
    }
 
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
      

    });
 
})(jQuery, window, document);
</script>
		<script>
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}	
 </script>

 
	
</body>
</html>