<?php

namespace App\Http\Controllers;

use App\Models\Cmde;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Produit;
use App\Utils\GetPayment;
use App\Utils\GetPriceProduct;
use App\Utils\GetPrintCommande;
use App\Utils\GetUserGroup;

class PaymentController extends Controller
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
            $tasks = DB::table('payments')->select(
                'pay_num',
                'numero',
                'pay_amount',
                'pay_mode',
                'pay_stat',
                'users.name as usr_name',
                'cl_name',
                'cl_phone',
                'payments.id',
            )
            ->join('commandes', 'commandes.id', '=', 'payments.cmd_id')
            ->join('clientes', 'clientes.id', '=', 'payments.idcl')
            ->join('users', 'users.id', '=', 'payments.user_id')
            ->get();
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/payments/one/".$row->id."' data-bs-toggle='modal'><i data-lucide='plus' class='w-5 h-5'>Voir</i></a>";
                return $showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $privation = GetUserGroup::getUserGroup();
        $list_coms = Cmde::where('cmd_stat','=','Pending')->orderBy('created_at','desc')->get();
        return view('payment.payment',['list_coms'=>$list_coms,'privation'=>$privation]);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cmd_id' => ['required'],
            'pay_amount' => ['required'],
            'pay_mode' => ['required']
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('payments')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $user_id = Auth::user()->id;
        $cmd = Cmde::find($request->cmd_id);
        //check if pay amount is under cmd value
        if($cmd->ttval > $request->pay_amount){return redirect()->back()->with('success','Montant inferieur a la commande');}

        
        $pay = GetPriceProduct::Pay($request->cmd_id,$request->pay_amount,$request->pay_mode,$user_id);
        
        //return $product;
        return redirect('payments')->with('success','Paiement effectué !');
    }

    public function onePayment($id)
    {
        //dd($id);
        $pay = Payment::findOrFail($id);
        $cmd = Cmde::findOrFail($pay->cmd_id);
        $print_coms = GetPrintCommande::getPrintCommande($cmd->id,$cmd->cmd_delivery);
        
        $print_details = GetPrintCommande::getPrintDetail($cmd->id);
        $privation = GetUserGroup::getUserGroup();
        $payments = Payment::where('cmd_id',$cmd->id)->get();
        
        //return $product;
        return view('payment.detailpay',['print_coms'=>$print_coms,
        'print_details'=>$print_details,'privation'=> $privation,'payments'=>$payments]);
    }
}
