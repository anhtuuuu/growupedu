<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Chuong
 * 
 * @property int $chuong
 * @property int $ma_bg
 * @property string $ten_chuong
 * @property string $alias
 * @property string|null $mo_ta
 * @property bool|null $trang_thai
 * @property bool|null $thong_bao
 * 
 * @property BaiGiang $bai_giang
 * @property Collection|Bai[] $bais
 *
 * @package App\Models
 */
class Chuong extends Model
{
	protected $table = 'chuong';
	protected $primaryKey = 'chuong';
	public $timestamps = false;

	protected $casts = [
		'ma_bg' => 'int',
		'trang_thai' => 'bool',
		'thong_bao' => 'bool'
	];

	protected $fillable = [
		'ma_bg',
		'ten_chuong',
		'alias',
		'mo_ta',
		'trang_thai',
		'thong_bao'
	];

	public function bai_giang()
	{
		return $this->belongsTo(BaiGiang::class, 'ma_bg');
	}

	public function bais()
	{
		return $this->hasMany(Bai::class, 'chuong');
	}
}
