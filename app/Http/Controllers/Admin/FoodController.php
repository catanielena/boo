<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Food;
use Illuminate\Support\Facades\Storage;
use \NumberFormatter;

class FoodController extends Controller
{

    protected $validationRules = [
        'name' => 'string |required | max:50',
        'image' => 'mimes:jpeg,png,jpg,gif,svg | nullable | max:1000 ',
        'description' => 'string | nullable | max:255',
        'allergens' => 'string | nullable | max:100',
        'price' => 'required',
        'weight' => 'string  |numeric| nullable| max:999',
        'visible' => 'required|boolean'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Food $food)
    {
        return view('admin.foods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules);
        $form_data=$request->all();
        
        // image
        if(array_key_exists('image', $form_data)) {
            $image_path = Storage::put('foods', $form_data['image']);
            $form_data['image'] = $image_path;
        }
        // $form_data['price'] = $this->formatPriceIt($form_data['price']);
        $newFood = new Food ();
        $newFood->fill($form_data);
        
        $newFood->user_id = Auth::id();
        
        $newFood->save();

        return redirect()->route("admin.home");
        // ->with('success',"Il post è stato creato") da aggiungere dopo boot
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        if( $food->user_id != Auth::id() ) {
            abort("403");
        }

        return view("admin.foods.show", compact("food"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        if( $food->user_id != Auth::id() ) {
            abort("403");
        }
        return view('admin.foods.edit', compact("food"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {

        if( $food->user_id != Auth::id() ) {
            abort("403");
        }

        // validations
        $request->validate($this->validationRules);
        $form_data=$request->all();
        
        // image
        if(array_key_exists('image', $form_data)) {
            if($food->image) {
                Storage::delete($food->image);
            }
            $image_path = Storage::put('foods', $form_data['image']);
            $form_data['image'] = $image_path;
        }

        $food->fill($form_data);
        $food->save();
        return redirect(route('admin.home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $food = Food::find($request->id);
        // if( $food->user_id != Auth::id() ) {
        //     abort("403");
        // }

        Storage::delete($food->image);
        if (!is_null($food)) {
            $food->delete();
        }
        return redirect()->route("admin.home");
        // ->with('success',"Il post {$post->id} è stato eliminato") da aggiungere 
    }
}
