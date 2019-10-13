<!-- Tables content -->
<section class="tables-section">
  <div class="outer-w3-agile mt-3">
    <h4 class="tittle-w3-agileits mb-4">কর্মকর্তাবৃন্দের তালিকা</h4>

    <div id="stuff-message"></div>

    <?php if($this->session->userdata('id') == 1) { ?>
      <div class="container-fluid">
        <div class="row" style="float: right;">
          <div>
            <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStuffModel" data-backdrop="static"><i class="fas fa-user-circle"></i> তথ্য যুক্ত করুন
            </a>
            <a href="#" type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeStuffModel" data-backdrop="static" onclick="deleteStuff()"><i class="fas fa-user-times"></i> তথ্য ডিলিট করুন
            </a>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    <?php } ?>

      <div class="container-fluid">
        <div class="row" style="float: right;">
          <div>
            <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#sendEmailModel" data-backdrop="static" onclick="emailModelOpen()"><i class="fas fa-mail-bulk"></i> ই-মেইল পাঠান
            </a>
            <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#sendSMSModel" data-backdrop="static" onclick="smsModelOpen()"><i class="fas fa-comment-alt"></i> এস.এম.এস পাঠান
            </a>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="manageStuff" style="width:100%;">
            <thead>
                <tr>
                  <th width="20px"></th>
                  <th>নাম</th>
                  <th>ফোন নম্বর</th>
                  <th>ই-মেইল অ্যাড্রেস</th>
                  <th>অ্যাড্রেস</th>
                </tr>
            </thead>
        </table>
      </div>

  </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addStuffModelLabel" aria-hidden="true" id="addStuffModel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title" id="addStuffModelLabel">কর্মকর্তা তথ্য</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">

          <?php echo form_open_multipart('mail/createStuff', ['id' => 'createStuffForm']);?>

          <div class="form-group text-center">
            <div class="kv-avatar">
              <div class="file-loading">
                <input id="stuffPhoto" name="stuffPhoto" type="file">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="stuffName"><b>নাম</b></label>
            <input type="text" class="form-control" id="stuffName" name="stuffName" autocomplete="off"
            placeholder="নাম" />
          </div>

          <div class="form-group">
            <label for="stuffAddress"><b>অ্যাড্রেস</b></label>
            <input type="text" class="form-control" id="stuffAddress" name="stuffAddress" autocomplete="off" placeholder="অ্যাড্রেস" />
          </div>
          
          <div class="form-group">
            <label for="stuffPhone"><b>ফোন নম্বর</b></label>
            <input type="text" class="form-control" id="stuffPhone" name="stuffPhone" autocomplete="off" placeholder="ফোন নম্বর" />
          </div>

          <div class="form-group">
            <label for="stuffEmail"><b>ই-মেইল অ্যাড্রেস</b></label>
            <input type="text" class="form-control" id="stuffEmail" name="stuffEmail" autocomplete="off" placeholder="ই-মেইল অ্যাড্রেস" />
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">সেভ করুন</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">বন্ধ করুন</button>  
        </div>

        <?php echo form_close();?>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="sendEmailModelLabel" aria-hidden="true" id="sendEmailModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="sendEmailModelLabel">ই-মেইল</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            
            <div class="modal-body">

            <?php echo form_open_multipart('mail/sendEmail', ['class' => 'form-horizontal','id' => 'sendEmailModelForm']);?>
              <div class="form-group row">
                <label for="emailAddress" class="col-sm-3 col-form-label">Recipient Email : </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="emailAddress" name="emailAddress" autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label for="emailSubject" class="col-sm-3 col-form-label">Subject : </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="emailSubject" name="emailSubject" autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-12">
                  <input id="input-b2" name="emailFile[]" type="file" class="file" data-show-preview="false" data-show-upload="false" multiple>
                </div>
              </div>

              <div class="form-group">
                  <textarea name="emailBody" id="emailBody"></textarea>
              </div>
              
            </div>

            <div class="modal-footer">
              

              <button type="submit" class="btn btn-success">Send</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

          <?php echo form_close();?>

        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="sendSMSModelLabel" aria-hidden="true" id="sendSMSModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="sendSMSModelLabel">এস.এম.এস</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <?php echo form_open('mail/sendSMS', ['class' => 'form-horizontal','id' => 'sendSMSForm']);?>
            <div class="modal-body">

              <div class="form-group row">
                <label for="phoneNumber" class="col-sm-3 col-form-label">Phone number : </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label for="maskingName" class="col-sm-3 col-form-label">Masking Name : </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="maskingName" name="maskingName">
                  </div>
              </div>

              <div class="form-group">
                  <textarea name="smsBody" id="smsBody"></textarea>
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

<div class="modal fade" id="removeStuffModel" tabindex="-1" role="dialog" aria-labelledby="removeStuffModelLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="removeStuffModelLabel">কর্মকর্তার তথ্য ডিলেট</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <p>আপনি কি নিশ্চিত তথ্য ডিলিট করতে চান ?</p>   
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="removeStuffBtn">ডিলিট </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">বন্ধ করুন</button>
          </div>
      </div>
  </div>
</div>

<script src="<?php echo base_url('custom/js/mail.js')?>"></script>