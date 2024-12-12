<footer class="footer">
    <div class="container-fluid d-flex justify-content-between">
        <div class="copyright">
            2024, made with <i class="fa fa-heart heart text-danger"></i> by
            <a href="https://github.com/SulthanRaghib">SulthanRaghib</a>
        </div>
    </div>
</footer>
</div>
</div>
<!--   Core JS Files   -->
<script src="{{ url('assets-dashboard/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ url('assets-dashboard/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


<!-- jQuery Sparkline -->
<script src="{{ url('assets-dashboard/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ url('assets-dashboard/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ url('assets-dashboard/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ url('assets-dashboard/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ url('assets-dashboard/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ url('assets-dashboard/js/plugin/jsvectormap/world.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ url('assets-dashboard/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Kaiadmin JS -->
<script src="{{ url('assets-dashboard/js/kaiadmin.min.js') }}"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{ url('assets-dashboard/js/setting-demo.js') }}"></script>
<script src="{{ url('assets-dashboard/js/demo.js') }}"></script>
<script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
    });
</script>
</body>

</html>
