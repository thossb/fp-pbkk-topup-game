@props(['game', 'denom'])
<x-bladewind.card reduce_padding="true" class="cursor-pointer hover:scale-105 hover:transition hover:delay-100">
        <div class="flex items-center flex-col w-full h-full px-10 py-6">
            <div>
                <x-bladewind.avatar size="big" image="/felixe.png"/>
            </div>
            <div class="my-2">
                <b class="text-lg">{{$denom->denom}} {{$game->unit}}</b>
            </div>
            <div class="my-2">
                <b class="text-lg">Rp. {{$denom->price}}</b>
            </div>
            <div>
                <a href="#">
                    <x-bladewind.button size="small" radius="medium" color="yellow">
                        Add
                    </x-bladewind.button>
                </a>
            </div>
        </div>
</x-bladewind.card>