@extends('main')

@section('title', ' - Modifier Groupe')

@section('main-content')
<div class="container col-lg-10 col-md-12 col-xs-12">
    <h2>Sélectionner le groupe à modifier</h2>
    <br>
    <select id="grp_id" name="grp_id" onchange="getGroupe();" class="form-control centered shadow">
        <option>Sélectionner un groupe</option>
        @foreach ($list_groupes as $list_groupe)
            <option value="{{ $list_groupe->id }}">{{ $list_groupe->name }}</option>
        @endforeach
    </select>
    <br>
    <h2>Modifier les informations du groupe</h2>
    <br>
    <form  method="POST" action="{{ route('saveupdategroupe') }}"> 
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        <input type="text" name="nameu" id="nameu" value="{{ $groupes[0]->name }}"
                               class="form-control shadow"  required />
        <br/>
        <input type="text" name="descriptionu" id="descriptionu" value="{{ $groupes[0]->description }}"
                               class="form-control shadow"  required />
        <br/>       
        <h3> Définir les autorisations</h3>
        <br>  
        <div class="row">
            <br/>
            <div class="col-lg-10 col-md-10 col-xs-10 custom-control custom-switch">
                <input type="checkbox" id="commandeu" {{ $groupes[0]->commande }} name="commandeu" class="custom-control-input">
                <label class="custom-control-label" for="commandeu">Commande</label>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-10 col-md-10 col-xs-10 custom-control custom-switch">
                <input type="checkbox" id="produitu"  {{ $groupes[0]->produit }} name="produitu" class="custom-control-input">
                <label class="custom-control-label" for="produitu">Produit</label>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-10 col-md-10 col-xs-10 custom-control custom-switch">
                <input type="checkbox" id="stocku" {{ $groupes[0]->stock }} name="stocku" class="custom-control-input">
                <label class="custom-control-label" for="stocku">+/- Produit</label>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-10 col-md-10 col-xs-10 custom-control custom-switch">
                <input type="checkbox" id="groupeu" {{ $groupes[0]->groupe }}  name="groupeu" class="custom-control-input">
                <label class="custom-control-label" for="groupeu">Groupe Utilisateur</label>
            </div>
        </div>
        <br>
        <div class="row">  
            <div class="col-lg-10 col-md-10 col-xs-10 custom-control custom-switch">
                <input type="checkbox" id="useru" {{ $groupes[0]->user }} name="useru" class="custom-control-input">
                <label class="custom-control-label" for="useru">Utilisateur</label>
            </div>
        </div>
        <br>
        <div class="row">
           <div class="col-lg-10 col-md-10 col-xs-10 custom-control custom-switch">
                <input type="checkbox" id="etatu" {{ $groupes[0]->etat }} name="etatu" class="custom-control-input">
                <label class="custom-control-label" for="etatu">Etat</label>
            </div>
        </div>
            <br>
            <div class="row">
                <div class="col-lg-10 col-md-10 col-xs-10 custom-control custom-switch">
                    <input type="checkbox" id="paramu" {{ $groupes[0]->parametres }} name="paramu" class="custom-control-input">
                    <label class="custom-control-label" for="paramu">Paramètres</label>
                </div>
            </div>
            
            <br/>
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <a class="btn btn-danger pull-right" href="/deletegroupe/{{ $id }}"> {{ __('Supprimer') }} </a>
    </form>
    <br>
</div>
@endsection
<script type="text/javascript">
    function getGroupe(){
            var id = $("#grp_id option:selected").attr("value");
            //console.log(id);
            $.ajax({
                url: '/updategroupe/'+id,
                type: 'POST',
                dataType: "text",
                data: {id:id},
                success: function(result){
                    //alert(id);
                    document.location.href='/updategroupe/'+id;
                },
                error: function(error) {
                    console.log('error:' + JSON.stringify(error));
                }
            });
        }
</script>