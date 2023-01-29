<?php

use App\Models\User;




User::updated('email_verified_at', date('Y-m-d'))->where('id', '=', 1);
