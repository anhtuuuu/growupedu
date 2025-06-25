<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class HocPhan
 * 
 * @property int $ma_hp
 * @property int $ma_bm
 * @property string $ten_hp
 * @property string $alias
 * @property string|null $mo_ta
 * @property bool|null $trang_thai
 * 
 * @property BoMon $bo_mon
 * @property Collection|LopHocPhan[] $lop_hoc_phans
 *
 * @package App\Models
 */
class HocPhan extends Model
{
	protected $table = 'hoc_phan';
	protected $primaryKey = 'ma_hp';
	public $timestamps = false;

	protected $casts = [
		'ma_bm' => 'int',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_bm',
		'ten_hp',
		'alias',
		'mo_ta',
		'trang_thai'
	];
	public function gets($args, $perPage = 5, $offset = -1)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'bo_mon.ma_bm as ma_bm',
				'bo_mon.ten_bm as ten_bm'
			])
			->join('bo_mon', 'bo_mon.ma_bm', '=', $this->table . '.ma_bm');

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
	public function bo_mon()
	{
		return $this->belongsTo(BoMon::class, 'ma_bm');
	}

	public function lop_hoc_phans()
	{
		return $this->hasMany(LopHocPhan::class, 'ma_hp');
	}
}
