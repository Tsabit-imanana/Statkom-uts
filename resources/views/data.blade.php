<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Presentation</title>
    <!-- Tambahkan CDN untuk Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
      
    </style>
</head>
<body>
    <div class="team-introduction"> <!-- New wrapper div for dark background -->
        <div class="team-introduction-text">INTRODUCTION OUR</div>
        <div class="team-introduction-text-team">TEAM</div>
        <div class="team-members">
            <div class="member">
                <img src="{{ asset('images/tsabit.png') }}" alt="Photo of {{ $teman1 }}" class="member-photo">
                <div class="member-info">
                    <h3>{{ $teman1 }}</h3>
                    <p>NPM: 23081010139</p> <!-- Ganti dengan NPM sebenarnya -->
                </div>
            </div>
            <div class="member">
                <img src="{{ asset('images/tsabit.png') }}" alt="Photo of {{ $teman2 }}" class="member-photo">
                <div class="member-info"> 
                    <h3>{{ $teman2 }}</h3>
                    <p>NPM: 23081010206</p> <!-- Ganti dengan NPM sebenarnya -->
                </div>
            </div>
            <div class="member">
                <img src="{{ asset('images/tsabit.png') }}" alt="Photo of {{ $teman3 }}" class="member-photo">
                <div class="member-info">
                    <h3>{{ $teman3 }}</h3>
                    <p>NPM: 23081010201</p> <!-- Ganti dengan NPM sebenarnya -->
                </div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Score Geo</th>
                    <th>Score PPU</th>
                    <th>Score KPU</th>
                    <th>Score Sej</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['score_geo'] as $index => $geo): ?>
                    <tr>
                        <td><?= $geo; ?></td>
                        <td><?= $data['score_ppu'][$index]; ?></td>
                        <td><?= $data['score_kpu'][$index]; ?></td>
                        <td><?= $data['score_sej'][$index]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            
        </table>
    </div>
    
<!-- Penyajian Data (Mean, Median, Modus) -->
<div class="main-section-title">PENGOLAHAN DATA</div>
<div class="main-section-title-type">MEAN</div>
<div class="data-row">
    <img src="{{ asset('images/mean.png') }}" alt="" srcset="">
    <div class="data-item"><p>Score Geo:</p> <p>{{ $results['geo']['mean'] }}</p></div>
    <div class="data-item"><p>Score KPU:</p> <p>{{ $results['kpu']['mean'] }}</p></div>
    <div class="data-item"><p>Score PPU:</p> <p>{{ $results['ppu']['mean'] }}</p></div>
    <div class="data-item"><p>Score Sej:</p> <p>{{ $results['sej']['mean'] }}</p></div>

</div>

<div class="main-section-title">PENGOLAHAN DATA</div>
<div class="main-section-title-type">MODUS</div>
<div class="data-row">
    <img src="{{ asset('images/modus.png') }}" alt="" srcset="">
    <div class="data-item"> <p>Score Geo:</p>
        @if (count($results['geo']['mode']) > 1)
            {{ implode(', ', $results['geo']['mode']) }}
        @else
            {{ $results['geo']['mode'][0] }}
        @endif
    </div>
    <div class="data-item"><p>Score KPU: </p>
        @if (count($results['kpu']['mode']) > 1)
            {{ implode(', ', $results['kpu']['mode']) }}
        @else
            {{ $results['kpu']['mode'][0] }}
        @endif
    </div>
    <div class="data-item"><p>Score PPU: </p>
        @if (count($results['ppu']['mode']) > 1)
            {{ implode(', ', $results['ppu']['mode']) }}
        @else
            {{ $results['ppu']['mode'][0] }}
        @endif
    </div>
    <div class="data-item"><p>Score Sej: </p>
        @if (count($results['sej']['mode']) > 1)
            {{ implode(', ', $results['sej']['mode']) }}
        @else
            {{ $results['sej']['mode'][0] }}
        @endif
    </div>
</div>

<div class="main-section-title">PENGOLAHAN DATA</div>
<div class="main-section-title-type">MEDIAN</div>
<div class="data-row">
    <img src="{{ asset('images/median.png') }}" alt="" srcset="">
    <div class="data-item"><p>Score Geo: </p> {{ $results['geo']['median'] }}</div>
    <div class="data-item"><p>Score KPU: </p> {{ $results['kpu']['median'] }}</div>
    <div class="data-item"><p>Score PPU: </p> {{ $results['ppu']['median'] }}</div>
    <div class="data-item"><p>Score Sej: </p> {{ $results['sej']['median'] }}</div>
</div>

