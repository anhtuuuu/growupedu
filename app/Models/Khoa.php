<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class Khoa
 * 
 * @property int $ma_khoa
 * @property string $ten_khoa
 * @property string $alias
 * @property string|null $mo_ta
 * @property bool|null $trang_thai
 * 
 * @property Collection|BoMon[] $bo_mons
 *
 * @package App\Models
 */
class Khoa extends Model
{
	protected $table = 'khoa';
	protected $primaryKey = 'ma_khoa';
	public $timestamps = false;

	protected $casts = [
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ten_khoa',
		'alias',
		'mo_ta',
		'trang_thai'
	];

	public function bo_mons()
	{
		return $this->hasMany(BoMon::class, 'ma_khoa');
	}
}
