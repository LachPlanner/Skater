<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Models;
use App\Models\Variant;

class ModelsWithVariantsSeeder extends Seeder
{
    public function run()
    {
        // Helper function to generate a random price
        $randomPrice = fn() => rand(0, 1) ? 150 : 200;

        // Create the board model
        $board = Models::firstOrCreate([
            'model_name' => 'Skateboard',
            'uri' => 'LayingBoardWithVariants',
        ]);

        // Create variants for board model
        $board->variants()->createMany([
            [
                'variant_name' => 'Board1',
                'variant_index' => 0,
                'image_path' => asset('images/boards/Board1.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board2',
                'variant_index' => 1,
                'image_path' => asset('images/boards/Board2.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board3',
                'variant_index' => 2,
                'image_path' => asset('images/boards/Board3.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board4',
                'variant_index' => 3,
                'image_path' => asset('images/boards/Board4.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board5',
                'variant_index' => 4,
                'image_path' => asset('images/boards/Board5.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board6',
                'variant_index' => 5,
                'image_path' => asset('images/boards/Board6.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board7',
                'variant_index' => 6,
                'image_path' => asset('images/boards/Board7.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board8',
                'variant_index' => 7,
                'image_path' => asset('images/boards/Board8.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board9',
                'variant_index' => 8,
                'image_path' => asset('images/boards/Board9.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board10',
                'variant_index' => 9,
                'image_path' => asset('images/boards/Board10.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board11',
                'variant_index' => 10,
                'image_path' => asset('images/boards/Board11.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board12',
                'variant_index' => 11,
                'image_path' => asset('images/boards/Board12.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board13',
                'variant_index' => 12,
                'image_path' => asset('images/boards/Board13.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board14',
                'variant_index' => 13,
                'image_path' => asset('images/boards/Board14.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board15',
                'variant_index' => 14,
                'image_path' => asset('images/boards/Board15.png'),
                'price' => $randomPrice(),
            ],
        ]);

        // Create the standingBoard model
        $standingBoard = Models::firstOrCreate([
            'model_name' => 'Standing Board',
            'uri' => 'standingBoardWithVariants',
        ]);

        // Create variants for standingBoard model
        $standingBoard->variants()->createMany([
            [
                'variant_name' => 'Board1',
                'variant_index' => 0,
                'image_path' => asset('images/boards/board1.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board2',
                'variant_index' => 1,
                'image_path' => asset('images/boards/board2.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board3',
                'variant_index' => 2,
                'image_path' => asset('images/boards/board3.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board4',
                'variant_index' => 3,
                'image_path' => asset('images/boards/board4.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board5',
                'variant_index' => 4,
                'image_path' => asset('images/boards/board5.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board6',
                'variant_index' => 5,
                'image_path' => asset('images/boards/board6.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board7',
                'variant_index' => 6,
                'image_path' => asset('images/boards/board7.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board8',
                'variant_index' => 7,
                'image_path' => asset('images/boards/board8.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board9',
                'variant_index' => 8,
                'image_path' => asset('images/boards/board9.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board10',
                'variant_index' => 9,
                'image_path' => asset('images/boards/board10.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board11',
                'variant_index' => 10,
                'image_path' => asset('images/boards/board11.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board12',
                'variant_index' => 11,
                'image_path' => asset('images/boards/board12.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board13',
                'variant_index' => 12,
                'image_path' => asset('images/boards/board13.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board14',
                'variant_index' => 13,
                'image_path' => asset('images/boards/board14.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Board15',
                'variant_index' => 14,
                'image_path' => asset('images/boards/board15.png'),
                'price' => $randomPrice(),
            ],
        ]);

        // Create the Truck model
        $truck = Models::firstOrCreate([
            'model_name' => 'Truck',
            'uri' => 'TruckWithVariants',
        ]);

        // Create variants for the Truck model
        $truck->variants()->createMany([
            [
                'variant_name' => 'Truck1',
                'variant_index' => 0,
                'image_path' => asset('images/trucks/truck1.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Truck2',
                'variant_index' => 1,
                'image_path' => asset('images/trucks/truck2.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Truck3',
                'variant_index' => 2,
                'image_path' => asset('images/trucks/truck3.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Truck4',
                'variant_index' => 3,
                'image_path' => asset('images/trucks/truck4.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Truck5',
                'variant_index' => 4,
                'image_path' => asset('images/trucks/truck5.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Truck6',
                'variant_index' => 5,
                'image_path' => asset('images/trucks/truck6.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Truck7',
                'variant_index' => 6,
                'image_path' => asset('images/trucks/truck7.png'),
                'price' => $randomPrice(),
            ],
        ]);

        $oneTruck = Models::firstOrCreate([
            'model_name' => 'One Truck',
            'uri' => 'OneTruckWithVariants',
        ]);
        
        // Create variants for the One Truck model
        $oneTruck->variants()->createMany([
            [
                'variant_name' => 'Truck1',
                'variant_index' => 0,
                'image_path' => asset('images/trucks/truck1.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Truck2',
                'variant_index' => 1,
                'image_path' => asset('images/trucks/truck2.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Truck3',
                'variant_index' => 2,
                'image_path' => asset('images/trucks/truck3.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Truck4',
                'variant_index' => 3,
                'image_path' => asset('images/trucks/truck4.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Truck5',
                'variant_index' => 4,
                'image_path' => asset('images/trucks/truck5.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Truck6',
                'variant_index' => 5,
                'image_path' => asset('images/trucks/truck6.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Truck7',
                'variant_index' => 6,
                'image_path' => asset('images/trucks/truck7.png'),
                'price' => $randomPrice(),
            ],
        ]);

        // Example for Wheels model
        $wheels = Models::firstOrCreate([
            'model_name' => 'Wheels',
            'uri' => 'WheelsWithVariants',
        ]);

        $wheels->variants()->createMany([
            [
                'variant_name' => 'Wheels1',
                'variant_index' => 0,
                'image_path' => asset('images/wheels/wheels1.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Wheels2',
                'variant_index' => 1,
                'image_path' => asset('images/wheels/wheels2.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Wheels3',
                'variant_index' => 2,
                'image_path' => asset('images/wheels/wheels3.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Wheels4',
                'variant_index' => 3,
                'image_path' => asset('images/wheels/wheels4.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Wheels5',
                'variant_index' => 4,
                'image_path' => asset('images/wheels/wheels5.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Wheels6',
                'variant_index' => 5,
                'image_path' => asset('images/wheels/wheels6.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Wheels7',
                'variant_index' => 6,
                'image_path' => asset('images/wheels/wheels7.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Wheels8',
                'variant_index' => 7,
                'image_path' => asset('images/wheels/wheels8.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Wheels9',
                'variant_index' => 8,
                'image_path' => asset('images/wheels/wheels9.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Wheels10',
                'variant_index' => 9,
                'image_path' => asset('images/wheels/wheels10.png'),
                'price' => $randomPrice(),
            ],
            [
                'variant_name' => 'Wheels11',
                'variant_index' => 10,
                'image_path' => asset('images/wheels/wheels11.png'),
                'price' => $randomPrice(),
            ],
        ]);

        // Create the One Wheel model
$oneWheel = Models::firstOrCreate([
    'model_name' => 'One Wheel',
    'uri' => 'OneWheelWithVariants',
]);

// Create variants for the One Wheel model
$oneWheel->variants()->createMany([
    [
        'variant_name' => 'Wheels1',
        'variant_index' => 0,
        'image_path' => asset('images/wheels/wheels1.png'),
        'price' => $randomPrice(),
    ],
    [
        'variant_name' => 'Wheels2',
        'variant_index' => 1,
        'image_path' => asset('images/wheels/wheels2.png'),
        'price' => $randomPrice(),
    ],
    [
        'variant_name' => 'Wheels3',
        'variant_index' => 2,
        'image_path' => asset('images/wheels/wheels3.png'),
        'price' => $randomPrice(),
    ],
    [
        'variant_name' => 'Wheels4',
        'variant_index' => 3,
        'image_path' => asset('images/wheels/wheels4.png'),
        'price' => $randomPrice(),
    ],
    [
        'variant_name' => 'Wheels5',
        'variant_index' => 4,
        'image_path' => asset('images/wheels/wheels5.png'),
        'price' => $randomPrice(),
    ],
    [
        'variant_name' => 'Wheels6',
        'variant_index' => 5,
        'image_path' => asset('images/wheels/wheels6.png'),
        'price' => $randomPrice(),
    ],
    [
        'variant_name' => 'Wheels7',
        'variant_index' => 6,
        'image_path' => asset('images/wheels/wheels7.png'),
        'price' => $randomPrice(),
    ],
    [
        'variant_name' => 'Wheels8',
        'variant_index' => 7,
        'image_path' => asset('images/wheels/wheels8.png'),
        'price' => $randomPrice(),
    ],
    [
        'variant_name' => 'Wheels9',
        'variant_index' => 8,
        'image_path' => asset('images/wheels/wheels9.png'),
        'price' => $randomPrice(),
    ],
    [
        'variant_name' => 'Wheels10',
        'variant_index' => 9,
        'image_path' => asset('images/wheels/wheels10.png'),
        'price' => $randomPrice(),
    ],
    [
        'variant_name' => 'Wheels11',
        'variant_index' => 10,
        'image_path' => asset('images/wheels/wheels11.png'),
        'price' => $randomPrice(),
    ],
]);
    }
}


