<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class FactureArticleVente extends Model{
        use HasFactory;
        protected $table = 'factures_articles_ventes';
        protected $primaryKey = 'id_facture_article_vente';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_facture_article_vente',
            'quantite_article',
            'remise_article',
            'reference_article',
            'reference_facture'
        ];

        public function getIdFactureArticleVenteAttribute(){
            return $this->attributes['id_facture_article_vente'];
        }

        public function getQuantiteArticleAttribute(){
            return $this->attributes['quantite_article'];
        }

        public function setQuantiteArticleAttribute($value){
            $this->attributes['quantite_article'] = $value;
        }

        public function getRemiseArticleAttribute(){
            return $this->attributes['remise_article'];
        }

        public function setRemiseArticleAttribute($value){
            $this->attributes['remise_article'] = $value;
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
