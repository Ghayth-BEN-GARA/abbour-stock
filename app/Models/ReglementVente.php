<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class ReglementVente extends Model{
        use HasFactory;
        protected $table = 'reglements_ventes';
        protected $primaryKey = 'id_reglement_vente';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_reglement_vente',
            'somme_reglement_vente',
            'account_reglement_vente',
            'remise_totale_vente',
            'date_reglement_vente',
            'type_reglement_vente',
            'reference_facture_vente',
            'matricule_client'
        ];

        public function getIdReglementVenteAttribute(){
            return $this->attributes['id_reglement_vente'];
        }

        public function getSommeReglementVenteAttribute(){
            return $this->attributes['somme_reglement_vente'];
        }

        public function setSommeReglementVenteAttribute($value){
            $this->attributes['somme_reglement_vente'] = $value;
        }

        public function getAccountReglementVenteAttribute(){
            return $this->attributes['account_reglement_vente'];
        }

        public function setAccountReglementVenteAttribute($value){
            $this->attributes['account_reglement_vente'] = $value;
        }

        public function getRemiseReglementVenteAttribute(){
            return $this->attributes['remise_totale_vente'];
        }

        public function setRemiseReglementVenteAttribute($value){
            $this->attributes['remise_totale_vente'] = $value;
        }

        public function getDateReglementVenteAttribute(){
            return $this->attributes['date_reglement_vente'];
        }

        public function setDateReglementVenteAttribute($value){
            $this->attributes['date_reglement_vente'] = $value;
        }

        public function getTypeReglementVenteAttribute(){
            return $this->attributes['type_reglement_vente'];
        }

        public function setTypeReglementVenteAttribute($value){
            $this->attributes['type_reglement_vente'] = $value;
        }

        public function getReferenceFactureVenteAttribute(){
            return $this->attributes['reference_facture_vente'];
        }

        public function setReferenceFactureVenteAttribute($value){
            $this->attributes['reference_facture_vente'] = $value;
        }

        public function getMatriculeClientAttribute(){
            return $this->attributes['matricule_client'];
        }

        public function setMatriculeClientAttribute($value){
            $this->attributes['matricule_client'] = $value;
        }
    }
?>
