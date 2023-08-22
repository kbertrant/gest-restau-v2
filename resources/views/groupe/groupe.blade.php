@extends('main')
@section('title', ' - Groupes')

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
                    New group
                </button>
            </div>
            <br>
            <h2>List groups</h2>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="cattable">
                    <thead>
                    <tr>
                        <th>ID </th>
                        <th>Name </th>
                        <th>Description</th>
                        <th>Order</th>
                        <th>Product</th>
                        <th>stock</th>
                        <th>groupe</th>
                        <th>User</th>
                        <th>payment</th>
                        <th>parameters</th>
                        <th>States</th>
                        <th>delivery</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Add new group</h5>
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
                    <h3> Set Autorisations </h3>
                    <br>  
                    <div class="container row">
                        <br/>
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="commandeu" name="commande" class="custom-control-input">
                            <label class="custom-control-label" for="commandeu">Orders</label>
                        </div>
                    
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="produitu"   name="produit" class="custom-control-input">
                            <label class="custom-control-label" for="produitu">Product</label>
                        </div>
                    
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="stocku" name="stock" class="custom-control-input">
                            <label class="custom-control-label" for="stocku">+/- Product</label>
                        </div>
                    
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="groupeu"  name="groupe" class="custom-control-input">
                            <label class="custom-control-label" for="groupeu">User Groupe</label>
                        </div>
                    
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="useru" name="user" class="custom-control-input">
                            <label class="custom-control-label" for="useru">User</label>
                        </div>
                    
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="etatu" name="etat" class="custom-control-input">
                            <label class="custom-control-label" for="etatu">States</label>
                        </div>
                    
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="paramu" name="param" class="custom-control-input">
                            <label class="custom-control-label" for="paramu">Paramèters</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                            <input type="checkbox" id="deliveryu" name="delivery" class="custom-control-input">
                            <label class="custom-control-label" for="deliveryu">Delivery</label>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-xs-4 custom-control custom-switch">
                                <input type="checkbox" id="paiements" name="paiements" class="custom-control-input">
                                <label class="custom-control-label" for="paiements">Payments</label>
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
                    { data: 'paiements', name: 'paiements' },
                    { data: 'parametres', name: 'parametres' },
                    { data: 'etat', name: 'etat' },
                    { data: 'delivery', name: 'delivery' },
                    
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
             });
        });
    
    }
</script>