<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class SinhVien
 * 
 * @property int $id
 * @property int $ma_tk
 * @property int $ma_lhp
 * @property Carbon $ngay_tham_gia
 * @property int|null $tien_do
 * @property bool|null $trang_thai
 * 
 * @property LopHocPhan $lop_hoc_phan
 * @property Taikhoan $taikhoan
 * @property Collection|DanhGia[] $danh_gia
 * @property Collection|NopBaiKiemTra[] $nop_bai_kiem_tras
 * @property Collection|TuongTac[] $tuong_tacs
 *
 * @package App\Models
 */
class SinhVien extends Model
{
	protected $table = 'sinh_vien';
	public $timestamps = false;

	protected $casts = [
		'ma_tk' => 'int',
		'ma_lhp' => 'int',
		'ngay_tham_gia' => 'datetime',
		'tien_do' => 'int',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_tk',
		'ma_lhp',
		'ngay_tham_gia',
		'tien_do',
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

	public function danh_gia()
	{
		return $this->hasMany(DanhGia::class, 'ma_tk', 'ma_tk');
	}

	public function nop_bai_kiem_tras()
	{
		return $this->hasMany(NopBaiKiemTra::class, 'ma_tk', 'ma_tk');
	}

	public function tuong_tacs()
	{
		return $this->hasMany(TuongTac::class, 'ma_tk', 'ma_tk');
	}
}
