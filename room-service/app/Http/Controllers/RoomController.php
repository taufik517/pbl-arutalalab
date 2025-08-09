<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

/**
 * @OA\Get(
 *     path="/api/rooms",
 *     summary="Get all rooms",
 *     tags={"Rooms"},
 *     @OA\Response(
 *         response=200,
 *         description="List of rooms",
 *         @OA\JsonContent(type="array", @OA\Items())

 *     )
 * )
 */
class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return response()->json($rooms);
    }

    /**
     * @OA\Post(
     *     path="/api/rooms",
     *     summary="Create a new room",
     *     tags={"Rooms"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "capacity"},
     *             @OA\Property(property="name", type="string", example="Ruang Rapat"),
     *             @OA\Property(property="capacity", type="integer", example=10),
     *             @OA\Property(property="facilities", type="string", example="AC, Proyektor")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Room created",
     *         @OA\JsonContent(ref="#/components/schemas/Room")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:0',
            'facilities' => 'nullable|string',
        ]);

        $room = Room::create($validated);
        return response()->json($room, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/rooms/{id}",
     *     summary="Get room by ID",
     *     tags={"Rooms"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Room detail",
     *         @OA\JsonContent(ref="#/components/schemas/Room")
     *     )
     * )
     */
    public function show(Room $room)
    {
        return response()->json($room);
    }

    /**
     * @OA\Put(
     *     path="/api/rooms/{id}",
     *     summary="Update room",
     *     tags={"Rooms"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Ruang Rapat Update"),
     *             @OA\Property(property="capacity", type="integer", example=12),
     *             @OA\Property(property="facilities", type="string", example="AC, Proyektor, Wifi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Room updated",
     *         @OA\JsonContent(ref="#/components/schemas/Room")
     *     )
     * )
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'capacity' => 'sometimes|required|integer|min:0',
            'facilities' => 'sometimes|nullable|string',
        ]);

        $room->update($validated);
        return response()->json($room, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/rooms/{id}",
     *     summary="Delete room",
     *     tags={"Rooms"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Room deleted"
     *     )
     * )
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(null, 204);
    }
}