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


    <!-- Required common Js -->
    <script src="<?php echo base_url('assets/template/js/jquery-2.2.3.min.js');?>"></script>
    <!-- //Required common Js -->

    <!-- Js for bootstrap working-->
    <script src="<?php echo base_url('assets/template/js/popper.min.js');?>" ></script>
    <script src="<?php echo base_url('assets/template/js/bootstrap.min.js');?>"></script>
    <!-- //Js for bootstrap working -->

    <script src="<?php echo base_url('custom/js/forget.js')?>"></script>

    <script>
        $(window).load(function () {
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>
</body>

</html>