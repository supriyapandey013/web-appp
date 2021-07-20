
<!DOCTYPE html>
<html lang="en">
   <?php
   $url_data='';
   if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $previous_page = $pageno - 1;
        $next_page = $pageno + 1;
        $no_of_records_per_page =20;
        $offset = ($pageno-1) * $no_of_records_per_page;
        $sql="select  p.*,t.title as ttile
                from product p LEFT JOIN type t On t.id=p.type_id
                where p.status =1 order by p.id desc";
         $value=$db->prepare($sql)->getResults(array());
         $result=count($value);
          $total_rows = $result;
          $total_pages = ceil($total_rows / $no_of_records_per_page);
         $num=20;
          $secondlast=$total_pages-1;
          $adjacents = "2";	
   include($css_path); ?>
	
    <link rel="stylesheet" type="text/css"  href="assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
	
			<style>
            .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
    z-index: 2;
    color: #fff;
    background-color: #fb9678;
    border-color: #fb9678;
    cursor: default;
}
.pagination > li > a, .pagination > li > span {
    position: relative;
    float: left;
    padding: 8px 13px;
    line-height: 1.42857;
    text-decoration: none;
    color: #fb9678;
    background-color: #fff;
    border: 1px solid #ddd;
    margin-left: -1px;
}
			 img.showimg{
            width: 50px;
            height: 50px;
         }
		 		 .toast {
    position: absolute;
    z-index: 1;
    left: 35%;
    top: 90px;
    background: #8ccc8c;
}
			</style>
</head>

<body class="skin-default fixed-layout">
<div id="main-wrapper">
 <?php include($menu_path); ?>
     
	 
        <div class="page-wrapper">
          
            <div class="container-fluid">
			 
			 
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Product List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <?php if(!empty($_SESSION['ID'])){  ?>
                             <a href="add_product"><button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i
                                    class="fa fa-plus-circle"></i>Add Product</button></a>
									
									<span onclick="deleteallselected();" class="btn btn-danger" > Delete Selecetd </span> 
							<?php } ?>	
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                    
                        <div class="card">
                            <div class="card-body">
                               

                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="table table-bordered table-striped"> 
                                        <thead>
                                            <tr>
											<th style="display:none">Sl.No.</th>
                                            <th>Name</th>
                                                <th>Type</th>
                                                <th>Price</th>
                                                <th>Rating</th>
												<?php if(!empty($_SESSION['ID'])){  ?>
                                                <th>Action</th>
												<?php   } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
										$i=0;
										$obj= new Product();
                                         $obj->setOffset($offset);
                                        $obj->setRecordsPerPage($no_of_records_per_page);
										$value=$obj->getAllData();
										//print_r($value);
										foreach($value as $key=>$row){
										//echo 
										$i++;
				                            ?>
											
                                            <tr id="del<?php echo $row['id'];?>">
											
											<td style="display:none"><?php echo $i;?></td>
                                            <td>
											<?php if(!empty($_SESSION['ID'])){  ?>
											<a href="edit_product?id=<?php echo ($row['id']); ?>">
											<?php echo htmlentities($row['title']);?>
											</a>
											<?php }else{ ?>
											<?php echo htmlentities($row['title']);?>
											<?php } ?>
											
											</td>
                                             <td><?php echo htmlentities($row['ttile']);?></td>
                                             <td><?php echo htmlentities($row['price']);?></td>
                                             <td><?php echo htmlentities($row['rating']);?></td>
											 <?php if(!empty($_SESSION['ID'])){  ?>
                                  <td class="hidden-xs">
                        <span onclick="return confirmDelete(<?php echo $row['id']; ?>);">  <button class="btn btn-danger btn-xs" title="Delete"><i class="mdi mdi-delete-forever"></i></button> </span>
<input type="checkbox" value="<?php echo $row['id']; ?>" id="deleteproductids" name="deleteproductids[]">
                        </td>
					<?php   } ?>
                                            </tr>
										<?php } ?>
                                        
                                        </tbody>
                                    </table>
                                </div>
                                 <div class="col-sm-6 text-left" id="pagg">
                              
                             
          <ul class="pagination">
          
          <?php if($pageno > 1){
echo "<li><a href='?pageno=1'> << </a></li>";
} ?>
 
