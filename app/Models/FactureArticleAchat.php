<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class FactureArticleAchat extends Model{
        use HasFactory;
        protected $table = 'factures_articles_achats';
        protected $primaryKey = 'id_facture_article_achat';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_facture_article_achat',
            'quantite_article',
            'prix_unitaire',
            'reference_article',
            'reference_facture'
        ];

        public function getIdFactureArticleAchatAttribute(){
            return $this->attributes['id_facture_article_achat'];
        }

        public function getQuantiteArticleAttribute(){
            return $this->attributes['quantite_article'];
        }

        public function setQuantiteArticleAttribute($value){
            $this->attributes['quantite_article'] = $value;
        }

        public function getPrixUnitaireArticleAttribute(){
            return $this->attributes['prix_unitaire'];
        }

        public function setPrixUnitaireArticleAttribute($value){
            $this->attributes['prix_unitaire'] = $value;
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
