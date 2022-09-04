<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbPessoa
 * 
 * @property int $codigo_pessoa
 * @property string $nome
 * @property string $sobrenome
 * @property int $idade
 * @property string $login
 * @property string $senha
 * @property int $status
 * 
 * @property Collection|TbEndereco[] $tb_enderecos
 *
 * @package App\Models
 */
class TbPessoa extends Model
{
	protected $table = 'tb_pessoa';
	protected $primaryKey = 'codigo_pessoa';
	public $timestamps = false;

	protected $casts = [
		'idade' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'nome',
		'sobrenome',
		'idade',
		'login',
		'senha',
		'status'
	];

	public function tb_enderecos()
	{
		return $this->hasMany(TbEndereco::class, 'codigo_pessoa');
	}
}
