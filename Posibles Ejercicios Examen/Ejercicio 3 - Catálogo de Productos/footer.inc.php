    </main>
    <footer style="background-color: #333; color: white; padding: 20px 0; margin-top: 50px;">
        <div class="container" style="text-align: center;">
            <p>&copy; <?php echo date('Y'); ?> - Catálogo de Productos</p>
            <?php
            // Array multidimensional con días y meses en español
            $fecha_espanol = [
                'dias' => ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                'meses' => ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 
                           'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
            ];
            
            // Obtener día de la semana (0=Domingo, 6=Sábado)
            $num_dia_semana = date('w');
            // Obtener día del mes
            $dia = date('d');
            // Obtener mes (0-11, por eso restamos 1)
            $num_mes = date('n') - 1;
            // Obtener año
            $anio = date('Y');
            
            // Construir fecha en español
            $fecha_formateada = $fecha_espanol['dias'][$num_dia_semana] . ', ' . 
                               $dia . ' de ' . 
                               $fecha_espanol['meses'][$num_mes] . ' de ' . 
                               $anio;
            ?>
            <p>Catálogo actualizado el <?php echo $fecha_formateada; ?></p>
        </div>
    </footer>
</body>
</html>
