<canvas id="columnChart"></canvas>
<script src="{{ asset('js/chart.min.js') }}"></script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
      var ctx = document.getElementById('columnChart').getContext('2d');
      var myChart = new Chart(ctx, {
         type: 'bar',
         data: {
            labels: ['Columna 1'],
            datasets: [{
               label: 'Valores',
               data: [10],
               backgroundColor: 'rgba(75, 192, 192, 0.2)',
               borderColor: 'rgba(75, 192, 192, 1)',
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
   });
</script>
