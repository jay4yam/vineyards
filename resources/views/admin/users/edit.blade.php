<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users Edit') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap gap-4 py-12 max-w-7xl mx-auto px-8">

        <!-- users -->
        <div class="w-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

            <form action="{{ route('backuser.update', [app()->getLocale(), 'backuser' => $user]) }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <!-- container -->
                <div class="flex flex-col lg:flex-row gap-2">

                    <!-- first col -->
                    <div class="w-full lg:w-1/2">

                        <!-- prenom / nom col -->
                        <div class="flex gap-2 py-2">
                            <div class="flex flex-col w-full">
                                <label for="firstname">Prenom</label>
                                <input class="border-gray-200 w-full" type="text" name="firstname" value="{{ old($user->firstname, $user->firstname) }}">
                                @error('firstname')<p class="text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div class="flex flex-col w-full">
                                <label for="lastname">Nom</label>
                                <input class="border-gray-200 w-full" type="text" name="lastname" value="{{ old($user->lastname, $user->lastname) }}">
                                @error('lastname')<p class="text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <!-- end prenom / nom col -->

                        <!-- job title / role -->
                        <div class="flex gap-2 py-2">
                            <div class="flex flex-col w-full">
                                <label for="job_title">Job Title</label>
                                <input class="border-gray-200 w-full" type="text" name="job_title" value="{{ old($user->job_title, $user->job_title) }}">
                                @error('job_title')<p class="text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div class="flex flex-col w-full">
                                <label for="lastname">Role</label>
                                <select class="border-gray-200 w-full" name="role">
                                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                    <option value="broker" @selected($user->role === 'broker')>Broker</option>
                                    <option value="guest" @selected($user->role === 'guest')>Guest</option>
                                    <option value="partner" @selected($user->role === 'partner')>Partner</option>
                                    <option value="user" @selected($user->role === 'user')>User</option>
                                </select>
                                @error('lastname')<p class="text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <!-- end job title / role -->

                        <!-- email -->
                        <div class="flex flex-col w-full py-2">
                            <label for="email">Email</label>
                            <input class="border-gray-200 w-full" type="text" name="email" value="{{ old($user->email, $user->email) }}">
                            @error('email')<p class="text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <!-- end email -->

                        <!-- phone -->
                        <div class="flex flex-col w-full py-2">
                            <label for="phone">Phone </label>
                            <input class="border-gray-200 w-full" type="text" name="phone" value="{{ old($user->phone, $user->phone) }}">
                            @error('phone')<p class="text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <!-- end phone -->

                        <!-- mobile -->
                        <div class="flex flex-col w-full py-2">
                            <label for="mobile">Mobile</label>
                            <input class="border-gray-200 w-full" type="text" name="mobile" value="{{ old($user->mobile, $user->mobile) }}">
                            @error('mobile')<p class="text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <!-- end mobile -->


                        <!-- linkedin -->
                        <div class="flex flex-col w-full py-2">
                            <label for="linkedin_profile_url">Linkedin</label>
                            <input class="border-gray-200 w-full" type="text" name="linkedin_profile_url" value="{{ old($user->linkedin_profile_url, $user->linkedin_profile_url) }}">
                            @error('linkedin_profile_url')<p class="text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <!-- end linkedin -->

                        <!-- facebook -->
                        <div class="flex flex-col w-full py-2">
                            <label for="linkedin_profile_url">Facebook</label>
                            <input class="border-gray-200 w-full" type="text" name="facebook_profile_url" value="{{ old($user->facebook_profile_url, $user->facebook_profile_url) }}">
                            @error('facebook_profile_url')<p class="text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <!-- end facebook -->

                        <!-- youtube -->
                        <div class="flex flex-col w-full py-2">
                            <label for="youtube_profile_url">Youtube</label>
                            <input class="border-gray-200 w-full" type="text" name="youtube_profile_url" value="{{ old($user->youtube_profile_url, $user->youtube_profile_url) }}">
                            @error('youtube_profile_url')<p class="text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <!-- end youtube -->

                        <!-- instagram -->
                        <div class="flex flex-col w-full py-2">
                            <label for="instagram_profile_url">Youtube</label>
                            <input class="border-gray-200 w-full" type="text" name="instagram_profile_url" value="{{ old($user->instagram_profile_url, $user->instagram_profile_url) }}">
                            @error('instagram_profile_url')<p class="text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <!-- end instagram -->

                    </div>
                    <!-- end first col -->

                    <!-- second col -->
                    <div class="w-full lg:w-1/2">

                        <!-- avatar -->
                        <div>
                            @if($user->avatar)
                            <img src="{{ asset('storage/user/'.$user->avatar) }}" alt="">
                            @endif
                            <div class="flex flex-col">
                                <label for="avatar">Avatar</label>
                                <input class="border-gray-200 py-2" type="file" name="avatar">
                            </div>
                        </div>
                        <!-- end avatar -->

                        <div>
                            <textarea name="biography" class="border-gray-200 w-full py-2">{{ $user->biography }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center py-4">
                    <button type="submit" class=" ring ring-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white p-2 rounded-md">Mettre à jour</button>
                </div>
            </form>
        </div>
        <!-- end articles blogs -->

    </div>

    @push('dedicated_js')
        <!-- Place the first <script> tag in your HTML's <head> -->
        <script src="https://cdn.tiny.cloud/1/dsnrqd6wanwpw9ttx90g1id6n31mhs3ooj2njnn63k3brdq9/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

        <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
        <script>
            tinymce.init({
                selector: 'textarea',
            });
        </script>
    @endpush
</x-app-layout>
