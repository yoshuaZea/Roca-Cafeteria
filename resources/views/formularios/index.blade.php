@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="col-span-1 flex flex-col">
            <img
                class="max-w-sm"
                src="{{ asset('img/logo.jpg') }}"
                alt="logo"
            >
            <p class="font-semibold text-orange-500 text-xl uppercase text-left">
                <i class="fa-solid fa-mug-hot mr-2"></i> Cafetería
            </p>
            <span class="text-gray-500 text-sm" id="fechaHoy"></span>
        </div>

        @if($visualizar))
            <div class="col-span-1 md:col-span-2">
                <p class="text-sm md:text-base text-gray-600">
                    Estimados usuarios, el siguiente formulario tiene <span class="underline underline-offset-1">cierto</span> cupo por lo que es necesario enviarlo el día viernes como fecha <span class="underline underline-offset-1">límite</span>.
                </p>
            </div>

            {{-- MENU --}}
            <div class="col-span-1 md:col-span-2">
                <p class="font-semibold text-orange-500 text-xl uppercase text-left">
                    <i class="fa-solid fa-utensils mr-1"></i> Menú
                </p>
                <span class="text-gray-500 text-sm">El menú se elije al momento de llegada</span>
                <p class="text-sm md:text-base text-gray-600 my-3">
                    Todos los menús incluyen café, té o agua de sabor y fruta de la estación.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <div class="flex flex-col items-center space-y-3">
                        <img
                            class="w-full h-40 block rounded-md shadow-md object-cover"
                            src="{{ asset('img/chilaquiles.jpeg') }}"
                            alt="chilaquiles"
                        >
                        <p class="text-sm md:text-base text-gray-600">
                            <span class="font-semibold">Menú 1:</span>
                            Chilaquiles verdes o rojos con huevo acompañados de una pieza de pan.
                        </p>
                    </div>
                    <div class="flex flex-col items-center space-y-3">
                        <img
                            class="w-full h-40 block rounded-md shadow-md object-cover"
                            src="{{ asset('img/huevos.jpeg') }}"
                            alt="huevos"
                        >
                        <p class="text-sm md:text-base text-gray-600">
                            <span class="font-semibold">Menú 2:</span>
                            Huevos divorciados o a la mexicana acompañados de frijoles refritos y una pieza de pan o tortillas.
                        </p>
                    </div>
                    <div class="flex flex-col items-center space-y-3">
                        <img
                            class="w-full h-40 block rounded-md shadow-md object-cover"
                            src="{{ asset('img/molletes.jpeg') }}"
                            alt="molletes"
                        >
                        <p class="text-sm md:text-base text-gray-600">
                            <span class="font-semibold">Menú 3:</span>
                            Molletes gratinados (4 piezas) acompañados con pico de gallo.
                        </p>
                    </div>
                    <div class="flex flex-col items-center space-y-3">
                        <img
                            class="w-full h-40 block rounded-md shadow-md object-cover"
                            src="{{ asset('img/huarache.jpeg') }}"
                            alt="huarache"
                        >
                        <p class="text-sm md:text-base text-gray-600">
                            <span class="font-semibold">Menú 4:</span>
                            Huarache preparado con frijoles, una cama de lechuga y cecina asada.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-span-1 md:col-span-2 divide-y-2 divide-gray-300 divide-dashed">
                <div></div>
                <div></div>
            </div>

            {{-- FORMULARIO --}}
            <div class="col-span-1 md:col-span-2 flex flex-col md:flex-row justify-center items-center">
                <form action="{{ route('formulario.store')}}" method="POST" class="flex flex-col w-full md:w-1/3" id="formulario-menu">
                    @csrf
                    <p class="font-semibold text-orange-500 text-xl uppercase text-left mb-5">
                        <i class="fa-solid fa-users mr-1"></i> Registro de datos
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="col-span-1 md:col-span-2">
                            <label
                            class="block text-gray-600 text-sm mb-2 font-semibold @error('personas') text-orange-500 @enderror"
                                for="familia"
                            >Nombre de la familia</label>
                            <input
                                type="text"
                                class="flex-1 appearance-none w-full py-2 px-4 bg-white text-gray-600 placeholder-gray-400 shadow-md rounded-r-md text-sm focus:outline-none focus:border-2 focus:border-orange-500 required @error('familia') border-l-4 border-orange-500  @enderror"
                                id="familia"
                                name="familia"
                                placeholder="Ejemplo. Familia Díaz"
                                maxlength="100"
                                value="{{ old('familia') }}"
                            />
                            @error('familia')
                                <div id="msg-error" class="block text-orange-500 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="">
                            <label
                                class="block text-gray-600 text-sm mb-2 font-semibold @error('personas') text-orange-500 @enderror"
                                for="personas"
                            >Número de personas</label>
                            <input
                                type="number"
                                class="flex-1 appearance-none w-full py-2 px-4 bg-white text-gray-600 placeholder-gray-400 shadow-md rounded-r-md text-sm focus:outline-none focus:border-2 focus:border-orange-500 required @error('personas') border-l-4 border-orange-500  @enderror"
                                id="personas"
                                name="personas"
                                placeholder="Ejemplo. 1, 2, 3, 4, 5"
                                min="1"
                                max="100"
                                maxlength="3"
                                value="{{ old('personas') }}"
                            />
                            @error('personas')
                                <div id="msg-error" class="block text-orange-500 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="">
                            <label
                                class="block text-gray-600 text-sm mb-2 font-semibold @error('dia') text-orange-500 @enderror"
                                for="dia"
                            >Día</label>
                            <div class="flex justify-between items-center py-2">
                                @php
                                    $sabado = $evaluarDia->first(function($item){
                                        return $item->dia == 'Sábado';
                                    });

                                    $domingo = $evaluarDia->first(function($item){
                                        return $item->dia == 'Domingo';
                                    });
                                @endphp

                                @if(!$sabado || ($sabado && $sabado->mostrar))
                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input
                                            type="radio"
                                            id="dia-1"
                                            name="dia"
                                            class="form-tick radio appearance-none h-5 w-5 border border-gray-300 rounded-md checked:bg-orange-500 checked:border-transparent focus:outline-none"
                                            {{ old('dia') == 'sábado' ? 'checked' : null }}
                                            value="sábado"
                                        />
                                        <span class="text-sm text-gray-600 font-semibold">Sábado</span>
                                    </label>
                                @endif

                                @if(!$domingo || ($domingo && $domingo->mostrar))
                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input
                                            type="radio"
                                            id="dia-2"
                                            name="dia"
                                            class="form-tick radio appearance-none h-5 w-5 border border-gray-300 rounded-md checked:bg-orange-500 checked:border-transparent focus:outline-none"
                                            {{ old('dia') == 'domingo' ? 'checked' : null }}
                                            value="domingo"
                                        />
                                        <span class="text-sm text-gray-600 font-semibold">Domingo</span>
                                    </label>
                                @endif
                            </div>
                            @foreach ($evaluarDia as $evaluar)
                                @if(!$evaluar->mostrar)
                                    <div class="block text-orange-500 text-xs mt-2">El día {{ $evaluar->dia }} llegó a su límite</div>
                                @endif
                            @endforeach
                            @error('dia')
                                <div id="msg-error" class="block text-orange-500 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-span-1 md:col-span-2 flex flex-col md:flex-row md:justify-end">
                            <button
                                type="submit"
                                class="shadow bg-orange-500 hover:opacity-90 text-white px-4 py-2 focus:outline-none focus:shadow-none rounded text-center text-sm uppercase self-stretch md:self-end"
                                id="btn-submit"
                            >Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="col-span-1 md:col-span-2">
                <p class="text-sm md:text-base text-gray-600">
                    Lo sentimos, el cupo de familias ha llegado a su límite. <i class="fa-solid fa-face-frown"></i>
                </p>
            </div>
        @endif
    </div>
@endsection
