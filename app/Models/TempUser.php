<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class TempUser extends Model{
        use HasFactory;
        protected $table = 'temp_users';
        protected $primaryKey = 'id_temp_users';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_temp_users',
            'email',
            'password',
            'nom',
            'prenom',
            'date_creation'
        ];

        public function getIdTempUsersAttribute(){
            return $this->attributes['id_temp_users'];
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

        public function getDateCreationUserAttribute(){
            return $this->attributes['date_creation'];
        }
    }
?>
