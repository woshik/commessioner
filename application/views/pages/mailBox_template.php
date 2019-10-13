<div class="outer-w3-agile mt-3">

  <ul class="nav nav-tabs" id="myTab" role="tablist">

    <li class="nav-item">
      <a class="nav-link active" id="emailBox-tab" data-toggle="tab" href="#emailBox" role="tab" aria-controls="emailBox" aria-selected="true">ই-মেইল</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="smsBox-tab" data-toggle="tab" href="#smsBox" role="tab" aria-controls="smsBox" aria-selected="false">এস.এম.এস</a>
    </li>

  </ul>

  <div class="tab-content" id="myTabContent">

    <div class="tab-pane fade show active" id="emailBox" role="tabpanel" aria-labelledby="emailBox-tab">

      <br>

      <div class="container-fluid">
        <div class="row" style="float: right;">
          <div>
            <a href="#" type="button" class="btn btn-danger" data-toggle="modal" data-target="#sendSmsModel" data-backdrop="static"><i class="fas fa-trash-alt"></i> ই-মেইল ডিলিট করুন
            </a>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="manageEmailData" style="width:100%;">
            <thead>
                <tr>
                  <th>ই-মেইল অ্যাড্রেস</th>
                  <th>ই-মেইল সাবজেক্ট</th>
                  <th>পাঠানোর সময়</th>
                  <th></th>
                </tr>
            </thead>
        </table>
      </div>

    </div>

    <div class="tab-pane fade" id="smsBox" role="tabpanel" aria-labelledby="smsBox-tab">

      <br>

      <div class="container-fluid">
        <div class="row" style="float: right;">
          <div>
            <a href="#" type="button" class="btn btn-danger" data-toggle="modal" data-target="#sendSmsModel" data-backdrop="static"><i class="fas fa-trash-alt"></i> এস.এম.এস ডিলিট করুন
            </a>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="manageSmsData" style="width:100%;">
            <thead>
                <tr>
                  <th>ফোন নম্বর</th>
                  <th>মেসেজ</th>
                  <th>পাঠানোর সময়</th>
                  <th></th>
                </tr>
            </thead>
        </table>
      </div>

    </div>
  </div>

</div>

<script src="<?php echo base_url('custom/js/mailBox.js')?>"></script>