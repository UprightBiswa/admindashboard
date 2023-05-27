<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice, $invoiceId, $subtotal;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice, $invoiceId, $subtotal)
    {
        $this->invoice = $invoice;
        $this->invoiceId = $invoiceId;
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

        $htmlContent = view('Admin.invoices.pdf',[
            'invoice' => $this->invoice,
            'invoiceId' => $this->invoiceId,
            'subtotal' => $this->subtotal,
        ])->render();

        $dompdf -> loadHtml($htmlContent);
        $dompdf ->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdfData = $dompdf->output();

        return $this->subject('invoice Email')->attachData($pdfData,'invoice.pdf', ['mime' => 'application/pdf',])->view('Admin.invoices.pdf');
        
    }
}
