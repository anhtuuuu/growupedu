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
 * Class LopHocPhan
 * 
 * @property int $ma_lhp
 * @property string $ten_lhp
 * @property string $alias
 * @property int $ma_tk
 * @property int $ma_hp
 * @property string|null $hinh_anh
 * @property string|null $mo_ta
 * @property Carbon $ngay_tao
 * @property bool|null $hien_thi
 * @property bool|null $trang_thai
 * @property bool|null $thong_bao
 * 
 * @property HocPhan $hoc_phan
 * @property Taikhoan $taikhoan
 * @property Collection|BaiKiemTra[] $bai_kiem_tras
 * @property Collection|Danhgium[] $danhgia
 * @property Collection|LhpBg[] $lhp_bgs
 * @property Collection|SinhVien[] $sinh_viens
 *
 * @package App\Models
 */
class LopHocPhan extends Model
{
	protected $table = 'lop_hoc_phan';
	protected $primaryKey = 'ma_lhp';
	public $timestamps = false;

	protected $casts = [
		'ma_tk' => 'int',
		'ma_hp' => 'int',
		'ngay_tao' => 'datetime',
		'hien_thi' => 'bool',
		'trang_thai' => 'bool',
		'thong_bao' => 'bool'
	];

	protected $fillable = [
		'ten_lhp',
		'alias',
		'ma_tk',
		'ma_hp',
		'hinh_anh',
		'mo_ta',
		'ngay_tao',
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
				'taikhoan.hinh_anh as avatar',
				'hoc_phan.ten_hp as ten_hp'
			])
			->leftJoin('taikhoan', 'taikhoan.ma_tk', '=', $this->table . '.ma_tk')
			->leftJoin('hoc_phan', 'hoc_phan.ma_hp', '=', $this->table.'.ma_hp');

		// $query = $this->generateWhere($query, $args);

		// $query = $this->generateOrderBy($query, $args);

		// if ($offset >= 0) {
		// 	$query->offset($offset)->limit($perPage);
		// }

		return $query->get()->toArray();
	}

	public function hoc_phan()
	{
		return $this->belongsTo(HocPhan::class, 'ma_hp');
	}

	public function taikhoan()
	{
		return $this->belongsTo(Taikhoan::class, 'ma_tk');
	}

	public function bai_kiem_tras()
	{
		return $this->hasMany(BaiKiemTra::class, 'ma_lhp');
	}

	public function danhgia()
	{
		return $this->hasMany(Danhgium::class, 'ma_lhp');
	}

	public function lhp_bgs()
	{
		return $this->hasMany(LhpBg::class, 'ma_lhp');
	}

	public function sinh_viens()
	{
		return $this->hasMany(SinhVien::class, 'ma_lhp');
	}
}
