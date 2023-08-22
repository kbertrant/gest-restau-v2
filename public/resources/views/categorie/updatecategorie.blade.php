@extends('main')

@section('title', ' - Modifier Produit')


@section('main-content')
<div class="container col-lg-8">
    
    <br>
    <h2>Update category's informations</h2>
    <br>
    <form method="POST" action="{{ route('categories.update') }}"> 
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        <input type="text" name="cat_name" id="cat_name" value="{{ $categorie[0]->cat_name }}"
                       class="form-control shadow"  required />
        <br/>
        
        <select name="cat_stat" id="cat_stat" class="form-control shadow">
            <option value="{{ $categorie[0]->cat_stat }}">{{ $categorie[0]->cat_stat }}</option>
            <option value="A">Active</option>
            <option value="I">Inactive</option>
        </select>
        <br/>
        <button type="submit" class="btn btn-success shadow">{{ __('mypage.mySave') }}</button>
        <a class="btn btn-danger pull-right shadow" href="/categories/destroy/{{ $id }}"> {{ __('mypage.myDelete') }}</a>
    </form>
</div>
@endsection
<script type="text/javascript">
    function getProduit(){
            var id = $("#cat_id option:selected").attr("value");

            console.log(id);
            
            $.ajax({
                url: '/categories/edit/'+id,
                type: 'POST',
                dataType: "text",
                data: {id:id},
                success: function(result){
                    //alert(id);
                    // document.location.href='/tactic?id='+id;
                    document.location.href='/categories/edit/'+id;
                },
                error: function(error) {
                    console.log('error:' + JSON.stringify(error));
                }
            });
        }
</script>