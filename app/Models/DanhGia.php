<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class DanhGia
 * 
 * @property int $id
 * @property int $ma_tk
 * @property int $ma_lhp
 * @property int|null $so_sao
 * @property string|null $noi_dung
 * @property Carbon $ngay_tao
 * @property bool|null $trang_thai
 * 
 * @property LopHocPhan $lop_hoc_phan
 * @property SinhVien $sinh_vien
 *
 * @package App\Models
 */
class DanhGia extends Model
{
	protected $table = 'danh_gia';
	public $timestamps = false;

	protected $casts = [
		'ma_tk' => 'int',
		'ma_lhp' => 'int',
		'so_sao' => 'int',
		'ngay_tao' => 'datetime',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_tk',
		'ma_lhp',
		'so_sao',
		'noi_dung',
		'ngay_tao',
		'trang_thai'
	];
	public function gets($args, $perPage = 5, $offset = -1)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'taikhoan.ma_tk as ma_tk',
				'taikhoan.ho_ten as ho_ten',
				'lop_hoc_phan.ma_lhp as ma_lhp',
				'lop_hoc_phan.ten_lhp as ten_lhp'
			])
			->join('taikhoan', 'taikhoan.ma_tk', '=', $this->table . '.ma_tk')
			->join('lop_hoc_phan', 'lop_hoc_phan.ma_lhp', '=', $this->table . '.ma_lhp')
			->where($this->table . '.trang_thai', 1);

		if (isset($args['order_by'])) {
			$query = $query->orderBy('ngay_tao', $args['order_by']);
		}
		if (isset($args['ma_gv'])) {
			$query = $query->where('lop_hoc_phan.ma_tk', $args['ma_gv']);
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
				'taikhoan.ma_tk as ma_tk',
				'taikhoan.ho_ten as ho_ten',
				'lop_hoc_phan.ma_lhp as ma_lhp',
				'lop_hoc_phan.ten_lhp as ten_lhp'
			])
			->join('taikhoan', 'taikhoan.ma_tk', '=', $this->table . '.ma_tk')
			->join('lop_hoc_phan', 'lop_hoc_phan.ma_lhp', '=', $this->table . '.ma_lhp')
			->where($this->table . '.id', $id);
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
			->join('lop_hoc_phan', 'lop_hoc_phan.ma_lhp', '=', 'danh_gia.ma_lhp')
			->where($this->table . '.id', $id)
			->where('lop_hoc_phan.ma_tk', $ma_tk)
			->update([$this->table . '.trang_thai' => 0]);
		return $result;
	}
	public function lop_hoc_phan()
	{
		return $this->belongsTo(LopHocPhan::class, 'ma_lhp');
	}

	public function sinh_vien()
	{
		return $this->belongsTo(SinhVien::class, 'ma_tk', 'ma_tk');
	}
}
