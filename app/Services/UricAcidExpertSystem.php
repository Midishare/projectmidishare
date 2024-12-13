<?php

namespace App\Services;

class UricAcidExpertSystem
{
    private $knowledgeBase;
    private $recommendations;

    public function __construct()
    {
        $this->knowledgeBase = [
            'male' => [
                'low' => ['min' => 0, 'max' => 3.4],
                'normal' => ['min' => 3.4, 'max' => 7.0],
                'high' => ['min' => 7.0, 'max' => 999]
            ],
            'female' => [
                'low' => ['min' => 0, 'max' => 2.4],
                'normal' => ['min' => 2.4, 'max' => 6.0],
                'high' => ['min' => 6.0, 'max' => 999]
            ]
        ];

        $this->recommendations = [
            'low' => [
                'status' => 'Rendah',
                'level' => 'Rendah',
                'risk' => 'Perlu Perhatian',
                'advice' => [
                    'Konsultasi dengan dokter untuk mengetahui penyebab',
                    'Periksa kesehatan secara menyeluruh',
                    'Pastikan asupan nutrisi cukup',
                    'Pertimbangkan suplemen atau diet khusus'
                ]
            ],
            'normal' => [
                'status' => 'Normal',
                'level' => 'Normal',
                'risk' => 'Rendah',
                'advice' => [
                    'Pertahankan pola makan sehat',
                    'Rutin berolahraga',
                    'Hindari konsumsi alkohol berlebihan',
                    'Lakukan pemeriksaan berkala setiap 6 bulan'
                ]
            ],
            'high' => [
                'status' => 'Tinggi',
                'level' => 'Tinggi',
                'risk' => 'Tinggi',
                'advice' => [
                    'Segera konsultasi dengan dokter',
                    'Kurangi konsumsi makanan tinggi purin',
                    'Batasi konsumsi daging merah',
                    'Tingkatkan konsumsi air putih',
                    'Hindari alkohol dan minuman bersoda',
                    'Pertimbangkan diet rendah purin'
                ]
            ]
        ];
    }

    public function analyze($uricAcid, $gender)
    {
        $rules = $this->knowledgeBase[strtolower($gender)];

        foreach ($rules as $status => $range) {
            if ($uricAcid >= $range['min'] && $uricAcid < $range['max']) {
                return $this->recommendations[$status];
            }
        }

        return $this->recommendations['normal'];
    }

    public function assessOverallStatus($userUricAcids)
    {
        if ($userUricAcids->isEmpty()) {
            return (object)[
                'result_status' => 'Belum Ada Data',
                'result_level' => 'Tidak Diketahui',
                'result_risk' => 'Perlu Pemeriksaan',
                'uric_acid_level' => 0,
                'checked_at' => now()
            ];
        }

        $latestRecord = $userUricAcids->sortByDesc('checked_at')->first();

        if (!$latestRecord) {
            return (object)[
                'result_status' => 'Belum Ada Data',
                'result_level' => 'Tidak Diketahui',
                'result_risk' => 'Perlu Pemeriksaan',
                'uric_acid_level' => 0,
                'checked_at' => now()
            ];
        }

        $result = $this->analyze($latestRecord->uric_acid_level, $latestRecord->gender);

        return (object)[
            'result_status' => $result['status'],
            'result_level' => $result['level'],
            'result_risk' => $result['risk'],
            'uric_acid_level' => $latestRecord->uric_acid_level,
            'checked_at' => $latestRecord->checked_at
        ];
    }
}
