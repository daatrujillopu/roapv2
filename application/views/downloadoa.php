<?php
if( ! empty($download_path))
{

   /*header("Content-Disposition: attachment; filename=" . $name.".".$format);
    header("Content-Type: application/octet-stream");
    header("Content-Length: " . filesize($download_path));
    readfile($download_path);
    /*echo base_url() .$download_path;*/
    //$data = file_get_contents(base_url() .$download_path); // Read the file's contents
    $name = $download_path;

    force_download($name, NULL);

}
?>