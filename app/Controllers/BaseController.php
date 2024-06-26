<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\User\UserModel;
use App\Models\Product\Variants;
use App\Models\Product\VariantOption;
use App\Models\Product\Product;
use App\Models\Product\Keywords;
use App\Models\Product\ProductImages;
use App\Models\Product\ProductKeyword;
use App\Models\Product\ProductVariant;
use App\Models\User\Otp;
use App\Controllers\UserAuth\EmailController;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $userModel;
    protected $variantModel;
    protected $variantOptionModel;
    protected $otpModel;
    protected $session;
    protected $validation;
    protected $encrypter;
    protected $pager;
    protected $emailController;
    protected $productModel;
    protected $keywordModel;
    protected $productImagesModel;
    protected $productKeywordModel;
    protected $productVariantModel;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        $this->session         = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->encrypter = \Config\Services::encrypter();
        $this->pager = \Config\Services::pager();
        $this->userModel = new UserModel();
        $this->variantModel = new Variants();
        $this->variantOptionModel = new VariantOption();
        $this->otpModel = new Otp();
        $this->emailController = new EmailController();
        $this->productModel = new Product();
        $this->keywordModel = new Keywords();
        $this->productImagesModel = new ProductImages();
        $this->productKeywordModel = new ProductKeyword();
        $this->productVariantModel = new ProductVariant();
        // Preload any models, libraries, etc, here.
    }
}
