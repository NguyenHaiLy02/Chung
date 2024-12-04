<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbChungNhan extends Model
{
    use HasFactory;

    protected $table = 'tbchungnhan';
    protected $fillable = ['maNCC', 'hinhanh'];

    public function nhaCungCap()
    {
        return $this->belongsTo(TbNhaCungCap::class, 'maNCC');
    }
}
