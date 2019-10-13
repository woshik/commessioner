<!-- top-bar -->
<nav class="navbar navbar-default mb-xl-4 mb-4">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <ul class="top-icons-agileits-w3layouts float-right">
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu drop-3">
                    <div class="profile d-flex mr-o">
                        <div class="profile-l align-self-center">
                            <img src="<?php echo base_url($userInfo['image_src'])?>" class="img-fluid mb-3" alt="Responsive image">
                        </div>
                        <div class="profile-r align-self-center">
                            <h3 class="sub-title-w3-agileits"><?php echo $userInfo['name']; ?></h3>
                            <a href="#"><?php echo $userInfo['email']; ?></a>
                        </div>
                    </div>

                    <a href="#" class="dropdown-item mt-3" data-toggle="modal" data-target="#adminSettingModel" data-backdrop="static">
                        <h4>
                            <i class="far fa-user mr-3"></i>প্রফাইল</h4>
                    </a>
                   
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url('login/logout')?>"><i class="fas fa-sign-out-alt mr-3"></i>লগ-আউট</a>
                </div>
            </li>
        </ul>
    </div>
</nav>