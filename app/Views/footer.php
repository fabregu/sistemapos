    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Desarrollado por Freddy Abregú  <?php echo date('Y'); ?></div>
                <div>
                    <a href="https://facebook.com/impressiveline" target="_blank">Facebook</a>
                                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
            </div>
    </footer>
    </div>
</div>
       

        <script src="<?php echo base_url(); ?>/js/all.min.js"></script>
        <script src="<?php echo base_url(); ?>/js/jquery-3.5.1.min.js" ></script>
        <!--<script src="<?php echo base_url(); ?>/js/jquery-3.5.1.slim.min.js" ></script>-->
        <script src="<?php echo base_url(); ?>/js/bootstrap.bundle.min.js" ></script>
        <script src="<?php echo base_url(); ?>/js/scripts.js"></script>

        <script src="<?php echo base_url(); ?>/js/jquery-ui/external/jquery/jquery.js"></script>
        <script src="<?php echo base_url(); ?>/js/jquery-ui/jquery-ui.min.js"></script>
        
        <script src="<?php echo base_url(); ?>/js/jquery.dataTables.min.js" ></script>
        <script src="<?php echo base_url(); ?>/js/dataTables.bootstrap4.min.js" ></script>
        <script src="<?php echo base_url(); ?>/assets/demo/datatables-demo.js"></script>
        
        
        <script>
            $('#modal-confirma').on('show.bs.modal', function(e){
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
            }
                );

        </script>
    </body>
</html>
