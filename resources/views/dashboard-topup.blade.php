<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>
    <div class="flex flex-col gap-10">
      {{-- Flash Message Session --}}
      @if (session('success'))
          <div class="mx-20 mt-4 animate-out fade-out delay-300 disappear-animation">
              <x-bladewind.alert shade="dark" type="success" show_close_icon="false">
                  {{ session('success') }}
              </x-bladewind.alert>
          </div>
      @else
          <div class="mt-4 mx-20 animate-out fade-out delay-300 disappear-animation">
              <x-bladewind.alert shade="dark" type="warning" show_close_icon="false">
                  Our website is still on-going development!
              </x-bladewind.alert>
          </div>
      @endif



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
                    <div class="swiper-lazy-preloader"></div>
                  </div>
                  <div class="swiper-slide">
                    <img
                      class="object-cover w-full h-96"
                      src="https://source.unsplash.com/collection/190727/3000x900"
                      alt="image"
                    />
                    <div class="swiper-lazy-preloader"></div>
                  </div>
                  <div class="swiper-slide">
                    <img
                      class="object-cover w-full h-96"
                      src="https://source.unsplash.com/collection/190728/3000x900"
                      alt="image"
                    />
                    <div class="swiper-lazy-preloader"></div>
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
                lazy: true,
                lazy: {
                    loadPrevNext: true,
                },
                preloadImages: false,
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
            <div class="mt-10 bg-white p-4 rounded-md bg-opacity-60">
              {{ $games->links() }}
            </div>
        </section>

    </div>
</x-app-layout>