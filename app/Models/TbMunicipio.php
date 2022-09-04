<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbMunicipio
 * 
 * @property int $codigo_municipio
 * @property int $codigo_uf
 * @property string|null $nome
 * @property int|null $status
 * 
 * @property TbUf $tb_uf
 * @property Collection|TbBairro[] $tb_bairros
 *
 * @package App\Models
 */
class TbMunicipio extends Model
{
	protected $table = 'tb_municipio';
	protected $primaryKey = 'codigo_municipio';
	public $timestamps = false;

	protected $casts = [
		'codigo_uf' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'codigo_uf',
		'nome',
		'status'
	];

	public function tb_uf()
	{
		return $this->belongsTo(TbUf::class, 'codigo_uf');
	}

	public function tb_bairros()
	{
		return $this->hasMany(TbBairro::class, 'codigo_municipio');
	}
}
