<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class DemandeModificationType extends Model{
        use HasFactory;
        protected $table = 'demandes_modification_type';
        protected $primaryKey = 'id_demande';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_demande',
            'type_demande',
            'etat_demande',
            'date_time_demande',
            'id_user'
        ];

        public function getIdDemandeAttribute(){
            return $this->attributes['id_demande'];
        }

        public function getTypeDemandeAttribute(){
            return $this->attributes['type_demande'];
        }

        public function setTypeDemandeAttribute($value){
            $this->attributes['type_demande'] = $value;
        }

        public function getEtatDemandeAttribute(){
            return $this->attributes['etat_demande'];
        }

        public function setEtatDemandeAttribute($value){
            $this->attributes['etat_demande'] = $value;
        }

        public function getDateTimeDemandeAttribute(){
            return $this->attributes['date_time_demande'];
        }

        public function setDateTimeDemandeAttribute($value){
            $this->attributes['date_time_demande'] = $value;
        }

        public function getIdUserAttribute(){
            return $this->attributes['id_user'];
        }

        public function setIdUserAttribute($value){
            $this->attributes['id_user'] = $value;
        }
    }
?>
