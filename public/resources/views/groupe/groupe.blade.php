@extends('main')
@section('title', ' - Groupes')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-10">
            <div class="container d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Nouveau groupe
                </button>
            </div>
            <br>
            <h2>Liste des groupes</h2>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="cattable">
                    <thead>
                    <tr>
                        <th>ID </th>
                        <th>Nom </th>
                        <th>Description</th>
                        <th>commande</th>
                        <th>produit</th>
                        <th>stock</th>
                        <th>groupe</th>
                        <th>User</th>
                        <th>paiement</th>
                        <th>parametres</th>
                        <th>etat</th>
                        <th>Action</th>
                    </tr>
                    </thead>
            </table>
            </div>
        </div>  
    </div>
</div>
<!-- begin modal for create -->
<!-- Button trigger modal -->  
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une nouveau groupe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="register-form" action="{{route('groupes.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    
                    <input type="text" name="name" id="name" placeholder="Nom du groupe"
                               class="form-control shadow"  required />
                    <br/>
                    <input type="text" name="description" id="description" placeholder="Description du groupe"
                                        class="form-control shadow"  required />
                    <br/>       
                    <h3> Définir les autorisations</h3>
                    <br>  
                    <div class="container row">
                        <br/>
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="commandeu" name="commande" class="custom-control-input">
                            <label class="custom-control-label" for="commandeu">Commande</label>
                        </div>
                    
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="produitu"   name="produit" class="custom-control-input">
                            <label class="custom-control-label" for="produitu">Produit</label>
                        </div>
                    
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="stocku" name="stock" class="custom-control-input">
                            <label class="custom-control-label" for="stocku">+/- Produit</label>
                        </div>
                    
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="groupeu"  name="groupe" class="custom-control-input">
                            <label class="custom-control-label" for="groupeu">Groupe Utilisateur</label>
                        </div>
                    
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="useru" name="user" class="custom-control-input">
                            <label class="custom-control-label" for="useru">Utilisateur</label>
                        </div>
                    
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="etatu" name="etat" class="custom-control-input">
                            <label class="custom-control-label" for="etatu">Etat</label>
                        </div>
                    
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="paramu" name="param" class="custom-control-input">
                            <label class="custom-control-label" for="paramu">Paramètres</label>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                                <input type="checkbox" id="paiements" name="paiements" class="custom-control-input">
                                <label class="custom-control-label" for="paiements">Paiements</label>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection
<script type="text/javascript">
    window.onload = function(){
         $(document).ready(function(){
                $('#cattable').DataTable({
                serverSide: true,
                ajax: '{{ route('groupes.list') }}',
                columns: [
                    { data: 'id', name: 'id','visible':true },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'commande', name: 'commande' },
                    { data: 'produit', name: 'produit' },
                    { data: 'stock', name: 'stock' },
                    { data: 'groupe', name: 'groupe' },
                    { data: 'user', name: 'user' },
                    { data: 'etat', name: 'etat' },
                    { data: 'paiements', name: 'paiements' },
                    { data: 'parametres', name: 'parametres' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
             });
        });
    
    }
</script>