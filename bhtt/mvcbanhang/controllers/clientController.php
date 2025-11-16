<?php
require_once "./../models/productModel.php";
require_once "./../models/categoryModel.php";
class clientController
{
    private $modelProduct;
    private $modelCategory;

    public function __construct()
    {
        $this->modelProduct = new productModel();
        $this->modelCategory = new categoryModel();
    }

    // Hiển thị chi tiết sản phẩm
    public function productDetail()
    {
        $productId = $_GET['id'];
        echo $productId;
        $$newsDetail = $this->modelProduct->findById($productId);
        $category = $this->modelCategory->getAll();
        if ($product) {
            include './../views/client/tintuc_detail.php';
        } else {
            echo 'Không tìm thấy sản phẩm!';
        }
    }

    public function index()
    {
        // Hiển thị sản phẩm nổi bật
        $products = $this->modelProduct->getFeaturedProducts(6);
        // Hiển thị danh mục
        $category = $this->modelCategory->getAll();
        include "./../views/client/layout.php";
    }

    public function findCategory()
    {
        // tạo 1 biến gán id của category
        $categoryId = $_GET['category_id'];
        // Hiển thị danh mục
        $category = $this->modelCategory->getAll();
        // Lấy tên danh mục
        $findByCat = $this->modelCategory->findById($categoryId);
        // Hiển danh sản phẩm theo danh mục
        $products = $this->modelCategory->getProductByCat($categoryId);
        include "./../views/client/findCategory.php";
    }

    // Tìm kiếm sản phẩm
    public function search() {
        $search = $_GET['search'];
        $products = $this->modelProduct->search($search);
        $category = $this->modelCategory->getAll();
        include "./../views/client/search.php";
    }

    public function logout()
    {
        session_start();
        if (isset($_SESSION['client']) && $_SESSION['client']) {
            unset($_SESSION['client']);
            header("Location: ./client.php");
        }
    }

    // Phương thức hiển thị giỏ hàng
    public function cart()
    {
        // Lấy danh mục để hiển thị trên header
        $category = $this->modelCategory->getAll();
        // Giỏ hàng được lưu trong session
        $cart = $_SESSION['cart'] ?? [];
        include './../views/client/cart.php';
    }

    // Phương thức thêm sản phẩm vào giỏ hàng
    public function addToCart()
    {
        $productId = $_GET['id'];
        $quantity = 1; // Mặc định thêm 1 sản phẩm

        $product = $this->modelProduct->findById($productId);

        if ($product) {
            // Khởi tạo giỏ hàng nếu chưa có
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
            if (array_key_exists($productId, $_SESSION['cart'])) {
                $_SESSION['cart'][$productId]['quantity'] += $quantity;
            } else {
                // Thêm sản phẩm mới vào giỏ hàng
                $_SESSION['cart'][$productId] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'quantity' => $quantity
                ];
            }
        }
        header('Location: ./client.php?controller=client&action=cart.phpphp');
    }

    // Phương thức cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantities'])) {
            foreach ($_POST['quantities'] as $productId => $quantity) {
                $productId = (int) $productId;
                $quantity = (int) $quantity;

                if (isset($_SESSION['cart'][$productId])) {
                    if ($quantity > 0) {
                        $_SESSION['cart'][$productId]['quantity'] = $quantity;
                    } else {
                        // Nếu số lượng là 0 hoặc âm, xóa sản phẩm khỏi giỏ hàng
                        unset($_SESSION['cart'][$productId]);
                    }
                }
            }
        }
        header('Location: ./client.php?controller=client&action=cart');
    }

    // Phương thức xóa sản phẩm khỏi giỏ hàng
    public function removeCartItem()
    {
        $productId = $_GET['id'];
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
        header('Location: ./client.php?controller=client&action=cart');
    }
}
