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
			->join('bai_giang', 'bai_giang.ma_bg', '=', $this->table . '.ma_bg')
			->where($this->table . '.trang_thai', 1);
		if (isset($args['alias_lesson'])) {
			$query = $query->where('bai_giang.alias', $args['alias_lesson']);
		}
		if (isset($args['id_lesson'])) {
			$query = $query->where('bai_giang.ma_bg', $args['id_lesson']);
		}
		if (isset($args['order_by'])) {
			$query = $query->orderBy('ngay_tao', $args['order_by']);
		}
		if (isset($args['ma_gv'])) {
			$query = $query->where('bai_giang.ma_tk', $args['ma_gv']);
		}

		if (isset($args['per_page'])) {
			$per_page = $args['per_page'] ?? 10;
			return $query->paginate($per_page);
		}
		return $query->get()->toArray();
	}
	public function add($data)
	{
		if (empty($data)) {
			return false;
		}
		$result = DB::table($this->table)->insert($data);
		return $result;
	}
	public function get_by_id($id)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				// 'taikhoan.ho_ten as ho_ten',
				// 'taikhoan.hinh_anh as avatar'
			])
			// ->join('taikhoan', 'taikhoan.ma_tk', '=', $this->table . '.ma_tk')
			->where($this->table . '.ma_chuong', $id);

		return $query->first();
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
			->join('bai_giang', 'bai_giang.ma_bg', '=', 'chuong.ma_bg')
			->where($this->table . '.ma_chuong', $id)
			->where('bai_giang.ma_tk', $ma_tk)
			->update([$this->table . '.trang_thai' => 0]);
		return $result;
	}
	public function admin_update($id, $data)
	{
		if (empty($data)) {
			return false;
		}
		$result = DB::table($this->table)
			->where($this->table . '.ma_chuong', $id)
			->update($data);
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
