<?php
$labels = [];
$valor = [];
$quantidade = [];
$mtd_pay = [];
$sts_pay = [];
foreach ($data['vendas'] as $row) {

    $labels[] = explode(" ", $row['created_at'])[0]; // Use a data como rótulo
    $quantidade[] = $row['quantidade'];
    $valor[] = $row['valor'];
    $mtd_pay[] = $row['mtd_pay'];
    $sts_pay[] = $row['sts_pay'];
}
foreach ($data['soma_venda'] as $row) {
    $soma_venda = $row['SUM(valor)'];
}
foreach ($data['vendas_canceladas'] as $row) {
    $vendas_canceladas_avg = $row['COUNT(id)'];
    $vendas_canceladas_date = $row['created_at'];
}

foreach ($data['vendas_confirmadas'] as $row) {
    $vendas_confirmadas_avg = $row['COUNT(id)'];
    $vendas_confirmadas_date = $row['created_at'];
}


// Extrair os valores corretamente dos resultados de consulta
$soma_mtd_pay = array_count_values($mtd_pay);
// Coleta os rótulos e valores dos métodos de pagamento
$mtd_labels = array_keys($soma_mtd_pay);
$mtd_valores = array_values($soma_mtd_pay);

// Monta os dados no formato adequado para o gráfico de barras
$data_barras = [
    'labels' => $mtd_labels,
    'datasets' => [
        [
            'label' => 'Frequência de Métodos de Pagamento',
            'data' => $mtd_valores,
            'backgroundColor' => ['blue', 'green', 'red', 'yellow'], // Cores das barras
            'borderColor' => ['dark'], // Cores das bordas das barras
            'borderWidth' => 1 // Largura das bordas das barras
        ]
    ]
];

// Transforma os dados em formato JSON
$json_barras = json_encode($data_barras);
// printData($json_barras);

?>

<div class="container mt-5">
    <h1>Estatísticas de Venda</h1>
    <?php if (empty($data['vendas'])) : ?>
        <br>
        <h3 class="">
            Ainda não há dados para as estatísticas. Faça uma venda agora mesmo -> <a href="?ct=main&mt=produtos_table">Aqui!</a>
        </h3>
        <button type="button"><a href="?ct=main&mt=index ">voltar</a></button>

    <?php else : ?>

        <div class="row">
            
            <div class="container col-5 mt-5 me-1 py-3 border rounded-2 border-dark">
                <!-- valor  -->
                <h3 class="text-center">Valor</h3>
                <div class="row justify-content-center">
                    <canvas id="lineChartValor" width="250" height="100" class="col-lg-6"></canvas>
                </div>
            </div>
            
            
            <div class="container col-5 mt-5 py-3 border rounded-2 border-dark">
                <!-- quantidade  -->
                <h3 class="text-center">Quantidade</h3>
                <div class="row justify-content-center">
                    <canvas id="lineChartB" width="250" height="100" class="col-lg-6"></canvas>
                </div>
                
            </div>
            
        </div>

        <div class=" my-3">
            <hr>
        </div>

        
        <div class="row my-3 p-2 border rounded-3 border-dark">

            <h3 class="text-center">Valor</h3>
            <div class="row justify-content-center">
                <canvas id="graficoMultiEixo" width="250" height="100" class="col-lg-6"></canvas>
            </div>
        </div>
            
        <div class=" my-3">
            <hr>
        </div>

        <div class="row border rounded-3 border-dark">

            <div class="container col-6 py-3 " style="border-right: solid; border-width: 1px; border-color: white; border-radius: 15px;">
                <!-- mtd_pay -->
                <h3 class="text-center">Método de pagamento</h3>
                <div class="row justify-content-center">
                    <canvas id="graficoBarras" width="250" height="100" class="col-lg-6"></canvas>
                </div>
            </div>


            <div class="container col-6 py-3 " style="border-left: solid; border-width: 1px; border-color: white; border-radius: 15px;">
                <!-- sts_pay -->
                <h3 class="text-center">Vendas confirmadas X não confirmadas</h3>
                <div class="row justify-content-center">
                    <canvas class="my-2" id="doughnut-chart" height="320" class="col-lg-6"></canvas>
                </div>
            </div>

        </div>

