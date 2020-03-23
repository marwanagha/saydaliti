</div>

<!--Global Javascript -->
<!--<script src="./js/jquery.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>-->
<!--<script src="./js/popper/popper.min.js"></script>-->
<!--<script src="./js/tether.min.js"></script>-->
<!--<script src="./js/bootstrap.min.js"></script>-->
<!--<script src="./js/jquery.cookie.js"></script>-->
<!--<script src="./js/jquery.validate.min.js"></script>-->
<!--<script src="./js/chart.min.js"></script>-->
<!--<script src="./js/front.js"></script>-->
<!--<script src="./js/custom.js"></script>-->

<?php
foreach ($shared_js as $js) {
    if (isset($js)) {
        echo "<script src=\"{$js}\"></script>";
    }
}

?>

<!--Core Javascript -->

</body>

</html>