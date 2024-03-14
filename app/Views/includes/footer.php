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
    "public/assets/js/plugins-init/select2-init.js",
    "public/assets/vendor/toastr/js/toastr.min.js",
    "public/assets/js/plugins-init/toastr-init.js",
];

foreach ($assets_arr as $assets) {
    echo script_tag($assets);
}

$session = \Config\Services::session();
if ($session->get('notify')) {
    $notify_data = $session->get('notify');
    echo '<script>
    toastr.' . $notify_data['type'] . '("' . $notify_data['content'] . '", "Top Right", {
        timeOut: 3000,
        closeButton: !0,
        debug: !1,
        newestOnTop: !0,
        progressBar: !0,
        positionClass: "toast-top-right",
        preventDuplicates: !0,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        tapToDismiss: !1
    });
    </script>';
    $session->set('notify', null);
}
?>

</div>

</body>

</html>