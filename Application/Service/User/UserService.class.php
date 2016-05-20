<?php
namespace Service\User;


class UserService {

  CONST SECRET_KEY = 'zcSbaM{si1F)<:Be!.7`#Wn=Tm~Yl@0O';
  CONST SALT_KEY = '8CVbvHl6ygIw4BAoKcNr53JuqOUQYz7m';
  CONST MASK_KEY = '5n2puFHOCd0IstRfGvyawLBkoSiTVe8m';

  public static function addUser($username, $password) {
    $userInfo = [
      'username' => trim($username),
      'password' => self::getPwd(md5($password)),
      'nickname' => !empty($nickname) ? trim($nickname) : '新用户' . $username,
      'salt' => self::createSalt(),
      'create_time' => time(),
    ];
    print_R($userInfo);exit();
    return D('user')->insert($userInfo);
  }

  public function login($username, $password) {
    $user = D('user')->where('username=' . $username)->find();

    if (empty($user)) {
      return [];
    }

    if (!self::checkPwd($password, $user['slat'], $user['password'])) {
      return [];
    }

    return $user;
  }

  private static checkPwd($password, $salt, $saltPassword) {
    $realPwd = self::getPwd(md5($password), $salt);
    return $saltPassword === $realPwd;
  }

  private static function createSalt() {
    return md5(self::SALT_KEY . uniqid(rand()));
  }

  private static function getPwd($pwd, $salt) {
    return md5(md5($pwd. $salt). self::SECRET_KEY);
  }

  public static function encryptSession($uid) {
    $expire = 3600 * 24; //过期时间
    $session = [
      'uid' => $uid,
      'time' => time()+$expire
    ];
    $return = json_encode($session) . '&' . md5($session);
    return base64_encode(self::mask($return));
  }

  public static function decryptSession($session) {
    $data_session = base64_decode($session);
    $data_session = self::mask($data_session);
    $arr = explode('&', $data_session);
    if(count($arr) != 2){
        return [];
    }
    $data = json_decode($arr[0], true);
    $data['raw'] = $arr[0];
    $data['sign'] = $arr[1];
    return $data;
  }

  private function mask($str){
      $DataMd5 = md5(self::MASK_KEY, true);
      $len = strlen($str);
      $result = '';
      $i = 0;
      while($i < $len){
          $j = 0;
          while($i < $len && $j < 16){
              $result .= $data[$i] ^ $DataMd5[$j];
              $i++;
              $j++;
          }
      }
      return $result;
  }


}
