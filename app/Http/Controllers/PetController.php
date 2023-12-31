<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
class PetController extends Controller
{
    public $pet;

    public function _construct(Pet $pet)
    {
        $this->pet = $pet;
    }

    public function index(Request $request)
    {
        $petsAdotados = Pet::query()->where('adotado', 1)->count();
        $selectedTipo = $request->input('tipo');
        $pet = Pet::query();

        if ($selectedTipo) {
            if($selectedTipo == 5){ //Exceção para os admins verem os já adotados
                $pet = $pet->where('adotado', 1)->get();
            } else {
                $pet = $pet->where('tipo', $selectedTipo)->where('adotado', 0)->get();
            }
        } else {
            $pet = $pet->get()->where('adotado', 0); //Adotado = 0 -> Não adotado
        }
        
        return  view('pet.index', compact('pet', 'selectedTipo', 'petsAdotados'));
    }

    public function adicionar()
    {
        return view('pet.adicionar');
    }

    public function salvar(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'descricao' => 'required',
            'castrado' => 'required',
            'vacinado' => 'required',
            'idade' => 'required',
            'genero' => 'required',
            'cor' => 'required',
            'tamanho' => 'required',
            'peso' => 'required',
            'tipo' => 'required',
            'imagem' => 'required',
            'imagem.*' => 'mimes:doc,pdf,docx,zip,png,jpge,jpg'
        ]);
       
        if ($request->hasfile('imagem')) {
            $file = $request->file('imagem');
            $name = time() . '.' . $file->extension();
            $file->move(public_path() . '/storage/', $name);
            $data = $name;
        }

        $pet = Pet::create($request->all());
        if ($file) {
            $pet->imagem = $data;
        }
        $pet->save();
        return redirect()->route('pet.detalhar', $pet->id);
    }

    public function editar($id)
    {
        $pet = Pet::find($id);
        return view('pet.editar', compact('pet'));
    }

    public function atualizar(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'castrado' => 'required',
            'vacinado' => 'required',
            'genero' => 'required',
            'cor' => 'required',
            'idade' => 'required',
            'tamanho' => 'required',
            'peso' => 'required',
            'tipo' => 'required',
            'imagem.*' => 'mimes:doc,pdf,docx,zip,png,jpge,jpg'
        ]);

        $pet = Pet::find($id);
        
        if ($request->hasfile('imagem')) {
            $file = $request->file('imagem');
            $name = time() . '.' . $file->extension();
            $file->move(public_path() . '/storage/', $name);
            $data = $name;
            $image_path = public_path() . '/storage/' . $pet->imagem;
            File::delete($image_path);
            $pet->imagem = $data;
        }

        $pet->update($request->all());
        $pet->save();

        return redirect()->route('pet.detalhar', $id);
    }

    public function detalhar($id)
    {
        $pet = Pet::find($id);
        return view('pet.detalhar')->with('pet', $pet);
    }

    public function excluir($id)
    {
        $pet = Pet::find($id);
        $image_path = public_path() . '/storage/' . $pet->imagem;
        File::delete($image_path);
        Pet::destroy($id);
        $pet = Pet::where('adotado', 0)->get();
        return redirect()->route('pet.index', compact('pet'));
    }
    
}
