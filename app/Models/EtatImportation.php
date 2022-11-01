<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class EtatImportation extends Model{
        use HasFactory;
        protected $table = 'etats_importation';
        protected $primaryKey = 'etat_importation_article';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'etat_importation_article'
        ];

        public function getEtatImportationArticleAttribute(){
            return $this->attributes['etat_importation_article'];
        }

        public function setEtatImportationArticleAttribute($value){
            $this->attributes['etat_importation_article'] = $value;
        }
    }
?>
