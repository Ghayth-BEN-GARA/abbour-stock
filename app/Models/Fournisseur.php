<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Fournisseur extends Model{
        use HasFactory;
        protected $table = 'fournisseurs';
        protected $primaryKey = 'matricule_fournisseur';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'matricule_fournisseur',
            'fullname_fournisseur',
            'email_fournisseur',
            'adresse_fournisseur',
            'mobile1_fournisseur',
            'mobile2_fournisseur',
            'date_creation_fournisseur'
        ];

        public function getMatriculeFournisseurAttribute(){
            return $this->attributes['matricule_fournisseur'];
        }

        public function setMatriculeFournisseurAttribute($value){
            $this->attributes['matricule_fournisseur'] = $value;
        }

        public function getFullNameFournisseurAttribute(){
            return $this->attributes['fullname_fournisseur'];
        }

        public function setFullNameFournisseurAttribute($value){
            $this->attributes['fullname_fournisseur'] = $value;
        }

        public function getEmailFournisseurAttribute(){
            return $this->attributes['email_fournisseur'];
        }

        public function setEmailFournisseurAttribute($value){
            $this->attributes['email_fournisseur'] = $value;
        }

        public function getAdresseFournisseurAttribute(){
            return $this->attributes['adresse_fournisseur'];
        }

        public function setAdresseFournisseurAttribute($value){
            $this->attributes['adresse_fournisseur'] = $value;
        }

        public function getMobile1FournisseurAttribute(){
            return $this->attributes['mobile1_fournisseur'];
        }

        public function setMobile1FournisseurAttribute($value){
            $this->attributes['mobile1_fournisseur'] = $value;
        }

        public function getMobile2FournisseurAttribute(){
            return $this->attributes['mobile2_fournisseur'];
        }

        public function setMobile2FournisseurAttribute($value){
            $this->attributes['mobile2_fournisseur'] = $value;
        }

        public function getDateCreationFournisseurAttribute(){
            return $this->attributes['date_creation_fournisseur'];
        }
    }
?>
