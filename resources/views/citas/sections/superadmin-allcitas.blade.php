<thead>
    <tr>
        <th>Estatus</th>
        <th>Fecha</th>
        <th>Paciente</th>
        <th>Especialista</th>
        <th>Especialidad</th>
        <th>Tipo</th>
        <th>Acción</th>
        <th>Calificación</th>
        <th></th>
    </tr>
</thead>
<tbody>
    @php
        for ($i=0; $i < count($datos); $i++) {
        echo "<tr>";
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
            echo "<td>" . $datos[$i]['specialist_name'] . "</td>";
            echo "<td>" . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . "</td>";
            echo "<td>" . $datos[$i]['specialist_specialty'] . "</td>";
            echo "<td>" . $datos[$i]['cita_tipo'] . "</td>";
            $citaid = $datos[$i]['cita_id'];
                echo "<td>";
                switch ($datos[$i]['cita_status']) {
                    case 0:
                        echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']);
                        $cancelar = array('cita' => $citaid, 'id' => $citaid, 'status' => 4);
                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                        echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                        echo Form::close();
                        break;
                    case 1:
                    case 7:
                        echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']);
                        $cancelar = array('cita' => $citaid, 'id' => $citaid, 'status' => 4);
                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                        echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                        echo Form::close();
                        break;
                    case 2:
                    case 3:
                        echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']);
                        break;
                }
                echo '</td>';
                echo '<td>
                    <i class="fa-solid fa-heart'. ($datos[$i]['score'] < (0) ? "-crack" : "") .'" style="color:'. ($datos[$i]['score'] < (0) ? "black" : "red") .'">' . (isset($datos[$i]['score']) ? $datos[$i]['score'] : " Sin calificar") . '</i>
                </td>';
         echo "</tr>";
        }
    @endphp
</tbody>