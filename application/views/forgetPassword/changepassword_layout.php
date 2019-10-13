<?php $this->load->view('forgetPassword/header.php'); ?>

<div id="message"></div>
<div class="alert alert-success custom-alert toggle-this-message">
    <center>অনুগ্রহ করে আপনার ই-মেইল দেখুন।</center>
</div>
<input type="hidden" name="hiddenmailId" id="hiddenmailId" value="<?php echo $id;?>">
<div class="form-body-w3-agile text-center w-lg-50 w-sm-75 w-100 mx-auto mt-5">
    <?php echo form_open('changepassword/changePassword', ['id'=>'newPasswordForm']);?>

        <div class="form-group">
            <input type="password" name="newpass" placeholder="নতুন পাসওয়ার্ড" class="form-control" required autocomplete="off">
        </div>

        <div class="form-group">
            <input type="password" name="confirmPass" placeholder="পাসওয়ার্ড নিশ্চিত করুন" class="form-control" required autocomplete="off">
        </div>

        <button type="submit" class="btn btn-primary error-w3l-btn mt-3 px-4">সাবমিটার</button>

    <?php echo form_close();?>
    <h1 class="paragraph-agileits-w3layouts mt-4">
        <a href="<?php echo base_url('login')?>">লগইন পেজ</a>
    </h1>
</div>

<?php $this->load->view('forgetPassword/footer.php'); ?>      