<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     tags={"Product"},
     *     path="/api/products",
     *     @OA\Parameter(
     *      name="page",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *     @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *     @OA\Response(response="200", description="List Products.")
     * )
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $name = $input["name"] ?? "";
        $products = Product::where("name", "LIKE", "%$name%")->paginate(10);
        return response()->json($products, 200,
            ["Content-Type"=>"application/json; charset=UTF-8", "Charset"=>'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }
    public function one(Request $request){
        $input=$request->all();
        $name=$input['name']??"";
        $products=Product::where("name","LIKE","%$name%")->paginate(100);
        return response()->json($products, 200,
        ["Content-Type"=>"application/json; character=UTF-8","Charset"=>'utf-8'],
        JSON_UNESCAPED_UNICODE);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     ** path="/api/products",
     *   tags={"Product"},
     *
     *
     * @OA\RequestBody(
     *    required=true,
     *    description="Create product info",
     *    @OA\JsonContent(
     *       required={"name","detail"},
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="detail", type="string"),
     *    ),
     * ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function store(Request $request)
    {
        $input = $request->all();
        $product = Product::create($input);
        return response()->json([
            "success"=> true,
            "data"=> $product
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
