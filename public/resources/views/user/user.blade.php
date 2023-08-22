@extends('main')
@section('title', ' - Utilisateurs')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-10">
            <div class="container d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    {{ __('mypage.myNewUser') }}
                </button>
            </div>
            <br>
            <h2>{{ __('mypage.myUserList') }}</h2>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="cattable">
                    <thead>
                        <tr>
                            <th>ID </th>
                            <th>Name </th>
                            <th>Email</th>
                            <th>Poste </th>
                            <th>Group</th>
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
                <h5 class="modal-title" id="exampleModalLabel">{{ __('mypage.myAddUser') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="register-form" action="{{route('personnels.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="text" name="name" id="name" placeholder="Nom du user"
                       class="form-control shadow"  required />
                    <br/>
                    <input type="email" name="email" id="email" placeholder="email du user"
                                class="form-control shadow"  required />
                    <br/>
                    <input type="password" name="password" id="password" placeholder="Nouveau mot de passe (facultatif)"
                    class="form-control shadow" />
                    <br/>
                    <input type="text" name="poste" id="poste" placeholder=" poste"
                                class="form-control shadow"  required />
                    <br/>

                    <select id="grp_id" name="grp_id" class="form-control centered shadow">
                        <option>Sélectionner un groupe</option>
                        @foreach ($list_grps as $list_grp)
                            <option value="{{ $list_grp->id }}" >{{ $list_grp->name }}</option>
                        @endforeach
                    </select>
                    <br>
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
                ajax: '{{ route('personnels.list') }}',
                columns: [
                    { data: 'id', name: 'id','visible':true },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'poste', name: 'poste' },
                    { data: 'grp_id', name: 'grp_id' },
                    {data: 'action', name: 'action', orderable: false}
                      ],order: [[0, 'desc']]
             });
        });
    
    }
</script>