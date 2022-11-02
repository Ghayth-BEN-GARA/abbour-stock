<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Stock extends Model{
        use HasFactory;
        protected $table = 'stocks';
        protected $primaryKey = 'id_stock';
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_stock',
            'quantite_stock',
            'prix_achat_article',
            'marge_prix',
            'reference_article '
        ];

        public function getIdStockAttribute(){
            return $this->attributes['id_stock'];
        }

        public function getQuantiteStockAttribute(){
            return $this->attributes['quantite_stock'];
        }

        public function setQuantiteStockAttribute($value){
            $this->attributes['quantite_stock'] = $value;
        }

        public function getPrixAchatArticleAttribute(){
            return $this->attributes['prix_achat_article'];
        }

        public function setPrixAchatArticleAttribute($value){
            $this->attributes['prix_achat_article'] = $value;
        }

        public function getMargePrixAttribute(){
            return $this->attributes['marge_prix'];
        }

        public function setMargePrixAttribute($value){
            $this->attributes['marge_prix'] = $value;
        }

        public function getReferenceArticleAttribute(){
            return $this->attributes['reference_article'];
        }

        public function setReferenceArticleAttribute($value){
            $this->attributes['reference_article'] = $value;
        }
    }
?>
