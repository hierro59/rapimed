@php
    for ($sc=0; $sc < count($datos); $sc++) { 
        if ($datos[$sc]['score_customers'] != NULL) {
            echo '<tr>
                    <td>
                        <div class="d-flex">
                            <img src="thumbnail/profile/' . $datos[$sc]['paciente_avatar'] . '" alt="" class="img-2 mr-3">
                            <div>
                                
                                <h6 class="fs-16 mb-1"><a href="' . route('users.show', ($datos[$sc]['role'] != "Customer" ? $datos[$sc]['paciente_id'] : $datos[$sc]['specialist_user_id'])) . '" class="text-black">' . ($datos[$sc]['role'] != "Customer" ? $datos[$sc]['paciente_name'] : $datos[$sc]['specialist_name']) . '</a></h6>
                                <small class="text-muted">Fecha: ' . $datos[$sc]['score_customers_date'] . '</small><br>
                                <small class="text-muted">Cita  #' . $datos[$sc]['cita_id'] . '</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <p class="fs-14 mb-1">Comentario</p>
                            <span class="text-primary font-w600 mb-auto">' . $datos[$sc]['score_customers_commit'] . '</span>
                        </div>
                    </td>
                    <td>
                        <div>
                            <p class="fs-14 mb-1">Calificación</p>
                            <span class="font-w600 mb-2 d-block text-nowrap"><i class="fa-solid fa-heart';
                        if ($datos[$sc]['score_customers'] < 0) {
                            echo '-crack';
                        } else {
                            echo '';
                        }
                        echo        '" style="color:'; 
                        if ($datos[$sc]['score_customers'] < 0) {
                            echo 'black';
                        } else {
                            echo 'red';
                        }
                        echo '"></i> ' . $datos[$sc]['score_customers'] . '</span>
                        </div>
                    </td>
                </tr>';
        }
    }
@endphp