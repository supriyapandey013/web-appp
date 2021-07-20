
         <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-collapse">
           
                    <ul class="navbar-nav my-lg-20" align="center"> 

                        <li class="nav-item"> 
                            <div class="new-orders-top-heads">
                                <a href="homepage" class="nav-link dropdown-toggle waves-effect waves-dark"> 
                                 <span style="font-size: 32px;font-weight: 600;">Homepage</span>
                            </a>
                            </div>
                        </li>
                        <li class="nav-item"> 
                            <div class="new-orders-top-heads">
                                <a href="product" class="nav-link dropdown-toggle waves-effect waves-dark"> 
                                 <span style="font-size: 32px;font-weight: 600;">Products</span>
                            </a>
                            </div>
                        </li>
						<?php if(empty($_SESSION['ID'])){ ?>
                        <li class="nav-item"> 
                            <div class="new-orders-top-heads">
                                <a href="login" class="nav-link dropdown-toggle waves-effect waves-dark"> 
                                 <span style="font-size: 32px;font-weight: 600;">Login</span>
                            </a>
                            </div>
                        </li>
						<?php }else{ ?>
                        <li class="nav-item"> 
                            <div class="new-orders-top-heads">
                                <a href="logout" class="nav-link dropdown-toggle waves-effect waves-dark"> 
                                 <span style="font-size: 32px;font-weight: 600;">Logout</span>
                            </a>
                            </div>
                        </li>
						<?php } ?>
						
                    </ul> 
                </div>
            </nav>
        </header>
  
  
  