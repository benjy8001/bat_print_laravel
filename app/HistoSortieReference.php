<?php

namespace rotostock;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class HistoSortieReference extends Model
{
	use SoftDeletes;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'histo_sortie_reference';

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
	 * [scopeNewOutcomeFromToday description]
	 * @return [type] [description]
	 */
	public function scopeNewOutcomeFromToday()
	{
		return DB::table('histo_sortie_reference')
		->join('lst_reference', 'histo_sortie_reference.fk_id_reference', '=', 'lst_reference.id')
		->select('histo_sortie_reference.*', DB::raw('COUNT(histo_sortie_reference.id) AS nb'), 'lst_reference.description', 'lst_reference.nb_stock')
		->where('histo_sortie_reference.updated_at', 'LIKE', date('Y-m-d') . ' %')
		->groupBy('histo_sortie_reference.fk_id_reference')
		->orderBy('histo_sortie_reference.updated_at', 'desc')
		->limit(25);
	}

	/**
	 * [scopeConsommationStock description]
	 * @param  [type] $date_debut [description]
	 * @param  [type] $date_fin   [description]
	 * @param  [type] $code_barre [description]
	 * @return [type]             [description]
	 */
	public function scopeConsommationStock($query, $date_debut, $date_fin, $code_barre)
	{
		$return = DB::table('histo_sortie_reference')
		->join('lst_reference', 'histo_sortie_reference.fk_id_reference', '=', 'lst_reference.id')
		->select('lst_reference.code_barre', DB::raw('COUNT(histo_sortie_reference.id) AS nb'), 'lst_reference.description', 'lst_reference.nb_stock', DB::raw('DATE_FORMAT(histo_sortie_reference.updated_at, "%d/%m/%Y") as date'))
		->whereBetween(DB::raw('DATE_FORMAT(histo_sortie_reference.updated_at, "%d/%m/%Y")'), [$date_debut, $date_fin]);

		if(!empty($code_barre)) $return->where('histo_sortie_reference.code_barre', '=', $code_barre);

		$return->groupBy('lst_reference.code_barre')
		->groupBy('date')
		->orderBy('date', 'desc');
		//dd($return->toSql());
		return $return;
	}

	/**
	 * [scopeGetTodayRemove description]
	 * @return [type] [description]
	 */
	public function scopeGetTodayRemove()
	{
		return DB::table('histo_sortie_reference')
		->join('lst_reference', 'histo_sortie_reference.fk_id_reference', '=', 'lst_reference.id')
		->select(DB::raw('COUNT(histo_sortie_reference.id) AS nb'))
		->where('histo_sortie_reference.updated_at', 'LIKE', date('Y-m-d') . ' %')->first();
	}

	/**
	 * [scopeGetYesterdayRemove]
	 * @return [type] [description]
	 */
	public function scopeGetYesterdayRemove()
	{
		return DB::table('histo_sortie_reference')
		->join('lst_reference', 'histo_sortie_reference.fk_id_reference', '=', 'lst_reference.id')
		->select(DB::raw('COUNT(histo_sortie_reference.id) AS nb'))
		->where('histo_sortie_reference.updated_at', 'LIKE', date('Y-m-d', strtotime('-1 day')) . ' %')->first();
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
