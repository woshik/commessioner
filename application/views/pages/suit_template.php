 <!-- Tables content -->
<section class="tables-section">
  <div class="outer-w3-agile mt-3">
      <h4 class="tittle-w3-agileits mb-4">মামলা নিয়ন্ত্রণ টেবিল</h4>

      <div id="messages"></div>

      <div class="container-fluid">
        <div class="row" style="float: right;">
          <div>
            
            <a href="<?php echo base_url('suit/createsuitpage')?>" type="button" class="btn btn-primary"> 
              <i class="fa fa-plus-circle" aria-hidden="true"></i> মামলা যুক্ত করুন
            </a>

            <a href="#" type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeSuit" onclick="deleteSuit()" data-backdrop="static"> 
              <i class="far fa-trash-alt"></i> মামলা ডিলিট করুন
            </a>

          </div>
        </div>
      </div>
      <div class="clearfix"></div>



      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="manageSuit" style="width:100%;">
            <thead>
                <tr>
                    <th scope="col">মামলা নং </th>
                    <th scope="col">আপীলকারীর নাম</th>   
                    <th scope="col">প্রতিপক্ষের নাম</th>
                    <th scope="col">আপীলদায়ের তারিখ</th>
                    <th scope="col">পরবর্তী তারিখ</th>
                    <th scope="col">এস.এম.এস</th>
                    <th scope="col">এস.এম.এস পাঠানোর তারিখ</th>
                    <th></th>
                </tr>
            </thead>
        </table>
      </div>
  </div>
