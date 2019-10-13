<?php $this->load->view('forgetPassword/header.php'); ?>

<div id="message"></div>
<div class="alert alert-success custom-alert toggle-this-message">
    <center>অনুগ্রহ করে আপনার ই-মেইল দেখুন।</center>
</div>
<input type="hidden" name="hiddenmailId" id="hiddenmailId" value="<?php echo $id;?>">
<div class="form-body-w3-agile text-center w-lg-50 w-sm-75 w-100 mx-auto mt-5">
    <?php echo form_open('checkpasscode/checkcode', ['id'=>'passcodeForm']);?>

        <div class="form-group">
            <input type="text" class="form-control" name="passcode" placeholder="পাস কোড"required autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary error-w3l-btn mt-3 px-4">সাবমিটার</button>
        <button id="resendPasscode" class="btn btn-primary error-w3l-btn mt-3 px-4">নতুন কোড পাঠান</button>

    <?php echo form_close();?>
    <h1 class="paragraph-agileits-w3layouts mt-4">
        <a href="<?php echo base_url('login')?>">লগইন পেজ</a>
    </h1>
</div>

<?php $this->load->view('forgetPassword/footer.php'); ?>  