<?php $this->load->view('forgetPassword/header.php'); ?>

<div id="message"></div>
<div class="form-body-w3-agile text-center w-lg-50 w-sm-75 w-100 mx-auto mt-5">
    <?php echo form_open('forgetpassword/checkMail', ['id'=>'forgetForm']);?>

        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="ইউজার নেম" required autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary error-w3l-btn mt-3 px-4">রিকভার</button>

    <?php echo form_close();?>
    <h1 class="paragraph-agileits-w3layouts mt-4">
        <a href="<?php echo base_url('login')?>">লগইন পেজ</a>
    </h1>
</div>

<?php $this->load->view('forgetPassword/footer.php'); ?>   