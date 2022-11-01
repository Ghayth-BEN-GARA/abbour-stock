<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Categorie extends Model{
        use HasFactory;
        protected $table = 'categories';
        protected $primaryKey = 'nom_categorie';
        public $timestamps = false;
        public $incrementing = false;

        protected $fillable = [
            'nom_categorie'
        ];

        public function getNomCategorieAttribute(){
            return $this->attributes['nom_categorie'];
        }

        public function setNomCategorieAttribute($value){
            $this->attributes['nom_categorie'] = $value;
        }
    }
?>
