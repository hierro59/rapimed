@php           
    for ($sc=0; $sc < count($score_customers); $sc++) { 
        
            echo '<tr>
                    <td>
                        <div class="d-flex">
                            <img src="thumbnail/profile/' . $score_customers[$sc]['paciente_avatar'] . '" alt="" class="img-2 mr-3">
                            <div>
                                
                                <h6 class="fs-16 mb-1"><a href="' . route('users.show', ($score_customers[$sc]['role'] != "Customer" ? $score_customers[$sc]['paciente_id'] : $score_customers[$sc]['specialist_user_id'])) . '" class="text-black">' . ($score_customers[$sc]['role'] != "Customer" ? $score_customers[$sc]['paciente_name'] : $score_customers[$sc]['specialist_name']) . '</a></h6>
                                <small class="text-muted">Fecha: ' . $score_customers[$sc]['score_customers_date'] . '</small><br>
                                <small class="text-muted">Cita  #' . $score_customers[$sc]['cita_id'] . '</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <p class="fs-14 mb-1">Comentario</p>
                            <span class="text-primary font-w600 mb-auto">' . $score_customers[$sc]['score_customers_commit'] . '</span>
                        </div>
                    </td>
                    <td>
                        <div>
                            <p class="fs-14 mb-1">Calificación</p>
                            <span class="font-w600 mb-2 d-block text-nowrap"><i class="fa-solid fa-heart';
                        if ($score_customers[$sc]['score_customers'] < 0) {
                            echo '-crack';
                        } else {
                            echo '';
                        }
                        echo        '" style="color:'; 
                        if ($score_customers[$sc]['score_customers'] < 0) {
                            echo 'black';
                        } else {
                            echo 'red';
                        }
                        echo '"></i> ' . $score_customers[$sc]['score_customers'] . '</span>
                        </div>
                    </td>
                </tr>';
    }
@endphp