<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class NopBaiKiemTra
 * 
 * @property int $id
 * @property int $ma_bkt
 * @property int $ma_tk
 * @property string $noi_dung
 * @property string $tra_loi
 * @property float|null $diem_so
 * @property Carbon $ngay_nop
 * @property bool|null $trang_thai
 * 
 * @property BaiKiemTra $bai_kiem_tra
 * @property SinhVien $sinh_vien
 *
 * @package App\Models
 */
class NopBaiKiemTra extends Model
{
	protected $table = 'nop_bai_kiem_tra';
	public $timestamps = false;

	protected $casts = [
		'ma_bkt' => 'int',
		'ma_tk' => 'int',
		'diem_so' => 'float',
		'ngay_nop' => 'datetime',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_bkt',
		'ma_tk',
		'noi_dung',
		'tra_loi',
		'diem_so',
		'ngay_nop',
		'trang_thai'
	];
	public function gets($args)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'taikhoan.ho_ten as ho_ten',
				'taikhoan.ma_tk as ma_tk',
				// 'taikhoan.hinh_anh as avatar',
				'lop_hoc_phan.ten_lhp as ten_lhp',
				'lop_hoc_phan.alias as alias_lhp',
				'bai_kiem_tra.tieu_de as tieu_de',

				])
			->join('bai_kiem_tra', 'bai_kiem_tra.ma_bkt', '=', $this->table . '.ma_bkt')
			->join('lop_hoc_phan', 'lop_hoc_phan.ma_lhp', '=', 'bai_kiem_tra.ma_lhp')
			->join('sinh_vien', 'sinh_vien.ma_tk', '=', $this->table . '.ma_tk')
			->join('taikhoan', 'taikhoan.ma_tk', '=',  'sinh_vien.ma_tk');


		if (isset($args['class_alias'])) {
			$query = $query->where('lop_hoc_phan.alias', $args['class_alias']);
		}
		if (isset($args['test_code'])) {
			$query = $query->where('bai_kiem_tra.ma_bkt', $args['test_code']);
		}
		if (isset($args['per_page'])) {
			$per_page = $args['per_page'] ?? 10;
			return $query->paginate($per_page);
		}
		return $query->get()->toArray();
	}
	public function bai_kiem_tra()
	{
		return $this->belongsTo(BaiKiemTra::class, 'ma_bkt');
	}

	public function sinh_vien()
	{
		return $this->belongsTo(SinhVien::class, 'ma_tk', 'ma_tk');
	}
}
