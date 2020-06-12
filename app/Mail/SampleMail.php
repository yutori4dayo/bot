<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SampleMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $datas;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($parameter)
    {
        $this->datas = $parameter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->view('mail')
                  ->from('admin@aoriunten.net')
                  ->subject('ツイッタートレンド')
                  ->with([
                      'datas' => $this->datas,
                    ]);
    }
}
