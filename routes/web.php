<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EtatController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\TablePositionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LangController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('lang/home', [LangController::class, 'index']);
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/list', [HomeController::class, 'index'])->name('home.list');

Route::get('/profile',  [HomeController::class, 'profile'])->name('profile');
//Route::get('/logout',  [LoginControllerController::class, 'logout'])->name('logout');
Route::get('/updateprofile',  [HomeController::class, 'update'])->name('updateprofile');
//Route::resource('produit', 'ProduitController

Route::get('/increment', [ProduitController::class,'increment'])->name('increment');
Route::get('/increment/list', [ProduitController::class,'increment'])->name('increment.list');
Route::post('/updatestock', [ProduitController::class,'updatestock'])->name('updatestock');


Route::get('/groupe', [GroupeController::class,'groupe'])->name('groupe');
Route::post('/savegroupe', [GroupeController::class,'savegroupe'])->name('savegroupe');
Route::post('/updategroupe/{id}', [GroupeController::class,'updategroupe'])->name('updategroupe');
Route::post('/saveupdategroupe', [GroupeController::class,'saveupdategroupe'])->name('saveupdategroupe');
Route::get('/updategroupe/{id}', [GroupeController::class,'updategroupe'])->name('updategroupe');
Route::get('/deletegroupe/{id}', [GroupeController::class,'delete_groupe'])->name('deletegroupe');

Route::get('/personnel', [PersonnelController::class,'personnel'])->name('personnel');
Route::post('/saveuser', [PersonnelController::class,'saveuser'])->name('saveuser');
Route::post('/saveupdateuser', [PersonnelController::class,'saveupdateuser'])->name('saveupdateuser');
Route::post('/updateuser/{id}', [PersonnelController::class,'updateuser'])->name('postupdateuser');
Route::get('/updateuser/{id}', [PersonnelController::class,'updateuser'])->name('updateuser');
Route::get('/deleteuser/{id}', [PersonnelController::class,'delete_personnel'])->name('deleteuser');

Route::get('/payments', [PaymentController::class,'index'])->name('payments.main');
Route::get('/payments/list', [PaymentController::class, 'index'])->name('payments.list');
Route::post('/payments/store', [PaymentController::class,'store'])->name('payments.store');
Route::get('/payments/edit/{id}', [PaymentController::class,'edit'])->name('payments.edit');
Route::post('/payments/update/',[PaymentController::class,'update'])->name('payments.update');
Route::get('/payments/destroy/{id}', [PaymentController::class,'destroy'])->name('payments.destroy');
Route::get('/payments/pay/{id}', [PaymentController::class,'pay'])->name('payments.pay');
Route::get('/payments/one/{id}', [PaymentController::class,'onePayment'])->name('payments.one');

Route::post('tables/store',[TablePositionController::class,'store'])->name('tables.store');
Route::post('/tables/update/',[TablePositionController::class,'update'])->name('tables.update');
Route::get('/tables', [TablePositionController::class, 'index'])->name('tables.main');
Route::get('/tables/list', [TablePositionController::class, 'index'])->name('tables.list');
Route::get('/tables/show/{id}',[TablePositionController::class,'show'])->name('tables.show');
Route::get('/tables/edit/{id}',[TablePositionController::class,'edit'])->name('tables.edit');
Route::get('/tables/destroy/{id}',[TablePositionController::class,'destroy'])->name('tables.destroy');

Route::post('categories/store',[CategorieController::class,'store'])->name('categories.store');
Route::post('/categories/update/',[CategorieController::class,'update'])->name('categories.update');
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.main');
Route::get('/categories/list', [CategorieController::class, 'index'])->name('categories.list');
Route::get('/categories/show/{id}',[CategorieController::class,'show'])->name('categories.show');
Route::get('/categories/edit/{id}',[CategorieController::class,'edit'])->name('categories.edit');
Route::get('/categories/destroy/{id}',[CategorieController::class,'destroy'])->name('categories.destroy');

Route::post('produits/store',[ProduitController::class,'store'])->name('produits.store');
Route::post('/produits/update/',[ProduitController::class,'update'])->name('produits.update');
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.main');
Route::get('/produits/list', [ProduitController::class, 'index'])->name('produits.list');
Route::get('/produits/show/{id}',[ProduitController::class,'show'])->name('produits.show');
Route::get('/produits/edit/{id}',[ProduitController::class,'edit'])->name('produits.edit');
Route::get('/produits/destroy/{id}',[ProduitController::class,'destroy'])->name('produits.destroy');

Route::post('personnels/store',[PersonnelController::class,'store'])->name('personnels.store');
Route::post('/personnels/update/',[PersonnelController::class,'update'])->name('personnels.update');
Route::get('/personnels', [PersonnelController::class, 'index'])->name('personnels.main');
Route::get('/personnels/list', [PersonnelController::class, 'index'])->name('personnels.list');
Route::get('/personnels/show/{id}',[PersonnelController::class,'show'])->name('personnels.show');
Route::get('/personnels/edit/{id}',[PersonnelController::class,'edit'])->name('personnels.edit');
Route::get('/personnels/destroy/{id}',[PersonnelController::class,'destroy'])->name('personnels.destroy');

Route::post('groupes/store',[GroupeController::class,'store'])->name('groupes.store');
Route::post('/groupes/update/',[GroupeController::class,'update'])->name('groupes.update');
Route::get('/groupes', [GroupeController::class, 'index'])->name('groupes.main');
Route::get('/groupes/list', [GroupeController::class, 'index'])->name('groupes.list');
Route::get('/groupes/show/{id}',[GroupeController::class,'show'])->name('groupes.show');
Route::get('/groupes/edit/{id}',[GroupeController::class,'edit'])->name('groupes.edit');
Route::get('/groupes/destroy/{id}',[GroupeController::class,'destroy'])->name('groupes.destroy');

Route::get('/commandes/list',  [CommandeController::class, 'index'])->name('commandes.list');
Route::get('/commandes',  [CommandeController::class, 'index'])->name('commandes.main');
Route::get('/generate/commande/{id}', [CommandeController::class, 'generatePDF'])->name('commandes.generate');
Route::post('/commandes/store', [CommandeController::class,'store'])->name('commandes.store');
Route::get('/commandes/edit/{id}', [CommandeController::class,'edit'])->name('commandes.edit');
Route::get('/commandes/one/{id}', [CommandeController::class,'one'])->name('commandes.one');
Route::post('/getproductprice/{id}', [CommandeController::class,'getproductprice'])->name('getproductprice');
Route::get('/getproductprice/{id}', [CommandeController::class,'getproductprice'])->name('getproductprice');
Route::get('/commandes/destroy/{id}', [CommandeController::class,'destroy'])->name('commandes.destroy');
Route::post('/commande/update', [CommandeController::class,'update'])->name('commandes.update');

Route::get('/delivery', [DeliveryController::class,'index'])->name('delivery.main');
Route::get('/delivery/list', [DeliveryController::class, 'index'])->name('delivery.list');
Route::post('/delivery/update/',[DeliveryController::class,'update'])->name('delivery.update');
Route::post('/delivery/pay/',[DeliveryController::class,'pay'])->name('delivery.pay');

Route::get('/etat', [EtatController::class,'etat'])->name('etat');
Route::get('/generate/daily', [EtatController::class,'generateDailyOrderPDF'])->name('etat.daily');
Route::get('/etat/research', [EtatController::class,'research'])->name('research');
Route::post('/send/research', [EtatController::class,'research'])->name('send.research');
