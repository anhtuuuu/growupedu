<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class Bai
 * 
 * @property int $ma_bai
 * @property int $ma_chuong
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
 * @property Chuong $chuong
 *
 * @package App\Models
 */
class Bai extends Model
{
	protected $table = 'bai';
	protected $primaryKey = 'ma_bai';
	public $timestamps = false;

	protected $casts = [
		'ma_chuong' => 'int',
		'ngay_tao' => 'datetime',
		'hien_thi' => 'bool',
		'trang_thai' => 'bool',
		'thong_bao' => 'bool'
	];

	protected $fillable = [
		'ma_chuong',
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
	public function gets($args, $perPage = 5, $offset = -1)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'chuong.ten_chuong as ten_chuong',
				'bai_giang.ten_bg as ten_bg'
			])
			->join('chuong', 'chuong.ma_chuong', '=', $this->table . '.ma_chuong')
			->join('bai_giang', 'bai_giang.ma_bg', '=', 'chuong.ma_bg');

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
	public function get_by_id($id)
	{

		if (empty(trim($id)))
			return '';

		$query = DB::table($this->table)
			->select([
				$this->table . '.*'
			])
			->join('chuong', 'chuong.ma_chuong', '=', $this->table . '.ma_chuong')
			->join('bai_giang', 'bai_giang.ma_bg', '=', 'chuong.ma_bg')
			->where($this->table . '.ma_bai', $id);


		// $query = $this->generateWhere($query, $args);

		// $query = $this->generateOrderBy($query, $args);

		// if ($offset >= 0) {
		// 	$query->offset($offset)->limit($perPage);
		// }

		return $query->first();
	}
	public function get_by_alias($alias)
	{

		if (empty(trim($alias)))
			return '';

		$query = DB::table($this->table)
			->select([
				$this->table . '.*'
			])
			->join('chuong', 'chuong.ma_chuong', '=', $this->table . '.ma_chuong')
			->join('bai_giang', 'bai_giang.ma_bg', '=', 'chuong.ma_bg')
			->where($this->table . '.alias', $alias);


		// $query = $this->generateWhere($query, $args);

		// $query = $this->generateOrderBy($query, $args);

		// if ($offset >= 0) {
		// 	$query->offset($offset)->limit($perPage);
		// }

		return $query->first();
	}
	public function chuong()
	{
		return $this->belongsTo(Chuong::class, 'ma_chuong');
	}
}