</div>


</div>
<?php endif; ?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    //colocar o charts e as infos do banco IMPORTANTE


    var ctx = document.getElementById('graficoMultiEixo').getContext('2d');

    // Cria o gráfico de linha com múltiplos eixos
    var graficoMultiEixo = new Chart(ctx, {
        type: 'line', // Tipo de gráfico de linha
        data: {
            labels: <?= json_encode($labels); ?>,
            datasets: [{
                label: 'Valor',
                data: <?= json_encode($valor); ?>,
                borderColor: 'red', // Cor da linha do dataset de valores
                backgroundColor: 'rgba(255, 0, 0, 0.2)', // Cor da área abaixo da linha do dataset de valores
                yAxisID: 'y-valor' // ID do eixo Y para os valores
            }, {
                label: 'Quantidade',
                data: <?= json_encode($quantidade); ?>,
                borderColor: 'blue', // Cor da linha do dataset de quantidades
                backgroundColor: 'rgba(0, 0, 255, 0.2)', // Cor da área abaixo da linha do dataset de quantidades
                yAxisID: 'y-quantidade' // ID do eixo Y para as quantidades
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },
                yAxes: [{
                    id: 'y-valor', // ID do eixo Y para os valores
                    type: 'linear',
                    position: 'left', // Posição do eixo Y para os valores
                }, {
                    id: 'y-quantidade', // ID do eixo Y para as quantidades
                    type: 'linear',
                    position: 'right', // Posição do eixo Y para as quantidades
                }]
            }
        }
    });



    var ctxValor = document.getElementById('lineChartValor').getContext('2d');
    var myChartValor = new Chart(ctxValor, {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Valor',
                data: <?= json_encode($valor) ?>,
                backgroundColor: 'coral', // Cor da área abaixo da linha
                borderColor: 'red', // Cor da linha
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false,
                    ticks: {
                        font: {
                            size: 13 // Tamanho da fonte
                        },
                        color: 'white'
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 13 // Tamanho da fonte
                        },
                        color: 'white'
                    }
                }
            }
        }
    });

    /* ============================      QUANTIDADE      ========================================== */
    var ctxQuantidade = document.getElementById('lineChartB').getContext('2d');
    var myChartQuantidade = new Chart(ctxQuantidade, {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Quantidade',
                data: <?= json_encode($quantidade) ?>,
                backgroundColor: 'aquamarine', // Cor da área abaixo da linha
                borderColor: 'blue', // Cor da linha
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false,
                    ticks: {
                        font: {
                            size: 13 // Tamanho da fonte
                        },
                        color: 'white'
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 13 // Tamanho da fonte
                        },
                        color: 'white'
                    }
                }
            }
        }
    });

    /* ============================      MÉTODO DE PAGAMENTO      ========================================== */
    var ctx = document.getElementById('graficoBarras').getContext('2d');

    // Cria o gráfico de barras
    var graficoBarras = new Chart(ctx, {
        type: 'bar', // Tipo de gráfico de barras
        data: <?php echo $json_barras; ?>,
        options: {
            scales: {
                y: {
                    beginAtZero: true // Começa o eixo Y no zero
                }
            }
            // Adicione outras opções personalizadas aqui, se necessário
        }
    });

    var ctx = document.getElementById('doughnut-chart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Vendas Canceladas', 'Vendas Confirmadas'],
            datasets: [{
                label: 'Vendas',
                data: [<?= $vendas_canceladas_avg ?>, <?= $vendas_confirmadas_avg ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Gráfico de Rosca - Vendas Canceladas x Confirmadas'
                }
            }
        }
    });

    // 
</script>