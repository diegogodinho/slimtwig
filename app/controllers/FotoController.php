<?php

namespace App\Controllers;

use App\Domain\Foto;

class FotoController extends BaseController
{
    public function Index($request, $response)
    {
        return $this->view->render($response, 'foto/upload-foto.twig');
    }
    public function Watermark($request, $response)
    {
        return $this->view->render($response, 'foto/watermark.twig');
    }

    public function Create($request, $response)
    {
        return $this->_createFoto($request, $response);
    }    

    public function Delete($request, $response)
    {

    }   

    private function getFileName(UploadedFile $uploadedFile = null)
    {        
        $basename = bin2hex(random_bytes(8));       
        $filename = sprintf('%s', $basename);
        return $filename;
    }

    private function _getImage($filename)
    {
        $info = getimagesize($filename);
        $imgtype = image_type_to_mime_type($info[2]);
        switch ($imgtype) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($filename);
                return $source;
            case 'image/gif':
                $source = imagecreatefromgif($filename);
                return $source;
            case 'image/png':
                $source = imagecreatefrompng($filename);
                return $source;
            default:
                die('Invalid image type.');
        }
    }

    private function _createWatherMark(&$foto, $directory)
    {
        $stamp = $this->_getImage($directory . 'stamp.jpeg');
        $marge_right = ((imagesx($foto) / 2) - (imagesx($stamp) / 2));
        $marge_bottom = ((imagesy($foto) / 2) - (imagesy($stamp) / 2));
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        imagecopy($foto, $stamp, imagesx($foto) - $sx - $marge_right, imagesy($foto) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
    }

    private function _createFoto($request, $response, $createWatherMark = true)
    {
        $uploadedFiles = $request->getUploadedFiles();

        $uploadedFile = $_FILES['foto'];
        $data = $request->getParsedBody();
        $filename = $_FILES['foto']['tmp_name'];
        $directory = $this->container->get('upload_directory');
        $newFileName = $this->getFileName() . '.jpeg';

        if (isset($uploadedFile)) {
            $source = $this->_getImage($filename);

            $size = min(imagesx($source), imagesy($source));
            $im2 = imagecrop($source, ['x' => $data["x"], 'y' => $data["y"], 'width' => $data["width"], 'height' => $data["height"]]);
            if ($im2 !== false) {
                if ($createWatherMark) {
                    $this->_createWatherMark($im2, $directory);
                    imagejpeg($im2, $directory . $newFileName);
                }
            }
            imagedestroy($source);
            imagedestroy($im2);

            Foto::create([
                'name' => $newFileName,
            ]);

            $response = $response->withStatus(200)->withJson($request->getUri()->getBaseUrl() . $this->container->get('upload_directory_relative') . $newFileName);
        }
        return $response;

    }
}
