<?php

namespace rotostock;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Reference extends Model
{
	use SoftDeletes;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'lst_reference';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['code_barre', 'description', 'nb_stock'];

	/**
	* The attributes that should be mutated to dates.
	*
	* @var array
	*/
	protected $dates = ['deleted_at'];

	/**
	 * [scopeGetEtatStock description]
	 * @param  [type] $query [description]
	 * @return [type]        [description]
	 */
	public function scopeGetEtatStock($query)
	{
		return $query
		->select(
			DB::raw('code_barre AS \'Code Barre\'')
			, DB::raw('description AS \'Description\'')
			, DB::raw('nb_stock AS \'Stock\'')
			, DB::raw('updated_at AS \'Date MAJ\'')
			)
		->orderBy('id', 'desc')
		->get();
	}

	/**
	 * [scopeGetHistoriqueReference description]
	 * @param  [type] $query [description]
	 * @param  [type] $id    [description]
	 * @return [type]        [description]
	 */
	public function scopeGetHistoriqueReference($query, $id)
	{
		$first = DB::table('histo_sortie_reference')
		->join('users', 'users.id', '=', 'histo_sortie_reference.fk_id_user')
		->select('histo_sortie_reference.fk_id_reference', 'histo_sortie_reference.created_at', 'histo_sortie_reference.fk_id_user', 'users.name', DB::raw('\'sortie\' AS mouvement'))
		->where('fk_id_reference', '=', $id);

		return DB::table('histo_ajout_reference')
		->join('users', 'users.id', '=', 'histo_ajout_reference.fk_id_user')
		->select('histo_ajout_reference.fk_id_reference', 'histo_ajout_reference.created_at', 'histo_ajout_reference.fk_id_user', 'users.name', DB::raw('\'entree\' AS mouvement'))
		->where('fk_id_reference', '=',  $id)
		->unionAll($first)
		->orderBy('created_at', 'desc')
		->get();
	}

	public function histoAjoutReference()
	{
		return $this->belongsToMany('rotostock\HistoAjoutReference', 'fk_id_reference');
	}
}
