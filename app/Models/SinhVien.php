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
 * Class SinhVien
 * 
 * @property int $id
 * @property int $ma_tk
 * @property int $ma_lhp
 * @property Carbon $ngay_tham_gia
 * @property int|null $tien_do
 * @property bool|null $trang_thai
 * 
 * @property LopHocPhan $lop_hoc_phan
 * @property Taikhoan $taikhoan
 * @property Collection|DanhGia[] $danh_gia
 * @property Collection|NopBaiKiemTra[] $nop_bai_kiem_tras
 * @property Collection|TuongTac[] $tuong_tacs
 *
 * @package App\Models
 */
class SinhVien extends Model
{
	protected $table = 'sinh_vien';
	public $timestamps = false;

	protected $casts = [
		'ma_tk' => 'int',
		'ma_lhp' => 'int',
		'ngay_tham_gia' => 'datetime',
		'tien_do' => 'int',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_tk',
		'ma_lhp',
		'ngay_tham_gia',
		'tien_do',
		'trang_thai'
	];
	public function gets($args, $perPage = 5, $offset = -1)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'taikhoan.ho_ten as ho_ten',
				'taikhoan.hinh_anh as avatar',
				'taikhoan.email as email',
				'lop_hoc_phan.ten_lhp as ten_lhp',
				'lop_hoc_phan.alias as alias_lhp'

			])
			->join('taikhoan', 'taikhoan.ma_tk', '=', $this->table . '.ma_tk')
			->join('lop_hoc_phan', 'lop_hoc_phan.ma_lhp', '=', $this->table . '.ma_lhp')
			->where($this->table . '.trang_thai', 1)
			->where('taikhoan.trang_thai', 1)
			->where('lop_hoc_phan.trang_thai', 1);
		if (isset($args['ma_lhp'])) {
			$query = $query->where($this->table . '.ma_lhp', $args['ma_lhp']);
		}
		if (isset($args['ma_sv'])) {
			$query = $query->where($this->table . '.ma_tk', $args['ma_sv']);
		}
		if (isset($args['ma_gv'])) {
			$query = $query->where('lop_hoc_phan.ma_tk', $args['ma_gv']);
		}
		if (isset($args['alias_class'])) {
			$query = $query->where('lop_hoc_phan.alias', $args['alias_class']);
		}
		if (isset($args['key_word'])) {
			$query = $query->where(function ($q) use ($args) {
				$q->where('taikhoan.ho_ten', 'like', "%{$args['key_word']}%")
					->orWhere('taikhoan.email', 'like', "%{$args['key_word']}%")
					->orWhere('taikhoan.username', 'like', "%{$args['key_word']}%")
					->orWhere('taikhoan.sdt', 'like', "%{$args['key_word']}%");
			});
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
	public function admin_delete($id, $ma_tk)
	{
		if (empty($id)) {
			return false;
		}
		$result = DB::table($this->table)
			->select([
				$this->table . '.*',
			])
			// ->join('lop_hoc_phan', 'lop_hoc_phan.ma_lhp', '=', 'sinh_vien.ma_lhp')
			// ->join('taikhoan', 'taikhoan.ma_tk', '=', 'sinh_vien.ma_tk')
			->where($this->table . '.id', $id)
			// ->where('lop_hoc_phan.ma_tk', $ma_tk)
			->update([$this->table . '.trang_thai' => 0]);
		return $result;
	}
	public function account_delete($id)
	{
		if (empty($id)) {
			return false;
		}
		$result = DB::table($this->table)
			->select([
				$this->table . '.*',
			])
			->where($this->table . '.id', $id)->delete();
		return $result;
	}
	public function lop_hoc_phan()
	{
		return $this->belongsTo(LopHocPhan::class, 'ma_lhp');
	}

	public function taikhoan()
	{
		return $this->belongsTo(Taikhoan::class, 'ma_tk');
	}

	public function danh_gia()
	{
		return $this->hasMany(DanhGia::class, 'ma_tk', 'ma_tk');
	}

	public function nop_bai_kiem_tras()
	{
		return $this->hasMany(NopBaiKiemTra::class, 'ma_tk', 'ma_tk');
	}

	public function tuong_tacs()
	{
		return $this->hasMany(TuongTac::class, 'ma_tk', 'ma_tk');
	}
}
