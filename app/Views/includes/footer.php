<?php

$assets_arr = [
    "public/assets/vendor/jquery/jquery.min.js",
    "public/assets/vendor/jqueryui/js/jquery-ui.min.js",
    "public/assets/vendor/global/global.min.js",
    "public/assets/js/custom.min.js",
    "public/assets/js/quixnav-init.js",
    "public/assets/vendor/datatables/js/jquery.dataTables.min.js",
    "public/assets/js/plugins-init/datatables.init.js",
    "public/assets/vendor/select2/js/select2.full.min.js",
    "public/assets/js/plugins-init/select2-init.js"
];

foreach ($assets_arr as $assets) {
    echo script_tag($assets);
}
?>
<!-- <script src="public/templates/vendor/jqueryui/js/jquery-ui.min.js"></script>
<script src="public/templates/vendor/global/global.min.js"></script>
<script src="public/templates/js/custom.min.js"></script>
<script src="public/templates/js/quixnav-init.js"></script>
<script src="public/templates/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="public/templates/js/plugins-init/datatables.init.js"></script>
<script src="public/templates/vendor/select2/js/select2.full.min.js"></script>
<script src="public/templates/js/plugins-init/select2-init.js"></script>  -->

</div>

</body>

</html>