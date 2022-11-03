<?php

namespace App\Http\Controllers;
use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index()
    {
	    $alunos = Aluno::orderBy('id', 'desc')->paginate(5);
	    return view('index', compact('alunos'));
    }
    
    public function create()
    {
	    return view('create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'data_nascimento' => 'required',
        ]);
        
        Aluno::create($request->post());

        return redirect()->route('alunos.index')->with('success','Aluno has been created successfully.');
    }
    
    public function show(Aluno $aluno)
    {
        return view('alunos.show',compact('aluno'));
    }

    public function edit(Aluno $aluno)
    {
        return view('alunos.edit',compact('aluno'));
    }

    public function update(Request $request, Aluno $aluno)
    {
        $request->validate([
            'nome' => 'required',
            'data_nascimento' => 'required',
        ]);
        
        $aluno->fill($request->post())->save();

        return redirect()->route('alunos.index')->with('success','Aluno Has Been updated successfully');
    }

    public function destroy(Aluno $aluno)
    {
        $aluno->delete();
        return redirect()->route('alunos.index')->with('success','Aluno has been deleted successfully');
    }



}
