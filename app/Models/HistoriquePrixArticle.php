<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class HistoriquePrixArticle extends Model{
        use HasFactory;
        protected $table = 'historiques_prix_articles';
        protected $primaryKey = 'id_historique_prix';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_historique_prix',
            'prix_unitaire_article',
            'date_creation_prix_article',
            'reference_article',
            'reference_facture'
        ];

        public function getIdHistoriquePrixAttribute(){
            return $this->attributes['id_historique_prix'];
        }

        public function getPrixUnitaireArticleAttribute(){
            return $this->attributes['prix_unitaire_article'];
        }

        public function setPrixUnitaireArticleAttribute($value){
            $this->attributes['prix_unitaire_article'] = $value;
        }

        public function getDateCreationPrixArticleAttribute(){
            return $this->attributes['date_creation_prix_article'];
        }

        public function setDateCreationPrixAttribute($value){
            $this->attributes['date_creation_prix_article'] = $value;
        }

        public function getReferenceArticleAttribute(){
            return $this->attributes['reference_article'];
        }

        public function setReferenceArticleAttribute($value){
            $this->attributes['reference_article'] = $value;
        }

        public function getReferenceFactureAttribute(){
            return $this->attributes['reference_facture'];
        }

        public function setReferenceFactureAttribute($value){
            $this->attributes['reference_facture'] = $value;
        }
    }
?>
