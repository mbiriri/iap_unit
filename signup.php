<?php
require_once 'ClassAutoLoad.php';

// Check if required objects exist
if (!$ObjLayout || !$ObjForms || !$ObjFncs) {
    die("Required components are not available. Please check your configuration.");
}

$ObjLayout->header($conf);
$ObjLayout->navbar($conf);
$ObjLayout->banner($conf);
$ObjLayout->form_content($conf, $ObjForms, $ObjFncs); // Added the missing parameters
$ObjLayout->footer($conf);
?>