<?php
echo "Current upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
echo "Current post_max_size: " . ini_get('post_max_size') . "<br>";
echo "Effective INI file: " . php_ini_loaded_file() . "<br>";
echo "Scanned INI files: " . php_ini_scanned_files() . "<br>";
