<?php

namespace App\Http\Controllers;

use App\Models\TbBairro;
use Illuminate\Http\Request;

class BairroController extends Controller
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
            // $$chave cria as variáveis com os names dos elementos do url
            //$aux = $chave;
            $$chave = trim( strip_tags( $valor ) );

            if(($chave != 'codigoMunicipio' or $chave != 'nome' or $chave != 'codigoBairro') == false){
                $aux = 'Não existe filtro para essa busca - 503';
            } else if($chave == 'codigoMunicipio'){
                $aux = TbBairro::where('codigo_municipio', 'LIKE', '%'. $codigoMunicipio.'%')->get();
            } else if($chave == 'nome'){
                $aux = TbBairro::where('nome', 'LIKE', '%'. $nome.'%')->get();
            } else if($chave == 'codigoBairro'){
                $aux = TbBairro::where('codigo_bairro', 'LIKE', '%'. $codigoBairro.'%')->get();
            }
           return $aux;
        }

        if(isset($aux)==false){
            return TbBairro::all();
        }
        //$qtd = $_GET['sigla']; outra forma de pegar parâmetros 
        //$qtd2 = $_GET['nome'];
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
            'codigo_municipio' => 'required',
            'nome' => 'required',
            'status' => 'required'
        ]);

        $bairro = TbBairro::create($request->all());

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
    public function update(Request $request, $codigoBairro)
    {
        TbBairro::findOrFail($codigoBairro)->update($request->all());

        return response()->json([
            "Mensagem" => "Cadastro OK"
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
