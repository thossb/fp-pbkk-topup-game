@props(['game'])
<x-bladewind.card reduce_padding="true" class="cursor-pointer hover:scale-105 hover:transition hover:delay-100">
    <div class="flex items-center">
        <div>
            <x-bladewind.avatar size="big" image="felixe.png"/>
        </div>
        <div class="grow pl-2 pt-1">
            <b class="text-lg">{{ $game->name }}</b>
            <div class="">
                <x-bladewind.tag label="{{ $game->category }}" color="yellow"/>
            </div>
        </div>
        <div>
            <a href="{{ route('games.show', ['id' => $game->id]) }}">
                <x-bladewind.button radius="medium" icon="arrow-small-right" icon_right="true" color="yellow">
                    Buy Now
                </x-bladewind.button>
            </a>
        </div>
    </div>
</x-bladewind.card>