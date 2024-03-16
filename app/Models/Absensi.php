<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'jenis_absen',
        'tanggal',
        'foto_selfie',
        'status_absen',
        'keterangan',
    ];

    /**
     * Get the student that owns the absensi.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
