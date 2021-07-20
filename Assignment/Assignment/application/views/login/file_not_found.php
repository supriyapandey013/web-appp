<html lang="en">
 <?php	include($css_path); ?>
   <body class="skin-default fixed-layout">
      <div id="main-wrapper">
         <?php include($menu_path); ?>
         <div class="page-wrapper">
            <div class="container-fluid">
               <div class="row page-titles">
                  <div class="col-md-5 align-self-center">
                     <h4 class="text-themecolor">File Not Found</h4>
                  </div>
                  <div class="col-md-7 align-self-center text-right">
                     <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                        </ol>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <div class="card">
					 <div class="w3-container w3-green" style="padding:32px 64px">
<h1>Sorry</h1>
<h1>404 - The page cannot be found</h1>
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
