<!-- Sidebar Holder -->
<nav id="sidebar">
    <div class="sidebar-header text-center">
        <h4>
            <a href="<?php echo base_url('dashboard');?>"><?php echo $userInfo['name']; ?></a>
        </h4>
        <span><a href="<?php echo base_url('dashboard');?>"><?php echo substr($userInfo['name'], 0, 1); ?></a></span>
    </div>
    
    <ul class="list-unstyled components">

        <li class="<?php if($page_section === "ড্যাশবোর্ড") echo $toggle;?>">
            <a href="<?php echo base_url('dashboard')?>">
                <i class="fas fa-tachometer-alt"></i>
                ড্যাশবোর্ড
            </a>
        </li>

        <li class="<?php if($page_section === "মামলা নিয়ন্ত্রণ" || $page_section === "মামলা ফরম") echo $toggle;?>">
            <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false">
                <i class="fas fa-file-alt"></i>
                মামলা
                <i class="fas fa-angle-down fa-pull-right"></i>
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu1">
                <li class="<?php if($page_section === "মামলা নিয়ন্ত্রণ") echo $toggle;?>" >
                    <a href="<?php echo base_url('suit')?>">মামলা নিয়ন্ত্রণ করুন</a>
                </li>
                <li class="<?php if($page_section === "মামলা ফরম") echo $toggle;?>">
                    <a href="<?php echo base_url('suit/createsuitpage')?>">মামলা যুক্ত করুন</a>
                </li>
            </ul>
        </li>

        <li class="<?php if($page_section === "এস.এম.এস") echo $toggle;?>" >
            <a href="<?php echo base_url('sms')?>">
                <i class="fas fa-sms"></i>
                এস.এম.এস
            </a>
        </li>

        <li class="<?php if($page_section === "ই-মেইল ও এস.এম.এস পাঠান" || $page_section === "ই-মেইল ও এস.এম.এস বক্স") echo $toggle;?>">
            <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false">
                <i class="fas fa-envelope"></i>
                বার্তা
                <i class="fas fa-angle-down fa-pull-right"></i>
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu2">
                <li class="<?php if($page_section === "ই-মেইল ও এস.এম.এস পাঠান") echo $toggle;?>">
                    <a href="<?php echo base_url('mail')?>">ই-মেইল ও এস.এম.এস পাঠান</a>
                </li>
                <li class="<?php if($page_section === "ই-মেইল ও এস.এম.এস বক্স") echo $toggle;?>">
                    <a href="<?php echo base_url('mail/sentbox')?>">ই-মেইল ও এস.এম.এস বক্স</a>
                </li>
            </ul>
        </li>

    <?php if($this->session->userdata('id') == 1) { ?>

        <li class="<?php if($page_section === "Error Log") echo $toggle;?>" >
            <a href="<?php echo base_url('errorlog')?>">
                <i class="fas fa-exclamation-triangle"></i>
                Error Log
            </a>
        </li>

        <li class="<?php if($page_section === "সেটিংস") echo $toggle;?>" >
            <a href="<?php echo base_url('setting')?>">
                <i class="fas fa-cog"></i>
                সেটিংস
            </a>
        </li>

    <?php } ?>
        
    </ul>
</nav>