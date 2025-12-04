<?php

namespace App\Repositories\Eloquent;

use App\DTOs\BookingDataDTO;
use App\Enums\StatusEnum;
use App\Models\Booking;
use App\Models\Status;
use App\Repositories\Contracts\IBookingRepository;
use Illuminate\Database\Eloquent\Collection;

class BookingRepository implements IBookingRepository
{
    public function create(BookingDataDTO $data): Booking
    {
        $status = Status::query()
        ->firstOrCreate([
            'name' => $data->status->value,
        ]);

        return Booking::query()
        ->create([
            'user_id'   => $data->userId,
            'price'     => $data->price,
            'status_id' => $status->id,
        ]);
    }

    public function getByUserId(string $userId): Collection
    {
        return Booking::query()
            ->with('status')
            ->where('user_id', $userId)
            ->get();
    }

    public function findById(string $id): Booking
    {
        return Booking::query()->findOrFail($id);
    }

    public function delete(Booking $booking): bool
    {
        return $booking->delete();
    }

    public function markAsConfirmed(Booking $booking): Booking
    {
        $status = Status::query()->firstOrCreate([
            'name' => StatusEnum::CONFIRMED,
        ]);

        $booking->status()->associate($status);
        $booking->save();

        return $booking;
    }

    public function markAsFailed(Booking $booking): Booking
    {
        $status = Status::query()->firstOrCreate([
            'name' => StatusEnum::FAILED,
        ]);

        $booking->status()->associate($status);
        $booking->save();

        return $booking;
    }
}