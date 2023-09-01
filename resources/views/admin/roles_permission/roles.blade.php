@extends('layouts.app')
@section('content')
@push('style')
    <style>
        .modal-backdrop{
            z-index: 1;
        }
    </style>
@endpush
<link rel="stylesheet" href="{{asset('plugin/jquery-confirm-master/dist/jquery-confirm.min.css')}}">
    @include('layouts.includes.home.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="admin_screen_cont" style="margin-top: 120px;width:100%;margin-left:0px">
                    <div class="row">
                        <div class="col-9 col-md-9">
                            <h4 class="text-center">Role Settings</h4>
                        </div>
                        <div class="col-3">
                            <div class="text-right">
                                <a href="#!" class="btn btn-primary btn-lg btn_role_model_open">Add new</a>
                            </div>
                        </div>
                    </div>
                    <hr />
                    @if(isset($roles) && count($roles) > 0)
                        <div class="tabContent_content2 margin_top_32">
                            <table id="allRoles" class="fs_16 table roles">
                                <tr class="fs_16 f_600">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Users Count</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($roles as $i)
                                    <tr class="f_400">
                                        <td>{{$i->id}}</td>
                                        <td>{{$i->name}}</td>
                                        <td>{{$i->users()->count()}}</td>
                                        <td>
                                            <a href="#!" class="btn btn-warning btn_edit" data-name="{{$i->name}}" data-id="{{$i->id}}">Edit</a>
                                            <a href="#!" class="btn btn-danger btn_delete" data-id="{{$i->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">No any role found</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="role_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="POST" action="{{route('admin_role_save')}}">
                <input type="hidden" name="id" id="edit_id">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Role manage</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Role name" id="role_name" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    @push('js')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/modals.js').'?v='.time() }}"></script>
    <script type="application/javascript" src="{{ asset('plugin/jquery-confirm-master/dist/jquery-confirm.min.js') }}"></script>
    <script>
        jQuery(document).on("click",'.btn_role_model_open',function(){
            jQuery("#edit_id").val('');
            jQuery("#role_modal").modal('show');
        });
        jQuery(document).on('click','.btn_edit',function(){
            jQuery("#edit_id").val(jQuery(this).data('id'));
            jQuery("#role_name").val(jQuery(this).data('name'));
            jQuery("#role_modal").modal('show');
        });
        jQuery(document).on('click','.btn_delete',function(){
            let id=jQuery(this).data('id');
            jQuery.confirm({
                title:"Confirm",
                content:"Are you sure to delete?",
                theme:'modern',
                icon:"question",
                buttons:{
                    No:function(){
                        return true;
                    },Yes:{
                        btnClass:"btn-danger",
                        action:function(){
                            jQuery.ajax({
                                url:"{{route('admin_role_delete')}}",
                                type:"DELETE",
                                dataType:'json',
                                data:{
                                    id:id,
                                    '_token':"{{csrf_token()}}"
                                },success:function(){
                                    window.location.reload();
                                }
                            })
                        }
                    }
                }
            })
        })
    </script>
    @endpush
@endsection
