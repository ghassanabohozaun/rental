<div class="row">

    <!-- begin: input -->
    <div class="form-group col-md-2">
        <label class="sr-only" for="governorate_id">{!! __('users.governorate_id') !!}</label>
        <select type="text" wire:model="governorateId" wire:change="changeGovernorate($event.target.value)"
            id="governoate_id" name="governoate_id" class="form-control">
            <option value="" selected='selected'>
                {!! __('users.select') !!} {!! __('users.governorate_id') !!}
            </option>
            @foreach ($governorates as $key => $governorate)
                <option value="{!! $governorate->id !!}">{!! $governorate->name !!}</option>
            @endforeach
        </select>
    </div>
    <!-- end: input -->


    <!-- begin: input -->

    <div class="form-group col-md-2">
        <label class="sr-only" for="city_id">{!! __(key: 'users.city_id') !!}</label>
        <select type="text" wire:model="cityId" id="city_id" name="city_id" class="form-control">
            <option value="" selected='selected'>
                {!! __('users.select') !!} {!! __('users.city_id') !!}
            </option>
            @foreach ($cities as $key => $city)
                <option value="{!! $city->id !!}">{!! $city->name !!}</option>
            @endforeach
        </select>
    </div>

</div>
