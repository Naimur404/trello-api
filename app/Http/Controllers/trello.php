<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class trello extends Controller
{
public function test(Request $request){
$requestTokenUrl = "https://trello.com/1/OAuthGetRequestToken";
$authorizeUrl = "https://trello.com/1/OAuthAuthorizeToken";
$callback = "http://127.0.0.1:8000/";
$oauthTimestamp = time();

Session::put('consumerkey', $request->apikey);
Session::put('consumerSecret', $request->apisecret);

$nonce = md5(mt_rand());
$oauthSignatureMethod = "HMAC-SHA1";
$oauthVersion = "1.0";

$sigBase = "GET&" . rawurlencode($requestTokenUrl) . "&"
    . rawurlencode("oauth_consumer_key=" . rawurlencode(Session::get('consumerkey'))
    . "&oauth_nonce=" . rawurlencode($nonce)
    . "&oauth_signature_method=" . rawurlencode($oauthSignatureMethod)
    . "&oauth_timestamp=" . $oauthTimestamp
    . "&oauth_version=" . $oauthVersion);

$sigKey = Session::get('consumerSecret') . "&";
$oauthSig = base64_encode(hash_hmac("sha1", $sigBase, $sigKey, true));
$requestUrl = $requestTokenUrl . "?"
    . "oauth_consumer_key=" . rawurlencode(Session::get('consumerkey'))
    . "&oauth_nonce=" . rawurlencode($nonce)
    . "&oauth_signature_method=" . rawurlencode($oauthSignatureMethod)
    . "&oauth_timestamp=" . rawurlencode($oauthTimestamp)
    . "&oauth_version=" . rawurlencode($oauthVersion)
    . "&oauth_signature=" . rawurlencode($oauthSig);


    $headers = get_headers($requestUrl, 1);
    if ($headers[0] == 'HTTP/1.1 200 OK') {
        $response = file_get_contents($requestUrl, false);
        $scope = 'read,write,account';
        $expiration = '1hour';
        parse_str($response, $values);
        Session::put('requestTokenSecret', $values["oauth_token_secret"]);
        Session::put('requestToken', $values["oauth_token"]);
        // $_SESSION["requestToken"] = $values["oauth_token"];
        // $_SESSION["requestToken"] = $values["oauth_token_secret"];
        $redirectUrl = $authorizeUrl . "?"
            . "&oauth_token=" . Session::get('requestToken')
            . "&scope=" . $scope
            ."&expiration=" . $expiration;

     return response()->json(['status' => 'sucess', 'msg' => "Oauth Authorize Sucessfull",'url'=>$redirectUrl]);
        }

else{
    return response()->json(['status' => 'error', 'msg' => "Authentication Faild.Please Enter Valid  coordinates"]);
}


}












public function token(Request $request){



 $oauthVerifier = $request->token_api;
$con = Session::get('consumerkey');

$token = Session::get('requestToken');
$nonce = md5(mt_rand());
$timestamp = time();

$oauth_signature_base = 'GET&'.
rawurlencode('https://trello.com/1/OAuthGetAccessToken').'&'.
rawurlencode(implode('&',[
    'oauth_consumer_key='.rawurlencode($con),
    'oauth_nonce='.rawurlencode($nonce),
    'oauth_signature_method='.rawurlencode('HMAC-SHA1'),
    'oauth_timestamp='.rawurlencode($timestamp),
    'oauth_token='.rawurlencode($token),
    'oauth_verifier='.rawurlencode($oauthVerifier),
    'oauth_version='.rawurlencode('1.0')
    ]));

$sigKey = Session::get('consumerSecret') . "&" . Session::get('requestTokenSecret');
$signature = base64_encode(hash_hmac('sha1',$oauth_signature_base,$sigKey,true));

$params = [
'oauth_consumer_key='.rawurlencode($con),
'oauth_nonce='.rawurlencode($nonce),
'oauth_signature_method='.rawurlencode('HMAC-SHA1'),
'oauth_timestamp='.rawurlencode($timestamp),
'oauth_token='.rawurlencode($token),
'oauth_verifier='.rawurlencode($oauthVerifier),
'oauth_version='.rawurlencode('1.0'),
'oauth_signature='.rawurlencode($signature)
];

 $url = sprintf('%s?%s','https://trello.com/1/OAuthGetAccessToken',implode('&',$params));




$response = file_get_contents($url);

parse_str($response, $values);

Session::put('oauth_access_token',$values['oauth_token']);

$key = Session::get('consumerkey');
        $token = Session::get('oauth_access_token');
        $data = Http::get('https://api.trello.com/1/members/me/organizations?key='.$key.'&token='.$token)->json();
        $data= collect($data);
        Session::put('orgid',$data[0]['id']);

return response()->json(['status' => 'sucess', 'msg' => "Api Access Sucessfull"]);







    }
    public function getboard(){
        $token = Session::get('oauth_access_token');
        $key = Session::get('consumerkey');
        $orgid = Session::get('orgid');
        $list = Http::get('https://api.trello.com/1/organizations/'.$orgid.'/boards?key='.$key.'&token='. $token)->json();
        $list = collect($list);
        return view('board',['list'=>$list]);

    }
    public function boarddelete(Request $request ,$id){
        $token = Session::get('oauth_access_token');
        $key = Session::get('consumerkey');
        $url = 'https://api.trello.com/1/boards/'.$id.'?key='.$key.'&token='.$token;
        $response = Http::delete($url);
        if($response){
         return redirect('/board');
        }


    }
    public function createboardview(){

         return view('createboard');



    }
    public function createboard(Request $request){
        $name = $request->name;
        $desc = $request->desc;
        $token = Session::get('oauth_access_token');
        $key = Session::get('consumerkey');
        $url = 'https://api.trello.com/1/boards/?name='.$name.'&key='.$key.'&token='.$token.'&desc='.$desc;
        $response = Http::post($url);
        if($response){
         return redirect('/board');
        }


    }
    public function editview($id){

        $token = Session::get('oauth_access_token');
        $key = Session::get('consumerkey');

        $url = 'https://api.trello.com/1/boards/'.$id.'?key='.$key.'&token='.$token;

        $response = Http::get($url);
        if($response){
         return view('editboard',['data'=>$response]);
        }


    }
    public function updateboard(Request $request,$id){
        $name = $request->name;
        $desc = $request->desc;
        $token = Session::get('oauth_access_token');
        $key = Session::get('consumerkey');

        $url = 'https://api.trello.com/1/boards/'.$id.'?name='.$name.'&key='.$key.'&token='.$token.'&desc='.$desc;

        $response = Http::put($url);
        if($response){
            return redirect('/board');
        }


    }
    public function getboadlist(Request $request,$id){

        $token = Session::get('oauth_access_token');
        $key = Session::get('consumerkey');

        $url = 'https://api.trello.com/1/boards/'.$id.'/lists?key='.$key.'&token='.$token;

        $response = Http::get($url)->json();
        $response = collect($response);
        if($response){
         return view('boardlist',compact('response','id'));
        }


    }
    public function createlistview($id){

        return view('createlist',compact('id'));



   }
   public function addlist(Request $request){



        $name = $request->name;
        $id = $request->id;
        $token = Session::get('oauth_access_token');
        $key = Session::get('consumerkey');

        $url = 'https://api.trello.com/1/lists?name='.$name.'&idBoard='.$id.'&key='.$key.'&token='.$token;

        $response = Http::post($url);
        if($response){
            return redirect('/getboadlist/'.$id);
        }

}
public function getcardlist(Request $request,$id){

    $token = Session::get('oauth_access_token');
    $key = Session::get('consumerkey');

    $url = 'https://api.trello.com/1/lists/'.$id.'/cards?key='.$key.'&token='.$token;

    $response = Http::get($url)->json();
    $response = collect($response);

    if($response){
     return view('cardlist',compact('response'));
    }


}
public function addcardview($id){

return view('addcard',compact('id'));


}
public function addcard(Request $request){
    $name = $request->name;
    $desc = $request->desc;
    $id = $request->id;
    $token = Session::get('oauth_access_token');
    $key = Session::get('consumerkey');
    $url = 'https://api.trello.com/1/cards?idList='.$id.'&key='.$key.'&token='.$token.'&name='.$name.'&desc='.$desc;
    $response = Http::post($url);
    if($response){
     return redirect('/getcardlist/'.$id);
    }


}

}

