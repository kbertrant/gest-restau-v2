@extends('main')

@section('title', ' - Modifier Commande')


@section('main-content')
<div class="container col-lg-8">
    <h2>Choose order to update</h2>
        <br>
        <select id="prod_name" name="prod_name" onchange="getCommande();" class="form-control centered shadow">
            <option>Choose order</option>
            @foreach ($list_commandes as $list_commande)
                <option value="{{ $list_commande->id }}">{{ $list_commande->numero }}</option>
            @endforeach
        </select>
        <br>
        <h2>Update informations order</h2>
        <form method="POST" action="{{ route('commandes.update') }}"> 
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $id }}">
            <input type="text" name="cl_name" id="cl_name" value="{{ $commande[0]->cl_name }}"
            class="form-control shadow"  required />
            <br/>
            <input type="text" name="cl_phone" id="cl_phone" value="{{ $commande[0]->cl_phone }}"
                    class="form-control shadow"  required />
            <br/>
            <select name="table_id" id="table_id" class="form-control qte shadow" required>
                <option value="">{{ __('mypage.myChoice') }}</option>
                @foreach ($list_tables as $list_table)
                    <option value="{{ $list_table->id }}">{{ $list_table->table_name }}</option>
                @endforeach
            </select>
        <br/>
        <div class="row">
            <div class="field_wrapper">
                
                @foreach($details as $detail)
                <div class="row" style="margin:5px">
                    <div class=" col-lg-6 col-md-6 col-xs-6 field">
                        <select class="prod form-control shadow" id="prod_id[]" name="prod_id[]">
                                <option value="{{ $detail->prod_id }}">{{ $detail->prod_name }}</option>
                            @foreach ($list_produits as $list_produit) 
                                <option value="{{ $list_produit->id }}" {{ ($detail->prod_id== $list_produit->id) ? 'selected' : '' }}>{{ $list_produit->prod_name }}</option> 
                            @endforeach
                        </select>
                    </div>
                <div class="col-lg-2 col-md-2 col-xs-2 field">
                    <select name="quantite[]" id="quantite[]" class="form-control qte shadow">
                            <option value="{{ $detail->quantite }}">{{ $detail->quantite }}</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-xs-2">
                    <input type="text" name="prix[]" id="prix[]" placeholder="0" class="form-control pri_total shadow"  disabled />
                </div>             
                <a href="javascript:void(0);" class="remove_button"><img src="{{ asset('img/remove-icon.png') }}"/></a>
                </div>   
                @endforeach
            <div>
        </div>
      
        <br/>
        <button type="submit" class="btn btn-success shadow">{{ __('mypage.mySave') }} </button>
        <a class="btn btn-danger pull-right shadow" href="/deletecommande/{{ $id }}"> {{ __('mypage.myclose') }} </a>
    </form>
</div>
@endsection
<script type="text/javascript">
window.onload = function(){
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="row" style="margin:5px"><div class=" col-lg-6 col-md-6 col-xs-6 field"><select class="prod form-control shadow" id="prod_id[]" name="prod_id[]"> @foreach ($list_produits as $list_produit) <option value="{{ $list_produit->id }}">{{ $list_produit->prod_name }}</option> @endforeach</select></div><div class="col-lg-2 col-md-2 col-xs-2 field"><select name="quantite[]" id="quantite[]" class="form-control qte shadow"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div><div class="col-lg-2 col-md-2 col-xs-2"><input type="text" name="prix[]" id="prix[]" placeholder="0" class="form-control pri_total shadow"  disabled /></div>             <a href="javascript:void(0);" class="remove_button"><img src="{{ asset('img/remove-icon.png') }}"/></a></div>';

        var x = 1; //Initial field counter is 1
        
        var change_prod = $('.prod');
        var change_prix = $('.pri_total');
        var change_qte = $('.qte'); 
        
        let id = [];
        
        var pri_prod = 0;
        //Once add button is clicked
        $(change_prod).change(function(){
            
            let prix_unit = [];
            if ($(this).text() !== '' ) {
            var temp = change_prod.val().split('-');
            id.push(temp[0]);
            prix_unit.push(temp[1]);
            }
            $(change_qte).change(function(){
            var qty = change_qte.val();
            pri_prod = Number(prix_unit) * Number(qty);
            change_prix.val(pri_prod);
        });
        change_prix.val(pri_prod);
        });
        
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
};
function getCommande(){
    var id = $("#prod_name option:selected").attr("value");
    console.log(id);  
    $.ajax({
        url: '/updatecommande/'+id,
        type: 'POST',
        dataType: "text",
        data: {id:id},
        success: function(result){
            //alert(id);
            document.location.href='/updatecommande/'+id;
        },
        error: function(error) {
            console.log('error:' + JSON.stringify(error));
        }
    });
}
</script>