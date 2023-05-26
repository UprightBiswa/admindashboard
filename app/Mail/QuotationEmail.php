<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $quotation;
    public $quotationId;
    public $subtotal;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quotation, $quotationId, $subtotal)
    {
        $this->quotation = $quotation;
        $this->quotationId = $quotationId;
        $this->subtotal = $subtotal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'Arial');

        $dompdf = new \Dompdf\Dompdf($options);

        $htmlContent = view('Admin.quotations.quotationemails', [
            'quotation' => $this->quotation,
            'quotationId' => $this->quotationId,
            'subtotal' => $this->subtotal,
        ])->render();

        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdfData = $dompdf->output();

        return $this->subject('Quotation Email')
            ->attachData($pdfData, 'quotation.pdf', [
                'mime' => 'application/pdf',
            ])
            ->view('Admin.quotations.quotationemails');
    }
}


