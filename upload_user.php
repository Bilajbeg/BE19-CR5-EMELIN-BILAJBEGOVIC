<?php
function upload_user($picture)
{
    if ($picture["error"] == 4) {
        $pictureName = "avatar.png";
        $message = "You didn't choose any picture, but you can upload it later";
    } else {
        $checkIfImage = getimagesize($picture["tmp_name"]);
        $message = $checkIfImage ? "Ok" :  "Not an image";
    }
    if ($message == "Ok") {
        $ext = strtolower(pathinfo($picture["name"], PATHINFO_EXTENSION));
        $pictureName = uniqid("") . "." . $ext;
        $destination = "pictures/{$pictureName}";
        move_uploaded_file($picture["tmp_name"], $destination);
    } elseif ($message == "Not an image") {
        $pictureName = "avatar.png";
        $message = "The file that you selected is not an image, you can upload it later";
    }
    return [$pictureName, $message];
};
