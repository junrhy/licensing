<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Licenses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="col-md-12 mt-2 mb-2">
                    <form method="POST" action="{{ route('save_license') }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-4">
                                <label class="label">App Name</label>
                               <input class="form-control" type="text" name="app_name" required="required">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="label">App URL</label>
                               <input class="form-control" type="text" name="app_url" required="required">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="label">Name</label>
                               <input class="form-control" type="text" name="name" required="required">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label class="label">Email</label>
                                <input class="form-control" type="email" name="email" required="required">
                            </div>
                        </div>

                        <input type="submit" value="Create" class="btn btn-primary mt-3" ></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
