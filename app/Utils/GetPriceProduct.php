<?php 

namespace App\Utils;

use App\Models\Produit;
use App\Models\Cmde;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetPriceProduct
{
    static function getPriceProduct($id_prod){
        $query_user = Produit::find($id_prod);
        return $query_user->prix_unit;
    }

    static function decrementQteProduct($qte,$id_prod){
        $product = Produit::find($id_prod);
        //dd($product);
        $product->prod_qte = ($product->prod_qte - $qte);
        $product->save();
    }

    static function Pay($cmd_id,$pay_amount,$pay_mode,$user_id){
        
        $num1 = 'PAY'.NOW();
        $num2 = str_replace( '-', '', $num1);
        $num3 = str_replace( ':', '', $num2);
        $num_pack = str_replace( ' ', '', $num3);

        $cmd = Cmde::find($cmd_id);
        
        if($cmd->ttval <= $pay_amount){
            $product = DB::table('payments')->insert(
                ['pay_num' =>$num_pack,
                'pay_amount' =>$pay_amount,
                'pay_mode' =>$pay_mode,
                'pay_reste' =>0,
                'pay_stat' =>'Paid',
                'cmd_id' =>$cmd->id,
                'site_id' =>1,
                'user_id' => $user_id,
                'idcl' =>$cmd->cl_id,
                'updated_at'=>NOW(),
                'created_at'=>NOW()]
            );
            $cmd->cmd_stat = 'Paid';
            $cmd->save();
        }
        return $product;
    }
}