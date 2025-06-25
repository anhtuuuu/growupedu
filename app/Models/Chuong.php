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
 * Class Chuong
 * 
 * @property int $ma_chuong
 * @property int $ma_bg
 * @property string $ten_chuong
 * @property string $alias
 * @property string|null $mo_ta
 * @property Carbon $ngay_tao
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
	protected $primaryKey = 'ma_chuong';
	public $timestamps = false;

	protected $casts = [
		'ma_bg' => 'int',
		'ngay_tao' => 'datetime',
		'trang_thai' => 'bool',
		'thong_bao' => 'bool'
	];

	protected $fillable = [
		'ma_bg',
		'ten_chuong',
		'alias',
		'mo_ta',
		'ngay_tao',
		'trang_thai',
		'thong_bao'
	];
	public function gets($args, $perPage = 5, $offset = -1)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'bai_giang.ten_bg as ten_bg',
				'bai_giang.alias as alias_lesson'
			])
			->join('bai_giang', 'bai_giang.ma_bg', '=', $this->table . '.ma_bg');

		if (isset($args['alias_lesson'])) {
			$query = $query->where('bai_giang.alias', $args['alias_lesson']);
		}
		if (isset($args['order_by'])) {
			$query = $query->orderBy('ngay_tao', $args['order_by']);
		}
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
	public function bai_giang()
	{
		return $this->belongsTo(BaiGiang::class, 'ma_bg');
	}

	public function bais()
	{
		return $this->hasMany(Bai::class, 'ma_chuong');
	}
}
