<?php namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;
use App\Models\TagModel;
use \CodeIgniter\Exceptions\PageNotFoundException;

class Tag extends BaseController {
    public function index(){

        $tag = new TagModel();

        $data = [
            'tags' => $tag->asObject()
            ->paginate(10),
            'pager' =>$tag->pager
        ];

        $this->_loadDefaultView('Listado de etiquetas',$data,'index');
    }

    public function new(){

        $tag = new TagModel();

        //mkdir('writeable/uploads/test',0755,true);

        $validation = \Config\Services::validation();
        
        $this->_loadDefaultView('Crear etiqueta',['validation'=>$validation, 'tag'=> new tagModel(),'tags'=> $tag->asObject()->findAll()],'new');

    }

    public function create(){

        $tag = new TagModel();

        if($this->validate('tags')){
            $id = $tag->insert([
                'name'=>$this->request->getPost('name'),
            ]);

            return redirect()->to("/dashboard/tag/$id/edit")->with('message', 'etiqueta creada con éxito');

        }else{
            echo $this->validator->listErrors();
            return;
        }

        return redirect()->back()->withInput();
        
    }
    public function edit($id = null){

        $tag = new tagModel();

        if ($tag->find($id)==null) 
        {
            throw PageNotFoundException::forPageNotFound();
        }

        echo "Sesión: ".session('message');

        $validation = \Config\Services::validation();
        
        $this->_loadDefaultView('Actualizar etiqueta',
        ['validation'=>$validation,'tag'=>$tag->asObject()->find($id),
        ],'edit');

    }
    public function update($id = null){

        $tag = new TagModel();

        if ($tag->find($id)==null)
        {
            throw PageNotFoundException::forPageNotFound();
        }

        if($this->validate('tags')){
            $tag->update($id, [
                'name'=>$this->request->getPost('name'),
            ]);

            return redirect()->to('/dashboard/tag')->with('message', 'etiqueta editada con éxito');

        }
             
        return redirect()->back()->withInput();
    }
    public function delete($id = null){

        $tag = new TagModel();

        if ($tag->find($id)==null)
        {
            throw PageNotFoundException::forPageNotFound();
        }

        $tag->delete($id);
        //echo "Delete $id";
        return redirect()->to('/dashboard/tag')->with('message', 'etiqueta eliminada con éxito');
    }

    private function _loadDefaultView($title,$data,$view){
        
        $dataHeader = [
            'title' => $title
        ];

        echo view("dashboard/templates/header",$dataHeader);
        echo view("dashboard/tag/$view",$data);
        echo view("dashboard/templates/footer");
    }
}