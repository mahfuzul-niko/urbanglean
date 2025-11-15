<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'address',
        'is_wholeseller',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Custom code
    public static function getPermissionGroupsForAdminHealperRole()
    {
      $permissionGroups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
      return $permissionGroups;
    }
    public static function permissionsByGroupNameForAdminHealperRole($groupname)
    {
      $permissions = DB::table('permissions')->where('group_name', $groupname)->orderBy('name', 'asc')->get();
      return $permissions;
    }

    public static function checkPermission($permissionName) {
        if(Auth::user()->can($permissionName) || Auth::user()->type == 'admin') {
            return true;
        }
      }
  
      public static function checkMultiplePermission($permissionName) {
        if(Auth::user()->hasAnyPermission($permissionName) || Auth::user()->type == 'admin') {
            return true;
        }
      }
    /* SMS API */
    public static function containsUnicode($text) {
        return strlen($text) !== mb_strlen($text, 'UTF-8');
    }

    private static function getUrlContent($url) {
        $parts = parse_url($url);
        $host = $parts['host'];
        $ch = curl_init();
        $header = array('GET /1575051 HTTP/1.1',
            "Host: {$host}",
            'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language:en-US,en;q=0.8',
            'Cache-Control:max-age=0',
            'Connection:keep-alive',
            'Host:adfoc.us',
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36',
        );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public static function send_sms($number, $msg) {

        $number = preg_replace('#[ -]+#', '', $number);
        $number = preg_replace('#[=]+#', '', $number);
        if(strlen($number)==10 || strlen($number)==13){
            $number = "0".$number;
        }

        $msg = str_replace("<br>","\n",$msg);
        $msg = str_replace(" ","+",$msg);
        $msg = strip_tags($msg);

        // new sms
        $userName = env('SMS_USER_NAME');
        $apiKey = env('SMS_API_KEY');
        $senderName = env('SMS_SENDER_ID');
        $to = '88'.$number;
        $url = "https://api.mimsms.com/api/SmsSending/Send?UserName=$userName&Apikey=$apiKey&MobileNumber=$to&SenderName=$senderName&TransactionType=T&Message=$msg";

        $response = self::getUrlContent($url);
        $response = json_decode($response, true);

        return $response;

     }



}
