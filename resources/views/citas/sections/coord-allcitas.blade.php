<thead>
    <tr>
        <th>ID</th>
        <th>Estatus</th>
        <th>Fecha</th>
        <th>Paciente</th>
        <th>Especialista</th>
        <th>Especialidad</th>
        <th>Tipo</th>
        <th>Acción</th>
    </tr>
</thead>
<tbody>
    @php
        for ($i=0; $i < count($datos); $i++) {
        echo "<tr>";
            echo "<td>". $datos[$i]['cita_id'] . "</td>";
            echo "<td>";
            switch ($datos[$i]['cita_status']) {
                case 0:
                    echo '<span class="btn btn-warning text-nowrap btn-sm">Solicitada</span>';
                    break;
                case 1:
                case 7:
                    echo '<span class="btn btn-success text-nowrap btn-sm">Aceptada</span>';
                    break;
                case 2:
                case 3:
                    echo '<span class="btn btn-danger text-nowrap btn-sm light">Rechazada</span>';
                    break;
                case 4:
                case 5:
                case 6:
                    echo '<span class="btn btn-danger text-nowrap btn-sm">Cancelada</span>';
                    break;
                case 8:
                    echo '<span class="btn btn-info text-nowrap btn-sm">Concluida</span>';
                    break;
            }
            echo "</td>";
            echo "<td>" . strftime("%d/%m/%Y, ", strtotime($datos[$i]['cita_fecha'])) . $datos[$i]['cita_hora'] . "</td>";
            echo "<td>" . $datos[$i]['paciente_name'] . "</td>";
            echo "<td>" . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . "</td>";
            echo "<td>" . $datos[$i]['specialist_specialty'] . "</td>";
            echo "<td>" . $datos[$i]['cita_tipo'] . "</td>";
            $citaid = $datos[$i]['cita_id'];
                echo "<td>";
                switch ($datos[$i]['cita_status']) {
                    case 0:
                        echo '<a href="' . route("citas.edit", $datos[$i]['cita_id']) . '" class="btn btn-info">Reprogramar</a>';
                        $cancelar = array('cita' => $citaid, 'id' => $citaid, 'status' => 4);
                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                        echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                        echo Form::close();
                        break;
                    case 1:
                    case 7:
                        echo '<a href="' . route("citas.edit", $datos[$i]['cita_id']) . '" class="btn btn-info">Reprogramar</a>';
                        $cancelar = array('cita' => $citaid, 'id' => $citaid, 'status' => 4);
                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                        echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                        echo Form::close();
                        break;
                    case 2:
                    case 3:
                        echo '<a href="' . route("citas.edit", $datos[$i]['cita_id']) . '" class="btn btn-info">Reprogramar</a>';
                        break;
                }
                echo '</td>';
         echo "</tr>";
        }
    @endphp
</tbody>