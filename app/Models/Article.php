<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Article extends Model{
        use HasFactory;
        protected $table = 'articles';
        protected $primaryKey = 'reference_article';
        public $timestamps = false;
        public $incrementing = false;

        protected $fillable = [
            'reference_article',
            'designation',
            'description',
            'categorie',
            'date_creation_article'
        ];

        public function getReferenceArticleAttribute(){
            return $this->attributes['reference_article'];
        }

        public function setReferenceArticleAttribute($value){
            $this->attributes['reference_article'] = $value;
        }

        public function getDesignationArticleAttribute(){
            return $this->attributes['designation'];
        }

        public function setDesignationArticleAttribute($value){
            $this->attributes['designation'] = $value;
        }

        public function getDescriptionArticleAttribute(){
            return $this->attributes['description'];
        }

        public function setDescriptionArticleAttribute($value){
            $this->attributes['description'] = $value;
        }

        public function getCategorieArticleAttribute(){
            return $this->attributes['categorie'];
        }

        public function setCategorieArticleAttribute($value){
            $this->attributes['categorie'] = $value;
        }

        public function getDateCreationArticleAttribute(){
            return $this->attributes['date_creation_article'];
        }

        public function setDateCreationArticleAttribute($value){
            $this->attributes['date_creation_article'] = $value;
        }
    }
?>
