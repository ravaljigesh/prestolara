<?php

namespace App\Classes;

use App\Objects\Order;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class Factory
{
    public static $instance;

    protected $order;

    protected $meta;

    protected $meta_lang;

    protected $cart;

    protected $affiliate;

    protected $address;

    protected $product;

    protected $customer;

    protected $customer_group;

    protected $stock_available;

    protected $queue;

    protected $session;

    protected $context;

    protected $affiliate_withdraw_details;

    protected $affiliate_referrals;

    protected $affiliate_bonus;

    protected $customer_checkout_information;

    protected $authorize;

    protected $customer_payment_profile;

    protected $product_shop;

    protected $carrier;

    protected $order_process;

    protected $ccavenue;

    protected $recommendation;

    protected $product_presenter;

    public function __get($property)
    {
        $property = explode('_', $property);
        if (count($property)) {
          $new_property = '';
          foreach ($property as $prop) {
            $new_property .= ucfirst($prop);
          }
          $property = $new_property;
        }
        $method = 'get'.ucfirst($property); // getStatus
        if (method_exists($this, $method)) {
          return $this->$method();
        }
    }

    public function getOrder()
    {
        return $this->order = new \App\Objects\Order;
    }

    public static function getFactory($force = false)
    {
        if (!isset(self::$instance) || $force) {
          self::$instance = new Factory();
        }

        return self::$instance;
    }

    public function validateFields(array $datas)
    {
        foreach ($datas as $d => $data) {
            if (Input::get($d) == '') {
                return $this->json('error', 'Please supply <u>'.$data . '</u>', true, $d);
            } else {
                $da = str_replace('-', '_', $d);
                $fields[$da] = Input::get($d);
            }
        }
        return (object) $fields;
    }

    public function getCore()
    {
        return $this->core = new \App\Classes\Core;
    }

    /**
     * Get the value of Meta
     *
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta = new \App\Objects\Meta;
    }

    /**
     * Get the value of Meta Lang
     *
     * @return mixed
     */
    public function getMetaLang()
    {
        return $this->meta_lang = new \App\Objects\MetaLang;
    }

    /**
     * Get the value of Cart
     *
     * @return mixed
     */
    public function getCart()
    {
        $context = \Context::getContext();
        if (isset($context->cart->id) && $context->cart->id) {
          return $this->cart = \App\Objects\Cart::find($context->cart->id);
        } else {
          return $this->cart = new \App\Objects\Cart;
        }
    }

    /**
     * Get the value of Affiliate
     *
     * @return mixed
     */
    public function getAffiliate()
    {
        $context = \Context::getContext();
        $this->affiliate = new \App\Objects\Affiliate;

        if (isset($context->customer->id) && $context->customer->id) {
          $this->affiliate = $this->affiliate->find($context->customer->id);
        }

        return $this->affiliate;
    }

    /**
     * Get the value of Address
     *
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address = new \App\Objects\Address;
    }

    /**
     * Get the value of Affiliate Withdraw
     *
     * @return mixed
     */
    public function getAffiliateWithdraw()
    {
        return $this->affiliate_withdraw = new \App\Objects\AffiliateWithdraw;
    }

    /**
     * Get the value of Customer
     *
     * @return mixed
     */
    public function getCustomer()
    {
        $this->customer = new \App\Objects\Customer;
        if (isset(\Context::getContext()->customer->id) && \Context::getContext()->customer->id) {
          $this->customer = $this->customer->find(\Context::getContext()->customer->id);
        }
        return $this->customer;
    }

    /**
     * Get the value of Customer Group
     *
     * @return mixed
     */
    public function getCustomerGroup()
    {
        return $this->customer_group = new \App\Objects\CustomerGroup;
    }

    /**
     * Get the value of Queue
     *
     * @return mixed
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * Get the value of Session
     *
     * @return mixed
     */
    public function getSession()
    {
        return $this->session = new \Symfony\Component\HttpFoundation\Session\Session;
    }

    /**
     * Get the value of Context
     *
     * @return mixed
     */
    public function getContext()
    {
        return $this->context = \Context::getContext();
    }

    /**
     * Get the value of Affiliate Withdraw Details
     *
     * @return mixed
     */
    public function getAffiliateWithdrawDetails()
    {
        return $this->affiliate_withdraw_details = new \App\Objects\AffiliateWithdrawDetails;
    }

    /**
     * Get the value of Instance
     *
     * @return mixed
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * Get the value of Affiliate Referrals
     *
     * @return mixed
     */
    public function getAffiliateReferrals()
    {
        return $this->affiliate_referrals = new \App\Objects\AffiliateReferrals;
    }


    /**
     * Get the value of Affiliate Bonus
     *
     * @return mixed
     */
    public function getAffiliateBonus()
    {
        return $this->affiliate_bonus = new \App\Objects\AffiliateBonus;
    }


    /**
     * Get the value of Customer Checkout Information
     *
     * @return mixed
     */
    public function getCustomerCheckoutInformation()
    {
        return $this->customer_checkout_information = new \App\Objects\CustomerCheckoutInformation;
    }


    /**
     * Get the value of Authorize
     *
     * @return mixed
     */
    public function getAuthorize()
    {
        require _PS_ROOT_DIR_ . '/modules/itinnovator_authorizenet/authorize.php';
        return $this->authorize = new \Authorize;
    }


    /**
     * Get the value of Customer Payment Profile
     *
     * @return mixed
     */
    public function getCustomerPaymentProfile()
    {
        return $this->customer_payment_profile = new \App\Objects\CustomerPaymentProfile;
    }


    /**
     * Get the value of Product
     *
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product = new \App\Objects\Product;
    }


    /**
     * Get the value of Stock Available
     *
     * @return mixed
     */
    public function getStockAvailable()
    {
        return $this->stock_available = new \App\Objects\StockAvailable;
    }


    /**
     * Get the value of Product Shop
     *
     * @return mixed
     */
    public function getProductShop()
    {
        return $this->product_shop = new \App\Objects\ProductShop;
    }


    /**
     * Get the value of Carrier
     *
     * @return mixed
     */
    public function getCarrier()
    {
        return $this->carrier = new \App\Objects\Carrier;
    }


    /**
     * Get the value of Order Process
     *
     * @return mixed
     */
    public function getOrderProcess()
    {
        return $this->order_process = new \App\Classes\OrderProcess;
    }


    /**
     * Get the value of Ccavenue
     *
     * @return mixed
     */
    public function getCcavenue()
    {
        return $this->ccavenue = new \App\Classes\CCAvenue;
    }


    /**
     * Get the value of Recommendation
     *
     * @return mixed
     */
    public function getRecommendation()
    {
        return $this->recommendation = new \App\Objects\Recommendation;
    }


    /**
     * Get the value of Product Presenter
     *
     * @return mixed
     */
    public function getProductPresenter()
    {
        return $this->product_presenter = new \App\Classes\ProductPresenter;
    }

}
