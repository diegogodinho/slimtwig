<?php

namespace App\Controllers;

use App\Domain\Foto;

class FotoController extends BaseController
{
    public function IndexJson($request, $response, $data)
	{
        $data = $request->getParsedBody();
		$total = Foto::count();
		$result = $this->Pagination(Foto::select('urlrelative','name','id'), (int)$data['start'], (int)$data['length'])->orderBy('id')->get();
		
		return $response->withJson([
			"data" => $result,
			"recordsTotal" => $total,
			"recordsFiltered"=> $total,			
		]);
	}

    public function Index($request, $response)
    {
        return $this->view->render($response, 'foto/foto-index.twig');
    }

    public function NewFoto($request, $response)
    {
        return $this->view->render($response, 'foto/upload-foto.twig');
    }
    public function Watermark($request, $response)
    {
        return $this->view->render($response, 'foto/watermark-upload.twig');
    }

    public function Create($request, $response)
    {
        return $this->_createFoto($request, $response);
    }

    public function WatermarkCreate($request, $response)
    {
        $this->_DeleteAllwaterMarks();
        return $this->_CreateFotowaterMark($request, $response);
    }

    public function Delete($request, $response)
    {
        $id = (int)$request->getAttribute('id');        
        $this->_DeleteImage($id);
        $response = $response->withStatus(200);
    }

    private function _DeleteImage($id)
    {        
        $fotoDel = Foto::find($id);
        if ($fotoDel) {            
            if (file_exists($fotoDel->physicaldirectory)) {
                unlink($fotoDel->physicaldirectory);
            }
            $fotoDel->delete();
        }
    }

    private function _DeleteAllwaterMarks()
    {
        $waterMarks = Foto::where('iswaterMark', 1)->get();
        foreach ($waterMarks as $waterMark) {
            if (file_exists($waterMark->physicaldirectory)) {
                unlink($waterMark->physicaldirectory);
            }
        }
        Foto::where('iswaterMark', 1)->delete();
    }

    private function _getFileName(UploadedFile $uploadedFile = null)
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

    private function _createwaterMark(&$foto, $directory)
    {
        //TODO: Get from the database
        $fotowaterMark = Foto::where('iswaterMark', 1)->first();
        if ($fotowaterMark) {
            $stamp = $this->_getImage($fotowaterMark->physicaldirectory);
            $marge_right = ((imagesx($foto) / 2) - (imagesx($stamp) / 2));
            $marge_bottom = ((imagesy($foto) / 2) - (imagesy($stamp) / 2));
            $sx = imagesx($stamp);
            $sy = imagesy($stamp);

            imagecopy($foto, $stamp, imagesx($foto) - $sx - $marge_right, imagesy($foto) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
        }
    }

    private function _createFoto($request, $response)
    {
        $uploadedFile = $_FILES['foto'];
        $data = $request->getParsedBody();
        $filename = $_FILES['foto']['tmp_name'];
        $directory = $this->container->get('upload_directory');
        $newFileName = $this->_getFileName() . '.jpeg';

        if (isset($uploadedFile)) {
            $source = $this->_getImage($filename);           

            $size = min(imagesx($source), imagesy($source));

            $im2 = imagecrop($source, ['x' => $data["x"], 'y' => $data["y"], 'width' => $data["width"], 'height' => $data["height"]]);
            if ($im2 !== false) {
                $this->_createwaterMark($im2, $directory);
                imagejpeg($im2, $directory . $newFileName);
            }
            imagedestroy($im2);
            imagedestroy($source);

            Foto::create([
                'name' => $newFileName,
                'urlrelative' => $request->getUri()->getBaseUrl() . $this->container->get('upload_directory_relative') . $newFileName,
                'physicaldirectory' => $directory . $newFileName,
                'iswaterMark' => 0,
            ]);

            $response = $response->withStatus(200)->withJson($request->getUri()->getBaseUrl() . $this->container->get('upload_directory_relative') . $newFileName);
        }
        return $response;
    }

    private function _CreateFotowaterMark($request, $response)
    {
        $uploadedFile = $_FILES['foto'];
        if (isset($uploadedFile)) {
            $filename = $_FILES['foto']['tmp_name'];
            $directory = $this->container->get('upload_directory');
            $newFileName = $this->_getFileName() . '.png';
            $watermark = $this->_getImage($filename);
            $img_w = imagesx($watermark);
            $img_h = imagesy($watermark);
            $im = imagecreatetruecolor($img_w, $img_h);
            $transparent = imagecolorallocatealpha($im, 0, 0, 0, 127);
            imagefill($im, 0, 0, $transparent);
            $black = imagecolorallocate($im, 0, 0, 0);
            imagecolortransparent($im, $black);
            imagealphablending($im, true);
            imagecopy($im, $watermark, 0, 0, 0, 0, $img_w, $img_h);
            imagepng($im, $directory . $newFileName);

            Foto::create([
                'name' => $newFileName,
                'urlrelative' => $request->getUri()->getBaseUrl() . $this->container->get('upload_directory_relative') . $newFileName,
                'physicaldirectory' => $directory . $newFileName,
                'iswaterMark' => 1,
            ]);

            imagedestroy($watermark);
            imagedestroy($im);
            $response = $response->withRedirect($this->router->pathFor('foto'));
        }
        return $response;
    }
}
