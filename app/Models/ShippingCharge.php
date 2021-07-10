<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShippingCharge
 *
 * @property int $ship_id
 * @property int $ord_id
 * @property int $ship_price
 * @property int $fakeId
 *
 * @property Order $order
 *
 * @package App\Models
 */
class ShippingCharge extends Model
{
    use HasFactory;

    protected $table = 'shipping_charge';
	protected $primaryKey = 'ship_id';
	public $timestamps = false;

	protected $casts = [
		'ord_id' => 'int',
		'ship_price' => 'int',
		'fakeId' => 'int'
	];

	protected $fillable = [
		'ord_id',
		'ship_price',
		'fakeId'
	];

	public function order()
	{
		return $this->belongsTo(Order::class, 'ord_id');
	}
}
