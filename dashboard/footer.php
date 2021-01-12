                </div>
            <!-- #/ container -->
        </div>
        <!-- #/ content body -->
    </div>

    <!-- Common JS -->
    <script src="assets/plugins/common/common.min.js"></script>

    <script src="assets/plugins/wysihtml5/js/wysihtml5-0.3.0.js"></script>
    <script src="assets/plugins/wysihtml5/js/bootstrap-wysihtml5.js"></script>
    <script src="assets/plugins/wysihtml5/js/wysihtml5-init.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>

    <script type="text/javascript" src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    
    <!-- icheck -->
    <script src="assets/plugins/icheck/icheck.min.js"></script>
    <!-- Custom script -->
    <script src="assets/js/custom.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {    
           
            //sidebar user card
            $('.nav-user-option').hide();
            $('#showUser').click(function() {
                if($('.nav-user').hasClass('user-card-sm')) {
                    $('.nav-user').removeClass('user-card-sm');
                } else {
                    $('.nav-user').addClass('user-card-sm');
                }
                $('.nav-user-option').slideToggle( "slow" );
                $("#showUser i").toggleClass("icofont-thin-up icofont-thin-down");
            });

  

        });

         window.onload = function(){
           // const ps = new PerfectScrollbar('.scroll-card', {
           //    wheelSpeed: 2,
           //    wheelPropagation: true,
           //    minScrollbarLength: 20
           //  });

            $('.scroll-card').each(function(){ const ps = new PerfectScrollbar($(this)[0]); });
            $('.scroll-div').each(function(){ const ps = new PerfectScrollbar($(this)[0]); });
            $('.news-card').each(function(){ const ps = new PerfectScrollbar($(this)[0]); });
            $('.scroll-card-sm').each(function(){ const ps = new PerfectScrollbar($(this)[0]); });
            
        } 


        // dynamic progressbar
        var i = 0;
        function makeProgress(){
            if(i < 60){
                i = i + 1;
                $(".meter-progress").css("width", i + "%");
            }
            // Wait for sometime before running this script again
            setTimeout("makeProgress()", 100);
        }
        makeProgress();
    </script>
</body>
</html>