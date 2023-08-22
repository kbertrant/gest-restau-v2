<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Produit;
use App\Utils\GetUserGroup;

class CategorieController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $tasks = Categorie::all();
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' data-id='".$row->id."' data-bs-toggle='modal'><i data-lucide='plus' class='w-5 h-5'>Voir</i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/categories/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i data-lucide='trash' class='w-5 h-5'>Modif</i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/categories/destroy/".$row->id."'><i data-lucide='trash' class='w-5 h-5'>Suppr</i></a>";

                return $updateButton." ".$deleteButton."".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $privation = GetUserGroup::getUserGroup();
        return view('categorie.categorie',['privation'=>$privation]);

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categorie()
    {
        $privation = GetUserGroup::getUserGroup();
        $list_cats = DB::select("SELECT * FROM categories");
        return view('categorie.categorie',compact($list_cats, $privation));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cat_name' => ['required','unique:categories'],
            'cat_stat' => ['required'],
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('categories')
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($request);
        $cat = DB::table('categories')->insert(
            ['cat_name' =>$request->cat_name,
            'cat_stat' =>$request->cat_stat,]
        );
        //return $product;
        return redirect('categories')->with('success','Categorie ajoutée');
    }

    public function edit($id)
    {
        $categorie = DB::select("SELECT * FROM categories WHERE id =(".$id.")");
        
        $privation = GetUserGroup::getUserGroup();
        return view('categorie.updatecategorie',compact($categorie,$id,$privation));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cat_name' => ['required','unique:categories'],
            'cat_stat' => ['required'],
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('categories')
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($request);
        
        $categorie = Categorie::findOrFail($request->id);
        $categorie->cat_name = $request->get('cat_name');
        $categorie->cat_stat = $request->get('cat_stat');
        $categorie->save();
        //return $product;
        return redirect('categories')->with('success','categorie ajoutée');
    }


    public function destroy($id){
        $categorie = Categorie::find($id);
        $categorie->delete();
        return redirect('categories')->with('success','categorie supprimé');
    }
}
