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
			->join('bo_mon', 'bo_mon.ma_bm', '=', $this->table . '.ma_bm')
			->where($this->table . '.trang_thai', 1);

		if (isset($args['id_subject'])) {
			$query = $query->where('bo_mon.ma_bm', $args['id_subject']);
		}
		

		// $query = $this->generateWhere($query, $args);

		// $query = $this->generateOrderBy($query, $args);

		// if ($offset >= 0) {
		// 	$query->offset($offset)->limit($perPage);
		// }

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
			->where($this->table . '.ma_hp', $id);

		return $query->first();
	}
	public function admin_update($id, $data)
	{
		if (empty($data)) {
			return false;
		}
		$result = DB::table($this->table)
			->where($this->table . '.ma_hp', $id)
			->update($data);
		return $result;
	}
	public function admin_delete($id)
	{
		if (empty($id)) {
			return false;
		}
		$result = DB::table($this->table)
			->select([
				$this->table . '.*',
			])
			// ->join('bai_giang', 'bai_giang.ma_bg', '=', 'chuong.ma_bg')
			->where($this->table . '.ma_hp', $id)
			// ->where('bai_giang.ma_tk', $ma_tk)
			->update([$this->table . '.trang_thai' => 0]);
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
