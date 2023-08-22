<?php 

namespace App\Utils;

use App\Models\Cmde;
use App\Models\Payment;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetPayment
{
    
    static function Pay($cmd_id,$pay_amount,$pay_mode,$user_id){
        
        $num1 = 'FAC_'.NOW();
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