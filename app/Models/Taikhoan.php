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
 * Class Taikhoan
 * 
 * @property int $ma_tk
 * @property int $ma_bm
 * @property string $ho_ten
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string|null $gioi_tinh
 * @property string|null $hinh_anh
 * @property Carbon $nam_sinh
 * @property string|null $sdt
 * @property string|null $lien_ket
 * @property Carbon $ngay_tao
 * @property int $vai_tro
 * @property bool|null $trang_thai_dang_nhap
 * @property bool|null $kich_hoat
 * @property bool|null $trang_thai
 * 
 * @property BoMon $bo_mon
 * @property Collection|BaiGiang[] $bai_giangs
 * @property Collection|LopHocPhan[] $lop_hoc_phans
 * @property Collection|SinhVien[] $sinh_viens
 *
 * @package App\Models
 */
class Taikhoan extends Model
{
	protected $table = 'taikhoan';
	protected $primaryKey = 'ma_tk';
	public $timestamps = false;

	protected $casts = [
		'ma_bm' => 'int',
		'nam_sinh' => 'datetime',
		'ngay_tao' => 'datetime',
		'vai_tro' => 'int',
		'trang_thai_dang_nhap' => 'bool',
		'kich_hoat' => 'bool',
		'trang_thai' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'ma_bm',
		'ho_ten',
		'username',
		'password',
		'email',
		'gioi_tinh',
		'hinh_anh',
		'nam_sinh',
		'sdt',
		'lien_ket',
		'ngay_tao',
		'vai_tro',
		'trang_thai_dang_nhap',
		'kich_hoat',
		'trang_thai'
	];
	public function gets($args, $perPage = 5, $offset = -1)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'taikhoan.ma_tk',
				'vai_tro.tieu_de as vai_tro',
				'bo_mon.ten_bm as ten_bm'
			])
			->leftJoin('vai_tro', 'vai_tro.ma_vt', '=', $this->table . '.vai_tro')
			->leftJoin('bo_mon', 'bo_mon.ma_bm', '=', $this->table . '.ma_bm');

		if (isset($args['ma_tk'])) {
			$query = $query->where($this->table . '.ma_tk', $args['ma_tk']);
		}
		if (isset($args['role'])) {
			$query = $query->where($this->table . '.vai_tro', $args['role']);
		}
		if (isset($args['key_word'])) {
			$query = $query->whereFullText('ho_ten', $args['key_word']);
		}
		if (isset($args['ma_gv'])) {
			$query = $query->where($this->table . '.ma_tk', $args['ma_gv']);
		}
		if (isset($args['per_page'])) {
			$per_page = $args['per_page'] ?? 10;
			return $query->paginate($per_page);
		}
		return $query->get()->toArray();
	}
	public function check_login($args, $email)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*'
			])
			->where($this->table . '.email', $email);

		if (isset($args['is_admin']) && $args['is_admin']) {
			$query = $query->where(function ($query) {
				$query->where('vai_tro', 1)
					->orWhere('vai_tro', 2);
			});
		}
		if (isset($args['is_client']) && $args['is_client']) {
			$query = $query->where(function ($query) {
				$query->where('vai_tro', 2)
					->orWhere('vai_tro', 3);
			});
		}	

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
	public function upload_image($username, $image)
	{
		if (empty($image)) {
			return false;
		}
		$result = DB::table($this->table)
			->where($this->table . '.username', $username)
			->update(['hinh_anh' => $image]);
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
			->where($this->table . '.ma_tk', $id);

		return $query->first();
	}
	public function admin_update($id, $data)
	{
		if (empty($data)) {
			return false;
		}
		$result = DB::table($this->table)
			->where($this->table . '.ma_tk', $id)
			->update($data);
		return $result;
	}
	public function admin_delete($id)
	{
		if (empty($id)) {
			return false;
		}
		$result = DB::table($this->table)->where('ma_tk', $id)->delete();
		return $result;
	}
	public function bo_mon()
	{
		return $this->belongsTo(BoMon::class, 'ma_bm');
	}

	public function vai_tro()
	{
		return $this->belongsTo(VaiTro::class, 'vai_tro');
	}

	public function bai_giangs()
	{
		return $this->hasMany(BaiGiang::class, 'ma_tk');
	}

	public function lop_hoc_phans()
	{
		return $this->hasMany(LopHocPhan::class, 'ma_tk');
	}

	public function sinh_viens()
	{
		return $this->hasMany(SinhVien::class, 'ma_tk');
	}
}
