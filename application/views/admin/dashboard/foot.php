<script src="/assets/plugins/chartjs/Chart.bundle.min.js"></script>

<script type="text/javascript">
    // Page Views Config
    var config = {
        type: 'line',
        data: {
            labels: <?php echo $graph_labels ?>,
            datasets: [{
                label: 'Page Views',
                data: <?php echo $graph_data ?>,
                backgroundColor: "rgba(255,155,51,0.6)"
            }]
        }
    };

    // Popular Sermons Config.
    var pop_sermons_config = {
        type: 'pie',
        data: {
            datasets: [{
                data: <?php echo $top_sermons_graph_data; ?>,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                label: 'Most Popular Sermons'
            }],
            labels: <?php echo $top_sermons_graph_label; ?>
        },
        options: {
            responsive: true
        }
    };

    // Top Books by Number of Sermons Config.
    var top_books_config = {
        type: 'pie',
        data: {
            datasets: [{
                data: <?php echo $top_books_graph_data; ?>,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                label: 'Top Books by Number of Sermons'
            }],
            labels: <?php echo $top_books_graph_label; ?>
        },
        options: {
            responsive: true
        }
    };

    window.onload = function () {
        // Set the pageviews chart.
        var ctx = document.getElementById("pageviews").getContext("2d");
        window.myLine = new Chart(ctx, config);
        // Set the popular sermons pie chart.
        var ctx = document.getElementById("popularsermons").getContext("2d");
        window.myLine = new Chart(ctx, pop_sermons_config);
        // Set the top books by number of sermons pie chart.
        var ctx = document.getElementById("topbooks").getContext("2d");
        window.myLine = new Chart(ctx, top_books_config);
    };


</script>
