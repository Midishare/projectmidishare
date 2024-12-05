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
            ],
            'ldl_cholesterol' => [
                'optimal' => ['min' => 0, 'max' => 100],
                'near_optimal' => ['min' => 100, 'max' => 130],
                'borderline_high' => ['min' => 130, 'max' => 160],
                'high' => ['min' => 160, 'max' => 190],
                'very_high' => ['min' => 190, 'max' => 999]
            ],
            'hdl_cholesterol' => [
                'low' => ['min' => 0, 'max' => 40],
                'good' => ['min' => 40, 'max' => 60],
                'high' => ['min' => 60, 'max' => 999]
            ],
            'triglycerides' => [
                'normal' => ['min' => 0, 'max' => 150],
                'borderline_high' => ['min' => 150, 'max' => 200],
                'high' => ['min' => 200, 'max' => 500],
                'very_high' => ['min' => 500, 'max' => 999]
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
            ],
            'ldl_cholesterol' => [
                'optimal' => [
                    'status' => 'Optimal',
                    'level' => 'Rendah',
                    'risk' => 'Rendah',
                    'advice' => [
                        'Tetap pertahankan gaya hidup sehat',
                        'Konsumsi makanan yang kaya antioksidan',
                        'Rajin berolahraga'
                    ]
                ],
                'near_optimal' => [
                    'status' => 'Hampir Optimal',
                    'level' => 'Rendah',
                    'risk' => 'Rendah',
                    'advice' => [
                        'Konsumsi lebih banyak serat larut',
                        'Kurangi konsumsi lemak trans',
                        'Pertimbangkan suplemen omega-3'
                    ]
                ],
                'borderline_high' => [
                    'status' => 'Borderline Tinggi',
                    'level' => 'Sedang',
                    'risk' => 'Sedang',
                    'advice' => [
                        'Ubah pola makan',
                        'Tingkatkan aktivitas fisik',
                        'Konsultasikan dengan ahli gizi'
                    ]
                ],
                'high' => [
                    'status' => 'Tinggi',
                    'level' => 'Tinggi',
                    'risk' => 'Tinggi',
                    'advice' => [
                        'Segera konsultasi dengan dokter',
                        'Pertimbangkan terapi menurunkan LDL',
                        'Lakukan diet ketat'
                    ]
                ],
                'very_high' => [
                    'status' => 'Sangat Tinggi',
                    'level' => 'Sangat Tinggi',
                    'risk' => 'Sangat Tinggi',
                    'advice' => [
                        'Lakukan pemeriksaan menyeluruh',
                        'Konsultasi dokter spesialis',
                        'Pertimbangkan terapi medis intensif'
                    ]
                ]
            ]
        ];
    }

    public function analyzeComprehensively($data)
    {
        $statuses = [];
        $risks = [];

        foreach ($this->knowledgeBase['total_cholesterol'] as $status => $range) {
            if ($data['total_cholesterol'] >= $range['min'] && $data['total_cholesterol'] < $range['max']) {
                $statuses['total_cholesterol'] = $status;
                $risks[] = $this->recommendations['total_cholesterol'][$status]['risk'];
                break;
            }
        }

        foreach ($this->knowledgeBase['ldl_cholesterol'] as $status => $range) {
            if ($data['ldl_cholesterol'] >= $range['min'] && $data['ldl_cholesterol'] < $range['max']) {
                $statuses['ldl_cholesterol'] = $status;
                break;
            }
        }

        $riskPriority = ['Sangat Tinggi', 'Tinggi', 'Sedang', 'Rendah'];
        $finalRisk = $riskPriority[0];
        foreach ($riskPriority as $risk) {
            if (in_array($risk, $risks)) {
                $finalRisk = $risk;
                break;
            }
        }

        $finalStatus = count($statuses) > 1 ? 'Berisiko' : 'Normal';
        $finalLevel = $finalRisk;

        $advice = [];
        if (isset($statuses['total_cholesterol'])) {
            $advice = $this->recommendations['total_cholesterol'][$statuses['total_cholesterol']]['advice'];
        }
        if (isset($statuses['ldl_cholesterol'])) {
            $advice = array_merge($advice, $this->recommendations['ldl_cholesterol'][$statuses['ldl_cholesterol']]['advice']);
        }

        return [
            'status' => $finalStatus,
            'level' => $finalLevel,
            'risk' => $finalRisk,
            'advice' => array_unique($advice)
        ];
    }
}
