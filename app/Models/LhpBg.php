<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LhpBg
 * 
 * @property int $id
 * @property int $ma_lhp
 * @property int $ma_bg
 * @property bool|null $trang_thai
 * 
 * @property BaiGiang $bai_giang
 * @property LopHocPhan $lop_hoc_phan
 *
 * @package App\Models
 */
class LhpBg extends Model
{
	protected $table = 'lhp_bg';
	public $timestamps = false;

	protected $casts = [
		'ma_lhp' => 'int',
		'ma_bg' => 'int',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_lhp',
		'ma_bg',
		'trang_thai'
	];

	public function bai_giang()
	{
		return $this->belongsTo(BaiGiang::class, 'ma_bg');
	}

	public function lop_hoc_phan()
	{
		return $this->belongsTo(LopHocPhan::class, 'ma_lhp');
	}
}