<div class="main-section-title">PENGOLAHAN DATA</div>
<div class="main-section-title-type">VARIAN</div>
<div class="data-row">
    <img src="{{ asset('images/VARIAN.png') }}" alt="" srcset="">
    <div class="data-item"><p>Score Geo: </p> {{ $results['geo']['variance'] }}</div>
    <div class="data-item"><p>Score KPU: </p> {{ $results['kpu']['variance'] }}</div>
    <div class="data-item"><p>Score PPU: </p> {{ $results['ppu']['variance'] }}</div>
    <div class="data-item"><p>Score Sej: </p> {{ $results['sej']['variance'] }}</div>
</div>

<div class="main-section-title">PENGOLAHAN DATA</div>
<div class="main-section-title-type">Standart deviasi</div>
<div class="data-row">
    <img src="{{ asset('images/STRDEV.png') }}" alt="" srcset="">
    <div class="data-item"><p>Score Geo: </p> {{ $results['geo']['stdDev'] }}</div>
    <div class="data-item"><p>Score KPU: </p> {{ $results['kpu']['stdDev'] }}</div>
    <div class="data-item"><p>Score PPU: </p> {{ $results['ppu']['stdDev'] }}</div>
    <div class="data-item"><p>Score Sej: </p> {{ $results['sej']['stdDev'] }}</div>
</div>

<div class="main-section-title">DISTRIBUSI FREKUENSI</div>
<div class="main-section-title-type">KOMULATIF</div>
<div class="frequency-distribution">
    <h3 class="dataname">Score Geo</h3>
    <canvas id="geoChart" class="chart"></canvas>

    <h3 class="dataname">Score KPU</h3>
    <canvas id="kpuChart" class="chart"></canvas>

    <h3 class="dataname">Score PPU</h3>
    <canvas id="ppuChart" class="chart"></canvas>

    <h3 class="dataname">Score SEJ</h3>
    <canvas id="sejChart" class="chart"></canvas>

</div>
<div class="main-section-title">DISTRIBUSI FREKUENSI</div>
<div class="main-section-title-type">KOMULATIF</div>
<div class="frequency-distribution">
    <h3 class="dataname">Score Geo Percent</h3>
    <canvas id="geoChartPercent" class="chart"></canvas>
    <h3 class="dataname">Score KPU Percent</h3>
    <canvas id="kpuChartPercent" class="chart"></canvas>
    <h3 class="dataname">Score PPU Percent</h3>
    <canvas id="ppuChartPercent" class="chart"></canvas>
    <h3 class="dataname">Score SEJ Percent</h3>
    <canvas id="sejChartPercent" class="chart"></canvas>
</div>


