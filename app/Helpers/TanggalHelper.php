<?php

namespace App\Helpers;

use Carbon\Carbon;

class TanggalHelper
{
    private const BULAN = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    public static function format(\Carbon\Carbon|string|null $date, bool $withDay = false): string
    {
        if (! $date) {
            return '-';
        }

        $carbon = $date instanceof Carbon ? $date : Carbon::parse($date);
        $formatted = $carbon->format('d') . ' '
            . self::BULAN[(int) $carbon->format('n')] . ' '
            . $carbon->format('Y');

        if ($withDay) {
            $hari = self::hariIndonesia($carbon->dayOfWeek);

            return $hari . ', ' . $formatted;
        }

        return $formatted;
    }

    public static function hariIndonesia(int $dayOfWeek): string
    {
        return match ($dayOfWeek) {
            Carbon::SUNDAY => 'Minggu',
            Carbon::MONDAY => 'Senin',
            Carbon::TUESDAY => 'Selasa',
            Carbon::WEDNESDAY => 'Rabu',
            Carbon::THURSDAY => 'Kamis',
            Carbon::FRIDAY => 'Jumat',
            Carbon::SATURDAY => 'Sabtu',
            default => '',
        };
    }
}
