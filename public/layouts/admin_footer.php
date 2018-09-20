  <!-- Footer -->
<!--         <footer>
            <div class="row">
                <div id="footer" class="col-lg-12 col-md-12">
                    <p>Copyright &copy; Your Website <?php echo date("Y", time()); ?></p>
                </div>
            </div>
        </footer> -->

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>    

<?php if(isset($database)) { $database->close_connection(); } ?>