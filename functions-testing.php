<?php
function print_result($functiontotest, $param, $expected, $actual) {
    echo "--------------------------------------------------------------------------------\n";
    echo "-- $functiontotest($param)\n";
    echo "-- Expected : ".var_export($expected,true)."\n";
    echo "-- Actual   : ".var_export($actual,true)."\n";
    echo "-- Result   : ".((var_export($actual,true)!=var_export($expected,true))?" WTF ?":"OK")."\n";
    echo "--------------------------------------------------------------------------------\n";
}

$testingdir = __DIR__.'/foo';
$validfilepath = $testingdir.'/bar.php';
$inexistantpath=__DIR__."/inexistant_dir/../foo/bar.php";
$filecontent = "Test";

mkdir($testingdir);
file_put_contents($validfilepath, $filecontent);

echo "######################################################################
#
# Testing using the original path
# $validfilepath
#
######################################################################\n";
print_result("file_exists", $validfilepath, true, file_exists($validfilepath));
print_result("realpath", $validfilepath, $validfilepath, realpath($validfilepath));
print_result("stream_resolve_include_path", $validfilepath, $validfilepath, stream_resolve_include_path($validfilepath));
print_result("file_get_contents", $validfilepath, $filecontent, file_get_contents($validfilepath));

echo "######################################################################
#
# Testing using a path containing an inexistant directory
# $inexistantpath
#
######################################################################\n";
print_result("file_exists", $inexistantpath, false, file_exists($inexistantpath));
print_result("realpath", $inexistantpath, false, realpath($inexistantpath));
print_result("stream_resolve_include_path", $inexistantpath, false, stream_resolve_include_path($inexistantpath));
print_result("file_get_contents", $inexistantpath, false, file_get_contents($inexistantpath));

unlink($validfilepath);
rmdir($testingdir);
?>