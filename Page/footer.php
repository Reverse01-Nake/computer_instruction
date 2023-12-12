            <?php if (isset($_SESSION['success'])) {?>
                <div class="alert alert-success a-d" style="display: flex;" role="alert" id="alert">
                    <p style="margin: 0;">
                        <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </p>
                    <button type="button" class="btn-close" style="margin-left: 3rem; padding: .25rem;" onclick="CloseAlert()"></button>
                </div>
            <?php } ?>  
            <?php if (isset($_SESSION['error'])) {?>
                <div class="alert alert-danger a-d" style="display: flex;" role="alert" id="alert">
                    <p style="margin: 0;">
                        <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        ?>
                    </p>
                    <button type="button" class="btn-close" style="margin-left: 3rem; padding: .25rem;" onclick="CloseAlert()"></button>
                </div>
            <?php } ?>  
            </div>
        </div>
    </div>

</body>

</html>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="../assets/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
<script src="../assets/js/main.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
</script>