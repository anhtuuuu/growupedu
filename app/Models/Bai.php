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
	public function gets($args)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'chuong.ten_chuong as ten_chuong',
				'chuong.alias as alias_chuong',
				'bai_giang.alias as alias_bg',
				'bai_giang.ten_bg as ten_bg'
			])
			->join('chuong', 'chuong.ma_chuong', '=', $this->table . '.ma_chuong')
			->join('bai_giang', 'bai_giang.ma_bg', '=', 'chuong.ma_bg')
			->where($this->table . '.trang_thai', 1);

		if (isset($args['hien_thi'])) {
			$query = $query->where($this->table . '.hien_thi', 1);
		}
		if (isset($args['alias_lesson'])) {
			$query = $query->where('bai_giang.alias', $args['alias_lesson']);
		}
		if (isset($args['id_chapter'])) {
			$query = $query->where('chuong.ma_chuong', $args['id_chapter']);
		}
		if (isset($args['alias_chapter'])) {
			$query = $query->where('chuong.alias', $args['alias_chapter']);
		}
		if (isset($args['ma_gv'])) {
			$query = $query->where('bai_giang.ma_tk', $args['ma_gv']);
		}
		// if (isset($args['class'])) {
		// 	$query = $query->where(function ($q) use ($args) {
		// 		$q->where('bai_giang.ma_bg', $args['class'][0]);
		// 			foreach(array_slice($args['class'], 1) as $row){
		// 				$q->orWhere('bai_giang.ma_bg', $row);
		// 			}					
		// 	});
		// }
		if (isset($args['lesson_id']) && !empty($args['lesson_id'])){
			$query = $query->where('bai_giang.ma_bg', $args['lesson_id']);
		}
		if (isset($args['q'])) {
			$query = $query->where(function ($q) use ($args) {
				$q->where($this->table . '.tieu_de', 'like', "%{$args['q']}%")
					->orWhere($this->table . '.mo_ta', 'like', "%{$args['q']}%")
					->orWhere($this->table . '.noi_dung', 'like', "%{$args['q']}%")
					->orWhere('chuong.ten_chuong', 'like', "%{$args['q']}%");
			});
		}
		if (isset($args['order_by'])) {
			$query = $query->orderBy('ngay_tao', $args['order_by']);
		}
		if (isset($args['per_page'])) {
			$per_page = $args['per_page'] ?? 10;
			return $query->paginate($per_page)->withQueryString();
		}
		return $query->get()->toArray();
	}

	public function admin_update($id, $data)
	{
		if (empty($data)) {
			return false;
		}
		$result = DB::table($this->table)
			->where($this->table . '.ma_bai', $id)
			->update($data);
		return $result;
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
		if (isset($args['ma_gv'])) {
			$query = $query->where('bai_giang.ma_tk', $args['ma_gv']);
		}


		// $query = $this->generateWhere($query, $args);

		// $query = $this->generateOrderBy($query, $args);

		// if ($offset >= 0) {
		// 	$query->offset($offset)->limit($perPage);
		// }

		return $query->first();
	}

	public function add($data)
	{
		if (empty($data)) {
			return false;
		}
		$result = DB::table($this->table)->insert($data);
		return $result;
	}
	public function admin_delete($id, $ma_tk)
	{
		if (empty($id)) {
			return false;
		}
		$result = DB::table($this->table)
			->select([
				$this->table . '.*',
			])
			->where($this->table . '.ma_bai', $id)->delete();
			// ->update([$this->table . '.trang_thai' => 0]);
		return $result;
	}
	public function chuong()
	{
		return $this->belongsTo(Chuong::class, 'ma_chuong');
	}
}
