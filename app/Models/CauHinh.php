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
 * @property string|null $ten_site
 * @property string|null $dia_chi
 * @property string|null $sdt
 * @property string|null $email
 * @property string|null $website
 * @property string|null $logo
 * @property string|null $favicon
 * @property string|null $lien_ket
 * @property string|null $facebook
 * 
 * 
 * 
 *
 * @package App\Models
 */
class CauHinh extends Model
{
	protected $table = 'cau_hinh';
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $fillable = [
		'ten_site',
		'dia_chi',
		'sdt',
		'email',
		'website',
		'logo',
		'favicon',
		'lien_ket',
		'facebook'
	];
	public function get()
	{
		$query = DB::table($this->table)
			->select([
				$this->table . '.*'
			]);
		return $query->first();
	}
	public function admin_update($data)
	{
		if (empty($data)) {
			return false;
		}
		$config = DB::table($this->table)
			->select([
				$this->table . '.*'
			])
			->first();
		$result = DB::table($this->table)
			->select([
				$this->table . '.*'
			])
			->where($this->table . '.id', $config->id)
			->update($data);
		return $result;
	}
	public function upload_image($type, $image)
	{
		if (empty($image)) {
			return false;
		}
		$config = DB::table($this->table)
			->select([
				$this->table . '.*'
			])
			->first();
		$result = DB::table($this->table)
			->where($this->table . '.id', $config->id)
			->update([$type => $image]);
		return $result;
	}
}
