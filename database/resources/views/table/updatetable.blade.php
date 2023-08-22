@extends('main')
@section('title', ' - Tables')

@section('main-content')
<div class="container col-lg-8">
    
    <br>
    <h2>Modifier les informations de la table</h2>
    <br>
    <form method="POST" action="{{ route('tables.update') }}"> 
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        <input type="text" name="table_name" id="table_name" value="{{ $table[0]->table_name }}"
                       class="form-control shadow"  required />
        <br/>
        
        <select name="table_stat" id="table_stat" class="form-control shadow">
            <option value="A">Active</option>
            <option value="I">Inactive</option>
        </select>
        <br/>
        <button type="submit" class="btn btn-success shadow">Enregistrer</button>
        <a class="btn btn-danger pull-right shadow" href="/tables/destroy/{{ $id }}"> Supprimer</a>
    </form>
</div>
@endsection
<script type="text/javascript">
    function getProduit(){
            var id = $("#table_id option:selected").val();

            console.log(id);
            
            $.ajax({
                url: '/tables/update/'+id,
                type: 'POST',
                dataType: "text",
                data: {id:id},
                success: function(result){
                    //alert(id);
                    // document.location.href='/tactic?id='+id;
                    document.location.href='/tables/update/'+id;
                },
                error: function(error) {
                    console.log('error:' + JSON.stringify(error));
                }
            });
        }
</script>