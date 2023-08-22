@extends('main')

@section('title', ' - Incrementer Produits')


@section('main-content')
<div class="container col-lg-12">
    <h2>Enregistrer le produit à décrementer ou à incrémenter</h2>
        <form method="POST" action="{{ route('updatestock') }}"> 
                @csrf
            <select class="form-control shadow" name="id" id="id">
                <option value="0">Sélectionner un produit</option>
                @foreach ($list_produits as $list_produit)
                    <option value="{{ $list_produit->id }}">{{ $list_produit->prod_name }}</option>
                @endforeach
            </select>
            <br/>
            <select name="prod_qte" id="prod_qte" class="form-control shadow">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
                <br/>
                <button type="submit" class="btn btn-success shadow" href="#">Enregistrer </button>
            </form>
            <br>
            <h1 class="h3 text-gray-800 align-items-center">Produits en stock</h1>
            <div class="table-responsive">
                <table class="table table-bordered" id="cattable">
                    <thead>
                        <tr>
                            <th>ID </th>
                            <th>Nom </th>
                            <th>Type</th>
                            <th>Description </th>
                            <th>Quantite</th>
                            <th>Stock minimum </th>
                            <th>Prix unitaire</th>
                            
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
       
    </div>
</div>
@endsection
<script type="text/javascript">
    window.onload = function(){
         $(document).ready(function(){
                $('#cattable').DataTable({
                serverSide: true,
                ajax: '{{ route('increment.list') }}',
                columns: [
                    { data: 'id', name: 'id','visible':true },
                    { data: 'prod_name', name: 'prod_name' },
                    { data: 'prod_type', name: 'prod_type' },
                    { data: 'description', name: 'description' },
                    { data: 'prod_qte', name: 'prod_qte' },
                    { data: 'stock_min', name: 'stock_min' },
                    { data: 'prix_unit', name: 'prix_unit' }
                    
                      ],order: [[0, 'desc']]
             });
        });
    
    }
</script>