<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;
use App\Models\MetadataUsers;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\CheckMetadataEmail;

class CheckMetadataUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:metadata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cheque metadata de usuarios y envia correo si faltan datos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $getMetadata = MetadataUsers::where('status', '=', 1)->get();
        //logger($getMetadata);
        
        for ($i=0; $i < count($getMetadata); $i++) { 
            
                if ($getMetadata[$i]['address'] == 'Sin datos') {
                    
                    $user_id = $getMetadata[$i]['customer_id'];
                    $get_email = User::select('name', 'email')->where('id', '=', $user_id)->get();
                    $user_email = $get_email[0]['email'];
                    if ($user_email == 'hierro59@gmail.com') {
                        $objData = new \stdClass();
                        $objData->sender = 'RapiMed';
                        $objData->receiver = $get_email[0]['name'];
                        Mail::to($user_email)->send(new CheckMetadataEmail($objData));
                    }
                    
                    continue;
                }
                if ($getMetadata[$i]['city'] == 'Sin datos') {
                    
                    logger($getMetadata[$i]['id'] . ' Sin dato city');
                    
                    continue;
                }
                if ($getMetadata[$i]['state'] == 'Sin datos') {
                    
                    logger($getMetadata[$i]['id'] . ' Sin dato state');
                    
                    continue;
                }
                if ($getMetadata[$i]['country'] == 'Sin datos') {
                    
                    logger($getMetadata[$i]['id'] . ' Sin dato country');
                    
                    continue;
                }
                if ($getMetadata[$i]['phone'] == 'Sin teléfono') {
                    
                    logger($getMetadata[$i]['id'] . ' Sin dato phone');
                    
                    continue;
                }
                
        }
        return Command::SUCCESS;
    }
}
