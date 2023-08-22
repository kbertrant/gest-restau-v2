<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Utils\GetUserGroup;
use App\Models\Groupe;

class GroupeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(request()->ajax()) {
            $tasks = Groupe::all();
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' data-id='".$row->id."' data-bs-toggle='modal'><i data-lucide='plus' class='w-5 h-5'>Voir</i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/groupes/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i data-lucide='trash' class='w-5 h-5'>Modif</i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/groupes/destroy/".$row->id."'><i data-lucide='trash' class='w-5 h-5'>Suppr</i></a>";

                return $updateButton." ".$deleteButton."".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $privation = GetUserGroup::getUserGroup();
        return view('groupe.groupe',['privation'=>$privation]);
    }

    public function groupe()
    {
        $groupes = DB::select("SELECT * FROM groupes");
        $id = null;

        $privation = GetUserGroup::getUserGroup();
        $list_groupes = DB::select("SELECT * FROM groupes");
        return view('groupe.groupe',['list_groupes'=>$list_groupes,
        'groupes'=>$groupes,'privation'=> $privation,'id'=>$id]);
    }

    public function store(Request $request)
    {
        
       /*  $validator = Validator::make($request->all(), [
            'name' => ['required','unique:groupe'],
            'description' => ['required'],
            'commande' => ['required'],
            'produit' => ['required'],
            'stock' => ['required'],
            'groupe' => ['required'],
            'user' => ['required'],
            'etat' => ['required']
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('groupe')
                        ->withErrors($validator)
                        ->withInput();
        } */
        if($request->produit == "on"){
            $produit = 1;
        }elseif($request->produit == null){
            $produit = 0;
        }
        if($request->commande == "on"){
            $commande = 1;
        }elseif($request->commande == null){
            $commande = 0;
        }
        if($request->stock == "on"){
            $stock = 1;
        }elseif($request->stock == null){
            $stock = 0;
        }
        if($request->paiement == "on"){
            $paiement = 1;
        }elseif($request->paiement == null){
            $paiement = 0;
        }
        if($request->groupe == "on"){
            $groupe = 1;
        }elseif($request->groupe == null){
            $groupe = 0;
        }
        if($request->user == "on"){
            $user = 1;
        }elseif($request->user == null){
            $user = 0;
        }
        if($request->etat == "on"){
            $etat = 1;
        }elseif($request->etat == null){
            $etat = 0;
        }
        if($request->param == "on"){
            $param = 1;
        }elseif($request->param == null){
            $param = 0;
        }
        if($request->delivery == "on"){
            $delivery = 1;
        }elseif($request->delivery == null){
            $delivery = 0;
        }
        

        

        $product = DB::table('groupes')->insert(
            ['name' =>$request->name,
            'description' =>$request->description,
            'commande' =>$commande,
            'produit' =>$produit,
            'stock' =>$stock,
            'paiements' =>$paiement,
            'groupe' =>$groupe,
            'user' =>$user,
            'etat' =>$etat,
            'delivery'=>$delivery,
            'parametres' =>$param,
            'created_at'=>now(),
            'updated_at'=>now()]
        );
        
        //return $product;
        return redirect('groupes')->with('success','groupe ajouté');
    }

    public function edit($id)
    {
        $privation = GetUserGroup::getUserGroup();
        $groupes = Groupe::find($id);
        if($groupes->produit == 1){
            $groupes->produit = "checked";
        }elseif($groupes->produit == 0){
            $groupes->produit = "";
        }
        if($groupes->commande == 1){
            $groupes->commande = "checked";
        }elseif($groupes->commande == 0){
            $groupes->commande = "";
        }
        if($groupes->stock == 1){
            $groupes->stock = "checked";
        }elseif($groupes->stock == 0){
            $groupes->stock = "";
        }
        if($groupes->groupe == 1){
            $groupes->groupe = "checked";
        }elseif($groupes->groupe == 0){
            $groupes->groupe = "";
        }
        if($groupes->user == 1){
            $groupes->user = "checked";
        }elseif($groupes->user == 0){
            $groupes->user = "";
        }
        if($groupes->etat == 1){
            $groupes->etat = "checked";
        }elseif($groupes->etat == 0){
            $groupes->etat = "";
        }
        if($groupes->parametres == 1){
            $groupes->parametres = "checked";
        }elseif($groupes->parametres == 0){
            $groupes->parametres = "";
        }

        if($groupes->delivery == 1){
            $groupes->delivery = "checked";
        }elseif($groupes->delivery == 0){
            $groupes->delivery = "";
        }
        if($groupes->paiements == 1){
            $groupes->paiements = "checked";
        }elseif($groupes->paiements == 0){
            $groupes->paiements = "";
        }

        if($groupes==null){
            $groupes->name = "nom groupe";
            $groupes->description = "description";
            $groupes->commande = "";
            $groupes->produit = "";
            $groupes->stock ="";
            $groupes->groupe = "";
            $groupes->user = "";
            $groupes->etat  = "";
            $groupes->delivery  = "";
            $groupes->parametres = "";
            $groupes->paiements = "";     
        }

        //dd($groupes);
        $list_groupes = Groupe::all();
        return view('groupe.updategroupe',['list_groupes'=>$list_groupes,
        'groupes'=>$groupes,'privation'=> $privation,'id'=>$id]);
    }


    public function update(Request $request)
    {
        //dd($request);
       /*  
        
        if ($validator->fails()) {
            return redirect('groupe')
                        ->withErrors($validator)
                        ->withInput();
        } */
        if($request->produitu == "on"){
            $produit = 1;
        }elseif($request->produitu == null){
            $produit = 0;
        }
        if($request->commandeu == "on"){
            $commande = 1;
        }elseif($request->commandeu == null){
            $commande = 0;
        }
        if($request->stocku == "on"){
            $stock = 1;
        }elseif($request->stocku == null){
            $stock = 0;
        }
        if($request->groupeu == "on"){
            $groupe = 1;
        }elseif($request->groupeu == null){
            $groupe = 0;
        }
        if($request->useru == "on"){
            $user = 1;
        }elseif($request->useru == null){
            $user = 0;
        }
        if($request->etatu == "on"){
            $etat = 1;
        }elseif($request->etatu == null){
            $etat = 0;
        }
        if($request->paramu == "on"){
            $param = 1;
        }elseif($request->paramu == null){
            $param = 0;
        }
        if($request->deliveryu == "on"){
            $delivery = 1;
        }elseif($request->deliveryu == null){
            $delivery = 0;
        }
        if($request->paiementsu == "on"){
            $paiements = 1;
        }elseif($request->paiementsu == null){
            $paiements = 0;
        }
        DB::table('groupes')->where('id',$request->id)->update(array('name'=>$request->nameu,
        'description'=>$request->descriptionu,
        'produit'=>$produit,
        'commande'=>$commande,
        'stock'=>$stock,
        'groupe'=>$groupe,
        'user'=>$user,
        'etat'=>$etat,
        'delivery'=>$delivery,
        'paiements'=>$paiements,
        'parametres'=>$param));
        

        //return $product;
        return redirect('groupes')->with('success','groupe ajouté');
    }


    public function destroy($id){
        //$groupe = DB::select("SELECT * FROM groupe WHERE id =(".$id.")");
        $groupe = DB::table('groupes')->delete($id);
        return redirect('groupes')->with('success','groupe supprimé');
    }
}
