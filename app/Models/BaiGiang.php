<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class BaiGiang
 * 
 * @property int $ma_bg
 * @property int $ma_tk
 * @property string $ten_bg
 * @property string $alias
 * @property string|null $mo_ta
 * @property bool|null $hien_thi
 * @property bool|null $trang_thai
 * @property bool|null $thong_bao
 * 
 * @property Taikhoan $taikhoan
 * @property Collection|Chuong[] $chuongs
 * @property Collection|LhpBg[] $lhp_bgs
 * @property Collection|TuongTac[] $tuong_tacs
 *
 * @package App\Models
 */
class BaiGiang extends Model
{
	protected $table = 'bai_giang';
	protected $primaryKey = 'ma_bg';
	public $timestamps = false;

	protected $casts = [
		'ma_tk' => 'int',
		'hien_thi' => 'bool',
		'trang_thai' => 'bool',
		'thong_bao' => 'bool'
	];

	protected $fillable = [
		'ma_tk',
		'ten_bg',
		'alias',
		'mo_ta',
		'hien_thi',
		'trang_thai',
		'thong_bao'
	];
	public function gets($args, $perPage = 5, $offset = -1)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'taikhoan.ho_ten as ho_ten',
				'taikhoan.hinh_anh as avatar'
			])
			->join('taikhoan', 'taikhoan.ma_tk', '=', $this->table . '.ma_tk');

		if(isset($args['ma_tk'])){
			$query = $query->where($this->table . '.ma_tk', $args['ma_tk']);
		}
		// $query = $this->generateWhere($query, $args);

		// $query = $this->generateOrderBy($query, $args);

		// if ($offset >= 0) {
		// 	$query->offset($offset)->limit($perPage);
		// }

		return $query->get()->toArray();
	}
	public function taikhoan()
	{
		return $this->belongsTo(Taikhoan::class, 'ma_tk');
	}

	public function chuongs()
	{
		return $this->hasMany(Chuong::class, 'ma_bg');
	}

	public function lhp_bgs()
	{
		return $this->hasMany(LhpBg::class, 'ma_bg');
	}

	public function tuong_tacs()
	{
		return $this->hasMany(TuongTac::class, 'ma_bg');
	}
}
