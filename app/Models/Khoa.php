<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class Khoa
 * 
 * @property int $ma_khoa
 * @property string $ten_khoa
 * @property string $alias
 * @property string|null $mo_ta
 * @property bool|null $trang_thai
 * 
 * @property Collection|BoMon[] $bo_mons
 *
 * @package App\Models
 */
class Khoa extends Model
{
	protected $table = 'khoa';
	protected $primaryKey = 'ma_khoa';
	public $timestamps = false;

	protected $casts = [
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ten_khoa',
		'alias',
		'mo_ta',
		'trang_thai'
	];
	public function gets($args, $perPage = 5, $offset = -1)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*'
			])
			->where($this->table . '.trang_thai', 1);


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
			->where($this->table . '.ma_khoa', $id);

		return $query->first();
	}
	public function admin_update($id, $data)
	{
		if (empty($data)) {
			return false;
		}
		$result = DB::table($this->table)
			->where($this->table . '.ma_khoa', $id)
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
			->where($this->table . '.ma_khoa', $id)
			// ->where('bai_giang.ma_tk', $ma_tk)
			->update([$this->table . '.trang_thai' => 0]);
		return $result;
	}
	public function bo_mons()
	{
		return $this->hasMany(BoMon::class, 'ma_khoa');
	}
}
