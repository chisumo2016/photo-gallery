  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/summernote.min.js"></script>
<!--  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>-->

  <script src="js/scripts.js"></script>

  <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
          var data = google.visualization.arrayToDataTable([
              ['Task', 'Hours per Day'],
              ['Visitors',       <?php       echo    $session->count;?>],
              ['Comments',        <?php       echo    Comment::count_all();?>],
              ['Users',         <?php       echo    User::count_all();?>],
              ['Photos',      <?php       echo    Photo::count_all();?>]


          ]);

          var options = {
              legend:'none',
              pieSliceText: 'label',
              title: 'My Daily Activities',
              backgroundColor:'transparent',
              is3D: true,
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
          chart.draw(data, options);
      }
  </script>
</body>

</html>
