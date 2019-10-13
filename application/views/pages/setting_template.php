<div class="outer-w3-agile mt-3">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">নতুন অ্যাকাউন্ট</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">এস.এম.এস অ্যাকাউন্ট</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false">ছবি</a>
    </li>
  </ul>

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane show active" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="padding: 25px;">
    
    <?php echo form_open('setting/createUser', ['class' => 'form-horizontal', 'id' => 'createNewUser']);?>
      
    <div class="row">
          <div class="col-md-12">
        <div id="add-user-message"></div>

              <div class="form-group row">
                <label for="createAccountName" class="col-sm-2 col-form-label">নাম : </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="createAccountName" name="createAccountName"
                   placeholder="নাম" autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label for="createAccountEmail" class="col-sm-2 col-form-label">ই-মেইল : </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="createAccountEmail" name="createAccountEmail" placeholder="ই-মেইল" autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label for="createAccountUserName" class="col-sm-2 col-form-label">ইউজার নেম : </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="createAccountUserName" name="createAccountUserName" placeholder="ইউজার নেম" autocomplete="off">
                </div>
              </div>
              
              <div class="form-group row">
                <label for="createAccountPassword" class="col-sm-2 col-form-label">পাসওয়ার্ড : </label>
                <div class="col-sm-10">
                  <input type="Password" class="form-control" id="createAccountPassword" name="createAccountPassword" placeholder="পাসওয়ার্ড" autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label for="createAccountCnPassword" class="col-sm-2 col-form-label">কনফার্ম পাসওয়ার্ড : </label>
                <div class="col-sm-10">
                  <input type="Password" class="form-control" id="createAccountCnPassword" name="createAccountCnPassword"  placeholder="কনফার্ম পাসওয়ার্ড" autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12">
                  <center>
                    <button type="submit" class="btn btn-primary">যুক্ত করুন</button>
                  </center>
                </div>
             </div>
            <!-- /col-md-12 -->
           </div>
        </div>
        <!-- /row -->           
      <?php echo form_close(); ?>

  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab" style="padding: 25px;">
    
    <?php echo form_open('setting/smsUpdate', ['class' => 'form-horizontal','id' => 'smsIdpasswordForm']);?>

        <div id="update-smsidpassword-messages"></div>

            <div class="form-group row">
              <label for="smsAccountId" class="col-sm-2 col-form-label">SMS Id : </label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="smsAccountId" name="smsAccountId" placeholder="SMS Id" autocomplete="off">
              </div>
            </div>

            <div class="form-group row">
              <label for="smsAccountPassword" class="col-sm-2 col-form-label">SMS Password : </label>
              <div class="col-sm-10">
                <input type="Password" class="form-control" id="smsAccountPassword" name="smsAccountPassword" placeholder="Password" autocomplete="off">
              </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                  <center>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </center>
                </div>
             </div>
     <?php echo form_close(); ?>
  </div>

  <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab" style="padding: 25px;">

    <?php echo form_open_multipart('setting/upload');?>
      
        <input id="input-b2" name="picture[]" type="file" class="file" data-browse-on-zone-click="true"  multiple>
      
    <?php echo form_close(); ?>

    
  </div>

</div>



</div>


<script src="<?php echo base_url('custom/js/setting.js')?>"></script>