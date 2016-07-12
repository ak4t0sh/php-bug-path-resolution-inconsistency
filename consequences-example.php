<?php
$testingdir = __DIR__.'/foo';
$validfilepath = $testingdir.'/bar.php';
$inexistantpath=__DIR__."/inexistant_dir/../foo/bar.php";
$filecontent = "Test";

mkdir($testingdir);
file_put_contents($validfilepath, $filecontent);

echo "is $inexistantpath exists ? ...".(file_exists($inexistantpath)?"Yes":"No")."\n";
if (file_exists($inexistantpath) == false) {
    echo "I don't care I can still open it. Look the content is : ";
    echo file_get_contents($inexistantpath);    //does not exists ? i don't care
}
unlink($validfilepath);
rmdir($testingdir);