<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbBairro
 * 
 * @property int $codigo_bairro
 * @property int $codigo_municipio
 * @property string $nome
 * @property int|null $status
 * 
 * @property TbMunicipio $tb_municipio
 * @property Collection|TbEndereco[] $tb_enderecos
 *
 * @package App\Models
 */
class TbBairro extends Model
{
	protected $table = 'tb_bairro';
	protected $primaryKey = 'codigo_bairro';
	public $timestamps = false;

	protected $casts = [
		'codigo_municipio' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'codigo_municipio',
		'nome',
		'status'
	];

	public function tb_municipio()
	{
		return $this->belongsTo(TbMunicipio::class, 'codigo_municipio');
	}

	public function tb_enderecos()
	{
		return $this->hasMany(TbEndereco::class, 'codigo_bairro');
	}
}
