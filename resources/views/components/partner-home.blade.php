<div data-aos="fade-up"
     data-aos-offset="200"
     data-aos-delay="50"
     data-aos-duration="500"
     data-aos-easing="ease-in-out"
     data-aos-mirror="true"
     data-aos-once="false"
     class="w-full lg:w-1/2 flex flex-col gap-2 items-center text-gray-600 text-sm">
    <img class="mx-auto w-full lg:w-1/2 rounded-md" loading="lazy" src="{{ asset('storage/user/'.$partner->avatar) }}" alt="{{ $partner->fullname }}">
    <p>
        {{ $partner->firstname }} <span class="uppercase font-bold">{{ $partner->lastname }}</span>
    </p>
    <p>
        {{ $partner->job_title }}
    </p>
    <div class="flex gap-4 justify-center items-center">
        @if($partner->linkedin_profile_url)
            <a href="{{ $partner->linkedin_profile_url }}">
                <x-fab-linkedin class="h-5 hover:text-red-800"/>
            </a>
        @endif

        @if($partner->facebook_profile_url)
            <a href="{{ $partner->facebook_profile_url }}">
                <x-fab-facebook-square class="h-5 hover:text-red-800"/>
            </a>
        @endif

        @if($partner->email)
            <a href="mailto:{{$partner->email}}">
                <x-fas-envelope class="h-6 hover:text-red-800" />
            </a>
        @endif

            @if($partner->website)
                <a href="{{$partner->email}}" target="_blank">
                    <x-mdi-web class="h-6 hover:text-red-800"/>
                </a>
            @endif
    </div>
</div>
