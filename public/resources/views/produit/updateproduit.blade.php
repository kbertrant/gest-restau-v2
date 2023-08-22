@extends('main')

@section('title', ' - Modifier Produit')


@section('main-content')
<div class="container col-lg-8">
    <h2>Updated product</h2>
    <br>
    <select id="prod_id" name="prod_id" onchange="getProduit();" class="form-control centered shadow">
        <option>select your product</option>
        @foreach ($list_produits as $list_produit)
            <option value="{{ $list_produit->id }}">{{ $list_produit->prod_name }}</option>
        @endforeach
    </select>
    <br>
    <h2>Update informations </h2>
    <br>
    <form method="POST" action="{{ route('produits.update') }}"> 
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        <input type="text" name="prod_name" id="prod_name" value="{{ $produit[0]->prod_name }}"
                       class="form-control shadow"  required />
        <br/>
        <input type="text" name="description" id="description" value="{{ $produit[0]->description }}"
                       class="form-control"  required />
        <br/>

        <input type="text" name="prix_unit" id="prix_unit" value="{{ $produit[0]->prix_unit }}"
                       class="form-control shadow"  required />
        <br/>

        <input type="text" name="prod_type" id="prod_type" value="{{ $produit[0]->prod_type }}"
                       class="form-control shadow"  required />
        <br/>
        <select name="cat_id" id="cat_id" class="form-control shadow">
            <option value="{{ $produit[0]->cat_id }}">{{ $produit[0]->cat_id }}</option>
            @foreach ($list_cats as $list_cat)
                <option value="{{ $list_cat->id }}">{{ $list_cat->cat_name }}</option>
            @endforeach 
        </select>
                <br/>
        <button type="submit" class="btn btn-success shadow">{{ __('mypage.mySave') }}</button>
        <a class="btn btn-danger pull-right shadow" href="/produits/destroy/{{ $id }}"> {{ __('mypage.myDelete') }}</a>
    </form>
</div>
@endsection
<script type="text/javascript">
    function getProduit(){
            var id = $("#prod_id option:selected").val();

            console.log(id);
            
            $.ajax({
                url: '/produits/update/'+id,
                type: 'POST',
                dataType: "text",
                data: {id:id},
                success: function(result){
                    //alert(id);
                    // document.location.href='/tactic?id='+id;
                    document.location.href='/produits/update/'+id;
                },
                error: function(error) {
                    console.log('error:' + JSON.stringify(error));
                }
            });
        }
</script>