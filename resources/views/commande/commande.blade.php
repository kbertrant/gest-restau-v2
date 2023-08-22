@extends('main')

@section('title', ' - Commandes')
@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-10">
            @if (session('success'))
                <div class="alert alert-danger" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="container d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    {{ __('mypage.myNewCommande') }}
                </button>
            </div>
            <br>
            <h2>{{ __('mypage.mylistCommandes') }}</h2>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="cmdtable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NUMBER</th>
                            <th>STATUS</th>
                            <th>CLIENT</th>
                            <th>CLIENT PHONE</th>
                            <th>AMOUNT</th>
                            <th>SERVER</th>
                            <th>DELIVERY</th>
                            <th>Action</th>
                          </tr>
                    </thead>
                </table>
            </div>
        </div>  
    </div>
</div>
<!-- Button trigger modal -->  
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalXLLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('mypage.myNewCommande') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="register-form" action="{{route('commandes.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="text" name="cl_name" id="cl_name" placeholder="Client"
                       class="form-control shadow"  required />
                    <br/>
                    <input type="text" name="cl_phone" id="cl_phone" placeholder="Phone client"
                            class="form-control shadow"  required />
                    <br/>
                    
                    <br/>
                    <select name="delivery" id="delivery" class="form-control qte shadow" required>
                        <option value=""> Delivery or On table</option>
                        <option value="N">NO on table</option>
                        <option value="Y">YES Delivery</option>
                    </select>
                    <br/>
                    <div class="row">
                        <div class="field_delivery" style="width: 100%;"><div class="in_delivery">
                    </div>
                </div>
            </div>
                    <br>
                    <fieldset class="scheduler-border">
                            <legend class="scheduler-border">{{ __('mypage.myboissons') }}</legend>
                        <div class="row">
                                
                                <div class="col-lg-6 col-md-6 col-xs-6">
                                    <select id="prod_id[]" name="prod_id[]" class="form-control prod shadow">
                                        <option value="">{{ __('mypage.myChoice') }}</option>
                                        @foreach ($list_entrees as $list_entree)
                                            <option value="{{ $list_entree->id }}">{{ $list_entree->prod_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <select name="quantite[]" id="quantite[]" class="form-control qte shadow">
                                        <option value="">Qty</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                
                                <div class="col-lg-2 col-md-2 col-xs-2">
                                    <a href="javascript:void(0);" class="add_buttonEN" title="Ajouter">
                                    <img src="{{ asset('img/add-icon.png') }}"/></a>
                                </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="field_wrapperEN" style="width: 100%;"><div>
                        </div>
                        </div>
                        </div>
                    </fieldset>
                    <br/>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">{{ __('mypage.myMenu') }}</legend>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-6">
                                <select id="prod_id[]" name="prod_id[]" class="form-control prod shadow">
                                    <option value="">{{ __('mypage.myChoice') }}</option>
                                    @foreach ($list_plats_principals as $list_plats_principal)
                                        <option value="{{ $list_plats_principal->id }}">{{ $list_plats_principal->prod_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <select name="quantite[]" id="quantite[]" class="form-control qte shadow">
                                    <option value="">Qty</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            
                            <div class="col-lg-2 col-md-2 col-xs-2">
                                <a href="javascript:void(0);" class="add_buttonPP" title="Ajouter">
                                <img src="{{ asset('img/add-icon.png') }}"/></a>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="field_wrapperPP" style="width: 100%;"><div>
                        </div>
                        </div>
                        </div>
                    </fieldset>
                    <br/>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">{{ __('mypage.myDessert') }}</legend>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-6">
                                <select id="prod_id[]" name="prod_id[]" class="form-control prod shadow">
                                    <option value="">{{ __('mypage.myChoice') }}</option>
                                    @foreach ($list_desserts as $list_dessert)
                                        <option value="{{ $list_dessert->id }}">{{ $list_dessert->prod_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <select name="quantite[]" id="quantite[]" class="form-control qte shadow">
                                    <option value="">Qty</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            
                            <div class="col-lg-2 col-md-2 col-xs-2">
                                <a href="javascript:void(0);" class="add_buttonDS" title="Ajouter">
                                <img src="{{ asset('img/add-icon.png') }}"/></a>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="field_wrapperDS" style="width: 100%;"><div>
                        </div>
                        </div>
                        </div>
                    </fieldset>
                    <br/>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">{{ __('mypage.mySalade') }}</legend>
                        <div class="row">
                            
                            <div class="col-lg-6 col-md-6 col-xs-6">
                                <select id="prod_id[]" name="prod_id[]" class="form-control prod shadow">
                                    <option value="">{{ __('mypage.myChoice') }}</option>
                                    @foreach ($list_boissons as $list_boisson)
                                        <option value="{{ $list_boisson->id }}">{{ $list_boisson->prod_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <select name="quantite[]" id="quantite[]" class="form-control qte shadow">
                                    <option value="">Qty</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            
                            <div class="col-lg-2 col-md-2 col-xs-2">
                                <a href="javascript:void(0);" class="add_buttonBO" title="Ajouter">
                                <img src="{{ asset('img/add-icon.png') }}"/></a>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="field_wrapperBO" style="width: 100%;"><div>
                        </div>
                    </div>
                </div>
                </fieldset>
                    <br/>
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('mypage.myclose') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('mypage.mySave') }}</button>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection
<script type="text/javascript">
    window.onload = function(){
         $(document).ready(function(){
                $('#cmdtable').DataTable({
                serverSide: true,
                ajax: '{{ route('commandes.list') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'numero', name: 'numero' },
                    { data: 'cmd_stat', name: 'cmd_stat' },
                    { data: 'cl_name', name: 'cl_name' },
                    { data: 'cl_phone', name: 'cl_phone' },
                    { data: 'ttval', name: 'ttval' },
                    { data: 'usr_name', name: 'usr_name' },
                    { data: 'cmd_delivery', name: 'cmd_delivery' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
            });
        });

    $(document).ready(function(){

        var contentDeliver = $('.field_delivery'); //Input field wrapper
        var deliveryHTML = '<div class="row" style="margin:5px"><div class=" col-lg-3 col-md-6 col-xs-12"><input type="text" name="fees" id="fees" placeholder="Delivery fees" class="form-control shadow" /></div><div class=" col-lg-3 col-md-6 col-xs-12"><input type="text" name="packaging" id="packaging" placeholder="Packaging fees" class="form-control shadow" /></div><div class=" col-lg-6 col-md-6 col-xs-12"><input type="text" name="dev_address" id="dev_address" placeholder="Delivery address" class="form-control shadow" /></div></div>';
        var tableset = '<div class="row" style="margin:5px"><select name="table_id" id="table_id" class="form-control qte shadow" required>'+
                        '<option value="">{{ __('mypage.myChoice') }}</option>'+
                        '@foreach ($list_tables as $list_table)'+
                            '<option value="{{ $list_table->id }}">{{ $list_table->table_name }}</option>'+
                        '@endforeach'+
                    '</select></div>';
        //check if order need delivery
        $('#delivery').change(function(){
            var deliverValue = $('#delivery').find(":selected").val();
            console.log(deliverValue);
            if(deliverValue=='Y'){
                $(contentDeliver).children('div').remove();
                $(contentDeliver).append(deliveryHTML);
            }else if(deliverValue=='N'){
                $(contentDeliver).children('div').remove();
                $(contentDeliver).append(tableset);
            }
        });
    });
    
        //add for entrées
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_buttonEN'); //Add button selector
        var wrapper = $('.field_wrapperEN'); //Input field wrapper
        var fieldHTML = '<div class="row" style="margin:5px;style="width: 100%;""><div class=" col-lg-6 col-md-6 col-xs-6 field"><select class="prod form-control shadow" id="prod_id[]" name="prod_id[]"> @foreach ($list_entrees as $list_entree) <option value="{{ $list_entree->id }}">{{ $list_entree->prod_name }}</option> @endforeach</select></div><div class="col-lg-3 col-md-3 col-xs-3 field"><select name="quantite[]" id="quantite[]" class="form-control qte shadow"><option value="">Quantité</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div> <a href="javascript:void(0);" class="remove_buttonEN"><img src="{{ asset('img/remove-icon.png') }}"/></a></div>';

        var x = 1; //Initial field counter is 1
        
        var change_prod = $('.prod');
        var change_prix = $('.pri_total');
        var change_qte = $('.qte'); 
        
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_buttonEN', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    // for add plat principal
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_buttonPP'); //Add button selector
        var wrapper = $('.field_wrapperPP'); //Input field wrapper
        var fieldHTML = '<div class="row" style="margin:5px"><div class=" col-lg-6 col-md-6 col-xs-6 field"><select class="prod form-control shadow" id="prod_id[]" name="prod_id[]"> @foreach ($list_plats_principals as $list_plats_principal) <option value="{{ $list_plats_principal->id }}">{{ $list_plats_principal->prod_name }}</option> @endforeach</select></div><div class="col-lg-3 col-md-3 col-xs-3 field"><select name="quantite[]" id="quantite[]" class="form-control qte shadow"><option value="">Quantité</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>   <a href="javascript:void(0);" class="remove_buttonPP"><img src="{{ asset('img/remove-icon.png') }}"/></a></div>';

        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_buttonPP', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    // for add dessert to order
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_buttonDS'); //Add button selector
        var wrapper = $('.field_wrapperDS'); //Input field wrapper
        var fieldHTML = '<div class="row" style="margin:5px"><div class=" col-lg-6 col-md-6 col-xs-6 field"><select class="prod form-control shadow" id="prod_id[]" name="prod_id[]"> @foreach ($list_desserts as $list_dessert) <option value="{{ $list_dessert->id }}">{{ $list_dessert->prod_name }}</option> @endforeach</select></div><div class="col-lg-3 col-md-3 col-xs-3 field"><select name="quantite[]" id="quantite[]" class="form-control qte shadow"><option value="">Quantité</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>  <a href="javascript:void(0);" class="remove_buttonDS"><img src="{{ asset('img/remove-icon.png') }}"/></a></div>';

        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_buttonDS', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });


    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_buttonBO'); //Add button selector
        var wrapper = $('.field_wrapperBO'); //Input field wrapper
        
        var fieldHTML = '<div class="row" style="margin:5px"><div class=" col-lg-6 col-md-6 col-xs-6 field"><select class="prod form-control shadow" id="prod_id[]" name="prod_id[]"> @foreach ($list_boissons as $list_boisson) <option value="{{ $list_boisson->id }}">{{ $list_boisson->prod_name }}</option> @endforeach</select></div><div class="col-lg-3 col-md-3 col-xs-3 field"><select name="quantite[]" id="quantite[]" class="form-control qte shadow"><option value="">Quantité</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>  <a href="javascript:void(0);" class="remove_buttonBO"><img src="{{ asset('img/remove-icon.png') }}"/></a></div>';
       var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_buttonBO', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
    }
</script>
