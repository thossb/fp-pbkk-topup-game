<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 ">
            {{ __("Update profile picture user") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('picture.update', ['id' => $user->id]) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="grid md:gap-6">
            <div>
                @if ($user->profile_picture)
                    <img id="profile_picture_edit" src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture Edit" class="mx-auto w-60 h-60 rounded-full ring-4 border-8 border-transparent ring-slate-600">
                @else
                    <img id="profile_picture_edit" src="{{ asset('img/default.png') }}" alt="Profile Picture Edit" class="mx-auto w-60 h-60 rounded-full ring-4 border-8 border-transparent ring-slate-600">
                @endif
                <div class="relative -mt-12 ml-40">
                    <input onchange="readURL(this);" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" aria-describedby="profile_picture_help" id="profile_picture" name="profile_picture" type="file">
                    <button disabled type="button" id="save_profile_picture_button" class="py-2.5 px-4 mr-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-blue-700 focus:text-blue-700 inline-flex items-center">
                        <svg class="inline w-4 h-4 mr-3 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                            <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                        </svg>
                        Edit
                    </button>
                    <input type="hidden" name="type" id="type" value="update">
                </div>
            </div>
        </div>

        <div class="relative">
            <div class="text-center">
                <button class="mt-2 text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 mb-2 text-center " id="delete_button">{{ __('Delete Profile Picture') }}</button>
            </div>

            <div class="text-center">
                <button class="mt-1 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center " id="submit_button" style="display:none">{{ __('Save Profile Picture') }}</button>
            </div>
        </div>
    </form>
</section>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profile_picture_edit').attr('src', e.target.result);
                $('#save_profile_picture_button').prop('disabled', false);
                $('#submit_button').show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function() {
        $('#delete_button').click(function(e) {
            e.preventDefault(); // Prevent form submission

            $('#profile_picture_edit').attr('src', "{{ asset('img/default.png') }}");
            $('#type').val('delete');
            $('#save_profile_picture_button').prop('disabled', true);
            $('#submit_button').show();
        });

        $('#submit_button').click(function() {
            $('form').submit();
        });
    });
</script>