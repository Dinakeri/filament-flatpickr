<?php

namespace Dinakeri\FilamentFlatpickr\Forms\Components;

use Filament\Forms\Components\Field;

class FlatpickrDatePicker extends Field
{
    protected string $view = 'filament-flatpickr::components.flatpickr-date-picker';

    public function getFlatpickrConfig(): array
    {
        return [
            'dateFormat' => 'Y-m-d',
        ];
    }

    protected bool $shouldDisableWeekends = false;

    public function disableWeekends(bool $condition = true): static
    {
        $this->shouldDisableWeekends = $condition;

        return $this;
    }

    public function shouldDisableWeekends(): bool
    {
        return $this->shouldDisableWeekends;
    }


    public function disableDays(array $days): static
    {

        $this->extraAttributes(array_merge(
            $this->getExtraAttributes(),
            ['data-disabled-days' => implode(',', $days)]
        ));

        return $this;
    }

    protected array $disabledDates = [];

    public function disableDates(array $dates): static
    {
        $this->disabledDates = $dates;


        return $this->extraAttributes(array_merge(
            $this->getExtraAttributes(),
            ['data-disabled-dates' => json_encode($dates)]
        ));
    }

    public function getDisabledDates(): array
    {
        return $this->disabledDates;
    }
}
