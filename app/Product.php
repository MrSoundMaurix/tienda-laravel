<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'products';
    public $timestamps = true;
    protected $dates = ['created_at','updated_at'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = ['name','description','description_details','price','popilarity','category_id','foto','fototype','created_at','updated_at'];

    protected $hidden = ['id'];


    public function category(){ 
        # Un producto pertenece a una categoria
        return $this->belongsTo(Category::class);
    }

    public function getImages(){
        # Un producto tiene muchas imagenes
        return $this->hasMany(ProductImage::class);
    }

    # Accessor para mostrar una imagen destacada
    public function getFeaturedImageUrlAttribute(){

        $featuredImage = $this->getImages()->where('featured', true)->first();
         
        # Si no tiene imagen destacada, toma la primera imagen del producto
        if(!$featuredImage)
            $featuredImage = $this->getImages()->first();
    
        if($featuredImage)
            return $featuredImage->url;

        return '/images/products/default.png';
    }

    public function getCategoryNameAttribute(){
        
        if($this->category)
            return $this->category->name;
        return 'General';
    }

}
