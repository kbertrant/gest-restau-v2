<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Produit;
use App\Utils\GetUserGroup;

class ProduitController extends Controller
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
            $tasks = Produit::all();
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' data-id='".$row->id."' data-bs-toggle='modal'><i data-lucide='plus' class='w-5 h-5'>Voir</i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/produits/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i data-lucide='trash' class='w-5 h-5'>Modif</i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/produits/destroy/".$row->id."'><i data-lucide='trash' class='w-5 h-5'>Suppr</i></a>";

                return $updateButton." ".$deleteButton."".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $list_cats = Categorie::all();
        $privation = GetUserGroup::getUserGroup();
        return view('produit.produit',['list_cats'=>$list_cats,'privation'=>$privation]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function produit()
    {
        $produit = DB::select("SELECT * FROM produits where id = 1");
        $id = null;
        $list_cats = Categorie::all();
        $privation = GetUserGroup::getUserGroup();
        $list_produits = Produit::all();
        return view('produit.produit',['list_produits'=>$list_produits,'list_cats'=>$list_cats,'produit'=>$produit,
        'id'=>$id,'privation'=> $privation]);
    }

    public function increment()
    {
        if(request()->ajax()) {
            $tasks = Produit::all();
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' data-id='".$row->id."' data-bs-toggle='modal'><i data-lucide='plus' class='w-5 h-5'>Voir</i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/produits/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i data-lucide='trash' class='w-5 h-5'>Modif</i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/produits/destroy/".$row->id."'><i data-lucide='trash' class='w-5 h-5'>Suppr</i></a>";

                return $updateButton." ".$deleteButton."".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $privation = GetUserGroup::getUserGroup();
        $list_produits = DB::select("SELECT * FROM produits");
        return view('produit.increment',['list_produits'=>$list_produits,'privation'=> $privation]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prod_name' => ['required','unique:produits'],
            'prod_type' => ['required'],
            'description' => ['required'],
            'prix_unit' => ['required'],
            'cat_id' => ['required'],
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('produit')
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($request);
        $product = DB::table('produits')->insert(
            ['prod_name' =>$request->prod_name,
            'prod_type' =>$request->prod_type,
            'description' =>$request->description,
            'prod_qte' =>0,
            'prix_unit' =>$request->prix_unit,
            'cat_id' =>$request->cat_id]
        );
        //return $product;
        return redirect('produits')->with('success','produit ajouté');
    }

    public function edit($id)
    {

        $produit = DB::select("SELECT * FROM produits WHERE id =(".$id.")");
        $list_cats = DB::select("SELECT * FROM categories");
        $privation = GetUserGroup::getUserGroup();
        $list_produits = DB::select("SELECT * FROM produits");
        return view('produit.updateproduit',['list_produits'=>$list_produits,'list_cats'=>$list_cats,
        'produit'=>$produit,'id'=>$id,'privation'=> $privation]);
    }

    public function updatestock(Request $request){

        $validator = Validator::make($request->all(), [
            'prod_qte' => ['required'],
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('increment')
                        ->withErrors($validator)
                        ->withInput();
        }

        $produit = Produit::findOrFail($request->get('id'));
        $produit->prod_qte = $request->get('prod_qte');
        $produit->save();
        return back();
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prod_name' => ['required','unique:produits'],
            'prod_type' => ['required'],
            'description' => ['required'],
            'prix_unit' => ['required'],
            'cat_id' => ['required'],
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('produit')
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($request);
        
        $produit = Produit::findOrFail($request->id);
        $produit->prod_name = $request->get('prod_name');
        $produit->prod_type = $request->get('prod_type');
        $produit->description = $request->get('description');
        $produit->prix_unit = $request->get('prix_unit');
        $produit->cat_id = $request->get('cat_id');
        $produit->save();
        //return $product;
        return redirect('produits')->with('success','produit ajouté');
    }


    public function getproductprice($id)
    {
        dd($id);
        $produit = DB::select("SELECT * FROM produits WHERE id =(".$id.")");
        $privation = GetUserGroup::getUserGroup();
        $list_produits = DB::select("SELECT * FROM produits");
        $list_commandes = DB::select("SELECT * FROM commandes");
        return $produit;
    }


    public function destroy($id){
        $produit = Produit::find($id);
        $produit->delete();
        return redirect('produits')->with('success','produit supprimé');
    }
}