<script>
    // Chart for Geo
    var ctxGeo = document.getElementById('geoChart').getContext('2d');
    var geoChart = new Chart(ctxGeo, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chart['geo']['labels']) !!},
            datasets: [{
                label: 'Disk Frek Kom >',
                data: {!! json_encode($chart['geo']['data_frek_kom_greater']) !!},
                backgroundColor: 'rgba(128, 128, 128, 0.5)',
                borderColor: 'rgba(128, 128, 128, 1)',
                borderWidth: 1
            },
            {
                label: 'Disk Frek Kom <',
                data: {!! json_encode($chart['geo']['data_frek_kom_less']) !!},
                backgroundColor: 'rgba(255, 165, 0, 0.5)',
                borderColor: 'rgba(255, 165, 0, 1)',
                borderWidth: 1
            },
            {
                label: 'Dist Frek',
                data: {!! json_encode($chart['geo']['data_frek']) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Chart for KPU
    var ctxKpu = document.getElementById('kpuChart').getContext('2d');
    var kpuChart = new Chart(ctxKpu, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chart['kpu']['labels']) !!},
            datasets: [{
                label: 'Disk Frek Kom >',
                data: {!! json_encode($chart['kpu']['data_frek_kom_greater']) !!},
                backgroundColor: 'rgba(128, 128, 128, 0.5)',
                borderColor: 'rgba(128, 128, 128, 1)',
                borderWidth: 1
            },
            {
                label: 'Disk Frek Kom <',
                data: {!! json_encode($chart['kpu']['data_frek_kom_less']) !!},
                backgroundColor: 'rgba(255, 165, 0, 0.5)',
                borderColor: 'rgba(255, 165, 0, 1)',
                borderWidth: 1
            },
            {
                label: 'Dist Frek',
                data: {!! json_encode($chart['kpu']['data_frek']) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    // Chart for ppu
    var ctxppu = document.getElementById('ppuChart').getContext('2d');
    var ppuChart = new Chart(ctxppu, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chart['ppu']['labels']) !!},
            datasets: [{
                label: 'Disk Frek Kom >',
                data: {!! json_encode($chart['ppu']['data_frek_kom_greater']) !!},
                backgroundColor: 'rgba(128, 128, 128, 0.5)',
                borderColor: 'rgba(128, 128, 128, 1)',
                borderWidth: 1
            },
            {
                label: 'Disk Frek Kom <',
                data: {!! json_encode($chart['ppu']['data_frek_kom_less']) !!},
                backgroundColor: 'rgba(255, 165, 0, 0.5)',
                borderColor: 'rgba(255, 165, 0, 1)',
                borderWidth: 1
            },
            {
                label: 'Dist Frek',
                data: {!! json_encode($chart['ppu']['data_frek']) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    // Chart for sej
    var ctxsej = document.getElementById('sejChart').getContext('2d');
    var sejChart = new Chart(ctxsej, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chart['sej']['labels']) !!},
            datasets: [{
                label: 'Disk Frek Kom >',
                data: {!! json_encode($chart['sej']['data_frek_kom_greater']) !!},
                backgroundColor: 'rgba(128, 128, 128, 0.5)',
                borderColor: 'rgba(128, 128, 128, 1)',
                borderWidth: 1
            },
            {
                label: 'Disk Frek Kom <',
                data: {!! json_encode($chart['sej']['data_frek_kom_less']) !!},
                backgroundColor: 'rgba(255, 165, 0, 0.5)',
                borderColor: 'rgba(255, 165, 0, 1)',
                borderWidth: 1
            },
            {
                label: 'Dist Frek',
                data: {!! json_encode($chart['sej']['data_frek']) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Cari nilai maksimum dari semua data sej
var maxValue = Math.max(
    Math.max(...{!! json_encode($chart['sej']['data_frek_kom_greater']) !!}),
    Math.max(...{!! json_encode($chart['sej']['data_frek_kom_less']) !!}),
    Math.max(...{!! json_encode($chart['sej']['data_frek']) !!})
);

// Fungsi untuk mengonversi nilai menjadi persentase
function convertToPercentage(data, maxValue) {
    return data.map(function(value) {
        return (value / maxValue) * 100;
    });
}

// Data dalam persentase
var dataFrekKomGreaterPercentage = convertToPercentage({!! json_encode($chart['sej']['data_frek_kom_greater']) !!}, maxValue);
var dataFrekKomLessPercentage = convertToPercentage({!! json_encode($chart['sej']['data_frek_kom_less']) !!}, maxValue);
var dataFrekPercentage = convertToPercentage({!! json_encode($chart['sej']['data_frek']) !!}, maxValue);

var ctxsej = document.getElementById('sejChartPercent').getContext('2d');
var sejChart = new Chart(ctxsej, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chart['sej']['labels']) !!},
        datasets: [{
            label: 'Disk Frek Kom >',
            data: dataFrekKomGreaterPercentage,
            backgroundColor: 'rgba(128, 128, 128, 0.5)',
            borderColor: 'rgba(128, 128, 128, 1)',
            borderWidth: 1
        },
        {
            label: 'Disk Frek Kom <',
            data: dataFrekKomLessPercentage,
            backgroundColor: 'rgba(255, 165, 0, 0.5)',
            borderColor: 'rgba(255, 165, 0, 1)',
            borderWidth: 1
        },
        {
            label: 'Dist Frek',
            data: dataFrekPercentage,
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                min: 0,
                max: 100, // Set maximal 100% for y-axis
                ticks: {
                    callback: function(value) {
                        return value + '%'; // Show percentages on y-axis
                    }
                }
            }
        }
    }
});
// Cari nilai maksimum dari semua data geo
var maxValue = Math.max(
    Math.max(...{!! json_encode($chart['geo']['data_frek_kom_greater']) !!}),
    Math.max(...{!! json_encode($chart['geo']['data_frek_kom_less']) !!}),
    Math.max(...{!! json_encode($chart['geo']['data_frek']) !!})
);

// Fungsi untuk mengonversi nilai menjadi persentase
function convertToPercentage(data, maxValue) {
    return data.map(function(value) {
        return (value / maxValue) * 100;
    });
}

// Data dalam persentase
var dataFrekKomGreaterPercentage = convertToPercentage({!! json_encode($chart['geo']['data_frek_kom_greater']) !!}, maxValue);
var dataFrekKomLessPercentage = convertToPercentage({!! json_encode($chart['geo']['data_frek_kom_less']) !!}, maxValue);
var dataFrekPercentage = convertToPercentage({!! json_encode($chart['geo']['data_frek']) !!}, maxValue);

var ctxgeo = document.getElementById('geoChartPercent').getContext('2d');
var geoChart = new Chart(ctxgeo, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chart['geo']['labels']) !!},
        datasets: [{
            label: 'Disk Frek Kom >',
            data: dataFrekKomGreaterPercentage,
            backgroundColor: 'rgba(128, 128, 128, 0.5)',
            borderColor: 'rgba(128, 128, 128, 1)',
            borderWidth: 1
        },
        {
            label: 'Disk Frek Kom <',
            data: dataFrekKomLessPercentage,
            backgroundColor: 'rgba(255, 165, 0, 0.5)',
            borderColor: 'rgba(255, 165, 0, 1)',
            borderWidth: 1
        },
        {
            label: 'Dist Frek',
            data: dataFrekPercentage,
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                min: 0,
                max: 100, // Set maximal 100% for y-axis
                ticks: {
                    callback: function(value) {
                        return value + '%'; // Show percentages on y-axis
                    }
                }
            }
        }
    }
});
// Cari nilai maksimum dari semua data ppu
var maxValue = Math.max(
    Math.max(...{!! json_encode($chart['ppu']['data_frek_kom_greater']) !!}),
    Math.max(...{!! json_encode($chart['ppu']['data_frek_kom_less']) !!}),
    Math.max(...{!! json_encode($chart['ppu']['data_frek']) !!})
);

// Fungsi untuk mengonversi nilai menjadi persentase
function convertToPercentage(data, maxValue) {
    return data.map(function(value) {
        return (value / maxValue) * 100;
    });
}

// Data dalam persentase
var dataFrekKomGreaterPercentage = convertToPercentage({!! json_encode($chart['ppu']['data_frek_kom_greater']) !!}, maxValue);
var dataFrekKomLessPercentage = convertToPercentage({!! json_encode($chart['ppu']['data_frek_kom_less']) !!}, maxValue);
var dataFrekPercentage = convertToPercentage({!! json_encode($chart['ppu']['data_frek']) !!}, maxValue);

var ctxppu = document.getElementById('ppuChartPercent').getContext('2d');
var ppuChart = new Chart(ctxppu, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chart['ppu']['labels']) !!},
        datasets: [{
            label: 'Disk Frek Kom >',
            data: dataFrekKomGreaterPercentage,
            backgroundColor: 'rgba(128, 128, 128, 0.5)',
            borderColor: 'rgba(128, 128, 128, 1)',
            borderWidth: 1
        },
        {
            label: 'Disk Frek Kom <',
            data: dataFrekKomLessPercentage,
            backgroundColor: 'rgba(255, 165, 0, 0.5)',
            borderColor: 'rgba(255, 165, 0, 1)',
            borderWidth: 1
        },
        {
            label: 'Dist Frek',
            data: dataFrekPercentage,
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                min: 0,
                max: 100, // Set maximal 100% for y-axis
                ticks: {
                    callback: function(value) {
                        return value + '%'; // Show percentages on y-axis
                    }
                }
            }
        }
    }
});
// Cari nilai maksimum dari semua data kpu
var maxValue = Math.max(
    Math.max(...{!! json_encode($chart['kpu']['data_frek_kom_greater']) !!}),
    Math.max(...{!! json_encode($chart['kpu']['data_frek_kom_less']) !!}),
    Math.max(...{!! json_encode($chart['kpu']['data_frek']) !!})
);

