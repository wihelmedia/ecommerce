(function () {
    var ctx = document.getElementById('myChart').getContext('2d');
    var jumlah_warga = $('#jumlah_warga').val();
    var laki_laki = $('#laki_laki').val();
    var perempuan = $('#perempuan').val();
    var katholik = $('#katholik').val();
    var islam = $('#islam').val();
    var masih_hidup = $('#masih_hidup').val();
    var meninggal = $('#meninggal').val();
    var myChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: ['Jumlah Warga', 'Perempuan', 'Laki-Laki', 'Katholik', 'Islam', 'Masih Hidup', 'Meninggal'],
            datasets: [{
                label: '# of Votes',
                data: [jumlah_warga, perempuan, laki_laki, katholik, islam, masih_hidup, meninggal],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
})();