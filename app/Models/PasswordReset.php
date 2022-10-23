<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class PasswordReset extends Model{
        use HasFactory;
        protected $table = 'password_resets';
        protected $primaryKey = 'id_password_reset';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_password_reset',
            'token',
            'id_user'
        ];

        public function getIdPasswordResetAttribute(){
            return $this->attributes['id_password_reset'];
        }

        public function getTokenAttribute(){
            return $this->attributes['token'];
        }

        public function setTokenAttribute($value){
            $this->attributes['token'] = $value;
        }

        public function getIdUserAttribute(){
            return $this->attributes['id_user'];
        }

        public function setIdUserAttribute($value){
            $this->attributes['id_user'] = $value;
        }
    }
?>
