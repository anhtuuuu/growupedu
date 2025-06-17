<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TuongTac
 * 
 * @property int $id
 * @property int $ma_tk
 * @property int $ma_bg
 * @property int|null $tra_loi_cho
 * @property string $noi_dung
 * @property Carbon $ngay_tao
 * @property bool|null $trang_thai
 * 
 * @property BaiGiang $bai_giang
 * @property Taikhoan $taikhoan
 *
 * @package App\Models
 */
class TuongTac extends Model
{
	protected $table = 'tuong_tac';
	public $timestamps = false;

	protected $casts = [
		'ma_tk' => 'int',
		'ma_bg' => 'int',
		'tra_loi_cho' => 'int',
		'ngay_tao' => 'datetime',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_tk',
		'ma_bg',
		'tra_loi_cho',
		'noi_dung',
		'ngay_tao',
		'trang_thai'
	];

	public function bai_giang()
	{
		return $this->belongsTo(BaiGiang::class, 'ma_bg');
	}

	public function taikhoan()
	{
		return $this->belongsTo(Taikhoan::class, 'ma_tk');
	}
}
