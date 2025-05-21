<?php

namespace Dinakeri\FilamentFlatpickr\Forms\Components;

use Filament\Forms\Components\Field;

class FlatpickrDatePicker extends Field
{
    protected string $view = 'filament-flatpickr::components.flatpickr-date-picker';

    protected bool $shouldShowWeekNumbers = false;

    protected bool $shouldEnableTime = false;

    protected bool $shouldEnable24hrTime = false;

    protected bool $shouldShowNoCalendar = false;

    protected bool $shouldEnableSeconds = false;

    protected $defaultDate = null;

    protected string $flatpickrDateFormat = 'Y-m-d H:i:s';

    protected string $flatpickrMode = 'single';

    public function getFlatpickrConfig(): array
    {
        $config = [
            'dateFormat' => $this->flatpickrDateFormat,
        ];

        $config['weekNumbers'] = $this->shouldShowWeekNumbers;
        $config['enableTime'] = $this->shouldEnableTime;
        $config['time_24hr'] = $this->shouldEnable24hrTime;
        $config['noCalendar'] = $this->shouldShowNoCalendar;
        $config['enableSeconds'] = $this->shouldEnableSeconds;
        $config['mode'] = $this->flatpickrMode;

            if ($this->defaultDate !== null) {
        // Flatpickr converteert dit zelf, als het formaat klopt.
        $config['defaultDate'] = $this->defaultDate;
    } else {
        // Anders gebruikt Flatpickr de 'value' attribute van de input field,
        // wat Filament's $getState() is.
        // Als je hier expliciet niets meegeeft, vertrouwt het op de input value.
    }

        return $config;
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

    public function weekNumbers(bool $condition = true): static
    {
        $this->shouldShowWeekNumbers = $condition;
        return $this;
    }

    public function enableTime(bool $condition = true): static
    {
        $this->shouldEnableTime = $condition;
        return $this;
    }

    public function time24hr(bool $condition = true): static
    {
        $this->shouldEnable24hrTime = $condition;
        return $this;
    }

    public function noCalendar(bool $condition = true): static
    {
        $this->shouldShowNoCalendar = $condition;
        return $this;
    }

    public function enableSeconds(bool $condition = true): static
    {
        $this->shouldEnableSeconds = $condition;
        return $this;
    }

    public function dateFormat(string $format): static
    {
        $this->flatpickrDateFormat = $format;
        return $this;
    }

    public function mode(string $mode): static
    {
        $this->flatpickrMode = $mode;
        return $this;
    }

    public function defaultDate($date): static
    {
        $this->defaultDate = $date;
        return $this;
    }
}
