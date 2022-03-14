<?php

namespace rotostock\Http\Controllers;

use Illuminate\Http\Request;
use rotostock\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use rotostock\Reference;
use rotostock\HistoAjoutReference;
use rotostock\HistoSortieReference;

class StockController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('ajax')->only('extractEtatStock');
	}

	/**
	 * Affichage de la page principale aprés connexion
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$request->user()->authorizeRoles(['utilisateur', 'administrateur']);

		//$references 		= Reference::all();
		$today_add 		= HistoAjoutReference::getTodayAdd();
		$yesterday_add 	= HistoAjoutReference::getYesterdayAdd();
		$pourcentage_add_from_yesterday = 0;
		if($yesterday_add->nb > 0)
		{
			$pourcentage_add_from_yesterday = round(($today_add->nb * 100) / $yesterday_add->nb, 2);
		}
		//
		$today_remove 	= HistoSortieReference::getTodayRemove();
		$yesterday_remove 	= HistoSortieReference::getYesterdayRemove();
		$pourcentage_remove_from_yesterday = 0;
		if($yesterday_remove->nb > 0)
		{
			$pourcentage_remove_from_yesterday = round(($today_remove->nb * 100) / $yesterday_remove->nb, 2);
		}

		//dd($yesterday_add);

		//withTrashed()->get();
		/*
		withTrashed()
		->where('airline_id', 1)
		->restore();
		 */
		//->forceDelete();
		//
		//return view('dashboard')->with('today_add', $today_add);
		return view('dashboard'
			, [
			'today_add' => $today_add
			, 'pourcentage_add_from_yesterday' => $pourcentage_add_from_yesterday
			, 'today_remove' => $today_remove
			, 'pourcentage_remove_from_yesterday' => $pourcentage_remove_from_yesterday
			]
			);
	}

	/**
	 * Formulaire d'ajout au stock + des ajouts du jour
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function entrees(Request $request)
	{
		$request->user()->authorizeRoles(['utilisateur', 'administrateur']);
		// $references = DB::table('histo_ajout_reference')
		// ->join('lst_reference', 'histo_ajout_reference.fk_id_reference', '=', 'lst_reference.id')
		// ->select('histo_ajout_reference.*', DB::raw('COUNT(histo_ajout_reference.id) AS nb'), 'lst_reference.description', 'lst_reference.nb_stock')
		// ->where('histo_ajout_reference.updated_at', 'LIKE', date('Y-m-d') . ' %')
		// ->groupBy('histo_ajout_reference.fk_id_reference')
		// ->orderBy('histo_ajout_reference.updated_at', 'desc')
		// ->limit(25)
		// ->get();
		$references = HistoAjoutReference::newIncomeFromToday()->get();
		// $references = HistoAjoutReference::with('references')->where('updated_at', 'LIKE', date('Y-m-d') . ' %')->orderBy('updated_at', 'desc')->take(25)->get();
		// $references = HistoAjoutReference::references()->where('updated_at', 'LIKE', date('Y-m-d') . ' %')->orderBy('updated_at', 'desc')->take(25)->toSql();
		//var_dump($references);
		//die;
		//dd($references);
		/*

		$references = HistoAjoutReference::join('lst_reference', 'lst_reference.id', '=', 'histo_ajout_reference.fk_id_reference')
		->select('histo_ajout_reference.*', 'lst_reference.description', 'lst_reference.nb_stock')
		->where('histo_ajout_reference.updated_at', 'LIKE', date('Y-m-d') . ' %')
		->orderBy('histo_ajout_reference.updated_at', 'desc')
		->take(25)
		->get();
		 */
		//
		return view('stock.entrees')->with('references', $references);
	}

	/**
	 * Ajout au stock
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function addStock(Request $request)
	{
		$request->user()->authorizeRoles(['utilisateur', 'administrateur']);

		$this->validate($request, [
			'code_barre' => 'required'
			]);
		//return view('stock/addStock');
		//$parameters = $request->all();
		$parameters = $request->except(['_token']);

		//Reference::create($parameters);

		//$reference = Reference::where('code_barre', '=',  $parameters['code_barre'])->first();
		//$reference = Reference::firstOrNew(['code_barre' => $parameters['code_barre']]);
		$attributes = ['code_barre' => $parameters['code_barre']];
		if (! $reference = Reference::withTrashed()->where($attributes)->first()) {
			$reference = new Reference($attributes);
		}
		$reference->nb_stock++;
		$reference->code_barre = $parameters['code_barre'];
		if ($reference->trashed())
		{
			$reference->restore();
		}
		$reference->save();
		//
		$histo = new HistoAjoutReference();
		$histo->fk_id_user 		=Auth::id();
		$histo->fk_id_reference 	= $reference->id;
		$histo->code_barre		= $parameters['code_barre'];
		$histo->save();

		return redirect()->route('entrees')->with('success', 'Stock ajouté.');
	}

	/**
	 * Affichage du formulaire de sortie de stock + des sorties du jour
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function sorties(Request $request)
	{
		$request->user()->authorizeRoles(['utilisateur', 'administrateur']);
		//
		$references = HistoSortieReference::newOutcomeFromToday()->get();
		return view('stock.sorties')->with('references', $references);
	}

	/**
	 * Action pour supprimer du stock
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function removeStock(Request $request)
	{
		$request->user()->authorizeRoles(['utilisateur', 'administrateur']);
		//
		$this->validate($request, [
			'code_barre' => 'required'
			]);
		//return view('stock/addStock');
		//$parameters = $request->all();
		$parameters = $request->except(['_token']);

		//Reference::create($parameters);

		//$reference = Reference::where('code_barre', '=',  $parameters['code_barre'])->first();
		//$reference = Reference::firstOrNew(['code_barre' => $parameters['code_barre']]);
		$attributes = ['code_barre' => $parameters['code_barre']];
		if (! $reference = Reference::withTrashed()->where($attributes)->first()) {
			$reference = new Reference($attributes);
		}
		if ($reference->exists)
		{
			$reference->nb_stock--;
			$reference->code_barre = $parameters['code_barre'];
			if ($reference->trashed())
			{
				$reference->restore();
			}
			$reference->save();
			//
			$histo 				= new HistoSortieReference();
			$histo->fk_id_user 		=Auth::id();
			$histo->fk_id_reference 	= $reference->id;
			$histo->code_barre 		= $parameters['code_barre'];
			$histo->save();
			return redirect()->route('sorties')->with('success', 'Stock retiré.');
		}
		else
		{
			return redirect()->route('sorties')->with('error', 'Référence inconnue, stock non modifié.');
		}

	}

	/**
	 * Affichage du stock
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function stock(Request $request)
	{
		$request->user()->authorizeRoles(['utilisateur', 'administrateur']);
		//
		$references = Reference::all();
		return view('stock.stock')->with('references', $references);
	}

	/**
	 * [updateReference description]
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function updateReference(Request $request, $id)
	{
		$request->user()->authorizeRoles(['utilisateur', 'administrateur']);
		//$reference = Reference::where('id', '=', $id)->first();
		$reference = Reference::find($id);
		$historique = Reference::getHistoriqueReference($id);

		//dd($historique);

		if ($request->isMethod('post'))
		{
			$this->validate($request, [
				'code_barre' => 'required'
				, 'nb_stock' => 'required'
				]);

			$parameters = $request->except(['_token']);

			$reference->code_barre 	= $parameters['code_barre'];
			$reference->nb_stock 	= $parameters['nb_stock'];
			$reference->description 	= $parameters['description'];
			$reference->save();

			return redirect()->route('viewStock')->with('success', 'La référence à été mise à jour.');
		}

		return view('stock/addReference', ['reference' => $reference, 'historique' => $historique]);
	}

	/**
	 * [createReference description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function createReference(Request $request)
	{
		$request->user()->authorizeRoles(['utilisateur', 'administrateur']);
		//
		if ($request->isMethod('post'))
		{
			$this->validate($request, [
				'code_barre' => 'required'
				, 'nb_stock' => 'required'
				]);

			$parameters = $request->except(['_token']);

       			//Reference::create($parameters);
			$attributes = ['code_barre' => $parameters['code_barre']];
			if (! $reference = Reference::withTrashed()->where($attributes)->first()) {
				$reference = new Reference($attributes);
			}
			if ($reference->trashed())
			{
				$reference->restore();
			}
			$reference->code_barre 	= $parameters['code_barre'];
			$reference->nb_stock 	= $parameters['nb_stock'];
			$reference->description 	= $parameters['description'];
			$reference->save();

			return redirect()->route('viewStock')->with('success', 'La référence a été ajoutée.');
		}
		return view('stock/addReference');
	}

	/**
	 * [deleteRefence description]
	 * @return [type]     [description]
	 */
	public function deleteRefence(Request $request, $id)
	{
		$request->user()->authorizeRoles('administrateur');
		//$id = $request->input('id');
       		//$reference = Reference::where('id', '=', $id)->first();
		$reference = Reference::find($id);
		$reference->delete();

		return redirect()->route('viewStock')->with('success', 'La référence à été supprimée.');
	}

	/**
	 * Page d'accés au extractions
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function extract(Request $request)
	{
		$request->user()->authorizeRoles('administrateur');
		//
		return view('stock.extract');
	}

	/**
	 * Extraction etat stock
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function extractEtatStock(Request $request)
	{
		$request->user()->authorizeRoles('administrateur');
		//
		$filename = 'EtatStock';
		$extension = 'xls';
		$storage_path = 'storage';
		//$storage_path = 'app/public';
		//
		$data = Reference::getEtatStock();
		//
		Excel::create($filename, function($excel) use($data) {
			// Set the title
			$excel->setTitle('Etat du stock');

    			// Chain the setters
			$excel->setCreator('Benjamin Mabille')
			->setCompany('Plug-It');

    			// Call them separately
			$excel->setDescription('Etat du stock');
			$excel->sheet('Stock', function($sheet) use($data) {
				$sheet->fromArray($data);
			});
		})->store($extension, public_path($storage_path));
		//storage_path($storage_path)
		//
		//return view('stock.extract_etat_stock')->render();
		$returnHTML = view('stock.extract_etat_stock', ['filename' => $filename . '.' . $extension])->render();
		return response()->json( array('success' => true, 'html'=>$returnHTML) );
	}

	/**
	 * Extraction conso stock
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function extractConso(Request $request)
	{
		$request->user()->authorizeRoles('administrateur');
		//
		$parameters = $request->except(['_token']);
		//
		$filename = 'ConsoStock';
		$extension = 'xls';
		$storage_path = 'storage';
		//$storage_path = 'app/public';
		//
		$data = HistoSortieReference::consommationStock($parameters['date_debut'], $parameters['date_fin'], $parameters['code_barre'])->get();
		//
		//dd($data);
		$data = json_decode( json_encode($data), true);
		//
		Excel::create($filename, function($excel) use($data) {
			// Set the title
			$excel->setTitle('Consommation du stock');

    			// Chain the setters
			$excel->setCreator('Benjamin Mabille')
			->setCompany('Plug-It');

    			// Call them separately
			$excel->setDescription('Consommation du stock');
			$excel->sheet('Consommation du au', function($sheet) use($data) {
				$sheet->fromArray($data);
			});
		})->store($extension, public_path($storage_path));
		//storage_path($storage_path)
		//
		//return view('stock.extract_etat_stock')->render();
		$returnHTML = view('stock.extract_etat_stock', ['filename' => $filename . '.' . $extension])->render();
		return response()->json( array('success' => true, 'html'=>$returnHTML) );
	}
}
