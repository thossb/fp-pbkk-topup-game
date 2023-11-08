<x-app-layout>
    <div class="flex flex-col gap-10">
        <div class="mt-4 mx-20">
            <x-bladewind.alert shade="dark" type="warning" show_close_icon="false">
                Our website is still on-going development !
            </x-bladewind.alert>
        </div>

        <!-- Sliders -->
        <section class="">
            @push('styles')
            <link
              rel="stylesheet"
              href="https://unpkg.com/swiper/swiper-bundle.min.css"
            />
            @endpush
            {{-- <x-slot name="header">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Laravel 9 Slider') }} 
                </h2>
            </x-slot>--}}
            <div class="swiper mySwiper mx-20 rounded-xl">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <img
                      class="object-cover w-full h-96"
                      src="https://source.unsplash.com/user/erondu/3000x900"
                      alt="image"
                    />
                  </div>
                  <div class="swiper-slide">
                    <img
                      class="object-cover w-full h-96"
                      src="https://source.unsplash.com/collection/190727/3000x900"
                      alt="image"
                    />
                  </div>
                  <div class="swiper-slide">
                    <img
                      class="object-cover w-full h-96"
                      src="https://source.unsplash.com/collection/190728/3000x900"
                      alt="image"
                    />
                  </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
              </div>
            @push('scripts')
            <!-- Swiper JS -->
            <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
            <script>
              var swiper = new Swiper(".mySwiper", {
                cssMode: true,
                navigation: {
                  nextEl: ".swiper-button-next",
                  prevEl: ".swiper-button-prev",
                },
                pagination: {
                  el: ".swiper-pagination",
                },
                mousewheel: true,
                keyboard: true,
              });
            </script>
            @endpush
        </section>

        <!-- Game Lists -->
        <section class="mx-20 mb-4">
            <div class="grid grid-flow-row grid-cols-2 items-center gap-5">
                @foreach ($games as $game)
                    <x-game-card :game="$game" />
                @endforeach
            </div>
        </section>

    </div>
</x-app-layout>