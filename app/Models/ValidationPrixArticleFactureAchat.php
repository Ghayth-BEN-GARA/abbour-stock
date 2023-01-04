<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class ValidationPrixArticleFactureAchat extends Model{
        use HasFactory;
        protected $table = 'validation_prix_articles_factures';
        protected $primaryKey = 'id_validation_prix_article';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_validation_prix_article',
            'new_prix_unitaire_article',
            'date_validation_new_prix_article',
            'reference_article',
            'reference_facture'
        ];

        public function getIdValidationPrixArticleAttribute(){
            return $this->attributes['id_validation_prix_article'];
        }

        public function getNewPrixArticleAttribute(){
            return $this->attributes['new_prix_unitaire_article'];
        }

        public function setNewPrixArticleAttribute($value){
            $this->attributes['new_prix_unitaire_article'] = $value;
        }

        public function getDateValidationNewPrixArticleAttribute(){
            return $this->attributes['date_validation_new_prix_article'];
        }

        public function setDateValidationNewPrixArticleAttribute($value){
            $this->attributes['date_validation_new_prix_article'] = $value;
        }

        public function getReferenceArticleAttribute(){
            return $this->attributes['reference_article'];
        }

        public function setReferenceArticleAttribute($value){
            $this->attributes['reference_article'] = $value;
        }

        public function getReferenceFactureAchatAttribute(){
            return $this->attributes['reference_facture'];
        }

        public function setReferenceFactureAchatAttribute($value){
            $this->attributes['reference_facture'] = $value;
        }
    }
?>
