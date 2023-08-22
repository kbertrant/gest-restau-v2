<?php

namespace App\Http\Controllers;

use App\Models\Cmde;
use App\Models\Delivery;
use App\Utils\GetPayment;
use App\Utils\GetPriceProduct;
use App\Utils\GetUserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
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
            $tasks = DB::table('deliveries')->select(
                'deliveries.id as id',
                'cmd_id',
                'dev_num',
                'dev_fees',
                'dev_stat',
                'dev_address',
                'dev_ttval',
                'users.name as usr_name',
                'cl_name',
                'cl_phone'
            )
            ->join('commandes', 'commandes.id', '=', 'deliveries.cmd_id')
            ->join('clientes', 'clientes.id', '=', 'deliveries.idcl')
            ->join('users', 'users.id', '=', 'deliveries.user_id')
            ->get();
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/commandes/one/".$row->cmd_id."' data-bs-toggle='modal'><i data-lucide='plus' class='w-5 h-5'>Delivery</i></a>";
                return $showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $privation = GetUserGroup::getUserGroup();
        $list_devs = Delivery::where('dev_stat','=','Pending')->orWhere('dev_stat','=','Processing')->orderBy('id', 'desc')->get();
        return view('delivery.delivery',['list_devs'=>$list_devs,'privation'=>$privation]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dev_id' => ['required'],
            'dev_stat' => ['required'],
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('delivery')
                        ->withErrors($validator)
                        ->withInput();
        }
        dd($request);
        $user_id = Auth::user()->id;
        $pay = GetPriceProduct::Pay($request->cmd_id,$request->pay_amount,$request->pay_mode,$user_id);

        $table = Delivery::findOrFail($request->dev_id);
        $table->dev_stat = $request->dev_stat;
        $table->save();
        //return $product;
        return redirect('delivery')->with('success','Delivery complete');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dev_id' => ['required'],
            'dev_stat' => ['required'],
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('delivery')
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($request);
        
        $table = Delivery::findOrFail($request->dev_id);
        $table->dev_stat = $request->dev_stat;
        $table->save();
        if($request->dev_stat=='Delivered'){
            //take order 
            $com = Cmde::findOrFail($table->cmd_id);
            $user_id = Auth::user()->id;
            $pay = GetPriceProduct::Pay($com->id,$com->ttval,'Cash',$user_id);
        }
        
        
        //return $product;
        return redirect('delivery')->with('success','Delivery done and paid');
    }
}
