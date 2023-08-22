<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hisune\EchartsPHP\ECharts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Client;
use App\Models\Cmde;
use App\Models\Commande;
use App\Utils\GetPrintCommande;
use App\Utils\GetUserGroup;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;

class EtatController extends Controller
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
    public function etat()
    {
        $nbres_commandes = array();
        $soms_commandes = array();
        $list_serveurs = User::where('poste','=','serveur');
        $i=0;
        //$chart = new ECharts();

        foreach($list_serveurs as $list_serveur){
            $i++;
            $nbre_commandes = DB::select("SELECT COUNT(id) AS nbre_com FROM commandes WHERE user_id = ".$list_serveur->id."");
            $som_commandes = DB::select("SELECT SUM(ttval) AS sum_com  FROM commandes WHERE user_id = ".$list_serveur->id."");
            array_push($nbres_commandes,$nbre_commandes[0]->nbre_com);
            array_push($soms_commandes,$som_commandes[0]->sum_com);
        }
        $n = $i;
        
        
        $list_coms = DB::select("SELECT clientes.*, users.*, commandes.*
        FROM commandes 
        INNER JOIN clientes ON clientes.id = commandes.cl_id
        INNER JOIN users ON users.id = commandes.user_id
        WHERE commandes.user_id =".Auth::user()->id."");
        $nbre_commande = DB::select("SELECT COUNT(id) AS nbre_com FROM commandes WHERE user_id = ".Auth::user()->id."");
        $nbre_stock = DB::select("SELECT COUNT(id) AS nbre_stock FROM produits");
        $som_commande = DB::select("SELECT SUM(ttval) AS sum_com  FROM commandes WHERE user_id = ".Auth::user()->id."");
        $privation = GetUserGroup::getUserGroup();
        //dd($i);
        return view('etat.etat', ['privation'=> $privation,'nbre_stock'=>$nbre_stock,
        'nbres_commandes'=>$nbres_commandes,'soms_commandes'=>$soms_commandes,
        'list_coms'=>$list_coms,'list_serveurs'=>$list_serveurs,'i'=>$i,'n'=>$n]);
    }

    public function research(Request $request)
    {
        if(request()->ajax()) {
            $tasks = Cmde::where('cmd_stat','Paid')
            ->join('clientes', 'clientes.id', '=', 'commandes.cl_id')
            ->join('users', 'users.id', '=', 'commandes.user_id')
            ->whereDate('commandes.created_at','=',today())
            ->select('commandes.id as id','cmd_stat','numero','cmd_delivery','ttval','cl_name','name','commandes.created_at as created_at')->get();
            //var_dump($tasks);
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/commandes/one/".$row->id."' data-bs-toggle='modal'><i data-lucide='plus' class='w-5 h-5'>Voir</i></a>";
                return $showButton;
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        
        return view('etat.etat');

    }

    public function generateDailyOrderPDF(){
        //$cmds = Cmde::whereDate('created_at','=',today())->get();
        $cmds = DB::table('commandes as com')->select(
            'numero',
            'ttval',
            'cmd_stat',
            'users.name as usr_name',
            'cl_name',
            'com.id as cmd_id',
            'cmd_delivery',
            'com.created_at as cmd_date',
        )
        ->join('clientes', 'clientes.id', '=', 'com.cl_id')
        ->join('users', 'users.id', '=', 'com.user_id')
        ->whereDate('com.created_at','=',today())
        ->get();
        //dd($cmd);
        
        $som = Cmde::where('cmd_stat','Paid')
        ->whereDate('created_at','=',today())
        ->sum('ttval');
        
        $count = Cmde::where('cmd_stat','Paid')
        ->whereDate('created_at','=',today())
        ->select('id as nbre_com')->count();
        
        $date_today = today();
        //dd($print_coms,$print_details);
        //$pdf = FacadePdf::setOption(['pdflibLicense' => "La Marmite Dorée LTD", 'defaultFont' => 'Ayuthaya']);
        $pdf = FacadePdf::loadView('etat.daily', [
            'cmds' => $cmds,
            'date_today'=>$date_today,
            'som'=>$som,
            'count'=>$count
        ])->setOption(['pdflibLicense' => "La Marmite Dorée LTD", 'defaultFont' => 'Ayuthaya','isPhpEnabled' => true]);

        
        return $pdf->download('orders_'.today().'.pdf');
    }

}
