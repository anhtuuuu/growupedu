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
 * @property Collection|Danhgium[] $danhgia
 * @property Collection|LopHocPhan[] $lop_hoc_phans
 * @property Collection|NopBaiKiemTra[] $nop_bai_kiem_tras
 * @property Collection|SinhVien[] $sinh_viens
 * @property Collection|TuongTac[] $tuong_tacs
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
				'vai_tro.tieu_de as tieu_de',
				'bo_mon.ten_bm as ten_bm'
			])
			->leftJoin('vai_tro', 'vai_tro.ma_vt', '=', $this->table . '.vai_tro')
			->leftJoin('bo_mon', 'bo_mon.ma_bm', '=', $this->table.'.ma_bm');

		// $query = $this->generateWhere($query, $args);

		// $query = $this->generateOrderBy($query, $args);

		if ($offset >= 0) {
			$query->offset($offset)->limit($perPage);
		}

		return $query->get()->toArray();
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

	public function danhgia()
	{
		return $this->hasMany(Danhgium::class, 'ma_tk');
	}

	public function lop_hoc_phans()
	{
		return $this->hasMany(LopHocPhan::class, 'ma_tk');
	}

	public function nop_bai_kiem_tras()
	{
		return $this->hasMany(NopBaiKiemTra::class, 'ma_tk');
	}

	public function sinh_viens()
	{
		return $this->hasMany(SinhVien::class, 'ma_tk');
	}

	public function tuong_tacs()
	{
		return $this->hasMany(TuongTac::class, 'ma_tk');
	}
}