<?php if($pageno > 1){ 
 
echo "<li><a href='?pageno=$previous_page.$url_data'> < </a></li>";

} ?>

         <?php
          if ($total_pages <= 10){   
 for ($i = 1; $i <= $total_pages; $i++){
 if ($i == $pageno) {
 echo "<li class='active'><a>$i</a></li>"; 
         }else{
        echo "<li><a href='?pageno=$i.$url_data'>$i</a></li>";
                }
        }
}
      
          
         elseif ($total_pages > 10){
         if($pageno <= 4) { 
          for($i=1;$i<=8;$i++){
              if ($i == $pageno) {
                echo "  <li class='active'><span>$i</span></li> ";
              }
              else{
                  echo "<li><a href='?pageno=$i.$url_data'>$i</a></li>";
         
          
                  } 
             }
             echo "<li><a>...</a></li>";
            echo "<li><a href='?pageno=$secondlast.$url_data'>$secondlast</a></li>";
            echo "<li><a href='?pageno=$total_pages.$url_data'>$total_pages</a></li>";
}
        
        
        elseif($pageno > 4 && $pageno < $total_pages - 4) { 
                echo "<li><a href='?pageno=1.$url_data'>1</a></li>";
                echo "<li><a href='?pageno=2.$url_data'>2</a></li>";
                echo "<li><a>...</a></li>";
            for (
                 $i = $pageno - $adjacents;
                 $i <= $pageno + $adjacents;
                 $i++
                 ) { 
                 if ($i == $pageno) {
             echo "<li class='active'><a>$i</a></li>"; 
             }else{
           echo "<li><a href='?pageno=$i.$url_data'>$i</a></li>";
          }                  
       }
echo "<li><a>...</a></li>";
echo "<li><a href='?pageno=$secondlast.$url_data'>$secondlast</a></li>";
echo "<li><a href='?pageno=$total_pages.$url_data'>$total_pages</a></li>";
}


                else {
                echo "<li><a href='?pageno=1.$url_data'>1</a></li>";
                echo "<li><a href='?pageno=2.$url_data'>2</a></li>";
                echo "<li><a>...</a></li>";
                for (
                     $i = $total_pages - 6;
                     $i <= $total_pages;
                     $i++
                     ) {
                     if ($i == $pageno) {
                 echo "<li class='active'><a>$i</a></li>"; 
                 }else{
                        echo "<li><a href='?pageno=$i.$url_data'>$i</a></li>";
 }                   
     }
}
         }
          
          ?>
           
         <?php if($pageno < $total_pages) {
            echo "<li><a href='?pageno=$next_page.$url_data'> > </a></li>";
            } ?>
            
             
            <?php if($pageno < $total_pages){
echo "<li><a href='?pageno=$total_pages.$url_data'> >> </a></li>";
} ?>
          </ul>
          
          <div class="col-sm-8 text-right" style="float: right;
    padding: 0px;
    white-space:nowrap;
    position: relative;
    left: 450px;
    bottom: 65px;">Showing <?php if($total_rows>0){ echo $offset+1; } else { echo 0; } ?> to <?php echo $num+$offset; ?> of <?php echo $total_rows; ?> (<?php echo $total_pages; ?> Pages)</div>
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
	
</body>
</html>


<script type="text/javascript">

 function confirmDelete(delete_id)
 {
	 
	
	       Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
			 var postdata = {"id":delete_id,"page":"city","action":"delete"};		
		$.ajax({
		
       type: "POST",
      url: "MODULE_Product",
      data: postdata,
      cache: false,
      success: function(result){
		 		
			Swal.fire({
                position: 'top-center',
                type: 'success',
                title: 'Product Deleted Successfully',
                showConfirmButton: false,
                timer: 2500
            })
      }
      });
								
                  $('#del'+delete_id).hide(); 
                }else{
					  return false;
				}
           })
 }
 
 </script> 
 <script type="text/javascript">


 function deleteallselected()
 {
	 var selectedValues =[]
$('input[type=checkbox]:checked').each(function(i,e){
  selectedValues.push( $(e).attr('value') )
})
 var urls= selectedValues.join(',') ;
	 ///var urls=document.getElementById("deleteproductids").value;
	//alert(urls);
	
	if(urls==undefined || urls==''){
				Swal.fire({
                position: 'top-center',
                type: 'error',
                title: 'Nothing selected',
                showConfirmButton: false,
                timer: 2500
            })
	}else{
		
	
			 
	       Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
			 var postdata = {"id":urls,"page":"product","action":"delete"};		
		$.ajax({
		
       type: "POST",
      url: "MODULE_product",
      data: postdata,
      cache: false,
      success: function(result){
		 		
			Swal.fire({
                position: 'top-center',
                type: 'success',
                title: 'Products Deleted Successfully',
                showConfirmButton: false,
                timer: 2500
            })
      }
      });
				setTimeout(function () { location.reload();}, 1000);						
                }else{
					  return false;
				}
           })
		 				
           }     
 }
 
 </script> 