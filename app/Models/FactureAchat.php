<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class FactureAchat extends Model{
        use HasFactory;
        protected $table = 'factures_achats';
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
            'matricule_fournisseur',
            'date_facture',
            'heure_facture',
            'type_facture',
            'paiement_facture',
            'responsable_facture',
            'id_user'
        ];

        public function getReferenceFactureAttribute(){
            return $this->attributes['reference_facture'];
        }

        public function setReferenceFactureAttribute($value){
            $this->attributes['reference_facture'] = $value;
        }

        public function getMatriculeFournisseurAttribute(){
            return $this->attributes['matricule_fournisseur'];
        }

        public function setMatriculeFournisseurAttribute($value){
            $this->attributes['matricule_fournisseur'] = $value;
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

        public function getTypeFactureAttribute(){
            return $this->attributes['type_facture'];
        }

        public function setTypeFactureAttribute($value){
            $this->attributes['type_facture'] = $value;
        }

        public function getPaiementFactureAttribute(){
            return $this->attributes['paiement_facture'];
        }

        public function setPaiementFactureAttribute($value){
            $this->attributes['paiement_facture'] = $value;
        }

        public function getResponsableFactureAttribute(){
            return $this->attributes['responsable_facture'];
        }

        public function setResponsableFactureAttribute($value){
            $this->attributes['responsable_facture'] = $value;
        }

        public function getIdUserAttribute(){
            return $this->attributes['id_user'];
        }

        public function setIdUserAttribute($value){
            $this->attributes['id_user'] = $value;
        }
    }
?>
