<!-- Tables content -->
<section class="tables-section">
  <div class="outer-w3-agile mt-3">
      <h4 class="tittle-w3-agileits mb-4">এস.এম.এস নিয়ন্ত্রণ টেবিল</h4>

      <div id="sms-messages"></div>

      <div class="container-fluid">
        <div class="row" style="float: right;">
          <div>
            <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#sendSmsModel" data-backdrop="static"><i class="fas fa-comment-alt"></i> এস.এম.এস পাঠান
            </a>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="manageSms" style="width:100%;">
            <thead>
                <tr>
                  <th>মামলা নং</th>
                  <th>আপীলকারীর নাম</th>
                  <th>আপীলকারীর ফোন নম্বর</th>
                  <th>প্রতিপক্ষের নাম</th>
                  <th>প্রতিপক্ষের ফোন নম্বর</th>
                  <th>আপীলদায়ের তারিখ</th>
                  <th>পরবর্তী তারিখ</th>
                </tr>
            </thead>
        </table>
      </div>
      
  </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="sendSmsModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">SMS Model</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <?php echo form_open('sms/sendMessage', ['class' => 'form-horizontal','id' => 'createSMSForm']);?>
            <div class="modal-body">

              <div class="form-group row">
                <label for="smsModelName" class="col-sm-3 col-form-label">Model Name : </label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="smsModelName" name="smsModelName" autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label for="smsModel" class="col-sm-3 col-form-label">SMS Model : </label>
                <div class="col-sm-5">
                  <select class="form-control" name="smsModel" id="smsModel">
                    <option value="">Select Model</option>
                   <?php foreach ($this->model_sms->smsModel() as $key => $value) { ?>
                      <option value="<?php echo $value['sms_model_id'] ?>"><?php echo $value['sms_model_name'] ?></option>
                    <?php } // /forwach ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="smsDays" class="col-sm-3 col-form-label">Send SMS : </label>
                <div class="col-sm-5">
                  <select class="form-control" name="smsDays" id="smsDays">
                    <option value="">Select Days</option>
                    <option value="0">Immediately</option>
                    <option value="1">1 Day ago</option>
                    <option value="2">2 Day ago</option>
                    <option value="3">3 Day ago</option>
                    <option value="4">4 Day ago</option>
                    <option value="5">5 Day ago</option>
                    <option value="6">6 Day ago</option>
                    <option value="7">7 Day ago</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="maskingName" class="col-sm-3 col-form-label">Masking Name : </label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="maskingName" name="maskingName">
                  </div>
              </div>

              <div class="form-group">
                  <textarea name="smsEditor" id="smsEditor"></textarea>
              </div>
              

            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Send</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

          <?php echo form_close();?>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('custom/js/sms.js');?>"></script>