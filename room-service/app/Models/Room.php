<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
/**
 * @OA\Schema(
 *     schema="Room",
 *     type="object",
 *     title="Room",
 *     required={"id", "name", "capacity"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Ruang Rapat"),
 *     @OA\Property(property="capacity", type="integer", example=10),
 *     @OA\Property(property="facilities", type="string", example="AC, Proyektor"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Room extends Model
{
    protected $fillable = ['name', 'capacity', 'facilities'];
}
