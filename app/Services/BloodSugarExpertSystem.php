<?php

namespace App\Services;

class BloodSugarExpertSystem
{
    private $knowledgeBase;
    private $recommendations;

    public function __construct()
    {
        $this->knowledgeBase = [
            'puasa' => [
                'normal' => ['min' => 70, 'max' => 100],
                'prediabetes' => ['min' => 100, 'max' => 126],
                'diabetes' => ['min' => 126, 'max' => 999]
            ],
            'setelah_makan' => [
                'normal' => ['min' => 70, 'max' => 140],
                'prediabetes' => ['min' => 140, 'max' => 200],
                'diabetes' => ['min' => 200, 'max' => 999]
            ]
        ];

        $this->recommendations = [
            'normal' => [
                'status' => 'Normal',
                'level' => 'Normal',
                'risk' => 'Rendah',
                'advice' => [
                    'Pertahankan pola makan sehat',
                    'Lakukan olahraga teratur',
                    'Cek kadar gula secara rutin setiap 6 bulan'
                ]
            ],
            'prediabetes' => [
                'status' => 'Prediabetes',
                'level' => 'Tinggi',
                'risk' => 'Sedang',
                'advice' => [
                    'Kurangi konsumsi gula dan karbohidrat',
                    'Tingkatkan aktivitas fisik',
                    'Konsultasi dengan dokter',
                    'Cek kadar gula setiap 3 bulan'
                ]
            ],
            'diabetes' => [
                'status' => 'Diabetes',
                'level' => 'Sangat Tinggi',
                'risk' => 'Tinggi',
                'advice' => [
                    'Segera konsultasi dengan dokter',
                    'Pantau kadar gula secara teratur',
                    'Ikuti anjuran diet dari dokter',
                    'Cek kadar gula setiap hari'
                ]
            ]
        ];
    }

    public function analyze($bloodSugar, $condition)
    {
        $rules = $this->knowledgeBase[$condition];

        if ($bloodSugar < 70) {
            return [
                'status' => 'Hipoglikemia',
                'level' => 'Rendah',
                'risk' => 'Tinggi',
                'advice' => [
                    'Segera konsumsi gula',
                    'Hubungi dokter jika kondisi tidak membaik',
                    'Perlu penanganan segera'
                ]
            ];
        }

        foreach ($rules as $status => $range) {
            if ($bloodSugar >= $range['min'] && $bloodSugar < $range['max']) {
                return $this->recommendations[$status];
            }
        }
    }
}
