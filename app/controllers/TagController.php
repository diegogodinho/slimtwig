<?php

namespace App\Controllers;

use App\Domain\Tag;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

class TagController extends CRUDController
{
    //Index
    public function IndexView($request, $response)
    {
        return $this->view->render($response, 'tag/index.twig');
    }

    public function _all($request, $response, $data)
    {
        
        $query = Tag::select('id', 'name', 'active');
        $data = $request->getParsedBody();
        if ($data) {
            if (!empty($data['name'])) {
                $query = $query->where('name', 'like', '%' . $data['name'] . '%');
            }
            if ($data['active'] == '0' ||  $data['active'] == '1') {
                $query = $query->where('active', (int)$data['active']);
            }            
        }
        $total = $query->count();

        $result = $this->Pagination($query->orderby('id'), (int) $data['start'], (int) $data['length'])->get();

        return $response->withJson([
            "data" => $result,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
        ]);
    }

    //Create
    public function CreateView($request, $response)
    {
        return $this->view->render($response, 'tag/create.twig');
    }

    public function _create($request, $response, $data)
    {
        $validation = $this->validator->Validate($request, [
            'name' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('tag.createview'));
        }

        Tag::create([
            'name' => $data['name'],
        ]);

        return $response->withRedirect($this->router->pathFor('tag.indexview'));
    }

    //Edit
    public function EditView($request, $response)
    {

        $validation = $this->validator->Validate($request, [
            'id' => v::intVal()->positive(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('tag.indexview'));
        }

        $tag = Tag::find((int) $request->getAttribute('id'));

        $_SESSION['old'] = [
            'name' => $tag->name,
            'id' => $tag->id,
        ];
        $this->container->view->getEnvironment()->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : null);

        return $this->view->render($response, 'tag/create.twig');
    }

    public function _update($request, $response, $data, $tag)
    {
        $validation = $this->validator->Validate($request, [
            'name' => v::notEmpty(),
        ]);

        if (!$this->validator->Valid()) {
            return $response->withRedirect($this->router->pathFor('tag.editview', ["id" => $tag->id]));
        }

        $tag->name = $data['name'];
        $tag->save();
        return $response->withRedirect($this->router->pathFor('tag.indexview'));
    }

    public function _find($id)
    {
        return Tag::find($id);
    }

    public function Delete($request, $response)
    {

    }

    public function ActivateDeactivate($request, $response)
    {
        $tag = Tag::find((int) $request->getAttribute('id'));
        $tag->active = $tag->active ? 0 : 1;
        $tag->save();
        $response = $response->withStatus(200);
        return $response;
    }

}
