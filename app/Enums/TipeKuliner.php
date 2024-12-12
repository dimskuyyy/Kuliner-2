<?php

namespace App\Enums;

enum TipeKuliner: string
{
    case SEMUA = 'Semua';
    case CAFE = 'cafe';
    case STREET_FOOD = 'street food';
    case KANTIN = 'kantin';
    case RUMAH_MAKAN = 'rumah makan';
    case RESTORAN = 'restoran';

    public function label(): string
    {
        return match ($this) {
            self::SEMUA => 'Semua',
            self::CAFE => 'Cafe',
            self::STREET_FOOD => 'Street Food',
            self::KANTIN => 'Kantin',
            self::RUMAH_MAKAN => 'Rumah Makan',
            self::RESTORAN => 'Restoran',
        };
    }
}