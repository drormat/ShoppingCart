<?php

/**
 * @property array productsList
 */
class Cart extends Eloquent
{
	protected $table = 'CartItems';
	public $timestamps = false;

	public function insertToCart($itemId,$itemName)
	{
		$cartItem = $this->where('product_id', '=', $itemId)->first();
		if($cartItem == null) {
			$this->product_id = $itemId;
			$this->name = $itemName;
			$this->amount = 1;
			$this->save();
		}
		else{
			$cartItem->amount += 1;
			$cartItem->save();

			$this->product_id = $cartItem->product_id;
			$this->name = $cartItem->name;
			$this->amount = $cartItem->amount;
		}
	}

	public function deleteItemFromCart($itemId)
	{
		$cartItem = $this->where('product_id', '=', $itemId)->first();
		if($cartItem == null) {
			return;
		}
		if($cartItem->amount == 1) {
			$cartItem->delete();

			$this->product_id = $cartItem->product_id;
			$this->name = $cartItem->name;
			$this->amount = $cartItem->amount;
		}
		else{
			$cartItem->amount -= 1;
			$cartItem->save();

			$this->product_id = $cartItem->product_id;
			$this->name = $cartItem->name;
			$this->amount = $cartItem->amount;
		}
	}

	public function deleteAllFromCart()
	{
		$this->delete();
	}
}