    <script type="text/javascript" src="<?php echo base_url('custom/js/dashboard.js');?>"></script>

    <!-- Sidebar-nav Js -->
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <!--// Sidebar-nav Js -->

    <!-- profile-widget-dropdown js-->
    <script src="<?php echo base_url('assets/template/js/script.js');?>"></script>
    <!--// profile-widget-dropdown js-->

    <?php if($page_section === "ড্যাশবোর্ড"){ ?>
       <!-- Calender -->
        <script src="<?php echo base_url('assets/template/js/pignose.calendar.full.js')?>"></script>
        <script>
            //<![CDATA[
            $(function () {
                $('.calender').pignoseCalendar({
                    theme: 'blue',
                });
            });
            //]]>
        </script>
        <!--// Calender -->
    <?php } ?>

    <!-- dropdown nav -->
    <script>
        $(document).ready(function () {
            $(".dropdown").hover(
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideDown();
                    $(this).toggleClass('open');
                },
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideUp();
                    $(this).toggleClass('open');
                }
            );
        });
    </script>
    <!-- //dropdown nav -->

    <!-- Js for bootstrap working-->
    <script src="<?php echo base_url('assets/template/js/popper.min.js');?>" ></script>
    <script src="<?php echo base_url('assets/template/js/bootstrap.min.js');?>"></script>
    <!-- //Js for bootstrap working -->

    <!-- Js for file input-->
    <script src="<?php echo base_url('assets/fileinput/js/fileinput.js') ?>"></script>
    <!--// Js for file input-->

    <?php if($page_section === "মামলা নিয়ন্ত্রণ" || $page_section === "এস.এম.এস" || $page_section === "ই-মেইল ও এস.এম.এস পাঠান" || $page_section === "ই-মেইল ও এস.এম.এস বক্স"){ ?>

        <script type="text/javascript" src="<?php echo base_url('assets/DataTables/datatables.js')?>"></script>

        <?php if($page_section === "এস.এম.এস" || $page_section === "ই-মেইল ও এস.এম.এস পাঠান"){ ?>

            <script src="<?php echo base_url('assets/editor/summernote-bs4.js') ?>"></script>

        <?php } ?>

        <?php if($page_section === "ই-মেইল ও এস.এম.এস পাঠান"){ ?>
            <!-- Light Box -->
            <script src="<?php echo base_url('assets/lightBox/js/lightbox.min.js') ?>"></script>
            <!--// Light Box -->
        <?php } ?>

    <?php } ?>

    <script>
        $(window).load(function () {
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>

</body>

</html>