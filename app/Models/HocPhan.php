<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HocPhan
 * 
 * @property int $ma_hp
 * @property int $ma_bm
 * @property string $ten_hp
 * @property string $alias
 * @property string|null $mo_ta
 * @property bool|null $trang_thai
 * 
 * @property BoMon $bo_mon
 * @property Collection|LopHocPhan[] $lop_hoc_phans
 *
 * @package App\Models
 */
class HocPhan extends Model
{
	protected $table = 'hoc_phan';
	protected $primaryKey = 'ma_hp';
	public $timestamps = false;

	protected $casts = [
		'ma_bm' => 'int',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_bm',
		'ten_hp',
		'alias',
		'mo_ta',
		'trang_thai'
	];

	public function bo_mon()
	{
		return $this->belongsTo(BoMon::class, 'ma_bm');
	}

	public function lop_hoc_phans()
	{
		return $this->hasMany(LopHocPhan::class, 'ma_hp');
	}
}
