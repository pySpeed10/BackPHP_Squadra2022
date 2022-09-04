<?php

namespace App\Http\Controllers;

use App\Models\TbUf;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

use function PHPUnit\Framework\isNull;

class Uf extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {   $aux = null;

        foreach ( $_GET as $chave => $valor ) {
            // $$chave cria as variáveis com os names dos elementos do formulário
            //$aux = $chave;
            $$chave = trim( strip_tags( $valor ) );

            if(($chave != 'sigla' or $chave != 'nome' or $chave != 'codigoMunicipio') == false){
                $aux = 'Não existe filtro para essa busca - 503';
            } else if($chave == 'sigla'){
                $aux = TbUf::where('sigla', 'LIKE', '%'. $sigla.'%')->get();
            } else if($chave == 'nome'){
                $aux = TbUf::where('nome', 'LIKE', '%'. $nome.'%')->get();
            } else if($chave == 'codigoUf'){
                $aux = TbUf::where('codigo_uf', 'LIKE', '%'. $codigoMunicipio.'%')->get();
            }
           return $aux;
        }

        if(isset($aux)==false){
            return TbUf::all();
        }
        //$qtd = $_GET['sigla'];
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
            'sigla' => 'required',
            'nome' => 'required',
            'status' => 'required'
        ]);

        TbUf::create($request->all());

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
    public function update(Request $request, $codigoUf)
    {
            TbUf::findOrFail($codigoUf)->update($request->all());

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
