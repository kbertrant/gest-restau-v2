@extends('main')
@section('title', ' - Produits')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-10">
            <div class="container d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    New product
                </button>
            </div>
            <br>
            <h2>List of products</h2>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="cattable">
                    <thead>
                    <tr>
                        <th>ID </th>
                        <th>Name </th>
                        <th>Type</th>
                        <th>Description </th>
                        <th>Quantity</th>
                        <th>Stock minimum </th>
                        <th>Price unit</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Add new product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="register-form" action="{{route('produits.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="text" name="prod_name" id="prod_name" placeholder="Designation"
                       class="form-control shadow"  required />
                    <br/>
                    <input type="text" name="description" id="description" placeholder="description"
                                class="form-control shadow"  required />
                    <br/>

                    <input type="text" name="prix_unit" id="prix_unit" placeholder="price unit"
                                class="form-control shadow"  required />
                    <br/>

                    <input type="text" name="prod_type" id="prod_type" placeholder="type de produit"
                                class="form-control shadow"  required />
                    <br/>
                    <br/>
                    <select name="cat_id" id="cat_id" class="form-control shadow">
                        <option value="">Choose category</option>
                        @foreach ($list_cats as $list_cat)
                            <option value="{{ $list_cat->id }}">{{ $list_cat->cat_name }}</option>
                        @endforeach 
                    </select>
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
                $('#cattable').DataTable({
                serverSide: true,
                ajax: '{{ route('produits.list') }}',
                columns: [
                    { data: 'id', name: 'id','visible':true },
                    { data: 'prod_name', name: 'prod_name' },
                    { data: 'prod_type', name: 'prod_type' },
                    { data: 'description', name: 'description' },
                    { data: 'prod_qte', name: 'prod_qte' },
                    { data: 'stock_min', name: 'stock_min' },
                    { data: 'prix_unit', name: 'prix_unit' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
             });
        });
    
    }
</script>