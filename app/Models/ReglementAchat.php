<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class ReglementAchat extends Model{
        use HasFactory;
        protected $table = 'reglements_achats';
        protected $primaryKey = 'id_reglement_achat';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_reglement_achat',
            'net_reglement_achat',
            'paye_reglement_achat',
            'date_reglement_achat',
            'type_reglement_achat',
            'reference_facture_achat',
            'matricule_fournisseur'
        ];

        public function getIdReglementAchatAttribute(){
            return $this->attributes['id_reglement_achat'];
        }

        public function getNetReglementAchatAttribute(){
            return $this->attributes['net_reglement_achat'];
        }

        public function setNetReglementAchatAttribute($value){
            $this->attributes['net_reglement_achat'] = $value;
        }

        public function getPayeReglementAchatAttribute(){
            return $this->attributes['paye_reglement_achat'];
        }

        public function setPayeReglementAchatAttribute($value){
            $this->attributes['paye_reglement_achat'] = $value;
        }

        public function getDateReglementAchatAttribute(){
            return $this->attributes['date_reglement_achat'];
        }

        public function setDateReglementAchatAttribute($value){
            $this->attributes['date_reglement_achat'] = $value;
        }

        public function getTypeReglementAchatAttribute(){
            return $this->attributes['type_reglement_achat'];
        }

        public function setTypeReglementAchatAttribute($value){
            $this->attributes['type_reglement_achat'] = $value;
        }

        public function getReferenceFactureAchatAttribute(){
            return $this->attributes['reference_facture_achat'];
        }

        public function setReferenceFactureAchatAttribute($value){
            $this->attributes['reference_facture_achat'] = $value;
        }

        public function getMatriculeFournisseurAttribute(){
            return $this->attributes['matricule_fournisseur'];
        }

        public function setMatriculeFournisseurAttribute($value){
            $this->attributes['matricule_fournisseur'] = $value;
        }
    }
?>
