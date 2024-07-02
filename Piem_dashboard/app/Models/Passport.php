<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Http\Traits\NameHasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Passport extends Model
{
    use HasFactory, HasUuids,NameHasSlug;

    protected $table = 'passports';
    protected $fillable = [
        'ktp',
        'kk',
        'akta_kelahiran',
        'ijazah',
        'surat_kawin',
        'passport',
        'status',
        'slug',
        'user_id',
        'produk_id',
    ];

    protected $dates = ['deleted_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }

    public static function bootNameHasSlug()
    {
        // static::creating(function (Model $model) {
        //     $model->slug = Str::slug($model->name);
        // });

        //with random-str
        static::creating(function (Model $model) {
            $model->slug = Str::slug(Str::random(4));
        });

    }

}
