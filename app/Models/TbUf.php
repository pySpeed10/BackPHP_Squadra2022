<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbUf
 * 
 * @property int $codigo_uf
 * @property string $sigla
 * @property string $nome
 * @property int $status
 * 
 * @property Collection|TbMunicipio[] $tb_municipios
 *
 * @package App\Models
 */
class TbUf extends Model
{
	protected $table = 'tb_uf';
	protected $primaryKey = 'codigo_uf';
	public $timestamps = false;

	protected $casts = [
		'status' => 'int'
	];

	protected $fillable = [
		'sigla',
		'nome',
		'status'
	];

	public function tb_municipios()
	{
		return $this->hasMany(TbMunicipio::class, 'codigo_uf');
	}
}
