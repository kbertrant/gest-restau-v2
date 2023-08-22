@extends('main')
@section('title', ' - Tables')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-10">
            <div class="container d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    New category
                </button>
            </div>
            <br>
            <h2>List category</h2>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="cattable">
                    <thead>
                    <tr>
                        <th>ID </th>
                        <th>Name </th>
                        <th>State</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="register-form" action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="text" name="cat_name" id="cat_name"
                       class="form-control shadow"  required />
                    <br/>
                    
                    <select name="cat_stat" id="cat_stat" class="form-control shadow">
                        <option value="A">Active</option>
                        <option value="I">Inactive</option>
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
                ajax: '{{ route('categories.list') }}',
                columns: [
                    { data: 'id', name: 'id','visible':true },
                    { data: 'cat_name', name: 'cat_name' },
                    { data: 'cat_stat', name: 'cat_stat' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
             });
        });
    
    }
</script>