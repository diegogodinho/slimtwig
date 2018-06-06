<?php

namespace App\Controllers;


class PictureController extends BaseController
{
    public function Index($request,$response)
    {
        return $this->view->render($response, 'picture/upload-picture.twig');
    }

    public function CreateImageTest($request, $response)
    {
        $directory = $this->container->get('upload_directory');
        $newFile = $directory.'example.jpeg';
        //$newFile2 = $directory. $this->getFileName() . '-crooped.jpeg';
        $newFile2 = $directory. 'Test' . '-crooped.jpeg';

        if (file_exists($newFile2))
        {
            unlink($newFile2);
        }

        $im = imagecreatefromjpeg($directory.'imageTest.jpg');
        $size = min(imagesx($im), imagesy($im));
        $im2 = imagecrop($im, ['x' => 10, 'y' => 10, 'width' => $size - 500, 'height' => $size- 500]);
        if ($im2 !== FALSE) {
            
            imagejpeg($im2, $newFile2);            
        }
        imagedestroy($im);
        imagedestroy($im2);
        
        $response = $response->write($newFile2);
        return $response;
    }

    public function SaveImage($request, $response)
    {
        $uploadedFiles = $request->getUploadedFiles();
        // handle single input with single file upload
        $uploadedFile = $uploadedFiles['picture'][0];
        var_dump($uploadedFiles);
        die();




        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            //TODO:Watermark
            
            //TODO: Crop and Save
            $info = getimagesize($uploadedFile);
            $imgtype = image_type_to_mime_type($info[2]);            
            switch ($imgtype) {
                case 'image/jpeg':
                    $source = imagecreatefromjpeg($uploadedFile);
                    break;
                case 'image/gif':
                    $source = imagecreatefromgif($uploadedFile);
                    break;
                case 'image/png':
                    $source = imagecreatefrompng($uploadedFile);
                    break;
                default:
                    die('Invalid image type.');
            }

            $im2 = imagecrop($im, ['x' => 10, 'y' => 10, 'width' => $size - 500, 'height' => $size- 500]);
            if ($im2 !== FALSE) 
            {
                imagejpeg($im2, $newFile2);
            }
            $response = $response->withStatus(200)->withJson($filename1);
        }

    }    

    private function getFileName(UploadedFile $uploadedFile = null)
    {
        //$extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php        
        //$filename = sprintf('%s.%0.8s', $basename, $extension);
        $filename = sprintf('%s', $basename);
        
        //$directory = $this->get('upload_directory');    
        //$uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
    
        return $filename;
    }
}
