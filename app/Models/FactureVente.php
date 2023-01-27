<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class FactureVente extends Model{
        use HasFactory;
        protected $table = 'factures_ventes';
        protected $primaryKey = 'reference_facture';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'reference_facture',
            'date_facture',
            'heure_facture',
            'livraison_facture',
            'id_user',
            'matricule_client'
        ];

        public function getReferenceFactureAttribute(){
            return $this->attributes['reference_facture'];
        }

        public function getDateFactureAttribute(){
            return $this->attributes['date_facture'];
        }

        public function setDateFactureAttribute($value){
            $this->attributes['date_facture'] = $value;
        }

        public function getHeureFactureAttribute(){
            return $this->attributes['heure_facture'];
        }

        public function setHeureFactureAttribute($value){
            $this->attributes['heure_facture'] = $value;
        }

        public function getLivraisonFactureAttribute(){
            return $this->attributes['livraison_facture'];
        }

        public function setLivraisonFactureAttribute($value){
            $this->attributes['livraison_facture'] = $value;
        }

        public function getIdUserAttribute(){
            return $this->attributes['id_user'];
        }

        public function setIdUserAttribute($value){
            $this->attributes['id_user'] = $value;
        }

        public function getMatriculeClientAttribute(){
            return $this->attributes['matricule_client'];
        }

        public function setMatriculeClientAttribute($value){
            $this->attributes['matricule_client'] = $value;
        }
    }
?>
