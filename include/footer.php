        <hr>
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2017 Piotr 'Inferno' Grencel</p>
                </div>
            </div>
        </footer>

    </div>
    <script src="src/js/jquery.js"></script>
    <script src="src/js/bootstrap-number-input.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Rodzaj');
            data.addColumn('number', 'Liczba');
            data.addRows([
                ['Boty', 2],
                ['Użytkownicy', 25],
                ['Wolne sloty', 30]
            ]);

            // Set chart options
            var options = {
                'title': 'Liczba użytkowników na serwerze',
                'width': 450,
                'height': 300
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>

</body>

</html>