<?php

require_once("model/ArticleDB.php");
require_once("ViewHelper.php");

class MainController {

    public static function index() {
        echo ViewHelper::render("view/index.php", [
            "articles" => ArticleDB::getAll()
        ]);
    }

    public static function product() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];

        $data = filter_input_array(INPUT_GET, $rules);

        echo ViewHelper::render("view/product.php", [
            "article" => ArticleDB::get($data)
        ]);
    }

    public static function cart() {
        echo ViewHelper::render("view/cart.php");
    }

    public static function checkout() {
        echo ViewHelper::render("view/checkout.php");
    }

    public static function signin() {
        echo ViewHelper::render("view/signin.php");
    }

    public static function signup() {
        echo ViewHelper::render("view/signup.php");
    }

    public static function controlPanel() {
        echo ViewHelper::render("view/control-panel.php", [
            "articles" => ArticleDB::getAll()
        ]);
    }

    public static function editFrom($article = []) {
        if (empty($article)) {
            $rules = [
                "id" => [
                    "filter" => FITLER_VALIDATE_INT,
                    "options" => ["min_range" => 1]
                ]
            ];

            $data = filter_input_array(INPUT_GET, $rules);
            
            if (!self::checkValues($data)) {
                throw new InvalidArgumentException();
            }
            
            $article = ArticleDB::get($data);
        }
        
        echo ViewHelper::render("view/edit-article.php", ["article" => $article]);
    }

    public static function edit() {
        $rules = self::getRules();
        $rules["id"] = [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 1]
        ];
        
        $data = filter_input_array(INPUT_POST, $rules);

        if (self::checkValues($data)) {
            ArticleDB::update($data);
            ViewHelper::redirect(BASE_URL . "product?id=" . $data["id"]);
        } else {
            self::editForm($data);
        }
    }

    /**
     * Returns TRUE if given $input array contains no FALSE values
     * @param type $input
     * @return type
     */
    private static function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }

        return $result;
    }

    /**
     * Returns an array of filtering rules for manipulation books
     * @return type
     */
    private static function getRules() {
        return [
            'title' => FILTER_SANITIZE_SPECIAL_CHARS,
            'description' => FILTER_SANITIZE_SPECIAL_CHARS,
            'price' => FILTER_VALIDATE_FLOAT,
        ];
    }

}
