<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Journal extends Model{
        use HasFactory;
        protected $table = 'journals';
        protected $primaryKey = 'id_journal';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_journal',
            'tache',
            'description',
            'date_time_tache',
            'id_user'
        ];

        public function getIdJournalAttribute(){
            return $this->attributes['id_journal'];
        }

        public function getTacheJournalAttribute(){
            return $this->attributes['tache'];
        }

        public function setTacheJournalAttribute($value){
            $this->attributes['tache'] = $value;
        }

        public function getDescriptionJournalAttribute(){
            return $this->attributes['description'];
        }

        public function setDescriptionJournalAttribute($value){
            $this->attributes['description'] = $value;
        }

        public function getDateTimeJournalAttribute(){
            return $this->attributes['date_time_tache'];
        }

        public function getIdUserAttribute(){
            return $this->attributes['id_user'];
        }

        public function setIdUserAttribute($value){
            $this->attributes['id_user'] = $value;
        }
    }
?>
