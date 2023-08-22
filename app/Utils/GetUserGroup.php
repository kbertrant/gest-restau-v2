<?php 

namespace App\Utils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetUserGroup
{
    static function getUserGroup(){
        
        $userId = Auth::user()->id;
        return $query_user = DB::table('users')->select('users.name','users.email','grp_id','groupes.name',
        'groupes.description','commande','produit','stock','groupe','user','etat','parametres','paiements','delivery')
        ->join('groupes','groupes.id','=','users.grp_id')
        ->where('users.id',$userId)
        ->first();
        dd($query_user);

    }
}