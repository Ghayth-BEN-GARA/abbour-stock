<?php
    namespace App\Mail;
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Mail\Mailable;
    use Illuminate\Mail\Mailables\Content;
    use Illuminate\Mail\Mailables\Envelope;
    use Illuminate\Queue\SerializesModels;

    class EnvoyerNotificationDecisionAdministrateur extends Mailable{
        use Queueable, SerializesModels;
        public $mailData;
        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct($mailData){
            $this->mailData = $mailData;
        }

        /**
         * Get the message envelope.
         *
         * @return \Illuminate\Mail\Mailables\Envelope
         */
        public function envelope(){
            return new Envelope(
                subject: "Décision de l'administrateur",
            );
        }

        /**
     * Build the message.
     *
     * @return $this
     */
        public function build(){
            return $this->subject("Décision de l'administrateur")->view('Mails.demande_modification_type');
        }

        /**
         * Get the attachments for the message.
         *
         * @return array
         */
        public function attachments(){
            return [];
        }
    }
?>
