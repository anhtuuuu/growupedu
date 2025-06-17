<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaiKiemTra
 * 
 * @property int $ma_bkt
 * @property int $ma_lhp
 * @property string $tieu_de
 * @property string $noi_dung
 * @property string $dap_an
 * @property Carbon $ngay_tao
 * @property bool|null $trang_thai
 * 
 * @property LopHocPhan $lop_hoc_phan
 * @property Collection|NopBaiKiemTra[] $nop_bai_kiem_tras
 *
 * @package App\Models
 */
class BaiKiemTra extends Model
{
	protected $table = 'bai_kiem_tra';
	protected $primaryKey = 'ma_bkt';
	public $timestamps = false;

	protected $casts = [
		'ma_lhp' => 'int',
		'ngay_tao' => 'datetime',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_lhp',
		'tieu_de',
		'noi_dung',
		'dap_an',
		'ngay_tao',
		'trang_thai'
	];

	public function lop_hoc_phan()
	{
		return $this->belongsTo(LopHocPhan::class, 'ma_lhp');
	}

	public function nop_bai_kiem_tras()
	{
		return $this->hasMany(NopBaiKiemTra::class, 'ma_bkt');
	}
}
