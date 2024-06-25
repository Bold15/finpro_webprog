<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiProductController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://your-golang-api-server:8080']);
    }

    public function index()
    {
        $response = $this->client->request('GET', '/products');
        $products = json_decode($response->getBody()->getContents());

        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $response = $this->client->request('POST', '/products', [
            'json' => [
                'name' => $request->name,
                'price' => $request->price,
            ]
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
}
