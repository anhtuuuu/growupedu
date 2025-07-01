<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class BaiGiang
 * 
 * @property int $ma_bg
 * @property int $ma_tk
 * @property string $ten_bg
 * @property string $alias
 * @property string|null $mo_ta
 * @property bool|null $hien_thi
 * @property bool|null $trang_thai
 * @property bool|null $thong_bao
 * 
 * @property Taikhoan $taikhoan
 * @property Collection|Chuong[] $chuongs
 * @property Collection|LopHocPhan[] $lop_hoc_phans
 *
 * @package App\Models
 */
class BaiGiang extends Model
{
	protected $table = 'bai_giang';
	protected $primaryKey = 'ma_bg';
	public $timestamps = false;

	protected $casts = [
		'ma_tk' => 'int',
		'hien_thi' => 'bool',
		'trang_thai' => 'bool',
		'thong_bao' => 'bool'
	];

	protected $fillable = [
		'ma_tk',
		'ten_bg',
		'alias',
		'mo_ta',
		'hien_thi',
		'trang_thai',
		'thong_bao'
	];
	public function gets($args, $perPage = 5, $offset = -1)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'taikhoan.ho_ten as ho_ten',
				'taikhoan.hinh_anh as avatar'
			])
			->join('taikhoan', 'taikhoan.ma_tk', '=', $this->table . '.ma_tk')
			->where($this->table . '.trang_thai', 1);

		if (isset($args['ma_tk'])) {
			$query = $query->where($this->table . '.ma_tk', $args['ma_tk']);
		}

		if (isset($args['alias_lesson'])) {
			$query = $query->where($this->table . '.alias', $args['alias_lesson']);
		}
				if (isset($args['ma_gv'])) {
			$query = $query->where('bai_giang.ma_tk', $args['ma_gv']);
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
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'taikhoan.ho_ten as ho_ten',
				'taikhoan.hinh_anh as avatar'
			])
			->join('taikhoan', 'taikhoan.ma_tk', '=', $this->table . '.ma_tk')
			->where($this->table . '.ma_bg', $id);

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
	public function admin_update($id, $data)
	{
		if (empty($data)) {
			return false;
		}
		$result = DB::table($this->table)
			->where($this->table . '.ma_bg', $id)
			->update($data);
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
			// ->join('bai_giang', 'bai_giang.ma_bg', '=', 'chuong.ma_bg')
			->where($this->table . '.ma_bg', $id)
			->where('bai_giang.ma_tk', $ma_tk)
			->update([$this->table . '.trang_thai' => 0]);
		return $result;
	}
	public function taikhoan()
	{
		return $this->belongsTo(Taikhoan::class, 'ma_tk');
	}

	public function chuongs()
	{
		return $this->hasMany(Chuong::class, 'ma_bg');
	}

	public function lop_hoc_phans()
	{
		return $this->hasMany(LopHocPhan::class, 'ma_bg');
	}
}
