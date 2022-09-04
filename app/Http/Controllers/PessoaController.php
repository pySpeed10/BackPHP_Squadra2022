<?php

namespace App\Http\Controllers;

use App\Models\TbBairro;
use App\Models\TbEndereco;
use App\Models\TbMunicipio;
use Illuminate\Http\Request;
use App\Models\TbPessoa;
use App\Models\TbUf;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //codigoPessoa, login e status
    {
        $aux = null; //criei variaveis de busca para auxiliar a varredura na lógica query

        foreach ( $_GET as $chave => $valor ) {
            // $$chave cria as variáveis com os names dos elementos do formulário
            //$aux = $chave;
            $$chave = trim( strip_tags( $valor ) );

            if(($chave != 'codigoPessoa' or $chave != 'login' or $chave != 'status') == false){
                $aux = 'Não existe filtro para essa busca - 503';
            } else if($chave == 'codigoPessoa'){
                ////$ajuda = TbPessoa::find('codigo_pessoa');
                //$ajuda2 = TbBairro::find($ajuda->codigo_bairro);
    
                        $bairro = TbEndereco::where('codigo_pessoa', $codigoPessoa)
                        ->select('tb_endereco.codigo_bairro')->first()->codigo_bairro;
                        $mun = TbBairro::where('codigo_bairro', $bairro)
                        ->select('tb_bairro.codigo_municipio')->first()->codigo_municipio;
                        $uf = TbMunicipio::where('codigo_municipio', $mun)
                        ->select('tb_municipio.codigo_uf')->first()->codigo_uf;

                        $aux = [
                            TbPessoa::where('codigo_pessoa',$codigoPessoa)->get(),
                            TbEndereco::where('codigo_pessoa',$codigoPessoa)->get(),
                            TbBairro::where('codigo_bairro', $bairro)->get(),
                            TbMunicipio::where('codigo_municipio', $mun)->get(),
                            TbUf::where('codigo_uf', $uf)->get()
                        ];

                        
            } else if($chave == 'login'){
                        $pessoa = TbPessoa::where('login', $login)
                        ->select('tb_pessoa.codigo_pessoa')->first()->codigo_pessoa;
                        $bairro = TbEndereco::where('codigo_pessoa', $pessoa)
                        ->select('tb_endereco.codigo_bairro')->first()->codigo_bairro;
                        $mun = TbBairro::where('codigo_bairro', $bairro)
                        ->select('tb_bairro.codigo_municipio')->first()->codigo_municipio;
                        $uf = TbMunicipio::where('codigo_municipio', $mun)
                        ->select('tb_municipio.codigo_uf')->first()->codigo_uf;

                        $aux = [
                            TbPessoa::where('login',$login)->get(),
                            TbEndereco::where('codigo_pessoa',$pessoa)->get(),
                            TbBairro::where('codigo_bairro', $bairro)->get(),
                            TbMunicipio::where('codigo_municipio', $mun)->get(),
                            TbUf::where('codigo_uf', $uf)->get()
                        ];

                //$aux = TbPessoa::where('login', 'LIKE', '%'. $login.'%')->get();
            } else if($chave == 'status'){

                //$aux = TbPessoa::where('status', 'LIKE', '%'. $status.'%')->get();
                        $pessoa = TbPessoa::where('status', $status)
                        ->select('tb_pessoa.codigo_pessoa')->first()->codigo_pessoa;
                        $bairro = TbEndereco::where('codigo_pessoa', $pessoa)
                        ->select('tb_endereco.codigo_bairro')->first()->codigo_bairro;
                        $mun = TbBairro::where('codigo_bairro', $bairro)
                        ->select('tb_bairro.codigo_municipio')->first()->codigo_municipio;
                        $uf = TbMunicipio::where('codigo_municipio', $mun)
                        ->select('tb_municipio.codigo_uf')->first()->codigo_uf;
                        //(object) $aux -> pensei nisso para cosntruir em cascata mas me enrolei rsrs
                        $aux = [
                            TbPessoa::where('status',$status)->get(),
                            TbEndereco::where('codigo_pessoa',$pessoa)->get(),
                            TbBairro::where('codigo_bairro', $bairro)->get(),
                            TbMunicipio::where('codigo_municipio', $mun)->get(),
                            TbUf::where('codigo_uf', $uf)->get()
                        ];
            }
           return $aux;
        }

        if(isset($aux)==false){
            return TbPessoa::all();
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
            'nome' => 'required',
		    'sobrenome' => 'required',
		    'idade' => 'required',
		    'login' => 'required',
		    'senha' => 'required',
		    'status' => 'required'
        ]);
        $pessoa = TbPessoa::create($request->all());
        $endereco = new EnderecoController();

        $endereco->store($request, $pessoa->codigo_pessoa);

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
    public function update(Request $request, $id)
    {

        TbPessoa::findOrFail($id)->update($request->all());

        return response()->json([
            "Mensagem" => "Atualizado OK"
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
