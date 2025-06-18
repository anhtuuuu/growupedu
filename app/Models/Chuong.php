<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

	public function gets($args, $perPage = 5, $offset = -1)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'bai_giang.alias as alias_lesson'
			])
			->join('bai_giang', 'bai_giang.ma_bg', '=', $this->table . '.ma_bg');

		if(isset($args['alias_lesson'])){
			$query = $query->where('bai_giang.alias', $args['alias_lesson']);
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

	public function bais()
	{
		return $this->hasMany(Bai::class, 'chuong');
	}
}
