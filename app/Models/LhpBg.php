<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class LhpBg
 * 
 * @property int $id
 * @property int $ma_lhp
 * @property int $ma_bg
 * @property bool|null $trang_thai
 * 
 * @property BaiGiang $bai_giang
 * @property LopHocPhan $lop_hoc_phan
 *
 * @package App\Models
 */
class LhpBg extends Model
{
	protected $table = 'lhp_bg';
	public $timestamps = false;

	protected $casts = [
		'ma_lhp' => 'int',
		'ma_bg' => 'int',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_lhp',
		'ma_bg',
		'trang_thai'
	];
	public function gets($args, $perPage = 5, $offset = -1)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'lop_hoc_phan.ma_lhp as ma_lhp',
				'lop_hoc_phan.alias as alias_lhp',
				'lop_hoc_phan.ten_lhp as ten_lhp',
				'bai_giang.ma_bg as ma_bg',
				'bai_giang.ten_bg as ten_bg',
				'bai_giang.alias as alias_bg'
			])
			->join('lop_hoc_phan', 'lop_hoc_phan.ma_lhp', '=', $this->table . '.ma_lhp')
			->join('bai_giang', 'bai_giang.ma_bg', '=', $this->table . '.ma_bg');

		if (isset($args['alias'])) {
			$query = $query->where('lop_hoc_phan.alias', $args['alias']);
		}
		// $query = $this->generateWhere($query, $args);

		// $query = $this->generateOrderBy($query, $args);

		// if ($offset >= 0) {
		// 	$query->offset($offset)->limit($perPage);
		// }

		return $query->get()->toArray();
	}
	public function bai_giang()
	{
		return $this->belongsTo(BaiGiang::class, 'ma_bg');
	}

	public function lop_hoc_phan()
	{
		return $this->belongsTo(LopHocPhan::class, 'ma_lhp');
	}
}
