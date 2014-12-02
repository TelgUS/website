<?php
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], 'c:/temp/' . $_FILES['userfile']['name'])) {
        print "Received {$_FILES['userfile']['name']} - its size is {$_FILES['userfile']['size']}";
    } else {
        print "Upload failed!";
    }
    
    $file = fopen('c:/temp/' . $_FILES['userfile']['name'], "r");
    flock($file, LOCK_UN);
    fclose($file);
?>