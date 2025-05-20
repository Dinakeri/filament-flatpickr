<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
<input
    x-data
    x-init="
        let config = {{ json_encode($getFlatpickrConfig()) }};

        const disableWeekends = $el.dataset.disableWeekends === 'true';
        const disabledDaysAttr = $el.dataset.disabledDays;
        const disabledDatesAttr = $el.dataset.disabledDates;

        const disableArray = [];

        if (disableWeekends || disabledDaysAttr) {
            const disabledDays = [];

            if (disableWeekends) {
                disabledDays.push(0, 6);
            }

            if (disabledDaysAttr) {
                disabledDays.push(...disabledDaysAttr.split(',').map(Number));
            }

            disableArray.push(function(date) {
                return disabledDays.includes(date.getDay());
            });
        }

        if (disabledDatesAttr) {
            try {
                console.log(disabledDatesAttr)
                const parsedDates = JSON.parse(disabledDatesAttr);
                disableArray.push(...parsedDates);
            } catch (e) {
                console.error('Invalid data-disabled-dates:', e);
            }
        }

        if (disableArray.length > 0) {
            config.disable = disableArray;
        }

        flatpickr($el, config);
    "
    {{ $attributes->merge([
        'type' => 'text',
        'id' => $getId(),
        'name' => $getName(),
        'value' => $getState(),
        'class' => 'filament-input block w-full transition duration-75 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500',
        'data-disable-weekends' => $shouldDisableWeekends() ? 'true' : 'false',
        'data-disabled-days' => $getExtraAttributes()['data-disabled-days'] ?? '',
        'data-disabled-dates' => isset($getExtraAttributes()['data-disabled-dates'])
         ? new \Illuminate\Support\HtmlString($getExtraAttributes()['data-disabled-dates'])
         : '',
    ]) }}
/>
</x-dynamic-component>
