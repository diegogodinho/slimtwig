<?php

namespace App\Controllers;

use App\Domain\Foto;

class FotoController extends BaseController
{
    public function Index($request,$response)
    {
        return $this->view->render($response, 'picture/upload-image.twig');
    }
    public function IndexNoCropper($request,$response)
    {
        return $this->view->render($response, 'picture/upload-image-no-cropper.twig');
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
            
            $uploadedFile = $_FILES['foto'];
            $data = $request->getParsedBody();
            $filename = $_FILES['foto']['tmp_name'];
            $directory = $this->container->get('upload_directory');
            $newFileName =  $this->getFileName() . '.jpeg';                       

            if (isset($uploadedFile)) {
                //TODO:Watermark
                
                //TODO: Crop and Save
                $info = getimagesize($filename);
                $imgtype = image_type_to_mime_type($info[2]);            
                switch ($imgtype) {
                    case 'image/jpeg':
                        $source = imagecreatefromjpeg($filename);
                        break;
                    case 'image/gif':
                        $source = imagecreatefromgif($filename);
                        break;
                    case 'image/png':
                        $source = imagecreatefrompng($filename);
                        break;
                    default:
                        die('Invalid image type.');
                }
                $size = min(imagesx($source), imagesy($source));
                $im2 = imagecrop($source, ['x' => $data["x"], 'y' => $data["y"], 'width' => $data["width"], 'height' => $data["height"]]);
                if ($im2 !== FALSE) 
                {
                    imagejpeg($im2, $directory.$newFileName);
                }
                imagedestroy($source);
                imagedestroy($im2);
                
                Foto::create([
                    'name' => $newFileName
                ]);
                
                $response = $response->withStatus(200)->withJson($request->getUri()->getBaseUrl().$this->container->get('upload_directory_relative').$newFileName);
            }
        return $response;
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
