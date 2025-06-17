<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VaiTro
 * 
 * @property int $ma_vt
 * @property string $tieu_de
 * @property string|null $mo_ta
 * @property bool|null $trang_thai
 * 
 * @property Collection|Taikhoan[] $taikhoans
 *
 * @package App\Models
 */
class VaiTro extends Model
{
	protected $table = 'vai_tro';
	protected $primaryKey = 'ma_vt';
	public $timestamps = false;

	protected $casts = [
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'tieu_de',
		'mo_ta',
		'trang_thai'
	];

	public function taikhoans()
	{
		return $this->hasMany(Taikhoan::class, 'vai_tro');
	}
}
