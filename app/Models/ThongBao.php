<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * Class VaiTro
 * 
 * @property int $id
 * @property int $ma_lhp
 * @property string $ho_ten
 * @property string $mo_ta  
 * @property string $noi_dung
 * @property Carbon $ngay_tao
 * @property bool|null $trang_thai
 * 
 * @property LopHocPhan $lop_hoc_phan
 *
 * @package App\Models
 */
class ThongBao extends Model
{
	protected $table = 'thong_bao';
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $casts = [
		'ngay_tao' => 'datetime',
		'trang_thai' => 'bool'
	];

	protected $fillable = [
		'ma_lhp',
		'ho_ten',
		'mo_ta',
		'noi_dung',
		'ngay_tao',
		'trang_thai'
	];
	public function gets($args)
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*'
			]);
		if (isset($args['order_by'])) {
			$query = $query->orderBy('ngay_tao', $args['order_by']);
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
	public function lop_hoc_phans()
	{
		return $this->belongsTo(LopHocPhan::class, 'ma_tk');
	}
}
