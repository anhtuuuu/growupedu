<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bai
 * 
 * @property int $ma_bai
 * @property int $chuong
 * @property string $tieu_de
 * @property string $alias
 * @property string|null $mo_ta
 * @property string|null $noi_dung
 * @property string|null $video
 * @property string|null $lien_ket
 * @property Carbon $ngay_tao
 * @property bool|null $hien_thi
 * @property bool|null $trang_thai
 * @property bool|null $thong_bao
 * 
 *
 * @package App\Models
 */
class Bai extends Model
{
	protected $table = 'bai';
	protected $primaryKey = 'ma_bai';
	public $timestamps = false;

	protected $casts = [
		'chuong' => 'int',
		'ngay_tao' => 'datetime',
		'hien_thi' => 'bool',
		'trang_thai' => 'bool',
		'thong_bao' => 'bool'
	];

	protected $fillable = [
		'chuong',
		'tieu_de',
		'alias',
		'mo_ta',
		'noi_dung',
		'video',
		'lien_ket',
		'ngay_tao',
		'hien_thi',
		'trang_thai',
		'thong_bao'
	];

	public function chuong()
	{
		return $this->belongsTo(Chuong::class, 'chuong');
	}
}
