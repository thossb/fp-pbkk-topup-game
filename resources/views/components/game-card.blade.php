@props(['game'])
<x-bladewind.card reduce_padding="true" class="cursor-pointer hover:shadow-yellow-main hover:shadow-lg">
    <div class="flex items-center">
        <div>
            <x-bladewind.avatar size="big" image="felixe.png"/>
        </div>
        <div class="grow pl-2 pt-1">
            <b class="text-lg">{{ $game->name }}</b>
            <div class="">
                <x-bladewind.tag label="MOBA" color="red"/>
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