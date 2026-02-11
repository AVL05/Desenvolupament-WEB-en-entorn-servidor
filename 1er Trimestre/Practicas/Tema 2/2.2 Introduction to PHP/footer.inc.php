<?php
// Multidimensional array for Spanish translations
$spanish_date = array(
    'days' => array(
        0 => 'Domingo',
        1 => 'Lunes', 
        2 => 'Martes',
        3 => 'Miércoles',
        4 => 'Jueves',
        5 => 'Viernes',
        6 => 'Sábado'
    ),
    'months' => array(
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre'
    )
);

// Get current date components
$day_number = date('w');        // Day of week (0=Sunday, 6=Saturday)
$month_number = date('n');      // Month (1-12)
$day_of_month = date('j');      // Day of month (1-31)
$year = date('Y');              // Year

// Generate Spanish date using array access
$spanish_day = $spanish_date['days'][$day_number];
$spanish_month = $spanish_date['months'][$month_number];
$formatted_date = $spanish_day . ', ' . $day_of_month . ' de ' . $spanish_month . ' de ' . $year;
?>

<footer>
    <div class="footer-content">
        <p>&copy; <?php echo $year; ?> Mi Sitio Web. Todos los derechos reservados.</p>
        <p>Fecha actual: <?php echo $formatted_date; ?></p>
        <p>Hora actual: <?php echo date('H:i:s'); ?></p>
    </div>
</footer>

</body>
</html>