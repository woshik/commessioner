<div class="outer-w3-agile mt-3">
  <h4 class="tittle-w3-agileits mb-4">মামলা ফরম</h4>
  <?php echo form_open('suit/create', ['id' => 'createSuitForm']);?>

  <div id="add-suit-messages"></div>

  <div class="form-group">
    <label for="mamlaNo"><b>মামলা নং</b></label>
    <input type="text" class="form-control" id="mamlaNo" name="mamlaNo" placeholder="মামলা নং" required autocomplete="off">
  </div>

  <div class="form-group">
    <label for="apilkarirNam"><b>আপীলকারীর নাম<b></label>
    <input type="text" class="form-control" id="apilkarirNam" name="apilkarirNam" placeholder="আপীলকারীর নাম" required autocomplete="off">
  </div>

  <div class="form-group">
    <label for="apilkarirTikana"><b>আপীলকারীর ঠিকানা</b></label>
    <input type="text" class="form-control" id="apilkarirTikana" name="apilkarirTikana" placeholder="আপীলকারীর ঠিকানা" autocomplete="off">
  </div>

  <div class="form-group">
    <label for="apilkarirPhone"><b>আপীলকারীর ফোন নম্বর</b></label>
    <input type="text" class="form-control" id="apilkarirPhone" name="apilkarirPhone" placeholder="আপীলকারীর ফোন নম্বর" required autocomplete="off">
  </div>

  <div class="form-group">
    <label for="protipokherNam"><b>প্রতিপক্ষের নাম</b></label>
    <input type="text" class="form-control" id="protipokherNam" name="protipokherNam" placeholder="প্রতিপক্ষের নাম" required autocomplete="off">
  </div>

  <div class="form-group">
    <label for="protipokherTikana"><b>প্রতিপক্ষের ঠিকানা</b></label>
    <input type="text" class="form-control" id="protipokherTikana" name="protipokherTikana" placeholder="প্রতিপক্ষের ঠিকানা" autocomplete="off">
  </div>

  <div class="form-group">
    <label for="protipokherPhone"><b>প্রতিপক্ষের ফোন নম্বর</b></label>
    <input type="text" class="form-control" id="protipokherPhone" name="protipokherPhone" placeholder="প্রতিপক্ষের ফোন নম্বর" required autocomplete="off">
  </div>

  <div class="form-group">
    <label for="jaharAdese"><b>যাহার আদেশের বিরুদ্ধে আপীল</b></label>
    <textarea class="form-control" id="jaharAdese" name="jaharAdese" placeholder="যাহার আদেশের বিরুদ্ধে আপীল" autocomplete="off"></textarea>
  </div>

  <div class="form-group">
    <label for="jeAdese"><b>যে আদেশের বিরুদ্ধে আপীল</b></label>
    <textarea class="form-control" id="jeAdese" name="jeAdese" placeholder="যে আদেশের বিরুদ্ধে আপীল" autocomplete="off"></textarea>
  </div>

  <div class="form-group">
    <label for="apilerTarik"><b>আপীলদায়ের তারিখ</b></label>
    <input type="date" class="form-control" id="apilerTarik" name="apilerTarik" value="<?php echo date('Y-m-d'); ?>" required>
  </div>

  <div class="form-group">
    <label for="porobortiTarik"><b>পরবর্তী তারিখ</b></label>
    <input type="date" class="form-control" id="porobortiTarik" name="porobortiTarik" required>
  </div>

  <div class="form-group">
    <label for="adaloterAdesh"><b>অএ আদালতের আদেশ</b></label>
    <textarea class="form-control" id="adaloterAdesh" name="adaloterAdesh" placeholder="অএ আদালতের আদেশ" autocomplete="off"></textarea>
  </div>

  <div class="form-group">
    <label for="mamlarBiboron"><b>মামলার বিবরন</b></label>
    <textarea class="form-control" id="mamlarBiboron" name="mamlarBiboron" placeholder="মামলার বিবরন" autocomplete="off"></textarea>
  </div>

  <div class="form-group">        
    <div class="text-center">
      <button type="reset" class="btn btn-primary">Reset</button>
      <button type="submit" class="btn btn-success">Submit</button>
    </div>
  </div>


  <?php echo form_close();?>
</div>

<script type="text/javascript" src="<?php echo base_url('custom/js/suit-create.js');?>"></script>


      
