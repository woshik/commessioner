<?php $this->load->view('dashboard_template/header.php'); ?>

<body>
    <div class="se-pre-con"></div>
    <div class="wrapper">
        
        <?php $this->load->view('dashboard_template/side-bar.php'); ?>

        <!-- Page Content Holder -->
        <div id="content">
            <input type="hidden" value="<?php echo base_url() ?>" id="base_url">

            <?php $this->load->view('dashboard_template/top-nav-bar.php'); ?>


            <?php

              if ($page_section === "ড্যাশবোর্ড") {

                $this->load->view('pages/dashboard_template');

              }elseif ($page_section === "মামলা নিয়ন্ত্রণ") {

                $this->load->view('pages/suit_template');
                
              }elseif ($page_section === "মামলা ফরম") {

                $this->load->view('pages/suit_create_template');
                
              }elseif ($page_section === "এস.এম.এস") {
                
                $this->load->view('pages/sms_template');

              }elseif ($page_section === "ই-মেইল ও এস.এম.এস পাঠান") {
                
                $this->load->view('pages/mail_template');

              }elseif ($page_section === "ই-মেইল ও এস.এম.এস বক্স") {
                
                $this->load->view('pages/mailBox_template');

              }elseif ($page_section === "Error Log") {
                
                $this->load->view('pages/errorLog_template');

              }elseif ($page_section === "সেটিংস") {
                
                $this->load->view('pages/setting_template');

              }

            ?>

          <!-- Copyright -->
          <div class="copyright py-xl-3 py-2 mt-xl-5 mt-4 text-center">
            <p>
              <i class="far fa-copyright"></i> 2018
              <?php if(strtotime('2018') < strtotime(date('Y'))) echo ' - '.date('Y'); ?> . <span class="reservedPart"> All Rights Reserved |</span> Developed By : <b><a href="https://software.blinkpark.com" target="_blank">BlinkSoft</a></b>
            </p>
          </div>
          <!--// Copyright -->
        </div>
    </div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="adminSettingModel">
<div class="modal-dialog modal-lg">
  <div class="modal-content">

      <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel">ব্যবহারকারীর তথ্য</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart('dashboard/updateAdminProfile', ['id' => 'adminView']);?>

        <div id="update-profile-message"></div>

        <div class="form-group text-center">
          <div class="kv-avatar">
            <div class="file-loading">
              <input id="adminPhoto" name="adminPhoto" type="file">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="adminname">নাম</label>
          <input type="text" class="form-control" id="adminname" name="adminname" autocomplete="off" />
        </div>

        <div class="form-group">
          <label for="adminEmail">ই-মেইল</label>
          <input type="text" class="form-control" id="adminEmail" name="adminEmail" autocomplete="off" />
        </div>
        
        <div class="form-group">
          <label for="adminusername">ইউজার নেম</label>
          <input type="text" class="form-control" id="adminusername" name="adminusername" readonly/>
        </div>

        <div class="form-group">
          <label for="adminCurrentPass">বর্তমান পাসওয়ার্ড</label>
          <input type="Password" class="form-control" id="adminCurrentPass" name="adminCurrentPass" autocomplete="off" placeholder="বর্তমান পাসওয়ার্ড" />
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="adminNewPass">নতুন পাসওয়ার্ড</label>
            <input type="Password" class="form-control" id="adminNewPass" name="adminNewPass" autocomplete="off" placeholder="নতুন পাসওয়ার্ড" />
          </div>

          <div class="form-group col-md-6">
            <label for="adminConfirmPass">কনফার্ম পাসওয়ার্ড</label>
            <input type="Password" class="form-control" id="adminConfirmPass" name="adminConfirmPass" placeholder="কনফার্ম পাসওয়ার্ড" autocomplete="off" />
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">সেভ করুন</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">বন্ধ করুন</button>  
      </div>

  </div>
</div>
</div>

<?php $this->load->view('dashboard_template/footer.php'); ?>