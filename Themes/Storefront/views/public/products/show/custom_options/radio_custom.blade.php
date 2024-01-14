<div class="form-group variant-custom-selection {{$option->name == "Color" ? 'option-color' : ''}}">
    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <label>
                {!!
                    $option->name .
                    ($option->is_required ? '<span>*</span>' : '')
                !!}
            </label>
        </div>

        <div class="col-xl-10 col-lg-12">
            @if(strtolower($option->name) === "color")
            <ul class="list-inline form-custom-radio custom-selection">
                <?php $i = 1; ?>
                @foreach ($option->values as $value)
                    <li data-index="{{$i}}"
                        :class="{ active: customRadioTypeOptionValueIsActive({{ $option->id }}, {{ $value->id }}) }"
                        @click="syncCustomRadioTypeOptionValue({{ $option->id }}, {{ $value->id }})"
                    >
                        <div class="box-color" style="background: {{$value->label}}"></div>
                        {!!$value->formattedPriceForProduct($product)!!}
                    </li>
                    <?php $i++; ?>
                @endforeach
            </ul>
            @else
            <ul class="list-inline form-custom-radio custom-selection">
                @foreach ($option->values as $value)
                    <li
                        :class="{ active: customRadioTypeOptionValueIsActive({{ $option->id }}, {{ $value->id }}) }"
                        @click="syncCustomRadioTypeOptionValue({{ $option->id }}, {{ $value->id }})"
                    >
                        {!!
                            $value->label .
                            $value->formattedPriceForProduct($product)
                        !!}
                    </li>
                @endforeach
            </ul>
            @endif
            <span
                class="error-message"
                v-if="errors.has('{{ "options.{$option->id}" }}')"
                v-text="errors.get('{{ "options.{$option->id}" }}')"
            >
        </div>
    </div>
</div>
