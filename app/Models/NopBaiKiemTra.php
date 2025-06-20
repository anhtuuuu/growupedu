<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class NopBaiKiemTra
 * 
 * @property int $id
 * @property int $ma_bkt
 * @property int $ma_tk
 * @property string $noi_dung
 * @property string $tra_loi
 * @property float|null $diem_so
 * @property Carbon $ngay_nop
 * @property bool|null $trang_thai
 * 
 * @property BaiKiemTra $bai_kiem_tra
 * @property SinhVien $sinh_vien
 *
 * @package App\Models
 */
class NopBaiKiemTra extends Model
{
	protected $table = 'nop_bai_kiem_tra';
	public $timestamps = false;

	protected $casts = [
		'ma_bkt' => 'int',
		'ma_tk' => 'int',
		'diem_so' => 'float',
		'ngay_nop' => 'datetime',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_bkt',
		'ma_tk',
		'noi_dung',
		'tra_loi',
		'diem_so',
		'ngay_nop',
		'trang_thai'
	];

	public function bai_kiem_tra()
	{
		return $this->belongsTo(BaiKiemTra::class, 'ma_bkt');
	}

	public function sinh_vien()
	{
		return $this->belongsTo(SinhVien::class, 'ma_tk', 'ma_tk');
	}
}
