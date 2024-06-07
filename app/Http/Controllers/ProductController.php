<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Dummy data untuk contoh
        $products = [
            [
                'name' => 'Jam Tangan A',
                'description' => 'Deskripsi singkat jam tangan A.',
                'price' => 1500000,
                'image' => 'https://via.placeholder.com/150'
            ],
            [
                'name' => 'Jam Tangan B',
                'description' => 'Deskripsi singkat jam tangan B.',
                'price' => 2000000,
                'image' => 'https://via.placeholder.com/150'
            ],
            [
                'name' => 'Jam Tangan C',
                'description' => 'Deskripsi singkat jam tangan C.',
                'price' => 2500000,
                'image' => 'https://via.placeholder.com/150'
            ],
        ];

        return view('products', compact('products'));
    }
}

