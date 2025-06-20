<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class TuongTac
 * 
 * @property int $id
 * @property int $ma_tk
 * @property int $ma_bg
 * @property int|null $tra_loi_cho
 * @property string $noi_dung
 * @property Carbon $ngay_tao
 * @property bool|null $trang_thai
 * 
 * @property BaiGiang $bai_giang
 * @property SinhVien $sinh_vien
 *
 * @package App\Models
 */
class TuongTac extends Model
{
	protected $table = 'tuong_tac';
	public $timestamps = false;

	protected $casts = [
		'ma_tk' => 'int',
		'ma_bg' => 'int',
		'tra_loi_cho' => 'int',
		'ngay_tao' => 'datetime',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_tk',
		'ma_bg',
		'tra_loi_cho',
		'noi_dung',
		'ngay_tao',
		'trang_thai'
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
			->join('bai_giang', 'bai_giang.ma_bg', '=', $this->table . '.ma_bg');


		// $query = $this->generateWhere($query, $args);

		// $query = $this->generateOrderBy($query, $args);

		// if ($offset >= 0) {
		// 		$query->offset($offset)->limit($perPage);
		// 	}

		return $query->get()->toArray();
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
