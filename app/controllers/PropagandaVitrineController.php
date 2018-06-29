<?php
namespace App\Controllers;

use App\Domain\Foto;

class PropagandaVitrineController extends BaseController
{
    public function CriarPropagandaVitrine($request, $response)
    {
        return $this->view->render($response, 'propagandavitrine/index.twig');
    }
}
