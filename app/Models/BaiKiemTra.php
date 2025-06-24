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
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_lhp',
		'tieu_de',
		'noi_dung',
		'dap_an',
		'ngay_tao',
		'trang_thai'
	];

	public function gets($args)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*',
				'lop_hoc_phan.ten_lhp as ten_lhp',
				'lop_hoc_phan.alias as alias_lhp'
				])
			->join('lop_hoc_phan', 'lop_hoc_phan.ma_lhp', '=', 'bai_kiem_tra.ma_lhp');



		if (isset($args['class_alias'])) {
			$query = $query->where('lop_hoc_phan.alias', $args['class_alias']);

		}
		if (isset($args['test_code'])) {
			$query = $query->where('bai_kiem_tra.ma_bkt', $args['test_code']);

		}
		if (isset($args['order_by'])) {
			$query = $query->orderBy('ngay_tao', $args['order_by']);
		}
		// $query = $this->generateWhere($query, $args);

		// $query = $this->generateOrderBy($query, $args);

		// if ($offset >= 0) {
		// 	$query->offset($offset)->limit($perPage);
		// }

		return $query->get()->toArray();
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
