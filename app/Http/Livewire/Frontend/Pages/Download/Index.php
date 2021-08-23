<?php

namespace App\Http\Livewire\Frontend\Pages\Download;

use App\Mail\ProductFileDownload;
use App\Model\ContactProduct;
use App\Model\Country;
use App\Model\PaymentType;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    public $product, $countries, $name, $email, $countryId, $phoneNo, $shipping = 1, $siteKey, $message, $quantity = 1;
    public $captcha = 0, $confirm = 0, $paymentTypes, $paymentType;

    public function increment()
    {
        $this->quantity++;
    }

    public function decrement()
    {
        $this->quantity--;
        if ($this->quantity < 1) {
            $this->quantity = 1;
        }
    }

    public function updateQuantity()
    {
        $this->quantity < 1 ? $this->quantity = 1 : $this->quantity;
    }

    public function mount($product)
    {
        $this->product = $product;
        $this->countries = Cache::rememberForever('countries', function () {
            return Country::get();
        });
        $this->paymentTypes = PaymentType::get();
    }

    public function setShipping($value)
    {
        $this->shipping = $value;
    }

    public function submit()
    {
        $this->confirm = !$this->confirm;
    }

    public function confirm()
    {
        $this->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|email|max:255',
//            'phoneNo' => 'required|numeric|max:9999999999',
//            'countryId' => 'nullable|numeric',
            'quantity' => 'required|numeric|max:999999999',
        ]);
        $unitPrice = $this->product->price;
        $contactProduct = ContactProduct::create([
            'user_id' => auth('web')->user()->id,
            'quantity' => $this->quantity,
            'shipping' => $this->shipping,
            'unit_price' => $unitPrice,
            'product_id' => $this->product->id,
            // 'payment_type_id' => $this->paymentType,
            'payment_type_id' => 1,
        ]);
        $data = [
            'name' => auth('web')->user()->fullname,
            'email' => auth('web')->user()->email,
            'phoneNo' => auth('web')->user()->phone_no,
            'productName' => $this->product->name,
            'message' => $this->message,
        ];
        //        Mail::to($user->email)->queue(new ProductFileDownload($data));
        if ($this->paymentType === 1) {
            $moreUsers = [
                'kiran_bhakta@yahoo.com', 'deltacreation@gmail.com', 'noreply@deltacreation.com.np'
            ];
            Mail::to('noreply@b2bglobalhub.com')
//            ->cc($moreUsers)
                ->
                queue(new ProductFileDownload($data));
        }
        $message = 'Thank you for ordering this product!';
        $this->resetInput();
        session()->flash('success', $message);
//        return redirect()->route('product.show', $this->product->slug);
    }

    public function paymentType($id = 1)
    {
        $this->paymentType = $id;
    }

    public function resetInput()
    {
        $this->quantity = 1;
        $this->confirm = 0;
    }

    public function render()
    {
        return view('livewire.frontend.pages.download.index');
    }
}
