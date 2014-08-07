<?php
if($_SESSION["verify"] != "FileManager4TinyMCE") die('forbidden');

require_once (dirname(__FILE__) . '/../../../../../../../../../../top.inc.php');

//Specifies where the root of your webpage sits on disk. Usually it is best to
//leave it as DOCUMENT_ROOT
$root = LC_DIR_IMAGES;

//**********************
//Path configuration
//**********************
// The default configuration uses the following setup
// | - root
// | | - uploads <- Directory where files will be uploaded
// | | - thumbs  <- Directory containing auto-generated thumbnails
// | | - tinymce
// | | | - plugins
// | | | | - filemanager

$base_url = \XLite::getInstance()->getShopURL(
    \XLite::getInstance()->getOptions(array('host_details', 'web_dir')) . '/images/'
); //url base of site if you want only relative url leave empty

$upload_dir = 'filemanager' . LC_DS . 'uploads'; // path from the base_url to the uploads folder
$thumbs_dir = 'filemanager' . LC_DS . 'thumbs'; // path from the base_url to thumbs folder

if (!is_dir($root . $upload_dir)) {
    \Includes\Utils\FileManager::mkdirRecursive($root . $upload_dir);
}

if (!is_dir($root . $thumbs_dir)) {
    \Includes\Utils\FileManager::mkdirRecursive($root . $thumbs_dir);
}

$MaxSizeUpload=1000; //Mb

//**********************
//Image config
//**********************
//set max width pixel or the max height pixel for all images
//If you set dimension limit, automatically the images that exceed this limit are convert to limit, instead
//if the images are lower the dimension is maintained
//if you don't have limit set both to 0
$image_max_width=0;
$image_max_height=0;

//Automatic resizing //
//If you set true $image_resizing the script convert all images uploaded to image_width x image_height resolution
//If you set width or height to 0 the script calcolate automatically the other size
$image_resizing=false;
$image_width=600;
$image_height=0;

//Thumbnail Size//
$thumbnail_width=122;
$thumbnail_height=91;

//******************
//Permissions config
//******************
$delete_file=true;
$create_folder=true;
$delete_folder=true;
$upload_files=true;


//**********************
//Allowed extensions
//**********************
$ext_img = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff'); //Images
$ext_video = array('mov', 'mpeg', 'mp4', 'avi', 'mpg','wma'); //Videos
$ext_music = array('mp3', 'm4a', 'ac3', 'aiff', 'mid'); //Music


$ext=array_merge($ext_img, $ext_video,$ext_music); //allowed extensions

?>
