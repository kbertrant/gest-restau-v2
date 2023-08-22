<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Utils\GetUserGroup;

class PersonnelController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $tasks = User::all();
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' data-id='".$row->id."' data-bs-toggle='modal'><i data-lucide='plus' class='w-5 h-5'>Voir</i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/personnels/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i data-lucide='trash' class='w-5 h-5'>Modif</i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/personnels/destroy/".$row->id."'><i data-lucide='trash' class='w-5 h-5'>Suppr</i></a>";

                return $updateButton." ".$deleteButton."".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $privation = GetUserGroup::getUserGroup();
        $list_grps = DB::select("SELECT * FROM groupes");
        return view('user.user',['list_grps'=>$list_grps,'privation'=>$privation]);

    }

    public function personnel()
    {
        $user = DB::select("SELECT * FROM users where id = 1");
        $id = null;
        $list_grps = DB::select("SELECT * FROM groupes");
        $privation = GetUserGroup::getUserGroup();
        $list_users = DB::select("SELECT * FROM users");
        return view('user.user',['list_users'=>$list_users,
        'user'=>$user,'id'=>$id,'privation'=> $privation,'list_grps'=>$list_grps]);
    }

    public function store(Request $request){
        //dd($request);
        $validator = Validator::make($request->all(), [
            'name' => ['required','unique:users'],
            'email' => ['required','unique:users'],
            'password' => ['required'],
            'grp_id' => ['required'],
        ]);
        //dd($request);
        if ($validator->fails()) {
            //dd($validator);
            return redirect('personnels')
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($request);
        $product = DB::table('users')->insert(
            ['name' =>$request->name,
            'email' =>$request->email,
            'poste' =>$request->poste,
            'password' =>Hash::make($request->password),
            'grp_id' =>$request->grp_id,]
        );
        //return $product;
        return redirect('personnels')->with('success','personnel ajouté');
    }

    public function edit($id)
    {

        $user = User::find($id);
        $list_grps = Groupe::all();
        $privation = GetUserGroup::getUserGroup();
        $list_users = User::all();
        return view('user.updateuser',['list_users'=>$list_users,
        'user'=>$user,'id'=>$id,'privation'=> $privation,'list_grps'=>$list_grps]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'poste' => ['required'],
            'grp_id' => ['required'],
        ]);
         //dd($request);
         if ($validator->fails()) {
            //dd($validator);
            return redirect('personnels')
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($request);
        
        $user = User::findOrFail($request->id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->poste = $request->get('poste');
        $user->password = Hash::make($request->get('password'));
        $user->grp_id = $request->get('grp_id');
        $user->save();
        //return $product;
        return redirect('personnels')->with('success','produit ajouté');
    }

    public function destroy($id){
        $produit = User::find($id);
        $produit->delete();
        return redirect('personnels')->with('success','personnel supprimé');
    }
}
