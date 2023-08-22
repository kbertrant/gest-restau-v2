<?php 

namespace App\Utils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetPrintCommande
{
    static function getPrintCommande($id_com,$delivery){
        if($delivery=='Y'){
            $query = DB::table('commandes')->select('commandes.id as idcmd','commandes.*','clientes.*','deliveries.*')
            ->join('clientes','commandes.cl_id','=','clientes.id')
            ->join('deliveries','commandes.id','=','deliveries.cmd_id')
            ->where('commandes.id',$id_com)
            ->first();
        }else{
            $query = DB::table('commandes')->select('commandes.id as idcmd','commandes.*','clientes.*')
            ->join('clientes','commandes.cl_id','=','clientes.id')
            ->where('commandes.id',$id_com)
            ->first();
        }
        //dd($query);
        return $query;
    }

    static function getPrintDetail($id_com){
        $q = DB::table('detailcommandes')->select('detailcommandes.*','produits.*')
        ->join('produits','detailcommandes.prod_id','=','produits.id')
        ->where('com_id',$id_com)
        ->get();

        return $q;
    }
}