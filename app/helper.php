<?php

use App\Models\Category;
use App\Models\Colors;
use App\Models\Variation;
use App\Models\ProductStocks;
use App\Models\Page;
use App\Models\Setting;
use Rakibhstu\Banglanumber\NumberToBangla;

/*
|--------------------------------------------------------------------------
| Auth Helpers
|--------------------------------------------------------------------------
*/
if (!function_exists('user')) {
    function user()
    {
        if (session()->has('user')) {
            return session('user');
        }

        if ($user = auth()->user()) {
            session(['user' => $user]);
            return $user;
        }

        return null;
    }
}

/*
|--------------------------------------------------------------------------
| Order Helpers
|--------------------------------------------------------------------------
*/
if (!function_exists('order_status')) {
    function order_status($order_status = 'pending')
    {
        return match ($order_status) {
            'pending' => 'primary',
            'processing' => 'dark',
            'shipped' => 'warning',
            'delivered' => 'success',
            'canceled' => 'danger',
            default => 'secondary',
        };
    }
}

/*
|--------------------------------------------------------------------------
| Image Helpers
|--------------------------------------------------------------------------
*/
if (!function_exists('admin_image')) {
    function admin_image($image)
    {
        return ($image && file_exists(public_path("images/admin/{$image}")))
            ? asset("images/admin/{$image}")
            : asset("images/admin.jpg");
    }
}

if (!function_exists('brand_image')) {
    function brand_image($image)
    {
        return ($image && file_exists(public_path("images/brand/{$image}")))
            ? asset("images/brand/{$image}")
            : asset("images/brand.png");
    }
}

if (!function_exists('category_image')) {
    function category_image($image)
    {
        return ($image && file_exists(public_path("images/category/{$image}")))
            ? asset("images/category/{$image}")
            : asset("images/category.jpeg");
    }
}

/*
|--------------------------------------------------------------------------
| Category & Business Helpers
|--------------------------------------------------------------------------
*/
if (!function_exists('featured_categories')) {
    function featured_categories()
    {
        return Category::where([
            'is_menu_active' => 1,
            'is_active' => 1
        ])
            ->orderBy('menu_position', 'ASC')
            ->limit(8)
            ->get();
    }
}

if (!function_exists('all_cateegories')) {
    function all_cateegories()
    {
        return Category::orderBy('title')->get(['id', 'title']);
    }
}

if (!function_exists('business_info')) {
    function business_info()
    {
        return Setting::find(1);
    }
}

/*
|--------------------------------------------------------------------------
| Product / Variation Helpers
|--------------------------------------------------------------------------
*/
if (!function_exists('color_info')) {
    function color_info($id)
    {
        return Colors::find($id);
    }
}

if (!function_exists('variation_info')) {
    function variation_info($id)
    {
        return Variation::find($id);
    }
}

if (!function_exists('single_variation_info')) {
    function single_variation_info($variant_id, $product_id)
    {
        return ProductStocks::where([
            'variant' => $variant_id,
            'product_id' => $product_id,
            'is_active' => 1
        ])
            ->get(['id', 'variant', 'variant_output']);
    }
}

if (!function_exists('variation_stock_info')) {
    function variation_stock_info($id)
    {
        return ProductStocks::find($id);
    }
}

/*
|--------------------------------------------------------------------------
| Page Helpers
|--------------------------------------------------------------------------
*/
if (!function_exists('other_pages')) {
    function other_pages()
    {
        return Page::whereNotIn('id', [9, 10])->get(['id', 'name']);
    }
}

/*
|--------------------------------------------------------------------------
| Bangla Number & Currency Helpers
|--------------------------------------------------------------------------
*/
if (!function_exists('bnConv')) {
    function bnConv($type = 'bnNum', $number = 0)
    {
        $numto = new NumberToBangla();

        if (session('locale') === 'bn') {
            return match ($type) {
                'bnNum' => $numto->bnNum($number),
                'bnWord' => $numto->bnWord($number),
                'bnMoney' => '৳' . number_format($number, 2),
                default => $number,
            };
        }

        return $number;
    }
}

if (!function_exists('__currency')) {
    function __currency()
    {
        return session('locale') === 'bn' ? '৳' : 'Tk';
    }
}

if (!function_exists('__translate')) {
    function __translate($en, $bn = null)
    {
        return session('locale') === 'bn' ? ($bn ?? $en) : $en;
    }
}

/*
|--------------------------------------------------------------------------
| Utility Helpers
|--------------------------------------------------------------------------
*/
if (!function_exists('humanReadableFilesize')) {
    function humanReadableFilesize($bytes, $decimals = 2)
    {
        $sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . $sizes[$factor];
    }
}

if (!function_exists('get_youtube_video_id')) {
    function get_youtube_video_id($url, $key = 'v')
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        return $query[$key] ?? null;
    }
}
