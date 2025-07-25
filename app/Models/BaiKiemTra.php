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
 * Class BaiKiemTra
 * 
 * @property int $ma_bkt
 * @property int $ma_lhp
 * @property string $tieu_de
 * @property string $noi_dung
 * @property string $dap_an
 * @property Carbon $ngay_tao
 * @property bool|null $trang_thai
 * 
 * @property LopHocPhan $lop_hoc_phan
 * @property Collection|NopBaiKiemTra[] $nop_bai_kiem_tras
 *
 * @package App\Models
 */
class BaiKiemTra extends Model
{
	protected $table = 'bai_kiem_tra';
	protected $primaryKey = 'ma_bkt';
	public $timestamps = false;

	protected $casts = [
		'ma_lhp' => 'int',
		'ngay_tao' => 'datetime',
		'bat_dau' => 'datetime',
		'han_nop' => 'datetime',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_lhp',
		'tieu_de',
		'noi_dung',
		'dap_an',
		'ngay_tao',
		'bat_dau',
		'han_nop',
		'trang_thai'
	];

	public function gets($args)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'lop_hoc_phan.ten_lhp as ten_lhp',
				'lop_hoc_phan.alias as alias_lhp',
				'lop_hoc_phan.ma_tk as ma_tk',
			])
			->join('lop_hoc_phan', 'lop_hoc_phan.ma_lhp', '=', 'bai_kiem_tra.ma_lhp')
			->where($this->table . '.trang_thai', 1);

		if (isset($args['class_alias'])) {
			$query = $query->where('lop_hoc_phan.alias', $args['class_alias']);

		}
		if (isset($args['test_code'])) {
			$query = $query->where('bai_kiem_tra.ma_bkt', $args['test_code']);

		}
		if (isset($args['ma_gv'])) {
			$query = $query->where('lop_hoc_phan.ma_tk', $args['ma_gv']);

		}
		if (isset($args['filter'])) {
			$query = $query->where($this->table . '.ma_lhp', $args['filter']);
		}
		if (isset($args['key_word'])) {
			$query = $query->where(function ($q) use ($args) {
				$q->where('tieu_de', 'like', "%{$args['key_word']}%");
			});
		}
		if (isset($args['order_by'])) {
			$query = $query->orderBy('ngay_tao', $args['order_by']);
		}
		if (isset($args['per_page'])) {
			$per_page = $args['per_page'] ?? 10;
			return $query->paginate($per_page);
		}
		return $query->get()->toArray();
	}
	public function get_by_id($id)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*'
			])
			->join('lop_hoc_phan', 'lop_hoc_phan.ma_lhp', '=', 'bai_kiem_tra.ma_lhp')
			->where($this->table . '.ma_bkt', $id)
			->where($this->table . '.trang_thai', 1);

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
			->join('lop_hoc_phan', 'lop_hoc_phan.ma_lhp', '=', 'bai_kiem_tra.ma_lhp')
			->where($this->table . '.ma_bkt', $id)
			->where('lop_hoc_phan.ma_tk', $ma_tk)
			->update([$this->table . '.trang_thai' => 0]);
		return $result;
	}
	public function admin_update($id, $data)
	{
		if (empty($data)) {
			return false;
		}
		$result = DB::table($this->table)
			->where($this->table . '.ma_bkt', $id)
			->update($data);
		return $result;
	}
	public function lop_hoc_phan()
	{
		return $this->belongsTo(LopHocPhan::class, 'ma_lhp');
	}

	public function nop_bai_kiem_tras()
	{
		return $this->hasMany(NopBaiKiemTra::class, 'ma_bkt');
	}
}
