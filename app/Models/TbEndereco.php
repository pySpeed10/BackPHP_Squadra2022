<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TbEndereco
 * 
 * @property int $codigo_endereco
 * @property int $codigo_pessoa
 * @property int $codigo_bairro
 * @property string $nome_rua
 * @property string $numero
 * @property string|null $complemento
 * @property string $cep
 * 
 * @property TbPessoa $tb_pessoa
 * @property TbBairro $tb_bairro
 *
 * @package App\Models
 */
class TbEndereco extends Model
{
	protected $table = 'tb_endereco';
	protected $primaryKey = 'codigo_endereco';
	public $timestamps = false;

	protected $casts = [
		'codigo_pessoa' => 'int',
		'codigo_bairro' => 'int'
	];

	protected $fillable = [
		'codigo_pessoa',
		'codigo_bairro',
		'nome_rua',
		'numero',
		'complemento',
		'cep'
	];

	public function tb_pessoa()
	{
		return $this->belongsTo(TbPessoa::class, 'codigo_pessoa');
	}

	public function tb_bairro()
	{
		return $this->belongsTo(TbBairro::class, 'codigo_bairro');
	}
}
