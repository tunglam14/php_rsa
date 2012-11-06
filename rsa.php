<?php
/*
===================================

1. Dau tien, generate 2 file public.pem va private.pem chua tuong ung public va
private key

- gen private file
openssl genrsa -des3 -out private.pem 1024
Sau do nhap chuoi 'phrase' theo yeu cau
Nho chuoi nay de con decrypt
(trong file private.pem di kem la '123456')

- gen public file
openssl rsa -in private.pem -out public.pem -outform PEM -pubout



====================================
*/

class RSA
{
    public $phrase = null;
    public $public_file = null;
    public $private_file = null;

    function __construct($puf,$prf,$ph)
    {
        $this->public_file = $puf;
        $this->private_file = $prf;
        $this->phrase = $ph;
    }
    function get_public_key()
    {
        try
        {
            $str = file_get_contents($this->public_file);
            return openssl_get_publickey($str);
        }
        catch( Exception $e)
        {
            return false;
        }
    }

    function get_private_key()
    {
        try
        {
            $str = file_get_contents($this->private_file);
            return openssl_get_privatekey(array($str,$this->phrase));
        }
        catch( Exception $e)
        {
            return false;
        }
    }

    function encrypt($data = '')
    {
        $key = $this->get_public_key();

        if(!$key)
        {
            return false;
        }
        else
        {
            openssl_public_encrypt($data,$en,$key);
            return $en;
        }
    }

    function decrypt($data = '')
    {
        $key = $this->get_private_key();

        if(!$key)
        {
            return false;
        }
        else
        {
            openssl_private_decrypt($data,$de,$key);
            return $de;
        }
    }
}

/*
- public.pem la file chua public key
- private.pem laf file chua private key
- 123456 la phrase gen private key
*/

$en = new RSA('public.pem','private.pem','123456');

# Chuoi can encrypt
$str = "taolahungxon";

$d = $en->encrypt($str);

echo "\nPlain text: ".
        $str."\n Encrypted: ".
        $d."\n Decrypted: ".
        $en->decrypt($d).
        "\n";
?>