// Fungsi untuk mengonversi nilai menjadi persentase
function convertToPercentage(data, maxValue) {
    return data.map(function(value) {
        return (value / maxValue) * 100;
    });
}

// Data dalam persentase
var dataFrekKomGreaterPercentage = convertToPercentage({!! json_encode($chart['kpu']['data_frek_kom_greater']) !!}, maxValue);
var dataFrekKomLessPercentage = convertToPercentage({!! json_encode($chart['kpu']['data_frek_kom_less']) !!}, maxValue);
var dataFrekPercentage = convertToPercentage({!! json_encode($chart['kpu']['data_frek']) !!}, maxValue);

var ctxkpu = document.getElementById('kpuChartPercent').getContext('2d');
var kpuChart = new Chart(ctxkpu, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chart['kpu']['labels']) !!},
        datasets: [{
            label: 'Disk Frek Kom >',
            data: dataFrekKomGreaterPercentage,
            backgroundColor: 'rgba(128, 128, 128, 0.5)',
            borderColor: 'rgba(128, 128, 128, 1)',
            borderWidth: 1
        },
        {
            label: 'Disk Frek Kom <',
            data: dataFrekKomLessPercentage,
            backgroundColor: 'rgba(255, 165, 0, 0.5)',
            borderColor: 'rgba(255, 165, 0, 1)',
            borderWidth: 1
        },
        {
            label: 'Dist Frek',
            data: dataFrekPercentage,
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                min: 0,
                max: 100, // Set maximal 100% for y-axis
                ticks: {
                    callback: function(value) {
                        return value + '%'; // Show percentages on y-axis
                    }
                }
            }
        }
    }
});


   
</script>




</body>
</html>
