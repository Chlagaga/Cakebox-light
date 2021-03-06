<?php

use Symfony\Component\HttpFoundation\Request;

$app->get("/api/file/info/{filepath}", function (Request $request, $filepath) use ($app) {

    $file = new SPLFileInfo($app["cakebox.root"].$filepath);

    $fileinfo             = [];
    $fileinfo["name"]     = $file->getBasename(".".$file->getExtension());
    $fileinfo["fullname"] = $file->getFilename();
    $fileinfo["mimetype"] = ($app["player.type"] != "DIVX") ? mime_content_type($file->getPathName()) : "video/divx";
    $fileinfo["access"]   = $app["cakebox.access"] . $filepath;
    $fileinfo["size"]     = $file->getSize();

    return $app->json($fileinfo);
})
->assert("filepath", ".*");
