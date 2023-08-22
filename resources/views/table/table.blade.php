@extends('main')
@section('title', ' - Tables')

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
                    Nouvelle table
                </button>
            </div>
            <br>
            <h2>Liste des tables</h2>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="centable">
                    <thead>
                    <tr>
                        <th>ID </th>
                        <th>Nom </th>
                        <th>Etat</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une nouvelle table</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="register-form" action="{{route('tables.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="text" name="table_name" id="table_name" value=""
                       class="form-control shadow"  required />
                    <br/>
                    
                    <select name="table_stat" id="table_stat" class="form-control shadow">
                        <option value="A">Active</option>
                        <option value="I">Inactive</option>
                    </select>
                    <br/>
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
                $('#centable').DataTable({
                serverSide: true,
                ajax: '{{ route('tables.list') }}',
                columns: [
                    { data: 'id', name: 'id','visible':true },
                    { data: 'table_name', name: 'table_name' },
                    { data: 'table_stat', name: 'table_stat' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
             });
          });
    
    
    }
</script>