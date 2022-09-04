<?php

namespace App\Http\Controllers;

use App\Models\TbMunicipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aux = null;

        foreach ( $_GET as $chave => $valor ) {
            // $$chave cria as variáveis com os names dos elementos do formulário
            //$aux = $chave;
            $$chave = trim( strip_tags( $valor ) );

            if(($chave != 'codigoMunicipio' or $chave != 'nome' or $chave != 'codigoUf') == false){
                $aux = 'Não existe filtro para essa busca - 503';
            } else if($chave == 'codigoMunicipio'){
                $aux = TbMunicipio::where('codigo_municipio', 'LIKE', '%'. $codigoMunicipio.'%')->get();
            } else if($chave == 'nome'){
                $aux = TbMunicipio::where('nome', 'LIKE', '%'. $nome.'%')->get();
            } else if($chave == 'codigoUf'){
                $aux = TbMunicipio::where('codigo_uf', 'LIKE', '%'. $codigoUf.'%')->get();
            }
           return $aux;
        }

        if(isset($aux)==false){
            return TbMunicipio::all();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo_uf' => 'required',
            'nome' => 'required',
            'status' => 'required'
        ]);

        TbMunicipio::create($request->all());

        return response()->json([
            "Mensagem" => "Cadastro OK"
        ], 200);
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
    public function update(Request $request, $codigoMunicipio)
    {
        TbMunicipio::findOrFail($codigoMunicipio)->update($request->all());

        return response()->json([
            "Mensagem" => "Modificação OK"
        ], 200);
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