</section>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="editSuit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">মামলার তথ্য পরিবর্তন</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <?php echo form_open('suit/edit', ['id' => 'editSuitForm']);?>
            <div class="modal-body">

              <div id="edit-suit-messages"></div>

              <div class="form-group row">
                <label for="editMamlaNo" class="col-sm-3 col-form-label">মামলা নং : </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="editMamlaNo" name="editMamlaNo" readonly autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label for="editApilkarirNam" class="col-sm-3 col-form-label">আপীলকারীর নাম : </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="editApilkarirNam" name="editApilkarirNam" autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label for="editApilkarirTikana" class="col-sm-3 col-form-label">আপীলকারীর ঠিকানা : </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="editApilkarirTikana" name="editApilkarirTikana" autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label for="editApilkarirPhone" class="col-sm-3 col-form-label">আপীলকারীর ফোন নম্বর : </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="editApilkarirPhone" name="editApilkarirPhone" autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label for="editProtipokherNam" class="col-sm-3 col-form-label">প্রতিপক্ষের নাম : </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="editProtipokherNam" name="editProtipokherNam" autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label for="editProtipokherTikana" class="col-sm-3 col-form-label">প্রতিপক্ষের ঠিকানা : </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="editProtipokherTikana" name="editProtipokherTikana" autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label for="editProtipokherPhone" class="col-sm-3 col-form-label">প্রতিপক্ষের ফোন নম্বর : </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="editProtipokherPhone" name="editProtipokherPhone" autocomplete="off">
                </div>
              </div>

              <div class="form-group row">
                <label for="editJaharAdese" class="col-sm-3 col-form-label">যাহার আদেশের বিরুদ্ধে আপীল : </label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="editJaharAdese" name="editJaharAdese" autocomplete="off"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="editJeAdese" class="col-sm-3 col-form-label">যে আদেশের বিরুদ্ধে আপীল : </label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="editJeAdese" name="editJeAdese" autocomplete="off"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="editApilerTarik" class="col-sm-3 col-form-label">আপীলদায়ের তারিখ : </label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" id="editApilerTarik" name="editApilerTarik">
                </div>
              </div>

              <div class="form-group row">
                <label for="editPorobortiTarik" class="col-sm-3 col-form-label">পরবর্তী তারিখ : </label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" id="editPorobortiTarik" name="editPorobortiTarik">
                </div>
              </div>

              <div class="form-group row">
                <label for="editAdaloterAdesh" class="col-sm-3 col-form-label">অএ আদালতের আদেশ : </label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="editAdaloterAdesh" name="editAdaloterAdesh" autocomplete="off"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="editMamlarBiboron" class="col-sm-3 col-form-label">মামলার বিবরন : </label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="editMamlarBiboron" name="editMamlarBiboron" autocomplete="off"></textarea>
                </div>
              </div>

            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">পরিবর্তন সেভ করুন</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">বন্ধ করুন</button>
            </div>

          <?php echo form_close();?>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showDetails">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">মামলার তথ্য</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

              <div class="mb-3">
                <label for="showMamlaNo">মামলা নং</label>
                <input type="text" class="form-control" id="showMamlaNo" name="showMamlaNo" readonly>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="showApilkarirNam">আপীলকারীর নাম</label>
                    <input type="text" class="form-control" id="showApilkarirNam" name="showApilkarirNam" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="showProtipokherNam">প্রতিপক্ষের নাম</label>
                    <input type="text" class="form-control" id="showProtipokherNam" name="showProtipokherNam" readonly>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="showApilkarirTikana">আপীলকারীর ঠিকানা</label>
                    <input type="text" class="form-control" id="showApilkarirTikana" name="showApilkarirTikana"readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="showProtipokherTikana">প্রতিপক্ষের ঠিকানা</label>
                    <input type="text" class="form-control" id="showProtipokherTikana" name="showProtipokherTikana" readonly>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="showApilkarirPhone">আপীলকারীর ফোন নম্বর</label>
                    <input type="text" class="form-control" id="showApilkarirPhone" name="showApilkarirPhone" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="showProtipokherPhone">প্রতিপক্ষের ফোন নম্বর</label>
                    <input type="text" class="form-control" id="showProtipokherPhone" name="showProtipokherPhone" readonly>
                </div>
              </div>

              <div class="mb-3">
                <label for="showJaharAdese">যাহার আদেশের বিরুদ্ধে আপীল</label>
                <textarea class="form-control" id="showJaharAdese" name="showJaharAdese" readonly></textarea>
              </div>

              <div class="mb-3">
                <label for="showJeAdese">যে আদেশের বিরুদ্ধে আপীল</label>
                <textarea class="form-control" id="showJeAdese" name="showJeAdese" readonly></textarea>
              </div>

              <div class="mb-3">
                <label for="showApilerTarik">আপীলদায়ের তারিখ</label>
                <input type="date" class="form-control" id="showApilerTarik" name="showApilerTarik" readonly>
              </div>

              <div class="mb-3">
                <label for="showMamlarBiboron">মামলার বিবরন</label>
                <textarea class="form-control" id="showMamlarBiboron" name="showMamlarBiboron"readonly></textarea>
              </div>

              
                <div class="table-responsive">
                  <table class="table table-bordered table-hover" id="date_adesh_table">
                    <thead>
                      <tr >
                        <th class="text-center">মামলার তারিখ</th>
                        <th class="text-center">আদালতের আদেশ</th>   
                      </tr>
                    </thead>
                  </table>
                </div>

            </div>

            <div class="modal-footer" id="createPDFIdField">
              <a href="<?php echo base_url('suit/createPDF').'/'?>" class="btn btn-success"  target="_blank"><i class="fa fa-print" aria-hidden="true"></i> প্রিন্ট</a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">বন্ধ করুন</button>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="removeSuit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">মামলা ডিলেট</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <p>আপনি কি নিশ্চিত তথ্য ডিলিট করতে চান ?</p>   
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="removeSuitBtn">ডিলিট </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">বন্ধ করুন</button>
          </div>
      </div>
  </div>
</div>




<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="newDateAndAdeshMalmaId" aria-hidden="true" id="newDateAndAdesh">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="newDateAndAdeshMalmaId"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <?php echo form_open('suit/newDateAndAdesh', ['class' => 'form-horizontal','id' => 'newDateAndAdeshForm']);?>

            <div class="modal-body">

              <div class="form-group row">
                <label for="newAdesh" class="col-sm-3 col-form-label">আদালতের আদেশ : </label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="newAdesh" name="newAdesh" autocomplete="off"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="newDate" class="col-sm-3 col-form-label">মামলার নতুন তারিখ : </label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" id="newDate" name="newDate">
                </div>
              </div>

            </div>

            <div class="modal-footer" id="createPDFIdField">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">বন্ধ করুন</button>
            </div>

            <?php echo form_close();?>
            
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('custom/js/suit.js');?>"></script>