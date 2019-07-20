        </div> <!-- #Content div do not remove -->
    </div><!-- Wrapper div do not remove -->   
    <!-- <footer class="page-footer special-gradient mt-7 pt-3" >
        <div class="footer-copyright text-center">© 2018 Copyright <b>ENERGY MARKET GROUP</b>
        </div>

    </footer> -->

        <!-- jQuery CDN -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min2.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <!-- Bootstrap Js CDN -->
        <!-- <script src="<?php echo base_url(); ?>assets/js/mdb.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/js/mdb.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <!-- jQuery Custom Scroller CDN -->
        
        <script type="text/javascript">
            $(document).ready(function () {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('#dismiss, .overlay').on('click', function () {
                    $('#sidebar').removeClass('active');
                    $('.overlay').fadeOut();
                });

                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').addClass('active');
                    $('.overlay').fadeIn();
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready( function () {
                $('#allTable').DataTable();
            } );
        </script>
    </body> <!-- DO NOT REMOVE BODY div -->
</html> <!-- DO NOT REMOVE HTML div -->