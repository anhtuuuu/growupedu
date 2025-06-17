<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Danhgium
 * 
 * @property int $id
 * @property int $ma_tk
 * @property int $ma_lhp
 * @property int|null $so_sao
 * @property string|null $noi_dung
 * @property Carbon $ngay_tao
 * @property bool|null $trang_thai
 * 
 * @property LopHocPhan $lop_hoc_phan
 * @property Taikhoan $taikhoan
 *
 * @package App\Models
 */
class Danhgium extends Model
{
	protected $table = 'danhgia';
	public $timestamps = false;

	protected $casts = [
		'ma_tk' => 'int',
		'ma_lhp' => 'int',
		'so_sao' => 'int',
		'ngay_tao' => 'datetime',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_tk',
		'ma_lhp',
		'so_sao',
		'noi_dung',
		'ngay_tao',
		'trang_thai'
	];

	public function lop_hoc_phan()
	{
		return $this->belongsTo(LopHocPhan::class, 'ma_lhp');
	}

	public function taikhoan()
	{
		return $this->belongsTo(Taikhoan::class, 'ma_tk');
	}
}
