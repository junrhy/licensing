<style type="text/css">
    .activation, .delete {
        cursor: pointer;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Licenses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="col-md-12">
                    <form action="{{ route('create_license') }}">
                        <input type="submit" value="Add New" class="btn btn-primary mt-3" ></input>
                    </form>
                    
                    <table class="table table-striped mt-1">
                        <thead class="thead-light">
                            <th>License Key</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date Registered</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>

                        @foreach($licenses as $license)
                        <tr>
                            <td>{{ $license->license_key }}</td>
                            <td>{{ $license->registered_name }}</td>
                            <td>{{ $license->registered_email }}</td>
                            <td>{{ $license->registered_date->format('M d, Y') }}</td>
                            <td>
                                <a class="activation {{ $license->is_active ? 'text-danger' : 'text-primary' }}" data-id="{{ $license->id }}">
                                {{ $license->is_active ? 'Deactivate' : 'Activate' }}
                                </a>
                            </td>
                            <td>
                                <a class="delete text-danger" data-id="{{ $license->id }}">
                                <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
$(document).ready(function(){
   $(".activation").unbind().click(function(){
        id = $(this).data('id');

        $.ajax({
            method: "POST",
            url: "/license/activation/"+id,
            data: { _token: "{{ csrf_token() }}" }
        })
        .done(function( msg ) {
            location.reload();
        });;
   });

   $(".delete").unbind().click(function(){
        id = $(this).data('id');

        $.ajax({
            method: "DELETE",
            url: "/license/delete/"+id,
            data: { _token: "{{ csrf_token() }}" }
        })
        .done(function( msg ) {
            location.reload();
        });;
   });
})
</script>