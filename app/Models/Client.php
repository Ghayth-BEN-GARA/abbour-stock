<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Client extends Model{
        use HasFactory;
        protected $table = 'clients';
        protected $primaryKey = 'matricule_client';
        public $timestamps = false;
        public $incrementing = false;

        protected $fillable = [
            'matricule_client',
            'nom_client',
            'prenom_client',
            'email_client',
            'adresse_client',
            'mobile_client',
            'date_creation_client'
        ];

        public function getMatriculeClientAttribute(){
            return $this->attributes['matricule_client'];
        }

        public function setMatriculeClientAttribute($value){
            $this->attributes['matricule_client'] = $value;
        }

        public function getNomClientAttribute(){
            return $this->attributes['nom_client'];
        }

        public function setNomClientAttribute($value){
            $this->attributes['nom_client'] = $value;
        }

        public function getPrenomClientAttribute(){
            return $this->attributes['prenom_client'];
        }

        public function setPrenomClientAttribute($value){
            $this->attributes['prenom_client'] = $value;
        }

        public function getEmailClientAttribute(){
            return $this->attributes['email_client'];
        }

        public function setEmailClientAttribute($value){
            $this->attributes['email_client'] = $value;
        }

        public function getAdresseClientAttribute(){
            return $this->attributes['adresse_client'];
        }

        public function setAdresseClientAttribute($value){
            $this->attributes['adresse_client'] = $value;
        }

        public function getMobileClientAttribute(){
            return $this->attributes['mobile_client'];
        }

        public function setMobileClientAttribute($value){
            $this->attributes['mobile_client'] = $value;
        }

        public function getDateCreationClientAttribute(){
            return $this->attributes['date_creation_client'];
        }

        public function getFullNameClientAttribute(){
            $this->getPrenomClientAttribute()." ".$this->getNomClientAttribute();
        }
    }
?>
