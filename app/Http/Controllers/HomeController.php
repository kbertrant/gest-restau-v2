<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Cmde;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Produit;
use App\Utils\GetUserGroup;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        if(request()->ajax()) {
            $tasks = DB::table('commandes as com')->select(
                'numero',
                'ttval',
                'cmd_stat',
                'users.name as usr_name',
                'cl_name',
                'cl_phone',
                'com.id as cmd_id',
                'cmd_delivery'
            )
            ->join('clientes', 'clientes.id', '=', 'com.cl_id')
            ->join('users', 'users.id', '=', 'com.user_id')
            ->get();

            return datatables()->of($tasks)
            ->addIndexColumn()
            ->make(true);
        }

        $nbre_cmd = Cmde::where('cmd_stat','Paid')->whereDate('created_at','=',today())->select('id as nbre_com')->count();
        $nbre_cmd_paid = Cmde::where('cmd_stat','Paid')->whereDate('created_at','=',today())->select('id as nbre_com')->count();
        //dd($nbre_commande);
        $nbre_stock = DB::select("SELECT COUNT(id) AS nbre_stock FROM produits");
        $som_commande = Cmde::where('cmd_stat','Paid')->whereDate('created_at','=',today())->sum('ttval');
        //dd($som_commande);
        $privation = GetUserGroup::getUserGroup();
        //dd($privation);
        return view('home', ['privation'=> $privation,'nbre_stock'=>$nbre_stock,
        'nbre_cmd'=>$nbre_cmd,'nbre_cmd_paid'=>$nbre_cmd_paid,'som_commande'=>$som_commande]);
    }

    public function profile()
    {
        $privation = GetUserGroup::getUserGroup();
        /** @var Application $application */
        $list_groupes = DB::select("SELECT * FROM groupes");
        $id = Auth::user()->id;
        $user = Auth::user();

        return view('user.profile', ['user'=> $user,'list_groupes'=>$list_groupes,'privation'=> $privation]);
    }

    public function update(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:12', 'min:6'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'password' => ['required','min:6'],
            'phone' => ['required','min:9', 'max:16'],
            'birth' => ['required'],
            'address' => ['required'],
            'poste' => ['required'],
            'gender' => ['required'],
            'grp_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect('profile')
                        ->withErrors($validator)
                        ->withInput();
        }

        
        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->display_password = $request->get('password');
        $user->password = Hash::make($request->get('password'));
        $user->phone = $request->get('phone');
        $user->gender = $request->get('gender');
        $user->birth = $request->get('birth');
        $user->poste = $request->get('poste');
        $user->address = $request->get('address');
        $user->grp_id = $request->get('grp_id');
        $user->save();

        return back();
    }
}
