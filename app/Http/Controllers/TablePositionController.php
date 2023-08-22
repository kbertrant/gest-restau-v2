<?php

namespace App\Http\Controllers;

use App\Models\TablePosition;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Produit;
use App\Utils\GetUserGroup;

class TablePositionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $tasks = TablePosition::all();
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' data-id='".$row->id."' data-bs-toggle='modal'><i data-lucide='plus' class='w-5 h-5'>Voir</i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/tables/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i data-lucide='trash' class='w-5 h-5'>Modif</i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/tables/destroy/".$row->id."'><i data-lucide='trash' class='w-5 h-5'>Suppr</i></a>";

                return $updateButton." ".$deleteButton."".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $privation = GetUserGroup::getUserGroup();
        return view('table.table',['privation'=>$privation]);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function table()
    {
        $privation = GetUserGroup::getUserGroup();
        $list_tables = DB::select("SELECT * FROM table_positions");
        return view('table.table',['list_tables'=>$list_tables,'privation'=> $privation]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'table_name' => ['required','unique:table_positions'],
            'table_stat' => ['required'],
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('tables')
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($request);
        $cat = DB::table('table_positions')->insert(
            ['table_name' =>$request->table_name,
            'table_stat' =>$request->table_stat,]
        );
        //return $product;
        return redirect('tables')->with('success','Table ajoutée');
    }

    public function edit($id)
    {
        $table = DB::select("SELECT * FROM table_positions WHERE id =(".$id.")");
        
        $privation = GetUserGroup::getUserGroup();
        return view('table.updatetable',[
        'table'=>$table,'id'=>$id,'privation'=> $privation]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'table_name' => ['required','unique:table_positions'],
            'table_stat' => ['required'],
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('tables')
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($request);
        
        $table = TablePosition::findOrFail($request->id);
        $table->table_name = $request->get('table_name');
        $table->table_stat = $request->get('table_stat');
        $table->save();
        //return $product;
        return redirect('tables')->with('success','table ajoutée');
    }


    public function destroy($id){
        $table = TablePosition::find($id);
        $table->delete();
        return redirect('tables')->with('success','table supprimé');
    }
}
