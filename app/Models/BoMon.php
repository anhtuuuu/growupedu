<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class BoMon
 * 
 * @property int $ma_bm
 * @property int $ma_khoa
 * @property string $ten_bm
 * @property string $alias
 * @property string|null $mo_ta
 * @property bool|null $trang_thai
 * 
 * @property Khoa $khoa
 * @property Collection|HocPhan[] $hoc_phans
 * @property Collection|Taikhoan[] $taikhoans
 *
 * @package App\Models
 */
class BoMon extends Model
{
	protected $table = 'bo_mon';
	protected $primaryKey = 'ma_bm';
	public $timestamps = false;

	protected $casts = [
		'ma_khoa' => 'int',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_khoa',
		'ten_bm',
		'alias',
		'mo_ta',
		'trang_thai'
	];
	public function gets($args, $perPage = 5, $offset = -1)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'khoa.ma_khoa as ma_khoa',
				'khoa.ten_khoa as ten_khoa'
			])
			->join('khoa', 'khoa.ma_khoa', '=', $this->table . '.ma_khoa');

		
		// $query = $this->generateWhere($query, $args);

		// $query = $this->generateOrderBy($query, $args);

		// if ($offset >= 0) {
		// 	$query->offset($offset)->limit($perPage);
		// }

		return $query->get()->toArray();
	}
	public function add($data){
		if(empty($data)){
			return false;
		}
		$result = DB::table($this->table)->insert($data);
		return $result;
	}
	public function khoa()
	{
		return $this->belongsTo(Khoa::class, 'ma_khoa');
	}

	public function hoc_phans()
	{
		return $this->hasMany(HocPhan::class, 'ma_bm');
	}

	public function taikhoans()
	{
		return $this->hasMany(Taikhoan::class, 'ma_bm');
	}
}
