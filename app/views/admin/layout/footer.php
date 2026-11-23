<footer class="footer-bar">

    © <?= date('Y'); ?>

    Techers.

    All Rights Reserved.

</footer>


<!-- Bootstrap JS -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
</script>


<!-- Sidebar Toggle -->
<script>

document
    .getElementById('sidebarToggle')
    ?.addEventListener(
        'click',
        function () {

            document
                .getElementById('sidebar')
                .classList
                .toggle('collapsed');

        }
    );

</script>


<!-- jQuery -->
<script
    src="https://code.jquery.com/jquery-3.7.1.min.js">
</script>

<!-- Summernote Bootstrap 5 JS -->
<script
    src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js">
</script>

<!-- DataTables Core -->
<script
    src="https://cdn.datatables.net/2.3.8/js/dataTables.js">
</script>


<!-- DataTables Bootstrap 5 -->
<script
    src="https://cdn.datatables.net/2.3.8/js/dataTables.bootstrap5.js">
</script>


<!-- DataTables Buttons -->
<script
    src="https://cdn.datatables.net/buttons/3.2.6/js/dataTables.buttons.js">
</script>


<!-- Buttons Bootstrap 5 -->
<script
    src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.bootstrap5.js">
</script>


<!-- JSZip -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js">
</script>

<!-- Export Buttons -->
<script
    src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.html5.min.js">
</script>


<!-- DataTables Initialization -->
<script>

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.data-table').forEach(function (table) {

    new DataTable(table, {

        /* Disable column sorting */
        ordering: false,

        /* Enable search */
        searching: true,

        /* Enable pagination */
        paging: true,

        /* Show information */
        info: true,

        /* Default records per page */
        pageLength: 10,

        /* Records per page options */
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'All']
        ],

        /* Layout */
        layout: {

            /* Export buttons - top left */
            topStart: {
                buttons: [
                    
                    {
                        extend: 'csv',
                        text: '<i class="bi bi-filetype-csv"></i> CSV'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="bi bi-file-earmark-excel"></i> Excel'
                    }
                    
                ]
            },

            /* Search - top right */
            topEnd: 'search',

            /* Page length - bottom left */
            bottomStart: 'pageLength',

            /* Pagination - bottom right */
            bottomEnd: 'paging'

        },

        /* Action column */
        columnDefs: [
            {
                targets: -1,
                searchable: false,
                orderable: false
            }
        ]

    });

    });

});

</script>


<?= \app\core\View::section('custom_js'); ?>


</body>
</html>
