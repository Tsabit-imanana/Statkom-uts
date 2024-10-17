<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Http\Requests\StoreDataRequest;
use App\Http\Requests\UpdateDataRequest;

class DataController extends Controller
{


 // Ganti dengan nama model yang sesuai

 public function show()
 {
     // Mengambil semua data
     $data = Data::all();

 
     // Inisialisasi variabel untuk rata-rata, median, modus, varian, dan standar deviasi
     $scoresGeo = [];
     $scoresPPU = [];
     $scoresKPU = [];
     $scoresSej = [];
 
     // Mengisi data
     foreach ($data as $item) {
         $scoresGeo[] = $item->score_geo;
         $scoresPPU[] = $item->score_ppu;
         $scoresKPU[] = $item->score_kpu;
         $scoresSej[] = $item->score_sej;
     }
 
     // Fungsi untuk menghitung varian dan standar deviasi
     function calculateVarianceAndStdDev($scores, $mean) {
         $variance = 0;
         foreach ($scores as $score) {
             $variance += pow($score - $mean, 2);
         }
         $variance = count($scores) > 0 ? $variance / count($scores) : 0;
         $stdDev = sqrt($variance);
         return ['variance' => $variance, 'stdDev' => $stdDev];
     }
 
     // Menghitung mean, median, modus, varian, dan standar deviasi untuk setiap skor
     $results = [];
     foreach (['geo' => $scoresGeo, 'ppu' => $scoresPPU, 'kpu' => $scoresKPU, 'sej' => $scoresSej] as $key => $scores) {
         $totalScore = array_sum($scores);
         $count = count($scores);
         $mean = $count > 0 ? $totalScore / $count : 0;
 
         // Modus
         $frequency = array_count_values($scores);
         $maxFrequency = max($frequency);
         $mode = array_keys($frequency, $maxFrequency);
 
         // Median
         sort($scores);
         $mid = floor($count / 2);
         $median = ($count % 2 == 0) ? ($scores[$mid - 1] + $scores[$mid]) / 2 : $scores[$mid];
 
         // Varian dan Standar Deviasi
         $varianceStdDev = calculateVarianceAndStdDev($scores, $mean);
 
         // Menyimpan hasil
         $results[$key] = [
             'mean' => $mean,
             'median' => $median,
             'mode' => $mode,
             'variance' => $varianceStdDev['variance'],
             'stdDev' => $varianceStdDev['stdDev'],
         ];
     }


     $ranges = [
        [201, 225], [226, 250], [251, 275], [276, 300], [301, 325], 
        [326, 350], [351, 375], [376, 400], [401, 425], [426, 450], 
        [451, 475], [476, 500], [501, 525], [526, 550], [551, 575], 
        [576, 600], [601, 625], [626, 650], [651, 675], [676, 700], 
        [701, 725], [726, 750], [751, 775], [776, 800], [801, 825], 
        [826, 850], [851, 875], [876, 900]
    ];

    // Ambil semua score_geo dari database
    $data = Data::pluck('score_geo')->toArray();
    
    // Variabel untuk menyimpan hasil distribusi kumulatif
    $cumulativeDistributiongeo = array_map(function($range) use ($data) {
        $upperBound = $range[1];

        // Hitung jumlah data yang lebih besar dari batas atas rentang
        return count(array_filter($data, function($score) use ($upperBound) {
            return $score > $upperBound;
        }));
    }, $ranges);

    $cumulativeDistributiongeoLess = array_map(function($range) use ($data) {
        $lowerBound = $range[0];
    
        // Hitung jumlah data yang kurang dari batas bawah rentang
        return count(array_filter($data, function($score) use ($lowerBound) {
            return $score < $lowerBound; // Menghitung skor yang kurang dari lowerBound
        }));
    }, $ranges);

// Variabel untuk menyimpan hasil distribusi frekuensi
$frequencyDistributiongeo = array_map(function($range) use ($data) {
    $lowerBound = $range[0];
    $upperBound = $range[1];

    // Hitung jumlah data yang dalam rentang
    return count(array_filter($data, function($score) use ($lowerBound, $upperBound) {
        return $score >= $lowerBound && $score <= $upperBound; // Menghitung skor dalam rentang
    }));
}, $ranges);
    // Ambil semua score_Kpu dari database
    $data = Data::pluck('score_Kpu')->toArray();
    
    // Variabel untuk menyimpan hasil distribusi kumulatif
    $cumulativeDistributionKpu = array_map(function($range) use ($data) {
        $upperBound = $range[1];

        // Hitung jumlah data yang lebih besar dari batas atas rentang
        return count(array_filter($data, function($score) use ($upperBound) {
            return $score > $upperBound;
        }));
    }, $ranges);

    $cumulativeDistributionKpuLess = array_map(function($range) use ($data) {
        $lowerBound = $range[0];
    
        // Hitung jumlah data yang kurang dari batas bawah rentang
        return count(array_filter($data, function($score) use ($lowerBound) {
            return $score < $lowerBound; // Menghitung skor yang kurang dari lowerBound
        }));
    }, $ranges);

// Variabel untuk menyimpan hasil distribusi frekuensi
$frequencyDistributionKpu = array_map(function($range) use ($data) {
    $lowerBound = $range[0];
    $upperBound = $range[1];

    // Hitung jumlah data yang dalam rentang
    return count(array_filter($data, function($score) use ($lowerBound, $upperBound) {
        return $score >= $lowerBound && $score <= $upperBound; // Menghitung skor dalam rentang
    }));
}, $ranges);
    // Ambil semua score_ppu dari database
    $data = Data::pluck('score_ppu')->toArray();
    
    // Variabel untuk menyimpan hasil distribusi kumulatif
    $cumulativeDistributionppu = array_map(function($range) use ($data) {
        $upperBound = $range[1];

        // Hitung jumlah data yang lebih besar dari batas atas rentang
        return count(array_filter($data, function($score) use ($upperBound) {
            return $score > $upperBound;
        }));
    }, $ranges);

    $cumulativeDistributionppuLess = array_map(function($range) use ($data) {
        $lowerBound = $range[0];
    
        // Hitung jumlah data yang kurang dari batas bawah rentang
        return count(array_filter($data, function($score) use ($lowerBound) {
            return $score < $lowerBound; // Menghitung skor yang kurang dari lowerBound
        }));
    }, $ranges);

// Variabel untuk menyimpan hasil distribusi frekuensi
$frequencyDistributionppu = array_map(function($range) use ($data) {
    $lowerBound = $range[0];
    $upperBound = $range[1];

    // Hitung jumlah data yang dalam rentang
    return count(array_filter($data, function($score) use ($lowerBound, $upperBound) {
        return $score >= $lowerBound && $score <= $upperBound; // Menghitung skor dalam rentang
    }));
}, $ranges);
    // Ambil semua score_sej dari database
    $data = Data::pluck('score_sej')->toArray();
    
    // Variabel untuk menyimpan hasil distribusi kumulatif
    $cumulativeDistributionsej = array_map(function($range) use ($data) {
        $upperBound = $range[1];

        // Hitung jumlah data yang lebih besar dari batas atas rentang
        return count(array_filter($data, function($score) use ($upperBound) {
            return $score > $upperBound;
        }));
    }, $ranges);

    $cumulativeDistributionsejLess = array_map(function($range) use ($data) {
        $lowerBound = $range[0];
    
        // Hitung jumlah data yang kurang dari batas bawah rentang
        return count(array_filter($data, function($score) use ($lowerBound) {
            return $score < $lowerBound; // Menghitung skor yang kurang dari lowerBound
        }));
    }, $ranges);

// Variabel untuk menyimpan hasil distribusi frekuensi
$frequencyDistributionsej = array_map(function($range) use ($data) {
    $lowerBound = $range[0];
    $upperBound = $range[1];

    // Hitung jumlah data yang dalam rentang
    return count(array_filter($data, function($score) use ($lowerBound, $upperBound) {
        return $score >= $lowerBound && $score <= $upperBound; // Menghitung skor dalam rentang
    }));
}, $ranges);

 

 
     $chart = [
        'geo' => [
            'labels' => [
    [0.223, 0.250], [0.251, 0.278], [0.279, 0.306], [0.307, 0.333], 
    [0.334, 0.361], [0.362, 0.389], [0.390, 0.417], [0.418, 0.444], 
    [0.446, 0.472], [0.473, 0.500], [0.501, 0.528], [0.529, 0.556], 
    [0.557, 0.583], [0.584, 0.611], [0.612, 0.639], [0.640, 0.667], 
    [0.668, 0.694], [0.696, 0.722], [0.723, 0.750], [0.751, 0.778], 
    [0.779, 0.806], [0.807, 0.833], [0.834, 0.861], [0.862, 0.889], 
    [0.890, 0.917], [0.918, 0.944], [0.946, 0.972], [0.973, 1.000]
            ],
            'data_frek_kom_greater' => $cumulativeDistributiongeo,
            'data_frek_kom_less' =>$cumulativeDistributiongeoLess ,
            'data_frek' => $frequencyDistributiongeo,
        ],
        'kpu' => [
            'labels' => [
                [0.223, 0.250], [0.251, 0.278], [0.279, 0.306], [0.307, 0.333], 
                [0.334, 0.361], [0.362, 0.389], [0.390, 0.417], [0.418, 0.444], 
                [0.446, 0.472], [0.473, 0.500], [0.501, 0.528], [0.529, 0.556], 
                [0.557, 0.583], [0.584, 0.611], [0.612, 0.639], [0.640, 0.667], 
                [0.668, 0.694], [0.696, 0.722], [0.723, 0.750], [0.751, 0.778], 
                [0.779, 0.806], [0.807, 0.833], [0.834, 0.861], [0.862, 0.889], 
                [0.890, 0.917], [0.918, 0.944], [0.946, 0.972], [0.973, 1.000]
            ],
            'data_frek_kom_greater' => $cumulativeDistributionKpu,
            'data_frek_kom_less' =>$cumulativeDistributionKpuLess ,
            'data_frek' => $frequencyDistributionKpu,   
        ],
        'ppu' => [
            'labels' => [
                [0.223, 0.250], [0.251, 0.278], [0.279, 0.306], [0.307, 0.333], 
    [0.334, 0.361], [0.362, 0.389], [0.390, 0.417], [0.418, 0.444], 
    [0.446, 0.472], [0.473, 0.500], [0.501, 0.528], [0.529, 0.556], 
    [0.557, 0.583], [0.584, 0.611], [0.612, 0.639], [0.640, 0.667], 
    [0.668, 0.694], [0.696, 0.722], [0.723, 0.750], [0.751, 0.778], 
    [0.779, 0.806], [0.807, 0.833], [0.834, 0.861], [0.862, 0.889], 
    [0.890, 0.917], [0.918, 0.944], [0.946, 0.972], [0.973, 1.000]
            ],
            'data_frek_kom_greater' => $cumulativeDistributionppu,
            'data_frek_kom_less' =>$cumulativeDistributionppuLess ,
            'data_frek' => $frequencyDistributionppu,   
        ],
        'sej' => [
            'labels' => [
                [0.223, 0.250], [0.251, 0.278], [0.279, 0.306], [0.307, 0.333], 
    [0.334, 0.361], [0.362, 0.389], [0.390, 0.417], [0.418, 0.444], 
    [0.446, 0.472], [0.473, 0.500], [0.501, 0.528], [0.529, 0.556], 
    [0.557, 0.583], [0.584, 0.611], [0.612, 0.639], [0.640, 0.667], 
    [0.668, 0.694], [0.696, 0.722], [0.723, 0.750], [0.751, 0.778], 
    [0.779, 0.806], [0.807, 0.833], [0.834, 0.861], [0.862, 0.889], 
    [0.890, 0.917], [0.918, 0.944], [0.946, 0.972], [0.973, 1.000]
            ], // X-axis labels
            'data_frek_kom_greater' => $cumulativeDistributionsej,
            'data_frek_kom_less' =>$cumulativeDistributionsejLess ,
            'data_frek' => $frequencyDistributionsej,   
        ],

    ];


     // Identitas teman
     $teman1 = 'Tsabit Imanana';
     $teman2 = 'Nadiyah Myrilla';
     $teman3 = 'Salsabila Nuha Aini';
     $data = Data::all(); // Ambil semua data

     // Ambil nilai skor dari setiap item dalam koleksi
     $scoresGeo = $data->pluck('score_geo');
     $scoresPPU = $data->pluck('score_ppu');
     $scoresKPU = $data->pluck('score_kpu');
     $scoresSej = $data->pluck('score_sej');
     
     return view('data', [
         'teman1' => $teman1,
         'teman2' => $teman2,
         'teman3' => $teman3,
         'results' => $results,
         'chart' => $chart,
         'data' => [
             'score_geo' => $scoresGeo, // Mengisi array dengan nilai dari pluck
             'score_ppu' => $scoresPPU,
             'score_kpu' => $scoresKPU,
             'score_sej' => $scoresSej
         ]
     ]);
 }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * Show the form for editing the specified resource.
     */
    public function edit(Data $data)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDataRequest $request, Data $data)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Data $data)
    {
        //
    }
}
