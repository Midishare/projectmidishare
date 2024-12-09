<?php

namespace App\Services;

class CholesterolExpertSystem
{
    private $knowledgeBase;
    private $recommendations;

    public function __construct()
    {
        $this->knowledgeBase = [
            'total_cholesterol' => [
                'optimal' => ['min' => 0, 'max' => 200],
                'borderline_high' => ['min' => 200, 'max' => 240],
                'high' => ['min' => 240, 'max' => 999]
            ]
        ];

        $this->recommendations = [
            'total_cholesterol' => [
                'optimal' => [
                    'status' => 'Optimal',
                    'level' => 'Rendah',
                    'risk' => 'Rendah',
                    'advice' => [
                        'Pertahankan gaya hidup sehat',
                        'Konsumsi makanan kaya serat',
                        'Tetap aktif bergerak'
                    ]
                ],
                'borderline_high' => [
                    'status' => 'Borderline Tinggi',
                    'level' => 'Sedang',
                    'risk' => 'Sedang',
                    'advice' => [
                        'Kurangi konsumsi lemak jenuh',
                        'Tingkatkan konsumsi ikan dan biji-bijian',
                        'Pertimbangkan konsultasi dengan dokter'
                    ]
                ],
                'high' => [
                    'status' => 'Tinggi',
                    'level' => 'Tinggi',
                    'risk' => 'Tinggi',
                    'advice' => [
                        'Segera konsultasi dengan dokter',
                        'Lakukan diet rendah kolesterol',
                        'Pertimbangkan terapi medis'
                    ]
                ]
            ]
        ];
    }

    public function analyzeComprehensively($data)
    {
        $statuses = [];
        $risks = [];

        // Analisis Total Kolesterol
        foreach ($this->knowledgeBase['total_cholesterol'] as $status => $range) {
            if ($data['total_cholesterol'] >= $range['min'] && $data['total_cholesterol'] < $range['max']) {
                $statuses['total_cholesterol'] = $status;
                $risks[] = $this->recommendations['total_cholesterol'][$status]['risk'];
                break;
            }
        }

        // Tentukan Risiko Final
        $riskPriority = ['Sangat Tinggi', 'Tinggi', 'Sedang', 'Rendah'];
        $finalRisk = $riskPriority[0];
        foreach ($riskPriority as $risk) {
            if (in_array($risk, $risks)) {
                $finalRisk = $risk;
                break;
            }
        }

        $finalStatus = count($statuses) > 0 ? 'Berisiko' : 'Normal';
        $finalLevel = $finalRisk;

        // Rekomendasi Berdasarkan Total Kolesterol
        $advice = [];
        if (isset($statuses['total_cholesterol'])) {
            $advice = $this->recommendations['total_cholesterol'][$statuses['total_cholesterol']]['advice'];
        }

        return [
            'status' => $finalStatus,
            'level' => $finalLevel,
            'risk' => $finalRisk,
            'advice' => array_unique($advice)
        ];
    }
}
