<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class EmplacementArticle extends Model{
        use HasFactory;
        protected $table = 'emplacements_articles';
        protected $primaryKey = 'id_emplacement_article';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_emplacement_article',
            'emplacement_article_creer',
            'stock_article_creer',
            'reference_article'
        ];

        public function getIdEmplacementArticleAttribute(){
            return $this->attributes['id_emplacement_article'];
        }

        public function getEmplacementArticleCreerAttribute(){
            return $this->attributes['emplacement_article_creer'];
        }

        public function setEmplacementArticleCreerAttribute($value){
            $this->attributes['emplacement_article_creer'] = $value;
        }

        public function getStockArticleCreerAttribute(){
            return $this->attributes['stock_article_creer'];
        }

        public function setStockArticleCreerAttribute($value){
            $this->attributes['stock_article_creer'] = $value;
        }

        public function getReferenceArticleAttribute(){
            return $this->attributes['reference_article'];
        }

        public function setReferenceArticleAttribute($value){
            $this->attributes['reference_article'] = $value;
        }
    }
?>
