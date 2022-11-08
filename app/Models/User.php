<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Laravel\Sanctum\HasApiTokens;

    class User extends Authenticatable{
        use HasApiTokens, HasFactory, Notifiable;
        protected $table = 'users';
        protected $primaryKey = 'id_user';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_user',
            'email',
            'password',
            'cin',
            'nom',
            'prenom',
            'genre',
            'naissance',
            'mobile',
            'adresse',
            'image',
            'type',
            'state',
            'date_creation'
        ];

        /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        protected $hidden = [
            'password',
        ];

        public function getIdUserAttribute(){
            return $this->attributes['id_user'];
        }

        public function getEmailUserAttribute(){
            return $this->attributes['email'];
        }

        public function setEmailUserAttribute($value){
            $this->attributes['email'] = $value;
        }

        public function getPasswordUserAttribute(){
            return $this->attributes['password'];
        }

        public function setPasswordUserAttribute($value){
            $this->attributes['password'] = $value;
        }

        public function getCinUserAttribute(){
            return $this->attributes['cin'];
        }

        public function setCinUserAttribute($value){
            $this->attributes['cin'] = $value;
        }

        public function getNomUserAttribute(){
            return $this->attributes['nom'];
        }

        public function setNomUserAttribute($value){
            $this->attributes['nom'] = $value;
        }

        public function getPrenomUserAttribute(){
            return $this->attributes['prenom'];
        }

        public function setPrenomUserAttribute($value){
            $this->attributes['prenom'] = $value;
        }

        public function getGenreUserAttribute(){
            return $this->attributes['genre'];
        }

        public function setGenreUserAttribute($value){
            $this->attributes['genre'] = $value;
        }

        public function getNaissanceUserAttribute(){
            return $this->attributes['naissance'];
        }

        public function setNaissanceUserAttribute($value){
            $this->attributes['naissance'] = $value;
        }

        public function getMobileUserAttribute(){
            return $this->attributes['mobile'];
        }

        public function setMobileUserAttribute($value){
            $this->attributes['mobile'] = $value;
        }

        public function getAdresseUserAttribute(){
            return $this->attributes['adresse'];
        }

        public function setAdresseUserAttribute($value){
            $this->attributes['adresse'] = $value;
        }

        public function getImageUserAttribute(){
            return $this->attributes['image'];
        }

        public function setImageUserAttribute($value){
            $this->attributes['image'] = $value;
        }

        public function getTypeUserAttribute(){
            return $this->attributes['type'];
        }

        public function setTypeUserAttribute($value){
            $this->attributes['type'] = $value;
        }

        public function getStateUserAttribute(){
            return $this->attributes['state'];
        }

        public function setStateUserAttribute($value){
            $this->attributes['state'] = $value;
        }

        public function getDateCreationUserAttribute(){
            return $this->attributes['date_creation'];
        }

        public function getFullNameUserAttribute(){
            return $this->getPrenomUserAttribute()." ".$this->getNomUserAttribute();
        }

        public function getFormattedMobileUserAttribute(){
            return substr($this->getMobileUserAttribute(), 0, 2)." ".substr($this->getMobileUserAttribute(), 2, 3)." ".substr($this->getMobileUserAttribute(), 5, 3);
        }

        public function getFormattedCinUserAttribute(){
            return substr($this->getCinUserAttribute(), 0, 3)." ".substr($this->getCinUserAttribute(), 3, 3)." ".substr($this->getCinUserAttribute(), 6, 2);
        }
    }
?>
