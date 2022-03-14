<?php

namespace rotostock;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class HistoAjoutReference extends Model
{
	use SoftDeletes;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'histo_ajout_reference';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['fk_id_reference', 'code_barre'];

	/**
	* The attributes that should be mutated to dates.
	*
	* @var array
	*/
	protected $dates = ['deleted_at'];

	/**
	 * [scopeNewIncomeFromToday description]
	 * @return [type] [description]
	 */
	public function scopeNewIncomeFromToday()
	{
		return DB::table('histo_ajout_reference')
		->join('lst_reference', 'histo_ajout_reference.fk_id_reference', '=', 'lst_reference.id')
		->select('histo_ajout_reference.*', DB::raw('COUNT(histo_ajout_reference.id) AS nb'), 'lst_reference.description', 'lst_reference.nb_stock')
		->where('histo_ajout_reference.updated_at', 'LIKE', date('Y-m-d') . ' %')
		->groupBy('histo_ajout_reference.fk_id_reference')
		->orderBy('histo_ajout_reference.updated_at', 'desc')
		->limit(25);
	}

	/**
	 * [scopeGetTodayAdd description]
	 * @return [type] [description]
	 */
	public function scopeGetTodayAdd()
	{
		return DB::table('histo_ajout_reference')
		->join('lst_reference', 'histo_ajout_reference.fk_id_reference', '=', 'lst_reference.id')
		->select(DB::raw('COUNT(histo_ajout_reference.id) AS nb'))
		->where('histo_ajout_reference.updated_at', 'LIKE', date('Y-m-d') . ' %')->first();
	}

	/**
	 * [scopeGetYesterdayAdd description]
	 * @return [type] [description]
	 */
	public function scopeGetYesterdayAdd()
	{
		return DB::table('histo_ajout_reference')
		->join('lst_reference', 'histo_ajout_reference.fk_id_reference', '=', 'lst_reference.id')
		->select(DB::raw('COUNT(histo_ajout_reference.id) AS nb'))
		->where('histo_ajout_reference.updated_at', 'LIKE', date('Y-m-d', strtotime('-1 day')) . ' %')->first();
	}

	/**
	 * [references description]
	 * @return [type] [description]
	 * Lien avec la table lst_reference
	 */
	public function references()
	{
		return $this->belongsTo('rotostock\Reference', 'fk_id_reference');
	}
}
