<?php

namespace App\Http\Controllers;

use App\Models\TbEndereco;
use App\Models\TbBairro;
use App\Models\TbMunicipio;
use App\Models\TbUf;
use App\Models\TbPessoa;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TbEndereco::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $codigo_pessoa
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $codigo_pessoa)
    {
        //$request->codigo_pessoa = $codigo_pessoa;

        $pessoa = TbPessoa::findOrFail($codigo_pessoa);
        
        $request->validate([
		    'codigo_bairro' => 'required',
		    'nome_rua' => 'required',
		    'numero' => 'required',
		    'complemento' => 'required',
		    'cep' => 'required',
        ]);

        $endereco = new TbEndereco();
        $request['codigo_pessoa'] = $codigo_pessoa;
        $endereco = TbEndereco::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
