<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Cmde;
use App\Models\Delivery;
use App\Models\DetailCommande;
use App\Models\Produit;
use App\Models\TablePosition;
use App\Utils\GetPriceProduct;
use App\Utils\GetPrintCommande;
use App\Utils\GetUserGroup;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class CommandeController extends Controller
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

    public function index(){

        if(request()->ajax()) {
            $tasks = DB::table('commandes')->select(
                'numero',
                'ttval',
                'cmd_stat',
                'users.name as usr_name',
                'cl_name',
                'cmd_stat',
                'cl_phone',
                'commandes.id as id',
                'cmd_delivery'
            )
            ->join('clientes', 'clientes.id', '=', 'commandes.cl_id')
            ->join('users', 'users.id', '=', 'commandes.user_id')
            ->get();

            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/commandes/one/".$row->id."' data-bs-toggle='modal'><i data-lucide='plus' class='w-5 h-5'>Voir</i></a>";
                // Update Button
                //$updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/commandes/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i data-lucide='trash' class='w-5 h-5'>Modif</i></a>";
                // Delete Button
                //$deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/commandes/destroy/".$row->id."'><i data-lucide='trash' class='w-5 h-5'>Suppr</i></a>";

                return //$updateButton." ".$deleteButton."".
                $showButton;
                 
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        $privation = GetUserGroup::getUserGroup();
        $list_entrees = Produit::where('cat_id',1)->where('prod_qte','>',0)->get();
        $list_plats_principals = Produit::where('cat_id',2)->where('prod_qte','>',0)->get();
        $list_desserts = Produit::where('cat_id',3)->where('prod_qte','>',0)->get();
        $list_boissons = Produit::where('cat_id',4)->where('prod_qte','>',0)->get();

        $list_produits = Produit::all();
        $list_tables = TablePosition::all();
        
        return view('commande.commande',['list_produits'=>$list_produits,
        'list_entrees'=>$list_entrees,
        'list_plats_principals'=>$list_plats_principals,
        'list_desserts'=>$list_desserts,
        'list_boissons'=>$list_boissons,
        'list_tables'=>$list_tables,
        'privation'=>$privation]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function commande()
    {
    
        //var_dump($commande);
        $privation = GetUserGroup::getUserGroup();
        $list_entrees = DB::select('SELECT * FROM produits WHERE cat_id = 1 AND NOT prod_qte = 0');
        $list_plats_principals = DB::select('SELECT * FROM produits WHERE cat_id = 2 AND NOT prod_qte = 0');
        $list_desserts = DB::select('SELECT * FROM produits WHERE cat_id = 4 AND NOT prod_qte = 0');
        $list_boissons = DB::select('SELECT * FROM produits WHERE cat_id = 3 AND NOT prod_qte = 0');

        $list_produits = DB::select("SELECT * FROM produits WHERE NOT prod_qte = 0");
        $list_tables = DB::select("SELECT * FROM table_positions ");
        $list_commandes = DB::select("SELECT * FROM commandes WHERE user_id = ".Auth::user()->id ." ORDER BY updated_at DESC");
        return view('commande.commande',['list_produits'=>$list_produits,'list_entrees'=>$list_entrees,'list_plats_principals'=>$list_plats_principals,
        'list_desserts'=>$list_desserts,'list_boissons'=>$list_boissons,'list_tables'=>$list_tables,
        'list_commandes'=>$list_commandes,'privation'=> $privation]);
    }

    public function edit($id)
    {
        //dd($id);
        $cmd = Cmde::findOrFail($id);
        $details = array();
        $commande = GetPrintCommande::getPrintCommande($id,$cmd->cmd_delivery);
        $details = GetPrintCommande::getPrintDetail($id);
        $n = sizeof($details);
        
        $privation = GetUserGroup::getUserGroup();
        $list_produits = Produit::all();
        $list_commandes = DB::select("SELECT * FROM commandes WHERE user_id = ".Auth::user()->id." ORDER BY updated_at DESC");
        //dd($details,$commande);
        $list_tables = TablePosition::all();
        return view('commande.detailcmd',['list_produits'=>$list_produits,
        'commande'=>$commande,
        'list_tables'=>$list_tables,
        'details'=>$details,
        'list_commandes'=>$list_commandes,
        'privation'=> $privation,'n'=>$n,'id'=>$id]);
    }

    public function store(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'cl_name' => ['required'],
            'cl_phone' => ['required'],
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('commandes')
                        ->withErrors($validator)
                        ->withInput();
        }
        
         $client = new Cliente(
            ['cl_name' =>$request->cl_name,
            'cl_phone' =>$request->cl_phone,
            'user_id' =>Auth::user()->id,
            'updated_at' =>NOW(),
            'created_at' =>NOW()]);
        $client->save();

        $num1 = 'ORD'.NOW();
        $num2 = str_replace( '-', '', $num1);
        $num3 = str_replace( ':', '', $num2);
        $num_pack = str_replace( ' ', '', $num3);

        $commande = new Cmde();
        $commande->user_id =Auth::user()->id;
        $commande->cl_id = $client->id;
        if($request->delivery == 'N'){$commande->table_id = $request->table_id;}
        $commande->numero = $num_pack;
        $commande->cmd_stat = "Pending";
        $commande->site_id = 1;
        $commande->value_remise=0;
        $commande->remise= 0;
        $commande->ttval = 0;
        $commande->cmd_delivery = $request->delivery;
        $commande->created_at = NOW();
        $commande->updated_at = NOW();
        $commande->save(); 
        //dd($request);
        $somme = array();
        $s = 0;
        //dd($commande);
        foreach ($request->prod_id as $p) {
            $i = $s++;
            if($p!=null){
                GetPriceProduct::decrementQteProduct($request->quantite[$i],$p);
                $detail = DB::table('detailcommandes')->insert(
                    ['quantite' =>$request->quantite[$i],
                    'prod_id' =>$p,
                    'com_id' =>$commande->id,
                    'created_at' =>NOW(),
                    'updated_at' =>NOW()]
                );
                $prix_unit = GetPriceProduct::getPriceProduct($p);
                array_push($somme, $prix_unit * $request->quantite[$i]);
            }
        }
        //récuperer la commande et inserer le montant total
        $up_command = Cmde::findOrFail($commande->id);
        $up_command->ttval = array_sum($somme);
        $up_command->save();
        if($commande->cmd_delivery == 'Y'){
            $deliv = new Delivery();
            $deliv->dev_num = $num_pack;
            $deliv->dev_fees = $request->fees;
            $deliv->dev_stat = 'Pending';
            $deliv->dev_address = $request->dev_address;
            $deliv->packaging = $request->packaging;
            $deliv->dev_ttval = $request->fees + $request->packaging + $up_command->ttval;
            $deliv->idcl = $up_command->cl_id;
            $deliv->cmd_id = $up_command->id;
            $deliv->user_id = $up_command->user_id;
            $deliv->site_id = 1;
            $deliv->save();
        }
        // récuperer de la commande et les details pour l'impression
        $print_coms = GetPrintCommande::getPrintCommande($commande->id,$commande->cmd_delivery);
        $print_details = GetPrintCommande::getPrintDetail($commande->id);
        
        $privation = GetUserGroup::getUserGroup();
        $list_tables = TablePosition::all();

        return view('commande.printcommande',['print_coms'=>$print_coms,
        'list_tables'=>$list_tables,
        'print_details'=>$print_details,
        'privation'=>$privation]);
    }

    public function generatePDF( $id){
        $cmd = Cmde::findOrFail($id);
        //dd($cmd);
        //if($cmd){return redirect()->back();}
        
        $print_coms = GetPrintCommande::getPrintCommande($id,$cmd->cmd_delivery);
        $print_details = GetPrintCommande::getPrintDetail($id);
        //dd($print_coms,$print_details);
        $pdf = PDF::loadView('commande.cmdpdf', [
            'print_coms' => $print_coms,
            'print_details' => $print_details
        ])->setPaper('a6')->setOption(['dpi' => 150,'isRemoteEnabled' => true,'defaultFont' => 'Ayuthaya','isPhpEnabled' => true]);
        
        return $pdf->download('order_'.$print_coms->numero.'.pdf');
        //dd($pdf->download('order_'.$print_coms->numero.'.pdf'));
        //return redirect()->route('commandes.main');
    }


    public function destroy($id){
        $comm = Cmde::find($id);
        $comm->delete();
        return redirect('commandes')->with('success','order deleted');
    }


    public function update(Request $request)
    {
        
        //dd($request);
        //update client infos
        $comm = Cmde::find($request->id);
        DB::table('clients')->where('id',$comm->cl_id)->update(array('cl_name'=>$request->cl_name,
        'user_id'=>Auth::user()->id,
        'cl_address' =>$request->cl_address,
        'cl_phone' =>$request->cl_phone,
        'updated_at'=>NOW()));

        // delete all product where equal to command id
        DB::table('detailcommandes')->where('com_id',$request->id)->delete();

        $somme = array();
        $s = 0;
        //dd($commande);
        foreach ($request->prod_id as $p) {
            $i = $s++;
            GetPriceProduct::decrementQteProduct($request->quantite[$i],$p);
            $detail = DB::table('detailcommandes')->insert(
                ['quantite' =>$request->quantite[$i],
                'prod_id' =>$p,
                'com_id' =>$request->id,
                'created_at' =>NOW(),
                'updated_at' =>NOW()]
            );
            $prix_unit = GetPriceProduct::getPriceProduct($p);
            array_push($somme, $prix_unit*$request->quantite[$i]);
        }
        //récuperer la commande et inserer le montant total
        
        $comm->prix_total = array_sum($somme);
        $comm->save();

        $print_coms = GetPrintCommande::getPrintCommande($request->id,$comm->cmd_delivery);
        
        $print_details = GetPrintCommande::getPrintDetail($request->id);
        $privation = GetUserGroup::getUserGroup();

        $list_tables = DB::select("SELECT * FROM table_positions ");
        //return $product;
        return view('commande.printcommande',['print_coms'=>$print_coms,'list_tables'=>$list_tables,
        'print_details'=>$print_details,'privation'=>$privation]);
    }

    
    public function one($id)
    {
        //dd($id);
        $cmd = Cmde::findOrFail($id);
        $details = array();
        $print_coms = GetPrintCommande::getPrintCommande($id,$cmd->cmd_delivery);
        
        $print_details = GetPrintCommande::getPrintDetail($id);
        $privation = GetUserGroup::getUserGroup();

        //return $product;
        return view('commande.detailcmd',['print_coms'=>$print_coms,
        'print_details'=>$print_details,'privation'=>$privation]);
    }
}
