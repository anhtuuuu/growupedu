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
 * @property int|null $ma_bg
 * @property int $ma_hp
 * @property string|null $hinh_anh
 * @property string|null $mo_ta
 * @property Carbon $ngay_tao
 * @property bool|null $hien_thi
 * @property bool|null $trang_thai
 * @property bool|null $thong_bao
 * 
 * @property BaiGiang|null $bai_giang
 * @property HocPhan $hoc_phan
 * @property Taikhoan $taikhoan
 * @property Collection|BaiKiemTra[] $bai_kiem_tras
 * @property Collection|DanhGia[] $danh_gia
 * @property Collection|SinhVien[] $sinh_viens
 * @property Collection|TuongTac[] $tuong_tacs
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
		'ma_bg' => 'int',
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
		'ma_bg',
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
			->join('taikhoan', 'taikhoan.ma_tk', '=', $this->table . '.ma_tk')
			->join('hoc_phan', 'hoc_phan.ma_hp', '=', $this->table . '.ma_hp');
		if (isset($args['alias'])) {
			$query = $query->where($this->table . '.alias', $args['alias']);
		}
		if (isset($args['ma_tk'])) {
			$query = $query->where($this->table . '.ma_tk', $args['ma_tk']);
		}
		// $query = $this->generateWhere($query, $args);

		// $query = $this->generateOrderBy($query, $args);

		// if ($offset >= 0) {
		// 	$query->offset($offset)->limit($perPage);
		// }

		return $query->get()->toArray();
	}
		public function add($data){
		if(empty($data)){
			return false;
		}
		$result = DB::table($this->table)->insert($data);
		return $result;
	}
		public function upload_image($alias, $image){
		if(empty($image)){
			return false;
		}
		$result = DB::table($this->table)
			->where($this->table . '.alias', $alias)
			->update(['hinh_anh' => $image]);
		return $result;
	}
	public function admin_update($id, $data)
	{
		if (empty($data)) {
			return false;
		}
		$result = DB::table($this->table)
			->where($this->table . '.ma_lhp', $id)
			->update($data);
		return $result;
	}


	public function get_by_id($id)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'taikhoan.ho_ten as ho_ten',
				'taikhoan.hinh_anh as avatar',
				'hoc_phan.ten_hp as ten_hp'
			])
			->join('taikhoan', 'taikhoan.ma_tk', '=', $this->table . '.ma_tk')
			->join('hoc_phan', 'hoc_phan.ma_hp', '=', $this->table . '.ma_hp')
			->where($this->table . '.ma_lhp', $id);
		return $query->first();
	}
	public function bai_giang()
	{
		return $this->belongsTo(BaiGiang::class, 'ma_bg');
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

	public function danh_gia()
	{
		return $this->hasMany(DanhGia::class, 'ma_lhp');
	}

	public function sinh_viens()
	{
		return $this->hasMany(SinhVien::class, 'ma_lhp');
	}

	public function tuong_tacs()
	{
		return $this->hasMany(TuongTac::class, 'ma_lhp');
	}
}
