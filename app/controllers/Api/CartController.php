<?php

class ApiCartController extends \BaseController {


    public function create()
    {
        $cartItem = new Cart();
        $itemID = Input::get('itemID');
        $itemName = Input::get('itemName');
        $cartItem->insertToCart($itemID,$itemName);

        return Response::json(array(
            'data'=>$cartItem->toArray()
        ));
    }

    public function getProductList()
    {
        $items = Cart::all();

        // Return the results as JSON data
        return Response::json(array(
            'data'=>$items->toArray(),
            'total' => count($items)
        ));
    }

    public function destroy(){
        $cartItem = new Cart();
        $itemID = Input::get('itemID');
        if($itemID == null)
        {
            $cartItem->deleteAllFromCart();
        }
        else{
            $cartItem->deleteItemFromCart($itemID);
        }


        return Response::json(array(
            'data'=>$cartItem->toArray()
        ));
    }

    public function destroyAll(){
        $cartItem = new Cart();
        $cartItem->deleteAllFromCart();

        $msg = "all item deleted from cart";
        return Response::json(array(
            'data'=>$msg->toArray()
        ));
    }

}